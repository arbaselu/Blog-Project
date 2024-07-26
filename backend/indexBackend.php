<?php
require_once 'config.php';
require_once 'helper.php';

// Determine the visibility of posts based on user role
if (isset($_SESSION['role_user']) && $_SESSION['role_user'] == 'admin') {
    $allPosts = ""; // Admins see all posts
} else {
    $allPosts = "WHERE posts.public = 1"; // Non-admins see only public posts
}

// SQL query to retrieve posts with author information
$sql = "SELECT posts.id,
               posts.post_title,
               posts.post_content,
               posts.public,
               posts.created_at,
               users.full_name
        FROM posts 
        LEFT JOIN users ON posts.author_id = users.id 
        $allPosts
        ORDER BY posts.id DESC";

if ($stmt = $connect->prepare($sql)) {
    // Execute the query
    if ($stmt->execute()) {
        // Fetch all posts
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts === false) {
            logError("No posts to display.",__FILE__,__LINE__);
            header("Location: error.php");
        } 
    } else {
        logError("Failed to execute query.", __FILE__, __LINE__);
        header("Location: error.php");
    }
} else {
    logError("Failed to prepare query.", __FILE__, __LINE__);
    header("Location: error.php");
}
?>
