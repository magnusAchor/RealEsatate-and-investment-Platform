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
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}

 $groupID = $_SESSION['groupID'];
// Retrieve the cart items from the database
$sql = "SELECT * FROM cart where group_id = $groupID ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iterate through each row and display the cart item
    while ($row = $result->fetch_assoc()) {
        $itemName = $row['item_name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $total = $row['total'];

        echo "<tr>";
        echo "<td>$itemName</td>";
        echo "<td>$quantity</td>";
        echo "<td>$price</td>";
        echo "<td>$total</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No items in the cart.</td></tr>";
}

$conn->close();
?>
