<?php
require_once '../backend/config.php';
require_once '../backend/helper.php';


if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    clearSessionErrors();
    $post_id = intval($_GET['post_id']);
    // Fetch post
    $sql = "SELECT id, post_title, public, post_content FROM posts WHERE id = :post_id";
    try {
        if ($stmt = $connect->prepare($sql)) {
            $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $post = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($post === false) {
                    header('Location: add.php');
                    die();
                }
                
                $title = $post['post_title'];
                $content = $post['post_content'];
                $public = $post['public'];
            } else {
                logError("Failed to execute query for fetching post", __FILE__, __LINE__);
                header('Location: ../error.php');
                die();
            }
        } else {
            logError("Failed to prepare statement for fetching post", __FILE__, __LINE__);
            header('Location: ../error.php');
            die();
        }
    } catch (Exception $e) {
        logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
        header('Location: ../error.php');
        die();
    }
} else {
    header('Location: add.php');
    die();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_title'], $_POST['new_content'], $_POST['new_public'])) {
    clearSessionErrors();
    $new_title = trim($_POST['new_title']);
    $new_content = trim($_POST['new_content']);
    $new_public = intval($_POST['new_public']);

    if (empty($new_title)) {
        $_SESSION['titleError'] = "Title is required!";
    } elseif (strlen($new_title) > 255) {
        $_SESSION['titleError'] = "Title is too long!";
    }

    if (empty($new_content)) {
        $_SESSION['contentError'] = "Content is required!";
    }

    if (empty($_SESSION['titleError']) && empty($_SESSION['contentError']) && !empty($post_id)) {
        // Update post
        $sql = "UPDATE posts SET post_title = :post_title_update, post_content = :post_content_update, public = :public_update WHERE id = :post_id";
        try {
            if ($stmt = $connect->prepare($sql)) {
                $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                $stmt->bindParam(':post_title_update', $new_title, PDO::PARAM_STR);
                $stmt->bindParam(':post_content_update', $new_content, PDO::PARAM_STR);
                $stmt->bindParam(':public_update', $new_public, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    header("Location: ../post.php?post_id=".$post_id);
                    die();
                } else {
                    logError("Failed to execute update query", __FILE__, __LINE__);
                    $_SESSION['titleError'] = "Error executing update query.";
                }
            } else {
                logError("Failed to prepare update statement", __FILE__, __LINE__);
                $_SESSION['titleError'] = "Error preparing update statement.";
            }
        } catch (Exception $e) {
            logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
            $_SESSION['titleError'] = "An unexpected error occurred.";
        }
    }
}

$connect = null;
?>

