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
   // echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Post</title>
  <link rel="stylesheet" type="text/css" href="custom-popup.css">
  <style>
    .search-container {
      position: relative;
      display: inline-block;
      margin-inline-end: 455px;
    }

    #search-input {
      padding: 10px;
      width: 200px;
    }

    .custom-popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 5px;
  z-index: 9999; /* Add a higher z-index value */
}


    .custom-popup h2 {
      margin-top: 0;
    }

    .custom-popup input[type="text"],
    .custom-popup button {
      display: block;
      margin-bottom: 10px;
      padding: 5px;
    }

    .custom-popup button {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    .custom-popup button:hover {
      background-color: #45a049;
    }

    .file-input-container {
      position: relative;
      display: inline-block;
    }

    .file-input-label {
      display: inline-block;
      padding: 8px 15px;
      background-color: #f1f1f1;
      color: #333;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .file-input-text {
      margin-right: 10px;
    }

    /* Hide the default file input */
    input[type="file"] {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      width: 0;
      height: 0;
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
    }

    .uploaded-files-container {
      margin-top: 20px;
    }

    .uploaded-file {
      margin-bottom: 10px;
    }

    .preview-container {
      display: flex;
      flex-wrap: wrap;
      margin-top: 10px;
    }

    .preview-item {
      margin-right: 10px;
      margin-bottom: 10px;
    }

    .preview-item img,
    .preview-item video {
      max-width: 200px;
      max-height: 200px;
    }
    
     p#charCount {
            color: blue;
        }

        .red-text {
            color: red;
        }
    
   
  </style>
  <script>
        // Add an event listener to the textarea to limit the character count
        document.querySelector('.caption').addEventListener('input', function () {
            var textarea = this;
            var maxLength = parseInt(textarea.getAttribute('maxlength'));

            if (textarea.value.length > maxLength) {
                textarea.value = textarea.value.slice(0, maxLength); // Truncate the text
            }
            
            // Update the character count and apply the red color class if remaining chars are less than 10
            updateCharacterCount();
        });

        var textarea = document.querySelector('.caption');
        var charCount = document.getElementById('charCount');
        var maxLength = parseInt(textarea.getAttribute('maxlength'));

        // Function to update character count and display a message
        function updateCharacterCount() {
            var remainingChars = maxLength - textarea.value.length;
            charCount.textContent = 'Characters remaining: ' + remainingChars;

            if (remainingChars < 0) {
                charCount.classList.add('red-text'); // Apply the red color class
                charCount.textContent = 'Exceeded maximum character limit of 200';
            } else {
                charCount.classList.remove('red-text'); // Remove the red color class
            }
        }

        // Add an event listener to the textarea
        textarea.addEventListener('input', updateCharacterCount);

        // Initial character count update
        updateCharacterCount();
    </script>
</head>
<body>
  <div class="search-container">
    <input type="text" id="search-input" style="margin-left: 1030px;" placeholder="Create Post..." onclick="return false;">
    <div class="custom-popup" id="custom-popup" style=" max-height: 50%; overflow-y: auto;">
      <span class="close-button" onclick="closePopup()">&times;</span>
      <h2>Create Post</h2>
     <p class="caution" style="color:red;"> Please note that only property-related posts, such as land sales, house rentals, and sales, are accepted. All other posts will not be approved.</P><br>
      <form class="postty" action="save_post" method="POST" enctype="multipart/form-data" >
   <div style="position: relative;">
        <textarea class="caption" rows="5" cols="40" maxlength="200" style="max-height: 200px;"></textarea>
        <p id="charCount" class="blue-text" style="position: absolute; bottom: 5px; right: 5px;">Characters remaining: 200</p>
    </div>
  <label for="price">Price (NGN):</label><br>
  <input type="number" class="price" id="price" step="0.01" placeholder="Enter price in NIARA" required><br><br>

  <label for="property_type">Property Type:</label>
  <select class="property_type" id="property_type" required>
    <option value="" selected disabled>Select Property Type</option>
    <option value="house">House</option>
    <option value="apartment">Apartment</option>
    <option value="condo">Condo</option>
  <option value="townhouse">Townhouse</option>
  <option value="villa">Villa</option>
  <option value="duplex">Duplex</option>
  <option value="penthouse">Penthouse</option>
  <option value="studio">Studio</option>
  <option value="cottage">Cottage</option>
  <option value="bungalow">Bungalow</option>
  <option value="land">Land</option>
  <option value="commercial">Commercial Property</option>
  <option value="industrial">Industrial Property</option>
  <option value="farm">Farm</option>
  <option value="ranch">Ranch</option>
  <option value="beach_house">Beach House</option>
  <option value="country_house">Country House</option>
  <option value="mobile_home">Mobile Home</option>
  <option value="hotel">Hotel</option>
  <option value="resort">Resort</option>
  <option value="office_space">Office Space</option>
  <option value="retail_space">Retail Space</option>
  <option value="warehouse">Warehouse</option>
  <option value="restaurant">Restaurant</option>
  <option value="parking_space">Parking Space</option>

  </select><br><br>
  <label for="location-input">Phonenumber:</label>
  <input type="text" id="phn" class="phn" placeholder="Enter a phone number" required>
  
  <label for="location-input">Email:</label><br>
  <input type="email" id="emaill" class="emaill" placeholder="Enter a valid email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br><br>

  <label for="location-input">Whatsapp Number:</label>
  <input type="text" id="whtNumb" class="whtNumb" placeholder="Enter a valid Whatsapp number" required>
  
  <!-- Location Search Input -->
  <label for="location-input">Location:</label>
  <input type="text" id="location-input" class="location-input" placeholder="Enter a location" required>

  <!-- Suggestions Dropdown -->
  <div id="suggestions"></div>

  <div class="file-input-container">
  <label for="media" class="file-input-label">
    <span class="file-input-text">Choose Files (Max 3)</span>
    <input type="file" class="media[]" id="media" accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx" multiple required
           onchange="limitMediaSelection(this, 3)">
  </label>
