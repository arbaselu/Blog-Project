<?php
require_once 'backend/helper.php'; 
require_once 'backend/helper.php';

// Define the variable for the video link
$video_link = '';

// SQL query to select the YouTube link from the assets_website
$sql = "SELECT youtube_link FROM assets_website";

if ($stmt = $connect->prepare($sql)) {

    if ($stmt->execute()) {

        $link = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($link) {
            // If a link is found, assign it to $video_link
            $video_link = $link['youtube_link'];
        } else {
            logError('No YouTube link found in the database.', __FILE__, __LINE__);
            header('location: error.php');
        }
    } else {
        logError('Error executing SQL query: ', __FILE__, __LINE__);
        header('location: error.php');
    }

    
}else{
    logError('Error preparing SQL query.', __FILE__, __LINE__);
    header('location: error.php');
}
?>


