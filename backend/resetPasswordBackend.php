<?php
session_start();
require_once 'config.php';
require_once 'helper.php';

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === 'admin') {
    clearSessionErrors();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $newPassword = trim($_POST['newPassword']);
        $confirmPassword = trim($_POST['confirmPassword']);

        if (empty($newPassword)) {
            $_SESSION['newPasswordError'] = "Enter a password";
        } else if (strlen($newPassword) < 8) {
            $_SESSION['newPasswordError'] = "The password must have at least 8 characters!";
        }

        if (empty($confirmPassword)) {
            $_SESSION['confirmPasswordError'] = "Enter a password to confirm";
        } else if ($newPassword !== $confirmPassword) {
            $_SESSION['confirmPasswordError'] = "Passwords do not match!";
        }

        if (empty($_SESSION['newPasswordError']) && empty($_SESSION['confirmPasswordError'])) {
            $sql = "UPDATE users SET password = :password WHERE username = :username";
            if ($stmt = $connect->prepare($sql)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':username', $_SESSION['username']);
                if ($stmt->execute()) {
                    header("Location: ../user.php");
                    die();
                } else {
                    logError("Failed to execute password update statement", __FILE__, __LINE__);
                    header("Location: error.php");
                    die();
                }
                $stmt = null;
            } else {
                logError("Failed to prepare SQL statement for password update", __FILE__, __LINE__);
                header("Location: error.php");
                die();
            }
        }
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = sanitize($_POST['email']);
        if (empty($email) || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $_SESSION['emailError'] = "Enter a valid email";
            header('Location: ../resetPassword.php');
            die();
        }

        if (isEmailTaken($email, $connect)) {
            $FromEmail = 'arbaselum10@gmail.com';
            $FromName = "Arbaselu Mario";
            $subject = 'Reset Password';

            $token = bin2hex(random_bytes(32));
            $expiry = time() + 3600;

            $stmt = $connect->prepare("UPDATE users SET reset_token = :reset_token, reset_token_expiry = :reset_token_expiry WHERE email = :email");
            $stmt->bindParam(':reset_token', $token);
            $stmt->bindParam(':reset_token_expiry', $expiry);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                $resetLink = "http://localhost/Blog/resetPasswordToken/reset_password_token.php?token=" . $token;
                include '../resetPasswordToken/resetPasswordEmail.php';
                include '../emails/sent.php';

                $_SESSION['emailCheck'] = "A reset email has been sent to your address!";
                header('Location: ../resetPassword.php');
                exit();
            } else {
                logError("Failed to execute reset token update statement", __FILE__, __LINE__);
                header("Location: error.php");
                die();
            }
        } else {
            $_SESSION['emailError'] = "There is no account associated with this email!";
            header('Location: ../resetPassword.php');
            exit();
        }
    }
}

$connect = null;
?>
