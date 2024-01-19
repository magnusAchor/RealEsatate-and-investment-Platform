<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'connect.php';


$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['userType'] = $_POST['userType'];
$_SESSION['phone_number'] = $_POST['phone_number'];
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['middle_name'] = $_POST['middle_name'];
$_SESSION['city'] = $_POST['city'];
$_SESSION['post_code'] = $_POST['post_code'];
$_SESSION['country'] = $_POST['country'];
$_SESSION['line1'] = $_POST['line1'];
$_SESSION['line2'] = $_POST['line2'];
$_SESSION['state'] = $_POST['state'];
$_SESSION['email'] = $_POST['email'];

// Retrieve form values
$userType = $_SESSION['userType'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$number = $_SESSION['phone_number'];
$fst_name = $_SESSION['first_name'];
$lst_name = $_SESSION['last_name'];
$mid_name = $_SESSION['middle_name'];
$_city = $_SESSION['city'];
$pst_code = $_SESSION['post_code'];
$contry = $_SESSION['country'];
$line_one = $_SESSION['line1'];
$line_2 = $_SESSION['line2'];
$stte = $_SESSION['state'];
$mail = $_SESSION['email'];
$status = 'ongoing';

$fullname = $fst_name . ' ' . $lst_name . ' ' . $mid_name;
$location = $_city . ' ' . $stte . ' ' . $contry;

// Check if the user is already registered
$alreadyRegistered = false;

if ($userType == 'buyer') {
    $buyerCheckQuery = "SELECT * FROM buyers WHERE name = '$username'";
    $buyerResult = $conn->query($buyerCheckQuery);

    if ($buyerResult->num_rows > 0) {
        $alreadyRegistered = true;
    } else {
        // Prepare and execute SQL query to insert form values into database
        $sql = "INSERT INTO users (username, password, status, phone_number, first_name, last_name, middle_name, city, post_code, country, line1, line2, state, email) VALUES ('$username', '$password', '$status', '$number', '$fst_name', '$lst_name', '$mid_name', '$_city', '$pst_code', '$contry', '$line_one', '$line_2', '$stte', '$mail')";
        
        $sbc = "INSERT INTO buyers (name, email, password, full_name, location, phone_number) VALUES ('$username', '$mail', '$password', '$fullname', '$location', '$number')";
        
        if ($conn->query($sql) === TRUE && $conn->query($sbc) === TRUE) {
            echo "Registration successful!";
            header("Location: login_form");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
} elseif ($userType == 'worker') {
    $workerCheckQuery = "SELECT * FROM employees WHERE username = '$username'";
    $workerResult = $conn->query($workerCheckQuery);

    if ($workerResult->num_rows > 0) {
        $alreadyRegistered = true;
    } else {
        // Prepare and execute SQL query to insert form values into database
        $sql = "INSERT INTO users (username, password, status, phone_number, first_name, last_name, middle_name, city, post_code, country, line1, line2, state, email) VALUES ('$username', '$password', '$status', '$number', '$fst_name', '$lst_name', '$mid_name', '$_city', '$pst_code', '$contry', '$line_one', '$line_2', '$stte', '$mail')";
        
        $sbc = "INSERT INTO employees (username, password, email, full_name, phone_number) VALUES ('$username', '$password', '$mail', '$fullname', '$number')";
        
        if ($conn->query($sql) === TRUE && $conn->query($sbc) === TRUE) {
            echo "Registration successful!";
            header("Location: login_form");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Close the database connection
//$conn->close();

// Display an alert if the user is already registered
if ($alreadyRegistered) {
    echo "<script>alert('User is already registered.')</script>";
    // Redirect or perform any other necessary actions
}
?>
