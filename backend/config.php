<?php
$servername = "localhost";
$username = 'root';
$password = "";
$dbname = "blog_db";

try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection successful";   
} catch (PDOException $e) {
    logError("Connection failed: " . $e->getMessage(), __FILE__, __LINE__);
    header("Location: error.php");
    exit();
}
?>
