<?php

session_start();

if(!isset($_SESSION["authenticated"]) || ($_SESSION["authenticated"] !== true) || $_SESSION["role_user"] !== 'admin') {
  header('location: ../login.php');
  die();
}
?>

<?php
require_once '../backend/config.php';
require_once 'editBackend.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
    <link rel="stylesheet" href="../Style/styleAddEdit.css">
</head>
<body>
    
<div class="page-content">
<h2>Edit article:</h2>
<div class="main-content"></div>

  <form action ="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'])?>"  method="POST">
    <input type="text" name="new_title" placeholder="Titlul articolului" value ="<?php if(isset($title) && !empty($title)) echo $title;?>"><?php if (isset($_SESSION['titleError'])) echo $_SESSION['titleError'];?><br>
    <label>Public:</label>
    <select name = "new_public">
        <option value="0" <?php if($public == 0) echo "selected";?>>No</option>
        <option value="1" <?php if($public == 1) echo "selected";?>>Yes</option>
    </select><br>
    <textarea name="new_content" cols="80" rows="20" ><?php if(isset($content) && !empty($content)) echo $content;?></textarea><?php if (isset($_SESSION['titleError'])) echo $_SESSION['contentError']; ?><br>
    <input class="button" type ="submit" value="Edit Post"><br>
  </form>

</div>
</div>

</body>
</html>


