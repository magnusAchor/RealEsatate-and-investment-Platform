<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//var_dump($_POST);

include 'connect.php';
include 'hearder.php';
$email=$_SESSION['email'];
//echo $email;
$_SESSION['chatted']=$_POST['chatted'];
$username = $_SESSION['username'];




if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];

 

 
} else {
  // Handle the case where the username is not set or empty
 // echo '<script>alert("User not logged in");</script>';
  header("Location: index " );
  exit();
}










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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $chatted = isset($_POST['chatted']) ? intval($_POST['chatted']) : 0;
    $fullname = isset($_SESSION['fullnamee']) ? $_SESSION['fullnamee'] : '';
    $chattingid = $chatted + $userID;
/*
    // Prepare and execute SQL query with prepared statement
    $sql = "INSERT INTO chat (userName, group_id, message) VALUES (?, ?, 'new chat')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $chattingid);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    */
}

  

   






?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #chat-container {
          width: 500px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: fixed;
    height: 50vh;
    margin-bottom: 100px;
        }

        #user-list {
            text-align: left;
            margin-bottom: 10px;
        }

        #user-list ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #user-list li {
            margin: 5px 0;
        }

        #chat-messages {
            text-align: right;
            background-color: aquamarine;
            flex-grow: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse;
            border: 1px solid #cccccc;
            border-radius: 3px;
            padding: 10px;
        }

        #message {
            padding: 5px;
            border: 1px solid #cccccc;
            border-radius: 3px;
            margin-right: 10px;
            flex-grow: 1;
        }

        #chat-form button {
            padding: 8px 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #2980b9;
        }
          @media (max-width: 900px) {
            #chat-container {
          width: 250px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: fixed;
    height: 70vh;
    margin-bottom: 5px;
        }
        div#chat-messages {
    width: inherit;
}


          }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="user-list">
            <ul id="users"></ul>
        </div>
        <fieldset style="width: 100%;">
            <legend><?php echo $fullname; ?></legend>
        </fieldset>
        <div id="chat-messages"></div>
        <div id="chat-form">
            <input type="text" id="message" name="message" placeholder="Type your message..." maxlength="35">
            <input type="hidden" id="chatting" name="chatting" value="<?php echo $chattingid; ?>">
            <button type="button" name="send" onclick="chat()">Send</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script >
    
  
      

  
function chat() {
    var chatting = $('input[name="chatting"]').val();
    var convers = $('input[name="message"]').val();
    //console.log(convers);
    
    // Create an object with the data you want to send to the server
    var conversData = {
        chatting: chatting,
        message: convers
    };

    // Send the data to the server using AJAX
    $.post("insert_livechat", conversData)
    .done(function (data) {
        $('input[name="message"]').val(""); 
        // This function is executed when the AJAX request is successful
       // console.log(data); // Output the server response to the browser's console for debugging purposes
        
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        // This function is executed when the AJAX request fails.
        // You can handle errors and display error messages here.
        //console.log("AJAX request failed: " + textStatus);
    });
    $.post("fetch-livemessages", conversData)
    .done(function (data) {
        // This function is executed when the AJAX request is successful
       // console.log(data); // Output the server response to the browser's console for debugging purposes
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        // This function is executed when the AJAX request fails.
        // You can handle errors and display error messages here.
        //console.log("AJAX request failed: " + textStatus);
    });
    fetchhatMessages();
   // location.reload();

  }
  function fetchhatMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch-livemessages", true);
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
  fetchhatMessages();

  // Periodically fetch chat messages (e.g., every 5 seconds)
  setInterval(fetchhatMessages, 5000);

  
    </script>
</body>
</html>
