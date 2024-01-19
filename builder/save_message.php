<?php
include 'connect.php';
if (isset($_POST['chat-input'])) {
    $chat = $_POST['chat-input'];
    
    echo $chat .'<br>';
    
  } else {
    echo "Post ID not found in the session.";
  }
  $groupId = uniqid();
  $users_ids=[];
  // Prepare and execute SQL query to retrieve the user ID
  $sql = "INSERT INTO chat ('group_id', 'users_id', 'message',)VALUES($groupId,$users_ids,$chat)  WHERE  users_id=''";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $userID = $row['id'];

      // Display the retrieved user ID
      echo "User ID: " . $userID;
  } else {
      // User not found or multiple users with the same username exist
      echo "Error: Unable to retrieve user ID.";
  }





?>