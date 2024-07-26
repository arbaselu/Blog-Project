<?php

function sanitize($txt){
    $txt = htmlspecialchars($txt);
    $txt = trim($txt);
    $txt = stripslashes($txt);

    return $txt;
}

function logError($message, $file, $line) {
    $logFile ='logs/error_log.txt'; // Update the path to point to logs directory
    $currentDateTime = date('Y-m-d H:i:s');
    $errorMessage = "[$currentDateTime] Error in $file at line $line: $message" . PHP_EOL;
    file_put_contents($logFile, $errorMessage, FILE_APPEND);
}



function clearSessionErrors() {
    $errorKeys = ['fullNameError', 'emailError', 'usernameError', 'passwordError', 'confirmPasswordError','emailCheck','titleError','contentError'];
    foreach ($errorKeys as $key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}

function isEmailTaken($email, $connect) {
    $sql = "SELECT email FROM users WHERE email = :email";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }
    return false;
}

function isUsernameTaken($username, $connect) {
    $sql = "SELECT username FROM users WHERE username = :username";
    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }
    return false;
}

// adds security functions for passwords eg: checking at least one number, special character, etc