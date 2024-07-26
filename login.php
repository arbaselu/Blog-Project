<?php
session_start();
require_once 'backend/loginBackend.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Style/loginStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
</head>
<script defer src="function.js"></script>
<body>
    <div class="form-container">
        <h1 class="title">Welcome back</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form">
            <input type="text" name="username" class="input" placeholder="Username" value=<?php if(isset($_POST['username'])) echo $_POST['username']; ?> >
            <p class="error"><?php if(isset($_SESSION['usernameError'])) echo $_SESSION['usernameError'] ;?></p>
            <input type="password" name="password" class="input" placeholder="Password">
            <p class="error"><?php  if(isset($_SESSION['passwordError'])) echo $_SESSION['passwordError'] ;?></p>
            <p class="page-link">
                <a href="resetPassword.php" class="page-link-label">Forgot Password?</a>
            </p> 
            <button type="submit" name="submit-login" class="form-btn">Log in</button>
        </form>
        <p class="sign-up-label">
            Don't have an account? <a href="register.php" class="sign-up-link">Sign up</a>
        </p>
    </div>
</body>
</html>

