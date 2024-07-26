<?php
// If the user is already authenticated, redirect to the user page
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("Location: ./user.php");
    die; 
}

require_once 'config.php';
require_once 'helper.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Clear session errors
    clearSessionErrors();

    // Sanitize and validate input
    $username = sanitize($_POST['username']);
    $password = trim($_POST['password']);

    // Validate username
    if (empty($username)) {
        $_SESSION['usernameError'] = "Enter a username"; 
    } else if (!isUsernameTaken($username, $connect)) { 
        $_SESSION['usernameError'] = "Username does not exist!";
        header('location: login.php');
        die();
    }  

    // Validate password
    if (empty($password)) {
        $_SESSION['passwordError'] = "Enter a password";
    } else if (strlen($password) < 8) {
        $_SESSION['passwordError'] = "The password must have at least 8 characters!";
    }

    // If there are no validation errors, proceed with authentication
    if (empty($_SESSION['usernameError']) && empty($_SESSION['passwordError'])) {
        $sql = "SELECT id, full_name, username, password, role_user FROM users WHERE username = :username";
        if ($stmt = $connect->prepare($sql)) {
            $stmt->bindParam(":username", $username);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) { // If a row with that username exists
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $user["password"])) { 
                        $_SESSION["authenticated"] = true; 
                        $_SESSION["id"] = $user['id']; 
                        $_SESSION["fullName"] = $user['full_name'];
                        $_SESSION["username"] = $user['username']; 
                        $_SESSION["role_user"] = $user['role_user']; 
                        
                        header("Location: ./user.php"); 
                        exit();
                    } else {
                        $_SESSION['passwordError'] = "Wrong password. Try again or click Forgot password to reset it.";
                    }
                } else {
                    $_SESSION['usernameError'] = "Couldn't find your account";
                }
            } else {
                logError("Failed to execute query.", __FILE__, __LINE__);
                header("Location: error.php");
            }
            $stmt = null; // Close the statement
        } else {
            logError("Failed to prepare query.", __FILE__, __LINE__);
            header("Location: error.php");
        }
    }
} 


$connect = null; // Close the database connection
?>
