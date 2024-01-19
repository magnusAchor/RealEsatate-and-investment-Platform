<?php
include 'connect.php'; // Include database connection
// Validate and sanitize input data
$username2 = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$password2 = isset($_SESSION['password']) ? $_SESSION['password'] : '';

$username2 = trim($username2); // Remove leading/trailing whitespaces
$password2 = trim($password2); // Remove leading/trailing whitespaces

// Sanitize the input to prevent SQL injection
$username2 = $conn->real_escape_string($username2);
$password2 = $conn->real_escape_string($password2);

// Prepare and execute SQL query to retrieve the user ID
$sql = "SELECT * FROM employees WHERE username='$username2' AND password = '$password2'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    

    // Display the retrieved user ID
    //echo "User ID: " . $userID2 . '<br>';
} else {
    // User not found or multiple users with the same username exist
    echo "Error: Unable to retrieve user ID.";
    exit; // Stop further execution if user not found
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming you've stored user ID in the session

    $type = $_POST['type']; // Type can be 'work_sample', 'skill', 'education', or 'experience'

    // Handle work sample or image upload
    if ($type === 'work_sample') {
        $title = $_POST['sampleTitle'];
        $image_name = $_FILES['workSample']['name'];
        $image_tmp = $_FILES['workSample']['tmp_name'];
        $image_path = 'work_samples/' . $image_name;

        move_uploaded_file($image_tmp, $image_path);

        $insertQuery = "INSERT INTO portfolio (user_id, type, title, image_filename) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("isss", $user_id, $type, $title, $image_name);
        $stmt->execute();
    }

    // Handle other fields based on the selected type
    elseif ($type === 'skill') {
        $skill_name = $_POST['skillName'];

        $insertQuery = "INSERT INTO portfolio (user_id, type, skill_name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iss", $user_id, $type, $skill_name);
        $stmt->execute();
    }
    elseif ($type === 'education') {
        $degree = $_POST['degree'];
        $institution = $_POST['institution'];
        $graduation_year = $_POST['graduation_year'];

        $insertQuery = "INSERT INTO portfolio (user_id, type, degree, institution, graduation_year) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("isssi", $user_id, $type, $degree, $institution, $graduation_year);
        $stmt->execute();
    }
    elseif ($type === 'experience') {
        $job_title = $_POST['job_title'];
        $company = $_POST['company'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $insertQuery = "INSERT INTO portfolio (user_id, type, job_title, company, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("isssss", $user_id, $type, $job_title, $company, $start_date, $end_date);
        $stmt->execute();
    }

    header("Location: portfolio"); // Redirect back to portfolio page
}
?>
