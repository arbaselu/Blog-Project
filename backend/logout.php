<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to account.php
header("Location: ../account.php");
exit; // Use exit instead of die for consistency
?>
