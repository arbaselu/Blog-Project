<?php
require_once 'backend/helper.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Style/resetPasswordStyle.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
</head>
<script defer src="function.js"></script>
<body>
 
   
<div class="form-container">
            <h1>Reset Password</h1>
            <form action="backend/resetPasswordBackend.php" method="POST" class="form">
                <?php
                
                if(isset($_SESSION['autentificat']) && $_SESSION['role_user'] === 'admin') {
                
               echo' <input type="password" name="newPassword" class="input" placeholder="New Password">
                <input type="password" name="confirmPassword" class="input" placeholder="Confirm Password">
                <button type="submit" name="submit-login" class="form-btn">Reset Password</button>';
                }
                else{
                    echo '<input type="email" name="email" class="input" placeholder="Email">
                    <button type="submit" name="submit-login" class="form-btn">Send Email</button>';
                    
                }
                ?>
                <p class="error"><?php if(isset($_SESSION['emailError'])) echo $_SESSION['emailError'] ; else if (isset($_SESSION['emailCheck'])) echo $_SESSION['emailCheck'] ;?></p>
                <?php clearSessionErrors(); ?>

            </form>
                
        </div>
</body>
</html>

