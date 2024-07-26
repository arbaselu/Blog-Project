<?php
require_once 'config.php';
require_once 'helper.php';

$emailError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_newsletter'])) {

    $FromEmail = 'arbaselum10@gmail.com';
    $FromName = "Arbaselu Mario";
    $subject = 'Welcome to Mario\'s Blog';

    $email = sanitize($_POST["email_newsletter"]);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Check if the email already exists in the database
        $sql = "SELECT email FROM newsletter WHERE email = :email";
        if ($stmt = $connect->prepare($sql)) {
            $stmt->bindParam(':email', $email);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    header('location: ../index.php');
                    exit();
                }
            } else {
                logError("Failed to execute email check query.", __FILE__, __LINE__);
                
            }
        } else {
            logError("Failed to prepare email check query.", __FILE__, __LINE__);
            
        }

        // If no errors, insert the email into the database
        if (empty($emailError)) {
            $sql = "INSERT INTO newsletter (email) VALUES (:email)";
            if ($stmt = $connect->prepare($sql)) {
                $stmt->bindParam(':email', $email);
                if ($stmt->execute()) {
                    include '../newsletter.php'; // Include content for newsletter
                    include '../emails/sent.php'; // Send welcome email
                    header('location: ../index.php');
                    exit();
                } else {
                    logError("Failed to execute email insert query.", __FILE__, __LINE__);         
                }
            } else {
                logError("Failed to prepare email insert query.", __FILE__, __LINE__);
                
            }
        }
    }
}

?>
