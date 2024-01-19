<?php
include 'connect.php';

// Store the form values in session variables
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['email'] = $_POST['email'];


// Retrieve form values
$username =$_SESSION['username'];
$password =$_SESSION['password'];
$email = $_SESSION['password'];

// Prepare and execute SQL query to check if username and password exist in the users table
$sql = "SELECT * FROM buyers WHERE name='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Successful login, redirect to buyer.html
    header("Location: buyers");
    exit();
} else {
    // Check if the username and password exist in the employees table
    $sql = "SELECT * FROM employees WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // Successful login in the employees table, open employersview
        header("Location: architectdash.");
        exit();
    } else {
        // Incorrect username or password, display error message
        echo "Error: Incorrect username or password.";
    }
}

// Close the database connection
$conn->close();
?>
