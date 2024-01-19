<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'connect.php';

// Check if the username is set and not empty
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare and execute SQL query with prepared statements to retrieve the user ID
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];

        // Display the retrieved user ID (escape the output for security)
       // echo "User ID: " . htmlspecialchars($userID, ENT_QUOTES, 'UTF-8');
    } else {
        // User not found or multiple users with the same username exist
        echo "Error: Unable to retrieve user ID.";
    }

   
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}

// Function to sanitize input data
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input from the form fields
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);
    $email = sanitizeInput($_POST['email']);
    $phoneNumber = sanitizeInput($_POST['phone_number']);
    $firstName = sanitizeInput($_POST['first_name']);
    $lastName = sanitizeInput($_POST['last_name']);
    $middleName = sanitizeInput($_POST['middle_name']);
    $city = sanitizeInput($_POST['city']);
    $postCode = sanitizeInput($_POST['post_code']);
    $country = sanitizeInput($_POST['country']);
    $addressLine2 = sanitizeInput($_POST['line2']);
    $addressLine1 = sanitizeInput($_POST['line1']);
    $state = sanitizeInput($_POST['state']);

    // Validate input data (add your own validation logic as needed)
    if (empty($username) || empty($password) || empty($email)) {
        echo "Please fill in all required fields.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Prepare the customer data
    $customerData = [
        'phone_number' => $phoneNumber,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'middle_name' => $middleName,
        'address' => [
            'city' => $city,
            'post_code' => $postCode,
            'country' => $country,
            'line2' => $addressLine2,
            'line1' => $addressLine1,
            'state' => $state,
        ],
        'email' => $email,
    ];

    // Make the API request to create the customer
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.escrow.com/2017-09-01/customer',
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_USERPWD => 'kutiyoung@gmail.com:16314_SXMRCoNvIOZaeNkiRzdVQF4wua0glm9ImJorDj9B2SZGoYcVtrGVQAAkqerx8BFE',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($customerData)
    ));

    $output = curl_exec($curl);
    echo $output;
    curl_close($curl);
}

// Prepare and execute SQL query to insert form values into the database
$sql = "INSERT INTO employees (username, password, email) VALUES ('$username', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();


/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'connect.php';

 // Retrieve form values
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email = $_POST['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form fields
    $phoneNumber = $_POST['phone_number'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $city = $_POST['city'];
    $postCode = $_POST['post_code'];
    $country = $_POST['country'];
    $addressLine2 = $_POST['line2'];
    $addressLine1 = $_POST['line1'];
    $state = $_POST['state'];
    $email = $_POST['email'];

    // Prepare the customer data
    $customerData = [
        'phone_number' => $phoneNumber,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'middle_name' => $middleName,
        'address' => [
            'city' => $city,
            'post_code' => $postCode,
            'country' => $country,
            'line2' => $addressLine2,
            'line1' => $addressLine1,
            'state' => $state,
        ],
        'email' => $email,
    ];

    // Make the API request to create the customer
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.escrow.com/2017-09-01/customer',
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_USERPWD => 'kutiyoung@gmail.com:16314_SXMRCoNvIOZaeNkiRzdVQF4wua0glm9ImJorDj9B2SZGoYcVtrGVQAAkqerx8BFE',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($customerData)
    ));

    $output = curl_exec($curl);
    echo $output;
    curl_close($curl);
}


 


 // Prepare and execute SQL query to insert form values into database
 $sql = "INSERT INTO employees (username, password, email) VALUES ('$username', '$password', '$email')";
 
 if ($conn->query($sql) === TRUE) {
    
     echo "Registration successful!";
     header("Location: login.html");
    exit();
 } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
 // Close the database connection
 $conn->close();*/
 ?>
 

   