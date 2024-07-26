<?php 
require_once 'config.php';

// Check if post_id is set and is a number
if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {

    $post_id = intval($_GET['post_id']);

    // SQL query to fetch post details
    $sql = "SELECT posts.post_title,
                   posts.post_content,
                   posts.public,
                   posts.created_at,
                   users.full_name 
            FROM posts 
            LEFT JOIN users ON posts.author_id = users.id 
            WHERE posts.id = :post_id";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $post = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($post === false) {
                // Redirect if no post found
                header('location: ../index.php');
                exit;
            }

            // Assign post details to variables
            $title = $post['post_title'];
            $content = $post['post_content'];
            $date = $post['created_at'];
            $author = $post['full_name'];
        } else {
            logError("Failed to execute post fetch query.", __FILE__, __LINE__);
            header('location: ../index.php');
            exit;
        }

        $stmt = null;
    } else {
        logError("Failed to prepare post fetch query.", __FILE__, __LINE__);
        header('location: ../index.php');
        exit;
    }

} else {
    // Redirect if post_id is not set or not valid
    header('location: ../index.php');
    exit;
}

$connect = null;
?>




