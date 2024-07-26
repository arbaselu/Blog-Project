<?php
ob_start(); // Start output buffering to capture the HTML content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
 
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <!-- Main container for the email content -->
        <h2 style="text-align: center; color: #333;">Reset Password</h2>
        <p style="text-align: center; color: #666;">You have requested a password reset. Please click the button below to reset your password.</p>
        <div style="text-align: center; margin: 20px 0;">
            <!-- Reset password link -->
            <a href="<?php echo htmlspecialchars($resetLink); ?>" style="display: inline-block; padding: 10px 20px; background-color: #ff5a5f; color: #fff; text-decoration: none; border-radius: 5px;">Reset Password</a>
        </div>
        <p style="text-align: center; color: #666;">If you did not request this reset, please ignore this email.</p>
    </div>
    <?php 
    $htmlContent = ob_get_clean(); // Get the HTML content from the buffer and clean the buffer
    ?>
</body>
</html>

