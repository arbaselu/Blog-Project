<?php
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("Location: ./user.php");
    die; 
}

require_once 'config.php';
require_once 'helper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    clearSessionErrors();

    $fullName = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $username = sanitize($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if (empty($fullName)) {
        $_SESSION['fullNameError'] = "Enter a name";
    }
    if (empty($email) || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $_SESSION['emailError'] = "Enter a valid email";
    } else if (isEmailTaken($email, $connect)) {
        $_SESSION['emailError'] = "There is already an account associated with this email!";
    }

    if (empty($username)) {
        $_SESSION['usernameError'] = "Enter a username";
    } else if (isUsernameTaken($username, $connect)) {
        $_SESSION['usernameError'] = "Username already exists!";
    }

    if (empty($password)) {
        $_SESSION['passwordError'] = "Enter a password";
    } else if (strlen($password) < 8) {
        $_SESSION['passwordError'] = "The password must have at least 8 characters!";
    }

    if (empty($confirmPassword)) {
        $_SESSION['confirmPasswordError'] = "Enter a password to confirm";
    } else if ($password != $confirmPassword) {
        $_SESSION['confirmPasswordError'] = "Passwords do not match!";
    }

    if (empty($_SESSION['fullNameError']) && empty($_SESSION['emailError']) && empty($_SESSION['usernameError']) && empty($_SESSION['passwordError']) && empty($_SESSION['confirmPasswordError'])) {
        $sql = "INSERT INTO users (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)";
        if ($stmt = $connect->prepare($sql)) {
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
            if ($stmt->execute()) {
                $userId = $connect->lastInsertId();

                $sql = "SELECT * FROM users WHERE id = :id";
                if ($stmt = $connect->prepare($sql)) {
                    $stmt->bindParam(':id', $userId);
                    if ($stmt->execute()) {
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        $_SESSION["autentificat"] = true;
                        $_SESSION["id"] = $user['id'];
                        $_SESSION["fullName"] = $user['full_name'];
                        $_SESSION["username"] = $user['username'];
                        $_SESSION["email_user"] = $user['email'];
                        $_SESSION['role_user'] = $user['role_user'];
                           
                        header("Location: user.php");
                        exit();
                    } else {
                        logError("An unexpected error occurred while retrieving user data", __FILE__, __LINE__);
                        header("Location: error.php");
                        exit();
                    }
                }
            } else {
                logError("An unexpected error occurred while inserting the user", __FILE__, __LINE__);
                header("Location: error.php");
                exit();
            }
        } else {
            logError("Failed to prepare SQL statement for user insertion", __FILE__, __LINE__);
            header("Location: error.php");
            exit();
        }
        $stmt = null;
    }
}

$connect = null;
?>


