
<?php
require_once 'backend/indexBackend.php';
session_start();
?>


<!DOCTYPE html>
<html lang='ro'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>
    <link rel="stylesheet" href="Style/blogStyle.css">
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


    <main>
        <div class="main-content">
        <div class="blog-articles">

<?php
    for($i = 0;$i < count($posts);$i++){
        echo '<div class="article">
            <a href ="post.php?post_id='.$posts[$i]['id'].'"><h2>'.$posts[$i]['post_title'].'</h2></a><br>
            <span class="post_date" <p class="post_date">Postat la data: '.$posts[$i]['created_at'].'</p></span>
            <img src="Images/background.jpg" alt="human-robot">
            <p>'.mb_strimwidth($posts[$i]['post_content'],0,250,"...").'</p>
            <a href ="post.php?post_id=' .$posts[$i]['id']. '"<button class="read-button">Citeste mai departe...</button></a>
            </div>';
}
?>
    </div>
    </div>
    </main>
  
     
        <footer class="footer">
        <p>&copy; 2024 Blog's Mario. All rights reserved.</p>
        </footer>

</body>
</html>

