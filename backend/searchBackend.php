<?php
require_once 'config.php';
require_once 'helper.php';

$posts_search = [];
if (isset($_POST['search-post']) && !empty($_POST['search-post'])) {
    $search = sanitize($_POST['search-post']);

    $sql_search = "SELECT id, post_title, public, created_at FROM posts WHERE post_title LIKE :search";

    try {
        if ($stmt = $connect->prepare($sql_search)) {
            $searchParam = "%$search%";
            $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $posts_search = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($posts_search)) {
                    echo "No posts found.";
                }
            } else {
                logError("Failed to execute search query", __FILE__, __LINE__);
                header("Location: error.php");
                exit();
            }
        } else {
            logError("Failed to prepare search query", __FILE__, __LINE__);
            header("Location: error.php");
            exit();
        }
    } catch (Exception $e) {
        logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
        header("Location: error.php");
        exit();
    }
}
?>
