<?php
// Assuming you have established a database connection
include 'connect.php';

// Start the session
session_start();

$chattinbase = $_SESSION['chatted'];
//echo $chattinbase;

// Function to fetch chat messages from the database
function fetchChatMessages() {
    global $conn;
    $chattinbase = $_SESSION['chatted'];
    //echo $chattinbase;
    // Start the session
    session_start();

    // Assuming you have a $username variable defined or retrieved
    $username = $_SESSION['username'];

    // Retrieve the user ID based on the username
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];

        // Display the retrieved user ID
       // echo "User ID: " . $userID . '<br>' . '<br>';
        $chattingid = $chattinbase + $userID;
    } else {
        // User not found or multiple users with the same username exist
        echo "Error: Unable to retrieve user ID.";
    }

    // Build the SQL query to retrieve chat messages
    $sql = "SELECT * FROM chat WHERE group_id = '$chattingid'  ORDER BY created_at DESC";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any messages are found
    if (mysqli_num_rows($result) > 0) {
        // Loop through the result set and construct the HTML for each message
        while ($row = mysqli_fetch_assoc($result)) {
            $message = htmlspecialchars($row['message']);
            $user = htmlspecialchars($row['userName']);
            $createdAt = htmlspecialchars($row['created_at']);

            // Create the fieldset element with the message information
            echo '<fieldset>';
            //echo $chattingid;
            echo '<legend>Message from User ' . $user . '</legend>';
            echo '<p><strong>User ' . $user . ':</strong> ' . $message . '</p>';
            echo '<p><em>Posted at: ' . $createdAt . '</em></p>';
            echo '</fieldset>';
        }
    } else {
        echo "No messages found.";
    }
}

// Call the fetchChatMessages function to fetch and output the chat messages
fetchChatMessages();
?>
