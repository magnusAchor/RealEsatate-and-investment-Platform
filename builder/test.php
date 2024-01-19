<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_POST);

include 'connect.php';



if (isset($_POST['workspace']) && isset($_POST['groupid'])) {
   $_SESSION['$workspace'] = $_POST['workspace'];
   $workspace_name= $_SESSION['$workspace'] ;

    $_SESSION['groupid'] = $_POST['groupid'];
    $gpid=$_SESSION['groupid'];

    echo $gpid;
} else {
    echo "Error: Required form values are missing.";
}
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];

 

 
} else {
  // Handle the case where the username is not set or empty
  echo '<script>alert("User not logged in");</script>';
  header("Location: index " );
  exit();
}
echo $username;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['clear'])) {
      // Check if any items are selected in the checkbox
      if (isset($_POST['createSpace']) && !empty($_POST['createSpace'])) {
          // Get the selected items from the checkbox
          $selectedItems = $_POST['createSpace'];

          // Prepare the SQL statement
          $clear = "DELETE FROM cart WHERE group_id = ? AND item_name = ?";
          $stmt = $conn->prepare($clear);
          if (!$stmt) {
              die("Error preparing the statement: " );
          }

          // Bind parameters and execute the statement for each selected item
          foreach ($selectedItems as $selectedItem) {
              $stmt->bind_param("ss", $gpid, $selectedItem);
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
  }
}





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

 



// Insert into chats, receive values from buyers (new workspace popup)


if (isset($_POST['createGroup']) ) {
  $workspace = $_POST['workspace'];
  $selectedUsers = isset($_POST['createSpace']) ? $_POST['createSpace'] : [];
  
  $GroupId = uniqid();
  //echo $GroupId;

  if (!empty($workspace) && !empty($selectedUsers)) {
    foreach ($selectedUsers as $user) {
      // Insert each selected user value into the chat table
      $insertQuery = "INSERT INTO chat (userName, workspace_name, group_id, user_id, workers_id, message) VALUES ('$username','$workspace', '$GroupId', $userID, $user, 'welcome')";
      $conn->query($insertQuery);
    }

    echo "Selected users added to the chat successfully.";
    
    // Set the session variable to mark that the code has been executed
    $_SESSION['groupCreated'] = true;
  } else {
    echo "Please select at least one user and provide a workspace name.";
  }
}




// Check if the form is submitted and process the message
if (isset($_POST['message'], $_POST['workspace'])) {
    $chatInput = $_POST['message'];
    $workspace = $_POST['workspace'];
    $username = $_SESSION['username'];
  
    if (!empty($workspace) && !empty($chatInput)) {
      insertIntoChatTable($username, $workspace, $groupID, $userID, $chatInput);
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



<!DOCTYPE html>
<html>
<head>
    <title>Workspace - Building Item Selection</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  <style>
body {
  background-color: #f0f0f0;
  font-family: Arial, sans-serif;
  color: #333333;
  margin: 0;
  padding: 20px;
}

h1, h2 {
  color: #004080;
}

form {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="number"] {
  width: 100px;
  padding: 5px;
  border: 1px solid #cccccc;
  border-radius: 3px;
}

select {
  padding: 5px;
  border: 1px solid #cccccc;
  border-radius: 3px;
}

button {
  padding: 10px 20px;
  background-color: #004080;
  color: #ffffff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #003366;
}

table {
  border-collapse: collapse;
  width: 100%;
}

thead {
  background-color: #004080;
  color: #ffffff;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #cccccc;
}

#chat-container {
  max-width: 500px;
  margin-top: 20px;
}



#chat-form {
  display: flex;
  align-items: center;
}

#chat-input {
  flex-grow: 1;
  padding: 5px;
  border: 1px solid #cccccc;
  border-radius: 3px;
}

#chat-form button {
  margin-left: 10px;
}

    </style>

