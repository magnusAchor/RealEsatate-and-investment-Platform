<?php
// Include the database configuration file
include 'connect.php';
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_POST);
print_r($_POST);*/
$groupID = $_SESSION['groupid'];
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}
//echo $groupID;

// Retrieve the cart items from the database
$sql = "SELECT * FROM cart WHERE group_id = '$groupID'";
$result = $conn->query($sql);

// Check if there are any items in the cart
if ($result->num_rows > 0) {
    // Open the table outside the loop
    echo '<table id="cart">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Select</th>';
    echo '<th>Building Item</th>';
    echo '<th>Quantity</th>';
    echo '<th>Price</th>';
    echo '<th>Total</th>';
    
    echo '</tr>';
    echo '</thead>';
    echo '<tbody id="cart-body">';

    // Iterate through each row and display the cart item
    while ($row = $result->fetch_assoc()) {
        $id= $row['id'];
        $itemName = $row['item_name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $total = $row['total'];

        echo "<tr>";
        echo '<td><input type="checkbox" name="createSpace[]" value="' . $id . '"></td>'; // Checkbox in the new column
        echo "<td>$itemName</td>";
        echo "<td>$quantity</td>";
        echo "<td>$price</td>";
        echo "<td>$total</td>";
        echo "</tr>";
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "<p>No items in the cart.</p>";
}


?>
<button type="button" name="clears" onclick="clearCart()">Clear cart</button>
<script>
function clearCart() {
    var selectedItems = []; // Array to store the values of checked checkboxes

    // Get all elements with the name "createSpace[]" (checkboxes)
    var checkboxes = document.getElementsByName('createSpace[]');

    // Loop through the checkboxes to check if they are checked
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            // If the checkbox is checked, add its value to the selectedItems array
            selectedItems.push(checkboxes[i].value);
        }
    }

    // Use the 'selectedItems' array as needed
    console.log(selectedItems);

    // Now, you can use the 'selectedItems' array to perform any actions, such as making an AJAX request to delete the selected items from the cart.
    // You can send the 'selectedItems' array to the server using an AJAX request and process it on the server-side to delete the corresponding items from the database.

    $.post("clearcart", { createSpace: selectedItems },
        function (data, textStatus, jqXHR) {
            // The 'data' variable will hold the response from the server
            // Process the response data if needed
            console.log(data); // Output the response to the browser's console for debugging purposes
        }
    );
    location.reload();
}
</script>

