<?php

if (!isset($_SESSION["authenticated"]) || ($_SESSION["authenticated"] !== true) || $_SESSION["role_user"] !== 'admin') {
    header('Location: ../index.php');
    die();
}

require_once '../backend/config.php';
require_once '../backend/helper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitize($_POST['title']);
    $public = sanitize($_POST['public']);
    $content = $_POST['content']; 

    if (empty($title)) {
        $_SESSION['titleError'] = "Title is required!";
    } else if (strlen($title) > 255) {
        $_SESSION['titleError'] = "Title is too long!";
    }

    if (empty($content)) {
        $_SESSION['contentError'] = "Content is required!";
    }

    if (empty($_SESSION['titleError']) && empty($_SESSION['contentError'])) {
        $sql = "INSERT INTO posts (post_title, public, post_content, author_id) VALUES (:title, :public, :content, :author_id)";

        try {
            if ($stmt = $connect->prepare($sql)) {
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':public', $public);
                $stmt->bindParam(':content', $content);
                $author_id = $_SESSION['id'];
                $stmt->bindParam(':author_id', $author_id);

                if ($stmt->execute()) {
                    echo "Post uploaded successfully!";
                } else {
                    logError("Failed to execute post insertion", __FILE__, __LINE__);
                    header("Location: ../error.php");
                    exit();
                }
            } else {
                logError("Failed to prepare statement", __FILE__, __LINE__);
                header("Location: ../error.php");
                exit();
            }
        } catch (Exception $e) {
            logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
            header("Location: ../error.php");
            exit();
        }
    }
}
$connect = null;
?>
