<?php
session_start();
require_once '../backend/config.php';
require_once '../backend/helper.php';

if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);
    
    // Preluare postare
    $sql = "DELETE FROM posts WHERE id = :post_id";
    
    try {
        if ($stmt = $connect->prepare($sql)) {
            $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                header('Location: ../blog.php');
                die();
            } else {
                logError("Failed to execute delete statement", __FILE__, __LINE__);
                header('Location: ../error.php');
                die();
            }
        } else {
            logError("Failed to prepare delete statement", __FILE__, __LINE__);
            header('Location: ../error.php');
            die();
        }
    } catch (Exception $e) {
        logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
        header('Location: ../error.php');
        die();
    }
} else {
    logError("Invalid or missing post_id parameter", __FILE__, __LINE__);
    header('Location: ../error.php');
    die();
}

$connect = null;
?>
