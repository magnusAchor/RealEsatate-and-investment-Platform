<?php
include 'connect.php';
$transactionReference = $_SESSION['transactionReference'];
$insertQuery = "UPDATE payment SET statuess = 'paid' WHERE statuess = 'pending' AND transactionReference = '$transactionReference'";
if ($conn->query($insertQuery)) {
  
    header('location:buyers');
    
} else {
    echo "Error updating payment details: " . $conn->error . "<br>";
}

?>