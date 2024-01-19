<?php
include 'connect.php';
// Check if the username is set and not empty
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Handle the case where the username is not set or empty
    
    header("Location: index " );
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Add your CSS styles here -->
    <style>
         .center-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .post-container {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .post-button {
            background-color: #f2f2f2;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .inner-fieldset {
            display: inline-block;
            margin: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .media-container {
            max-width: 300px;
            max-height: 200px;
            overflow: hidden;
        }

        .post-image {
            max-width: 100%;
            max-height: 100%;
        }

        .post-video {
            max-width: 100%;
            max-height: 100%;
        }

        .post-document {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #000;

        }

        /* Style for the contact popup */
        .contact-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
        }

        .contact-popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px; /* Increase padding to make the popup bigger */
            width: 400px; /* Set a specific width to control the size of the popup */
            max-width: 90%; /* Set a maximum width to handle smaller screens */
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            max-height: 400px; 
            min-width: fit-content;
        }

        .contact-info {
            margin-bottom: 10px;
        }

        .contact-info label {
            font-weight: bold;
        }

        .contact-info span {
            display: block;
        }

        .whatsapp-button {
            display: block;
            background-color: #25D366;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
        }

 
    .search-button {
        min-width: 500px;
        margin-left: 300px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        background-color: #f7f7f9; /* Optional: Customize the button color */
        color: white; /* Optional: Customize the icon and text color */
        border: outset;
        cursor: pointer;
    }

    .search-button i {
        margin-right: 10px; /* Space between icon and text */
    }

    .search-form button {
    padding: 6px 12px;
    background-color: #f7f7f9;
    color: #007bff;
    border: outset;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    
}
@media (max-width: 768px) {
    .search-button {
        min-width: 500px;
        margin-left: 300px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        background-color: #f7f7f9; /* Optional: Customize the button color */
        color: white; /* Optional: Customize the icon and text color */
        border: outset;
        cursor: pointer;
    }

    }

    @media (width: 560px) {
    .search-button {
        min-width: 490px;
        max-width: 490px;
    }

    }

    @media (width: 375px) {
    .search-button {
        min-width: 300px;
        max-width: 300px;
    }

    }
    @media (width: 414px) {
    .search-button {
        min-width: 350px;
        max-width: 350px;
    }

    }
    @media (width: 390px) {
    .search-button {
        min-width: 300px;
        max-width: 300px;
    }

    }
    @media (width: 393px) {
    .search-button {
        min-width: 300px;
        max-width: 300px;
    }

    }

    @media (width: 360px) {
    .search-button {
        min-width: 240px;
        max-width: 240px;
    }

    }
    @media (width: 412px) {
    .search-button {
        min-width: 380px;
        max-width: 380px;
    }

    }
    @media (width: 540px) {
    .search-button {
        min-width: 400px;
        max-width: 400px;
    }

    }

    @media (width: 280px) {
    .search-button {
        min-width: 200px;
        max-width: 200px;
    }

    }

    @media (width: 412px) {
    .search-button {
        min-width: 300px;
        max-width: 300px;
    }

    }
    @media (width: 560px) {
    .search-button {
        min-width: 500px;
        max-width: 500px;
    }

    }
    </style>
</head>
<body>
    

    <!-- Modify the search form to show search results in the popup -->
<div class="search-form">
    <form method="POST" >
       
    <button class="search-button"  onclick="showSearchResultsPopup(); return false;">
    <i class="fas fa-search"></i> Search
</button>

    </form>
</div>

        <script>
             // Check if the popup should be displayed based on local storage
    window.onload = function() {
      const shouldDisplayPopup = localStorage.getItem('displaySearchPopup');

      if (shouldDisplayPopup === 'true') {
        showSearchResultsPopup();
        event.preventDefault(); 
      }
    };

    function showSearchResultsPopup() {
      document.getElementById('search-results-popup').style.display = 'block';
      localStorage.setItem('displaySearchPopup', 'true');
    }

    function hideSearchResultsPopup() {
      document.getElementById('search-results-popup').style.display = 'none';
      localStorage.setItem('displaySearchPopup', 'false');
    }
   
    function showContactPopup() {
            document.getElementById("contactPopup").style.display = "block";
        }

        function closeContactPopup() {
            document.getElementById("contactPopup").style.display = "none";
        }

        const contactButtons = document.querySelectorAll(".contact-button");

        contactButtons.forEach((button) => {
            button.addEventListener("click", showContactPopup);
        });
</script>

    <!-- Add a hidden container to hold the search results -->
    <div class="search-results" style="display: none;">
<div class="search-results-content">
        
        </div>
    </div>
 
<!-- Add the search results popup HTML at the end of the body -->
<div class="contact-popup" id="search-results-popup">
    
    <div class="contact-popup-content">
    <button onclick="hideSearchResultsPopup()">Close</button>
        <h2>Search Results</h2>
        <!-- Search results will be displayed here -->
        <div class="search-results-content">
           
        <?php
        
        
       include 'searchengine.php';
        
        ?>
            

        </div>
        <button onclick="hideSearchResultsPopup()">Close</button>
    </div>
</div>
<!-- Your HTML content here -->
    <!-- Contact Popup -->
    <div class="contact-popup" id="contactPopup">
        <div class="contact-popup-content">
            <div class="contact-info">
                <label>Contact Information:</label>
                <span>Name: Magnus Achor</span>
                <span>Email: rresha160@gmail.com</span>
                <span>Phone: +2349152326481</span>
            </div>
            <a href="https://api.whatsapp.com/send?phone=+2349152326481" class="whatsapp-button" target="_blank">Chat on WhatsApp</a>
            <button onclick="closeContactPopup()">Close</button>
        </div>
    </div>
</body>
</html>
