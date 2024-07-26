<?php
require_once 'backend/searchBackend.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search a Post for Edit</title>
    <link rel="stylesheet" href="Style/search.css">
    <script defer src="function.js"></script>
</head>
<body>

    <header>
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
    </header>

    <main>
        <div class="main-container">
            <div class="form-search">
                <h1>Search for a Post by Title</h1>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="text" name="search-post" placeholder="Title..">
                    <button type="submit" class="submit_button">Search</button>
                </form>  
            </div>

            <div class="post-search">
                <?php
                if (isset($_POST['search-post'])) {
                    if (count($posts_search) > 0) {
                        echo '<h2>Post Found</h2><hr><br>';
                        foreach ($posts_search as $post) {
                            $public = $post['public'] ? "Active" : "Inactive";
                            $icon = $post['public'] ? 'Images/active.svg' : 'Images/inactive.svg';

                            echo '<div class="article">
                                <div class="public">
                                    <p>' . htmlspecialchars($public) . '</p>
                                    <img src="' . htmlspecialchars($icon) . '" alt="Status Icon">
                                </div>
                                <a href="post.php?post_id=' . htmlspecialchars($post['id']) . '"><h2>' . htmlspecialchars($post['post_title']) . '</h2></a><br>
                                <span class="post_date"><p class="post_date">Posted on: ' . htmlspecialchars($post['created_at']) . '</p></span>
                                <br><hr><br>
                            </div>';
                        }
                    } else {
                        echo '<h2>No Posts Found</h2><br><div class="article"><br><hr><br></div>';
                    }
                }
                ?>
            </div>
        </div>
    </main> 

</body>
</html>
