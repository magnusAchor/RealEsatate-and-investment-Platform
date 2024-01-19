<?php
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
    
    header("Location: index " );
    exit();
}

// Validate and sanitize the username session variable
$username = isset($_SESSION['username']) ? trim($_SESSION['username']) : '';
$username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Validate and sanitize the email session variable
$email = isset($_SESSION['email']) ? trim($_SESSION['email']) : '';
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['profile-picture-inputt']) && $_FILES['profile-picture-inputt']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile-picture-inputt'];

        // Read the contents of the uploaded file
        $profilepicss = file_get_contents($file['tmp_name']);

        // Update the profile picture in the database
        $stmt = $conn->prepare("UPDATE buyers SET profile_pic = ? WHERE email = ?");
        $stmt->bind_param("ss", $profilepicss, $email);
        if ($stmt->execute()) {
            
            header('Location: buyers_profile_setting');
            exit();
        } else {
            echo "Error updating profile picture: " . $stmt->error;
        }
            header('Location: buyers_profile_setting');
        $stmt->close();
        $conn->close();
    } else {
        echo "Error uploading profile picture: " . $_FILES['profile-picture-inputt']['error'];
    }
}

?>