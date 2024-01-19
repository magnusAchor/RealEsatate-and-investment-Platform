<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//var_dump($_POST);

include 'connect.php';
$email=$_SESSION['email'];
//echo $email;
$_SESSION['groupid']=$_POST['groupid'];




if (isset($_POST['workspace']) && isset($_POST['groupid'])) {
   $_SESSION['workspace'] = $_POST['workspace'];
   $workspace_name= $_SESSION['workspace'] ;

    $_SESSION['groupid'] = $_POST['groupid'];
    $gpid=$_SESSION['groupid'];

    //echo $gpid;
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
//echo $username;









$sql = "SELECT id FROM users WHERE username ='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $userID = $row['id'];

      // Display the retrieved user ID
      //echo "User ID: " . $userID.'<br>'.'<br>';
      
  } else {
      // User not found or multiple users with the same username exist
      echo "Error: Unable to retrieve user ID.";
  }





// Insert into chats, receive values from buyers (new workspace popup)

if (isset($_POST['createGroup'])) {
  $workspace = $_POST['workspace'];
  $selectedUsers = isset($_POST['createSpace']) ? $_POST['createSpace'] : [];

  $GroupId = uniqid();
  //echo $GroupId;

  if (!empty($workspace) && !empty($selectedUsers)) {
      foreach ($selectedUsers as $user) {
          // Escape the input values to prevent SQL injection
          $workspace = mysqli_real_escape_string($conn, $workspace);
          $user = mysqli_real_escape_string($conn, $user);

          // Verify if $user is a valid number
          if (is_numeric($user)) {
              // Cast $user to an integer to ensure it is handled as an integer value
              $user = (int)$user;

              // Insert each selected user value into the chat table
              $insertQuery = "INSERT INTO chat (userName, workspace_name, group_id, user_id, workers_id, message) VALUES ('$username', '$workspace', '$GroupId', $userID, $user, 'welcome')";
              $conn->query($insertQuery);
          } else {
              echo "Invalid user ID: $user";
          }
      }
      $red="SELECT email from buyers WHERE 'email' = '$email' " ;
        if( $conn->query($red)>0){
          header("location: worklist" );

        }else{
          header("location: worklist_worker" );
        }
      
   

      echo "Selected users added to the chat successfully.";

      // Set the session variable to mark that the code has been executed
      $_SESSION['groupCreated'] = true;
      
  } else {
      echo "Please select at least one user and provide a workspace name.";
  }
}







?>



<!DOCTYPE html>
<html>
<head>
    <title>Workspace - Building Item Selection</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        //history.replaceState({}, null, '/po8yugyt');
    </script>
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
    <form name="addCart" method="post" action="">
        <label for="item-list">Building Items:</label>
        <select type="text "id="item-list" name="item-list">
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

        <button type="button" name="addCart" onclick="posted()" >Add to Cart</button>
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
   include 'insert_cart_items.php';
?>

            
          

    
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

    <h2>Pay</h2>
    <button onclick="copyCartLink()">Pay Worker</button>

    <h2>Chat</h2>
<div id="chat-container">
  <fieldset style="width: 500px; height: 300px; max-width: 300px; overflow-y: auto; display: flex; flex-direction: column-reverse;">
   
  
  
  <div id="chat-messages" style="text-align: right; background-color: aquamarine;">
    

    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

  </fieldset>
  </div>
    <input type="text" id="message" name="message" placeholder="Type your message..." maxlength="35">
    <input type="hidden" id="workspace" name="workspace" value="<?php echo $workspace_name;?>">
    <button type="button" name="send" onclick="chat()">Send</button>


        </form>
       

<br><br>


    
 
 
 
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src=" "></script>
    <script >
      
    
      $(document).ready(function () {
        $('#chat-container').click(function (e) { 
          e.preventDefault();
      
          location.reload();
          
        });
      });
      //add to cart
  
      function posted() {
        var selectElement = document.getElementById("item-list");
    var selectedValue = selectElement.value;
    console.log(selectedValue);

    var select = $('select[name="item-list"]').val();
    console.log(select);
    var quantity = $('input[name="quantity"]').val();
    var price = $('input[name="price"]').val();
    var total = parseFloat(quantity) * parseFloat(price); // Calculate the total

    var form = { "item-list": selectedValue, quantity: quantity, price: price, total: total };

    $.post("insert_cart", form, function (data, textStatus, jqXHR) {
        // The 'data' variable will hold the response from the server

        // Process the 'data' as needed
        // For example, you can display a success message or update the cart display
        console.log(data); // Output the response to the browser's console for debugging purposes
    }).fail(function (jqXHR, textStatus, errorThrown) {
        // This function is executed when the AJAX request fails.
        // You can handle errors and display error messages here.
        console.log("AJAX request failed: " + textStatus);
    });

    $.post("insert_cart_items", form, function (data, textStatus, jqXHR) {
        // The 'data' variable will hold the response from the server

        // Process the 'data' as needed
        // For example, you can display a success message or update the cart display
        console.log(data); // Output the response to the browser's console for debugging purposes
    }).fail(function (jqXHR, textStatus, errorThrown) {
        // This function is executed when the AJAX request fails.
        // You can handle errors and display error messages here.
        console.log("AJAX request failed: " + textStatus);
    });

    //alert(price + select + quantity);
    // Reloads the current page
location.reload();

}

  
function chat() {
    var workspace = $('input[name="workspace"]').val();
    var messages = $('input[name="message"]').val();
    console.log(messages);
    
    // Create an object with the data you want to send to the server
    var messageData = {
        workspace: workspace,
        message: messages
    };

    // Send the data to the server using AJAX
    $.post("insert_chat", messageData)
    .done(function (data) {
        // This function is executed when the AJAX request is successful
        console.log(data); // Output the server response to the browser's console for debugging purposes
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        // This function is executed when the AJAX request fails.
        // You can handle errors and display error messages here.
        console.log("AJAX request failed: " + textStatus);
    });
    fetchChatMessages();

  }
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
  function scrollToBottom() {
    var chatContainer = document.getElementById("chat-container");
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }


  // Fetch chat messages on page load
  fetchChatMessages();

  // Periodically fetch chat messages (e.g., every 5 seconds)
  setInterval(fetchChatMessages, 5000);


    </script>
</body>
</html>