</head>
<body>
    <h1>
        <?php 
        echo $workspace_name;
           ?>
           </h1>

    <h2>Select Building Items</h2>
    <form method="post" action="">
        <label for="item-list">Building Items:</label>
        <select id="item-list" name="item-list">
            <option value="foundation">Foundation</option>
            <option value="bricks">Bricks</option>
            <option value="cement">Cement</option>
            <option value="doors">Doors</option>
            <option value="electrical">Electrical Wiring</option>
            <option value="flooring">Flooring</option>
            <option value="glass">Glass</option>
            <option value="insulation">Insulation</option>
            <option value="paint">Paint</option>
            <option value="roofing">Roofing</option>
            <option value="windows">Windows</option>
            <!-- Add more building items here -->
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="0" value="0">

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0.01" step="0.01" value="0.00">

        <button type="button" onclick="addToCart()">Add to Cart</button>
    </form>

    <h2>Cart</h2>
    <form id="clear" name="clear" method="post" action="">
   <!-- <table id="cart">
        <thead>
            <tr>
                <th></th>
                <th>Building Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="cart-body">-->
            <!-- Cart items will be dynamically added here -->
            
            <?php
            // Retrieve the group ID from the session
           
// Retrieve the cart items from the database


// Retrieve the cart items from the database
$sql = "SELECT * FROM cart WHERE group_id = '$gpid'";
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
        $itemName = $row['item_name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $total = $row['total'];

        echo "<tr>";
        echo '<td><input type="checkbox" name="createSpace[]" value="' . $itemName . '"></td>'; // Checkbox in the new column
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

            
          

    <button type="submit" name="clear">Clear cart</button>
</form>

    <h2>Total Price</h2>
    <div id="total-price">
    <span id="total-price">
    
        <?php
    // Initialize the $totalprice variable
$totalprice = 0;

// Retrieve the cart items from the database
$sql = "SELECT * FROM cart WHERE group_id = '$gpid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iterate through each row and display the cart item
    while ($row = $result->fetch_assoc()) {
        $itemName = $row['item_name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $total = $row['total'];

        $totalprice += floatval($total);
        
    }

    // Display the total price after iterating through all the cart items
    echo "Total Price: " . number_format($totalprice, 2);
} else {
    echo "<tr><td colspan='4'>No items in the cart.</td></tr>";
}
?>
    </span>
    </div>

    <h2>Share Cart</h2>
    <button onclick="copyCartLink()">Copy Cart Link</button>

    <h2>Chat</h2>
<div id="chat-container">
  <fieldset style="width: 500px; height: 300px; max-width: 300px; overflow-y: auto; display: flex; flex-direction: column-reverse;">
   
  
  
  <div id="chat-messages" style="text-align: right; background-color: aquamarine;">
    
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

  </fieldset>
  <form id="chat-form" method="post" action=" ">
    <input type="text" id="chat-input" name="message" placeholder="Type your message..." maxlength="35">
    <input type="hidden" id="workspace" name="workspace" value="<?php echo $workspace_name;?>">
    <button type="submit">Send</button>
</form>

        </form>
</div>
<br><br>


    
 
 
 
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="script.js"></script>
    <script >
        // Function to fetch and display chat messages
  function fetchChatMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch-messages", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var chatMessagesContainer = document.getElementById("chat-messages");
        chatMessagesContainer.innerHTML = xhr.responseText;
        scrollToBottom();
      }
    };
    xhr.send();
  }
        
    function sendMessage() {
        var input = document.getElementById("chat-input");
        var message = input.value.trim();

        if (message !== "") {
            saveMessageToDatabase(message);
            input.value = "";
        }
    }

    function saveMessageToDatabase(message, workspace) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        fetchChatMessages(); // Fetch updated messages after saving
        console.log("Message saved successfully.");
      } else {
        console.error("Error saving message:", this.status);
      }
    }
  };

  var formData = new FormData();
  formData.append("message", message);
  formData.append("workspace", workspace);

  xhttp.open("POST", "workspace", true);
  xhttp.send(formData);
}

  


    

     // Function to handle form submission
  function handleFormSubmit(event) {
    event.preventDefault();
    var chatInput = document.getElementById("chat-input");
    var workspaceInput = document.getElementById("workspace");
    var message = chatInput.value.trim();
    var workspace = workspaceInput.value.trim();

    if (message !== "" && workspace !== "") {
      saveMessageToDatabase(message, workspace);
      chatInput.value = "";
    }
  }

  // Event listener for form submission
  var chatForm = document.getElementById("chat-form");
  chatForm.addEventListener("submit", handleFormSubmit);

  // Function to scroll to the bottom of the chat container
  function scrollToBottom() {
    var chatContainer = document.getElementById("chat-container");
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }

  // Fetch chat messages on page load
  fetchChatMessages();

  // Periodically fetch chat messages (e.g., every 5 seconds)
  setInterval(fetchChatMessages, 5000);

       function showPopup() {
  var popup = document.getElementById("popup");
  popup.classList.add("active");
}

