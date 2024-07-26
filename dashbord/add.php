<?php
session_start();

if(!isset($_SESSION["authenticated"]) || ($_SESSION["authenticated"] !== true) || $_SESSION["role_user"] !== 'admin') {
    header('location: ../login.php');
    die();
}
?>

<?php
require_once '../backend/config.php';
require_once 'addBackend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add post</title>
    <link rel="stylesheet" href="../Style/styleAddEdit.css">
</head>
<body>
    
<div class="page-content">
 <h1>Add content on page!</h1>
 <div class="main-content">
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
    <input type="text" name="title" placeholder="Titlul articolului" value ="<?php if(isset($title) && !empty($title)) echo $title;?>"><?php if (isset($_SESSION['titleError'])) echo $_SESSION['titleError']; ?><br>
    <label>Public:</label>
    <select name="public">
        <option value="0">No</option>
        <option value="1">Yes</option>
    </select><br>
    <textarea name="content" cols="80" rows="20"><?php if(isset($content) && !empty($content)) echo $content;?></textarea><?php if (isset($_SESSION['titleError'])) echo $_SESSION['contentError']; ?><br>
    <input class="button" type="submit" value="Add Post"><br>
  </form>
</div>
</div>
</body>
</html>
