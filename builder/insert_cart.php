<?php
include 'connect.php';
//var_dump($_SESSION);
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}
$groupID = $_SESSION['groupid'];
    echo $groupID;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form has been submitted, proceed with inserting into the database

    // Retrieve the data sent from the AJAX request
    $itemName = $_POST['item-list'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $workspace_name = $_SESSION['workspace'];
    echo $workspace_name;

    // group id
    $wor = "SELECT group_id FROM chat WHERE workspace_name = '$workspace_name'";
    $workerid = $conn->query($wor);

    if ($workerid->num_rows == TRUE) {
        $finl = $workerid->fetch_assoc();
        $groupidup = $finl['group_id'];

        $_SESSION['group_id'] = $groupidup; // Save the group ID in a session variable

        // echo $groupidup;
    } else {
        echo "No group ID found.";
    }

    // Now you can access $_SESSION['group_id'] anywhere in the file
    //$groupID = $_SESSION['groupid'];
   // echo "Group ID: " . $groupID . '<br>' . '<br>';

    // Escape the data to prevent SQL injection
    $itemName = mysqli_real_escape_string($conn, $itemName);
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $price = mysqli_real_escape_string($conn, $price);
    $total = mysqli_real_escape_string($conn, $total);
    $groupID = mysqli_real_escape_string($conn, $groupID);

    // Build the SQL INSERT statement
    $sql = "INSERT INTO cart (item_name, quantity, price, total, group_id) VALUES ('$itemName', '$quantity', '$price', '$total', '$groupID')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $conn->error;
    }
} else {
    // Form has not been submitted, do nothing or perform any desired action
}
?>
