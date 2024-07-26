<?php
require_once 'backend/config.php';
require_once 'backend/helper.php'; 

// Define variable for video link
$new_video_link = '';

// Check if the request method is POST and the 'new_video_link' field is set
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['new_video_link'])) {
    
    // Sanitize and trim the input
    $new_video_link = trim($_POST['new_video_link']);
    $new_video_link = htmlspecialchars($new_video_link); // Protect against XSS attacks

    $sql = "UPDATE assets_website SET youtube_link = :new_video_link";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bindParam(':new_video_link', $new_video_link);

        if ($stmt->execute()) {
            // Redirect to the user page upon success
            header('Location: user.php');
            exit();
        } else {
            logError('Error executing SQL query: ', __FILE__, __LINE__);
            header('location: error.php');
        }
    } else {
        logError('Error preparing SQL query.', __FILE__, __LINE__);
        header('location: error.php');
    }
}

$connect = null;
?>

