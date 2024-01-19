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
   // echo '<script>alert("User not logged in");</script>';
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
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Add custom styles here if needed */
    .file-upload {
      margin-top: 20px;
    }

    .user-list {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">File Upload & User List</a>
    <!-- Add a logout button or other navigation elements if needed -->
  </nav>

  <!-- Container for the main content -->
  <div class="container">
    <!-- File Upload Section -->
    <div class="file-upload mt-4">
      <h2>Upload Building Plan</h2>
      <div class="input-group">
        <input type="file" class="form-control" id="file-input">
        <div class="input-group-append">
          <button class="btn btn-primary" onclick="uploadFile()">Upload</button>
        </div>
      </div>
    </div>

    <!-- User List Section -->
    <div class="user-list mt-4">
      <h2>User List</h2>
      <ul class="list-group" id="available-users">
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
                echo '<li class="list-group-item">' . 'Name: ' . htmlspecialchars($usernm, ENT_QUOTES, 'UTF-8');
                echo '<button type="submit" class="btn btn-primary float-right">Hire ' . $_SESSION['pidsty'] . '</button>';
                echo '</li>';
                echo '</form>';
            }
        } else {
            echo '<li class="list-group-item">No posts found.</li>';
        }
        ?>
      </ul>
    </div>
  </div>

  <!-- Include Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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
