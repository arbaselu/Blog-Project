<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>
    <link rel="stylesheet" href="Style/userStyle.css">
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

    <div class="page-content">
            <h1>Hello <?php echo $_SESSION['fullName']."!" ?></h1>
        <div class="main-container">
<?php 
                if(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin') {   
            echo  '<div class="posts-settings">
        <a href="dashbord/add.php" ><button class="btn-add">
            Add article
        </button></a>
        
        <a href="search.php" ><button class="btn-search">
            Search a post for edit
        </button></a>
        </div>
            <div class="container-swap-video">
            
              <h4>Add that latest video to your home page</h4>
                <form class="form-swap" action="updateVideo.php" method="POST" >
                <input type="text" name="new_video_link" placeholder="Link Video" required>
                <button type="submit" class="submit_button">Swap video</button>
                </form>
       
    </div>';
     
}

?>
        <div class="account-settings">
        <a href="resetPassword.php" ><button class="btn-reset">
            Reset Password
        </button></a>
        
        <a href="backend/logout.php" ><button class="btn-logout">
            Logout
        </button></a>
        </div>
              
</div>
</div>

</body>
</html>

           