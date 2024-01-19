<?php

error_reporting(0);
ini_set('display_errors', 0);








// Start or resume the session
session_start();


// Create a new connection to MySQL database
$servername = "localhost";
$dbUsername = "villadin_Cool";
$dbPassword = "8N(l#R&wb5u$";
$dbName = "villadin_jobconstruct";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Close the database connection
//$conn->close();
?>