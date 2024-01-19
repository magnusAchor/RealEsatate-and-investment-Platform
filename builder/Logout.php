<?php
session_start(); // Start the session

// Unset and destroy session
session_unset();
session_destroy();

// Clear POST data
$_POST = array();

// Redirect to a desired page after logout
header("Location: https://villadin.com/"); // Replace "index.php" with your desired page
exit();
?>
