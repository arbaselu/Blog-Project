<?php
 ob_start();
require_once 'indexBackend.php';
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Newsletter</title>
        <style>
           
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            
            
        }
        .header {
            background-color:  #ff5a5f;
            color: white;
            padding: 20px;
            text-align: center;
        }

       .content-container{
        color:#777777;
       }

       .content a{
        text-decoration: none;
       }

       .content h2{
        color: black;
       }

       .read-button{
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        background-color: #ff5a5f;
        color: white;
       cursor: pointer;
        border-radius: 5px;
       }

        .footer {
            background-color: #eeeeee;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
        .social {
            text-align: center;
            padding: 20px 0;
        }
        .social a {
            margin: 0 10px;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #ff5a5f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
      
    
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <h1>Welcome to Mario's Blog</h1>
            </div>
            <div class="intro">
                <h1>Hello,</h1>
                <p>Thank you for subscribing to our blog. We're excited to share our latest posts with you!</p>
                <p>Stay tuned for updates, tips, and insights from our team.</p>
            </div>
            <div class="content-container">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <hr>
                    <div class="content">
                        <a href="http://localhost/blog/post.php?post_id= <?php echo $posts[$i]['id']; ?>" target="_blank">
                            <h2><?php echo $posts[$i]['post_title']; ?></h2>
                        </a>
                        <p><?php echo mb_strimwidth($posts[$i]['post_content'], 0, 200, "..."); ?></p>
                        <a href="http://localhost/blog/post.php?post_id= <?php echo $posts[$i]['id']; ?>" target="_blank">
                            <button class="button">Read More</button>
                        </a>
                    </div>
                <?php endfor; ?>
                <hr>
                <p>We hope you enjoy reading our latest posts. Visit our blog to explore more!</p>
                <a href="http://localhost/blog/index.php" target="_blank" class="button">Visit Our Blog</a>
                <p>If you have any questions or feedback, feel free to reply to this email. We're here to help!</p>
            </div>
            <div class="social">
                <h3>Connect with us on social media</h3>
                <a href="https://www.facebook.com/mario.arbaselu" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/1384/1384053.png" alt="Facebook">
                </a>
                <a href="#">
                    <img src="https://cdn-icons-png.flaticon.com/24/733/733579.png" alt="Twitter">
                </a>
                <a href="https://www.instagram.com/arbaselu.mario" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/733/733558.png" alt="Instagram">
                </a>
                <a href="https://www.linkedin.com/in/mario-arbaselu-069a68262?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/24/174/174857.png" alt="LinkedIn">
                </a>
            </div>
            <div class="footer">
                <p>&copy; 2024 Mario's Blog. All rights reserved.</p>
                <p>Craiova, Romania</p>
                <p><a href="#">Unsubscribe</a></p>
            </div>
        </div>
        <?php $htmlContent = ob_get_clean(); ?>
    </body>
    </html>
    

 