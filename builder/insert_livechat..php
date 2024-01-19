<?php
session_start(); // Make sure to start the session

include 'connect.php';

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['chatting'], $_POST['message'])) {
        
        $groupID=$_POST['chatting'];
       
        $message = $_POST['message'];

        echo $message;
        echo $chattingid;

        // Retrieve the user ID based on the username
        $sql = "SELECT id FROM employees WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $userID = $row['id'];

            // Display the retrieved user ID
            echo "User ID: " . $userID . '<br>' . '<br>';
            
            insertIntoChatTable($username, $groupID, $message);
        } else {
            // User not found or multiple users with the same username exist
            echo "Error: Unable to retrieve user ID.";
        }
    } else {
        echo "Please provide a workspace ID and a message.";
    }
}

// Function to insert a message into the chat table
function insertIntoChatTable($username, $groupID, $message) {
    global $conn; // Use the global connection object

    // Escape the input values to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $groupId = mysqli_real_escape_string($conn, $groupID);
    $message = mysqli_real_escape_string($conn, $message);

    // Build the SQL INSERT statement
    $sql = "INSERT INTO chat (userName, group_id, message) VALUES ('$username', '$groupID', '$message')";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}


?>
