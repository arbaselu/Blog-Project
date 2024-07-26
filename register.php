<?php
session_start();
require_once 'backend/registerBackend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="Style/registerStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
</head>
<script defer src="function.js"></script>
<body>

    
    <div class="form-container">
      <p class="title">Create account</p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form">
        <input type="text" name="full_name" class="input" placeholder="Full Name"  value=<?php if(isset($_POST['full_name'])) echo $_POST['full_name']; ?>>
        <p class="error"><?php if(isset($_SESSION['fullNameError'])) echo $_SESSION['fullNameError'] ;?></p>

        <input type="email" name="email" class="input" placeholder="Email" require value=<?php if(isset($_POST['email'])) echo $_POST['email']; ?>>
        <p class="error"><?php if(isset($_SESSION['emailError'])) echo $_SESSION['emailError'] ;?></p>

        <input type="text" name="username" class="input" placeholder="Username"  value=<?php if(isset($_POST['username'])) echo $_POST['username']; ?>>
        <p class="error"><?php if(isset($_SESSION['usernameError'])) echo $_SESSION['usernameError'] ;?></p>

        <input type="password" name="password" class="input" placeholder="Password" value=<?php if(isset($_POST['password'])) echo $_POST['password']; ?>>
        <p class="error"><?php if(isset($_SESSION['passwordError'])) echo $_SESSION['passwordError'] ;?></p>

        <input type="password" name ="confirmPassword" class="input" placeholder="Confirm-password" >

        <p class="error"><?php if(isset($_SESSION['confirmPasswordError'])) echo $_SESSION['confirmPasswordError'] ;?></p>
        <button type = "submit" name="submit-register" class="form-btn">Create account</button>
      </form>
      <p class="sign-up-label">
        Already have an account?<a href ="login.php" class="sign-up-link" >Log in</a>
      </p>

    </div>
    
</body>
</html>