function hidePopup() {
  var popup = document.getElementById("popup");
  popup.classList.remove("active");
}


        // Initialize shared cart
        var sharedCart = [];

        // Initialize chat messages
        var chatMessages = [];

        function addToCart() {
  var itemList = document.getElementById("item-list");
  var selectedOption = itemList.options[itemList.selectedIndex];

  var quantityInput = document.getElementById("quantity");
  var quantity = parseInt(quantityInput.value);

  var priceInput = document.getElementById("price");
  var price = parseFloat(priceInput.value);

  var groupID = <?php echo json_encode($_SESSION['group_id']); ?>; // Retrieve the groupID from the PHP session

  if (quantity > 0 && price >= 0.01) {
    var itemName = selectedOption.text;
    var total = quantity * price;

    var item = {
      name: itemName,
      quantity: quantity,
      price: price,
      total: total
    };

    sharedCart.push(item);

    var cartTable = document.getElementById("cart-body");
    var newRow = cartTable.insertRow();

    var itemCell = newRow.insertCell();
    itemCell.textContent = itemName;

    var quantityCell = newRow.insertCell();
    quantityCell.textContent = quantity;

    var priceCell = newRow.insertCell();
    priceCell.textContent = price.toFixed(2);

    var totalCell = newRow.insertCell();
    totalCell.textContent = total.toFixed(2);

    
    saveCartToDatabase(itemName, quantity, price, total, groupID); // Pass the groupID parameter

    // Reset input fields
    quantityInput.value = "0";
    priceInput.value = "0.00";
  }
}


            // Reset input fields
            quantityInput.value = "0";
            priceInput.value = "0.00";
        

            function updateTotalPrice() {
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'workspace', // Replace with the actual URL of your PHP script
        type: 'GET',
        success: function(response) {
            // Update the total price on the page with the returned value
            $('#total-price').text(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


        function saveCartToDatabase(itemName, quantity, price, total, groupID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        console.log("Cart values saved to database.");
      } else {
        console.error("Error saving cart values:", this.status);
      }
    }
  };

  var formData = new FormData();
  formData.append("itemName", itemName);
  formData.append("quantity", quantity);
  formData.append("price", price);
  formData.append("total", total);
  formData.append("groupID", groupID); // Add the groupID to the form data

  xhttp.open("POST", "insert_cart", true);
  xhttp.send(formData);
}



        function copyCartLink() {
            var cartUrl = window.location.href;
            navigator.clipboard.writeText(cartUrl).then(function () {
                alert("Cart link copied to clipboard!");
            }).catch(function (error) {
                console.error("Failed to copy cart link: ", error);
            });
        }
       

        function renderChatMessages() {
            var chatMessagesContainer = document.getElementById("chat-messages");
            chatMessagesContainer.innerHTML = "";

            chatMessages.forEach(function (message) {
                var messageElement = document.createElement("div");
                messageElement.textContent = message;
                chatMessagesContainer.appendChild(messageElement);
            });
        }


    </script>
</body>
</html>


