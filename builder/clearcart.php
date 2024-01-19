<?php
// Include the database configuration file
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
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the 'createSpace' data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createSpace'])) {
    // Retrieve the selected items from the POST data and sanitize them
    $selectedItems = isset($_POST['createSpace']) ? $_POST['createSpace'] : array();
    $selectedItems = array_map('sanitize_input', $selectedItems);

    // Validate the selected items
    foreach ($selectedItems as $selectedItem) {
        if (!is_numeric($selectedItem)) {
            die("Invalid input detected. Please select valid items to remove.");
        }
    }

    // Prepare the SQL statement
    $clear = "DELETE FROM cart WHERE group_id = ? AND id = ?";
    $stmt = $conn->prepare($clear);
    if (!$stmt) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters (both are string types)
    $stmt->bind_param("ss", $groupID, $selectedItem);

    // Loop through the selected items and delete them from the cart
    foreach ($selectedItems as $selectedItem) {
        // Set the values of the parameters and sanitize them
        $groupID = isset($_SESSION['groupid']) ? sanitize_input($_SESSION['groupid']) : '';

        // Execute the statement
        if ($stmt->execute()) {
            echo "Item '$selectedItem' deleted from the cart successfully.";
        } else {
            echo "Error deleting item '$selectedItem' from the cart: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No items selected to remove from the cart.";
}
?>
