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
   // echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}


if (isset($_POST['rel'])) {
  $_SESSION['rel'] = $_POST['rel'];
  $worker=$_SESSION['rel'];
  $_SESSION['buyer']= $_POST['buyer'];
  $buyer = $_SESSION['buyer'];
  $workername = $_POST['full_name'];
  $position = $_POST['position'];

  //echo $worker .'<br>';
 // echo "The post ID is: " . $buyer;
} else {
  echo "Post ID not found in the session.";
}
$buyername = $conn->query("SELECT username from users where id = $buyer")->fetch_assoc()['username'];
//echo "$buyername ";

// Check if the relationship already exists
$existingRelationshipQuery = "SELECT COUNT(*) FROM relationship WHERE worker_id = $worker AND buyers_id = $buyer";
$result = $conn->query($existingRelationshipQuery);
$row = $result->fetch_assoc();
$relationshipCount = $row['COUNT(*)'];

if ($relationshipCount > 0) {
    //echo "Relationship already exists.";
    header("Location: employersview " );
    exit;
} else {
    // Perform the database query to create the relationship
    $query = "INSERT INTO relationship (messages, full_name, position, worker_id, buyers_id, Statues)
          VALUES ('$buyername is offering you a job', '$workername', '$position', $worker, $buyer, 'pending')";

    //$status = "UPDATE employees SET statues = '$buyer' where id = $worker" ;

    if ($conn->query($query) === TRUE ) {
     // echo "Relationship created successfully.";
      header("Location: employersview " );
      
  } else {
      // Handle the case where at least one query failed
      echo "Error creating relationship: " . $conn->error;
  }
}

// Assuming you have established a database connection

if (isset($_POST['add_column'])) {
  $newvalue=$_POST['add_column'];
  // Retrieve the current number of columns in the table
  $query = "SELECT COUNT(*) as column_count FROM relationship";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $columnCount = $row['column_count'];

  // Generate the column name for the new column
  $newColumnName = "user" . ($columnCount + 1);

  // Alter the table to add the new column
  $alterQuery = "ALTER TABLE relationship ADD COLUMN $newColumnName VARCHAR(255)";
  mysqli_query($conn, $alterQuery);

  // Insert the value into the new column
  $insertQuery = "UPDATE your_table SET $newColumnName = 'your_value'";
  mysqli_query($conn, $insertQuery);

  // Output a success message
  //echo "New column added and value inserted successfully.";
}



// Close the database connection
$conn->close(); 
?>


