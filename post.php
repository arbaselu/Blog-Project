<?php
session_start();
require_once 'backend/postBackend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="Style/postsStyle.css">
</head>
<body>
    <article class="article">
        <div class="titlu">
            <?php echo htmlspecialchars($title); ?>
        </div>

        <img src="Images/home.svg" alt="Image related to the post">
        
        <div class="continut">
            <?php echo nl2br(htmlspecialchars($content)); ?>
        </div>


        <div class="post_autor">
            <h4>Autor articol: <?php echo htmlspecialchars($author); ?></h4>
        </div>

        <div class="post_data">
            <p>Postat la <?php echo htmlspecialchars($date); ?></p>
        </div>
     <hr>
     <div class="container-buttons">
        <div class="edit-button">
            <?php 
                if(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin') {
                    echo '<a href="dashbord/edit.php?post_id=' . htmlspecialchars($post_id) . '">Edit</a>';
                    echo '<a href="dashbord/deleteBackend.php?post_id=' . htmlspecialchars($post_id) . '">Delete</a>';
                }
            ?>
        </div>
        </div>
      
    </article>
</body>
</html>


