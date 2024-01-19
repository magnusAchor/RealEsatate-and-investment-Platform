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
        $buyer = $row['id'];

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
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload and User List</title>
  <script>
       // history.replaceState({}, null, '/conrtorrty');
        </script>
  <script src="script.js"></script>
  <style>
    /* File Upload Styles */
    .file-upload {
      margin-top: 20px;
    }

    /* User List Styles */
    .user-list {
      margin-top: 20px;
    }
  </style>
</head>
    <header>
        <?php
        include 'hearder.php';
        ?>
    </header>
<body>
    <br><br><br><br><br><br><br><br>
  <!-- File Upload Section -->
  <div class="file-upload">
    <h2>Upload Building Plan</h2>
    <input type="file" id="file-input">
    <button onclick="uploadFile()">Upload</button>
  </div>

  <!-- User List Section -->
  <div class="user-list">
    <h2>User List</h2>
    <ul id="available-users">
      <!-- List of available users will be dynamically added here -->
      <?php
      $sql = "SELECT * FROM employees  ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION['pidsty'] = $row['id'];
        $pidsty = $_SESSION['pidsty'];
        $_SESSION['nam'] = $row['full_name'];
        $usernm = $_SESSION['nam'];
        $ml = $row['email'];

        echo '<form method="post" action="employersview">';
        echo '<input type="hidden" name="nam" value="' . htmlspecialchars($_SESSION['nam'], ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="buyer" value="' . $buyer . '">';
        echo '<input type="hidden" name="ml" value="' . htmlspecialchars($ml, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="pidsty" value="' . $_SESSION['pidsty'] . '">'; // Move this hidden input here
        echo '<p>' . 'Name: ' . htmlspecialchars($usernm, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<button type="submit" class="post-button">hire ' . $_SESSION['pidsty'] . '</button><br>';
        echo '</form>';
    }
} else {
    echo "No posts found.";
}
      ?>
    </ul>
  </div>

  <script>
    // Function to handle file upload
    function uploadFile() {
      const fileInput = document.getElementById('file-input');
      const file = fileInput.files[0];

      // Perform file upload using the appropriate method (e.g., AJAX, fetch API, etc.)
      // ...

      // Optionally display a success message or perform any other actions after the upload
      // ...
    }

    // Function to dynamically add users to the user list
    function addUser(username) {
      const userList = document.getElementById('available-users');
      const listItem = document.createElement('li');
      listItem.textContent = username;
      userList.appendChild(listItem);
    }

    // Example usage: add some sample users
    /* addUser('John');
    addUser('Emily');
    addUser('Michael'); */
  </script>
</body>
</html>
