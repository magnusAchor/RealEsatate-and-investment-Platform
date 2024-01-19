<?php
// Assuming you have established a database connection
include 'connect.php';
$groupid=$_SESSION['groupid'];
echo $groupid;

// Check if the username is set and not empty
if (isset($_SESSION['workspace']) && !empty($_SESSION['workspace'])) {
    $workspace=$_SESSION['workspace'];
echo $workspace;

        // Display the retrieved user ID (escape the output for security)
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}


// Function to fetch chat messages from the database
function fetchChatMessages() {
    global $conn;
    $groupid =$_SESSION['groupid'];
    $workspace=$_SESSION['workspace'];
    // Build the SQL query to retrieve chat messages
    $sql = "SELECT * FROM chat WHERE group_id = '$groupid' and workspace_name = '$workspace' ORDER BY created_at ASC";

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
