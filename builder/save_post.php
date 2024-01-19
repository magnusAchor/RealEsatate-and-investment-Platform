<?php
session_start(); // Start or resume the session
include 'connect.php'; // Include the file with database connection

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
   // echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}
$post_id = uniqid();
$pending = 'pending';

// Prepare and execute SQL query to retrieve the user ID
$sql = "SELECT id FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userID = $row['id'];

    // Display the retrieved user ID
   // echo "User ID: " . $userID;
} else {
    // User not found or multiple users with the same username exist
   // echo "Error: Unable to retrieve user ID.";
}

// Function to sanitize the input data
function sanitize_input($data) {
    // Remove any HTML tags
    $data = strip_tags($data);
    // Remove any leading/trailing whitespaces
    $data = trim($data);
    // Escape special characters to prevent SQL injection
    global $conn; // Access the global $conn variable
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data and sanitize it
$caption = nl2br($_POST['caption']);
    $location = nl2br($_POST['location-input']);
    $price = sanitize_input($_POST['price']);
    $property_type = sanitize_input($_POST['property_type']);
    $phnumber = sanitize_input($_POST['phn']);
    $emaill = sanitize_input($_POST['emaill']);
    $whtNumb = sanitize_input($_POST['whtNumb']);

    // Prepare and execute the SQL query to insert data into 'posts' table
    $sql = "INSERT INTO posts (userName, caption, post_id, user_id, location, price, property_type, post_status, phonenumber, Email, Whatsapp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $username, $caption, $post_id, $userID, $location, $price, $property_type, $pending, $phnumber, $emaill, $whtNumb);
    
    $stmt->execute();
       

        // Handle the uploaded files
        if (!empty($_FILES['media']['name'][0])) {
            $mediaTmpNames = $_FILES['media']['tmp_name'];
            $mediaTypes = $_FILES['media']['type'];

            // Iterate through the uploaded files
            for ($i = 0; $i < count($mediaTmpNames); $i++) {
                $mediaTmpName = $mediaTmpNames[$i];
                $mediaType = $mediaTypes[$i];

                // Read the contents of the uploaded file
                $mediaData = file_get_contents($mediaTmpName);

                // Prepare and execute the SQL query to insert media data into 'media' table
                $sql = "INSERT INTO posts (userName, document, post_id, user_id, media_type, post_status, phonenumber, Email, Whatsapp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssss", $username, $mediaData, $post_id, $userID, $mediaType, $pending, $phnumber, $emaill, $whtNumb);

                if ($stmt->execute()) {
                    // File saved successfully
                    //echo "File '" . $_FILES['media']['name'][$i] . "' uploaded and inserted into the database.";
                } else {
                    // Error occurred while saving the file
                   // echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $stmt->close();
            }
        

        
    } else {
        // Error occurred while inserting data into 'posts' table
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //echo "alert('your post is pending verification once approved it will be uploaded')";
    $conn->close();
   
    header("Location: buyers");
   
    exit();
}
?>
