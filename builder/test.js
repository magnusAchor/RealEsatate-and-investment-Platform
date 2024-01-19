// Function to fetch and display chat messages
function fetchChatMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch-messages.php", true);
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

  xhttp.open("POST", "workspace.php", true);
  xhttp.send(formData);
}

  


    function handleKeyPress(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            sendMessage();
        }
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



            // Reset input fields
            quantityInput.value = "0";
            priceInput.value = "0.00";
        

            function updateTotalPrice() {
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'workspace.php', // Replace with the actual URL of your PHP script
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

  xhttp.open("POST", "insert_cart.php", true);
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

