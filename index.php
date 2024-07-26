<?php
require_once 'backend/indexBackend.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>
    <link rel="stylesheet" href="Style/indexStyle.css">
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

    <main class="main">
        <div class="newsletter">
            <h1>ACCELEREAZĂ-ȚI CARIERA
            LA URMĂTORUL NIVEL!</h1>
            <div class="text-newsletter">
            <p><img src ="Icons/arrow1.svg" alt="arrow">Inveți cum funcționează lucrurile, nu doar cum se fac</p>
            <p><img src ="Icons/arrow1.svg" alt="arrow">Strategii de carieră și conversie profesională</p>
            <p><img src ="Icons/arrow1.svg" alt="arrow">Explorezi piața de dezvoltare software și cele mai noi tehnologii</p>
        </div>
      
       <form class="form-newsletter" action="backend/newsletterBackend.php" method="POST" id="newsletter-form">
            <input type="email" name="email_newsletter" placeholder="Email" required>
            <button type="submit" class="submit_button">MA INSCRIU LA NEWSLETTER</button>
       </form>  
       
    </div>

    <div class="blog-articles">
        <div class="title"><h1>Cele mai recente articole</h1></div>
        <div class="main-article">
<?php
    for ($i = 0; $i < 3; $i++) {
        echo '<div class="article">
            <a href="post.php?post_id='.$posts[$i]['id'].'"><h2>'.$posts[$i]['post_title'].'</h2></a><br>  
            <p>'.mb_strimwidth($posts[$i]['post_content'], 0, 200, "...").'</p>
            </div>';
    }
?>

    </div>
    </div>
        <div class="youtube">
            <h3>RECENT PE YOUTUBE</h3>
<?php
            require_once 'selectVideo.php';
                    if (filter_var($video_link, FILTER_VALIDATE_URL)) {
                        echo '<iframe class="video" src="'.$video_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                            } else {
                                echo '<p>'.$video_link.'</p>';
                            }
?>
    </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Blog's Mario. All rights reserved.</p>
    </footer>

</body>
</html>