</div>


  <button type="submit" class="save-button" >Save Post</button>

  

</form>

      <div class="uploaded-files-container">
        <h3>Uploaded Files:</h3>
        <div id="uploaded-files" class="preview-container"></div>
      </div>
    </div>
  </div>

  

  <script>
   document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms['postty'];

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                // Display the alert to the customer
                alert("Your post has been submitted and is pending verification.");

                // Proceed with form submission after showing the alert
                form.submit();
            });
        });


  // Add an event listener to the form submission button
  const submitButton = document.querySelector('.save-button');
  submitButton.addEventListener('click', function (event) {
   alert('your post is pending verification');
  });





    function closePopup() {
      document.getElementById('custom-popup').style.display = 'none';
    }

    const searchInput = document.getElementById('search-input');
    const popup = document.getElementById('custom-popup');

    searchInput.addEventListener('click', function() {
      popup.style.display = 'block';
    });

// Show the uploaded files' previews
const fileInput = document.getElementById('media');
const uploadedFilesContainer = document.getElementById('uploaded-files');

fileInput.addEventListener('change', function(e) {
  const files = e.target.files;

  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const fileName = file.name;
    const fileURL = URL.createObjectURL(file);
    const uploadedFile = document.createElement('div');
    uploadedFile.classList.add('preview-item');

    // Display image preview
    if (file.type.startsWith('image/')) {
      const image = document.createElement('img');
      image.src = fileURL;
      uploadedFile.appendChild(image);
    }

    // Display video preview
    if (file.type.startsWith('video/')) {
      const video = document.createElement('video');
      video.src = fileURL;
      video.controls = true;
      uploadedFile.appendChild(video);
    }

    // Display other file type
    if (!file.type.startsWith('image/') && !file.type.startsWith('video/')) {
      const fileLink = document.createElement('a');
      fileLink.href = fileURL;
      fileLink.textContent = fileName;
      uploadedFile.appendChild(fileLink);
    }

    uploadedFilesContainer.appendChild(uploadedFile);
  }
});

// Additional code to handle selecting more files without removing previous selections
const form = document.querySelector('form');

form.addEventListener('submit', function(e) {
  e.preventDefault();

  // Clear the file input value after submission
  fileInput.value = '';

  // Reset the input element to allow selecting the same files again
  fileInput.type = '';
  fileInput.type = 'file';
});

// Clear the uploaded files preview when closing the popup
function closePopup() {
  uploadedFilesContainer.innerHTML = '';
  document.getElementById('custom-popup').style.display = 'none';
}




        // Function to fetch location suggestions from Nominatim API
        function fetchSuggestions(query) {
            const apiUrl = `https://nominatim.openstreetmap.org/search?q=${query}&format=json`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const suggestionsContainer = document.getElementById('suggestions');
                    suggestionsContainer.innerHTML = '';

                    data.forEach(place => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.classList.add('suggestion-item');
                        suggestionItem.innerText = place.display_name;
                        suggestionItem.addEventListener('click', () => {
                            document.getElementById('location-input').value = place.display_name;
                            suggestionsContainer.innerHTML = '';
                        });

                        suggestionsContainer.appendChild(suggestionItem);
                    });
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                });
        }

        // Function to handle input changes and fetch suggestions
        function handleInput() {
            const input = document.getElementById('location-input');
            const query = input.value.trim();

            if (query.length >= 3) {
                fetchSuggestions(query);
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        }

        // Event listener for input changes
        document.getElementById('location-input').addEventListener('input', handleInput);

        // Prevent form submission for demonstration purposes
        document.querySelector('form').addEventListener('submit', (event) => {
          
            alert('your post is pending verification.');
        });

        function limitMediaSelection(input, maxFiles) {
  const selectedFiles = input.files;
  if (selectedFiles.length > maxFiles) {
    alert(`You can only select a maximum of ${maxFiles} files.`);
    input.value = ''; // Clear the selected files
  }
}

    
  </script>
</body>
</html>
