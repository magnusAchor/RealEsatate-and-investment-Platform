<?php
include 'connect.php';

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];

 

 
} else {
  // Handle the case where the username is not set or empty
  echo '<script>alert("User not logged in");</script>';
  header("Location: index " );
  exit();
}
$groupid=$_SESSION['groupid'];
$workspace_name= $_SESSION['workspace'];
$messages = $_POST['message'];
echo $messages;
echo $workspace_name;
var_dump($_POST);
print_r($_SESSION);
$sql = "SELECT id FROM users WHERE username ='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $userID = $row['id'];

      // Display the retrieved user ID
      echo "User ID: " . $userID.'<br>'.'<br>';
      
  } else {
      // User not found or multiple users with the same username exist
      echo "Error: Unable to retrieve user ID.";
  }

  // Check if the form is submitted and process the message
if (isset($_POST['message'])) {
    $chatInput = $_POST['message'];
    echo $chatInput;
    
    $username = $_SESSION['username'];
  
    if (!empty($workspace_name) && !empty($chatInput)) {
      insertIntoChatTable($username, $workspace_name, $groupid, $userID, $chatInput);
    } else {
      echo "Please provide a workspace name and a message.";
    }
  }
  
  // Function to insert message sent from buyers/users into the database
function insertIntoChatTable($username, $workspace, $groupID, $userId, $message) {
    // Assuming you have established a database connection
    include 'connect.php';

    // Escape the input values to prevent SQL injection
    $workspace = mysqli_real_escape_string($conn, $workspace);
    $groupId = mysqli_real_escape_string($conn, $groupID);
    $userId = mysqli_real_escape_string($conn, $userId);
    $message = mysqli_real_escape_string($conn, $message);

    // Build the SQL INSERT statement
    $sql = "INSERT INTO chat (userName, workspace_name, group_id, user_id, message) VALUES ('$username', '$workspace', '$groupID', '$userId', '$message')";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
?>