<?php
session_start();
if (isset($_SESSION["authenticated"]) && ($_SESSION["authenticated"] === true)) {
    header('Location: user.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>

    <link rel="stylesheet" href="Style/accountStyle.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">

    <script defer src="function.js"></script>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><img src="Icons/code-icon.svg" alt="Logo"></a>
            <span id="logo-name">Mario's Blog</span>
        </div>
        <div class="menu-toggle" id="menu-toggle">
            <img src="Icons/menu-toggle1.svg" alt="Menu">
        </div>
        <ul class="navbar-links" id="navbar-links">
            <li class="nav-item"><a href="index.php">Home</a></li>
            <li class="nav-item"><a href="blog.php">Blog</a></li>
            <li class="nav-item"><a href="account.php">Account</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="page-content">
            <h1>Login/Register</h1>
            <div class="buttons-account">
                <a href="login.php"><button class="btn-login">Login</button></a>
                <a href="register.php"><button class="btn-register">Register</button></a>
            </div>
        </div>
    </main>
</body>
</html>
