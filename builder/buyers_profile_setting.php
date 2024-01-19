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
    
    header("Location: index " );
    exit();
}


// Validate and sanitize the username session variable
$username = isset($_SESSION['username']) ? trim($_SESSION['username']) : '';
$username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Validate and sanitize the email session variable
$email = isset($_SESSION['email']) ? trim($_SESSION['email']) : '';
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

// Check if the email is valid and non-empty
if (!$email) {
    die("Invalid email.");
}

// Prepare and execute SQL query to retrieve the user's location, name, and profile_pic from the buyers table
$stmt = $conn->prepare("SELECT location, name, profile_pic FROM buyers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$loc = $stmt->get_result();

if ($loc->num_rows == 1) {
    $row = $loc->fetch_assoc();
    $location = $row['location'];
    $name = $row['name'];
    $imageData = $row['profile_pic'];

    // Sanitize the location and name retrieved from the database before displaying
    $location = htmlspecialchars($location);
    $name = htmlspecialchars($name);
} else {
    // User not found or multiple users with the same email exist
    die("Error: Unable to retrieve user information.");
}

// Prepare and execute SQL query to retrieve the user ID from the users table
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userID = $row['id'];

    // Sanitize the user ID retrieved from the database before displaying
    $userID = htmlspecialchars($userID);
} else {
    // User not found or multiple users with the same username exist
    die("Error: Unable to retrieve user ID.");
}

$stmt->close();
/*
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Settings</title>
          <script>
        //history.replaceState({}, null, '/bps434566');
        </script>
        
    <style>
       

         .center-container-media {
           
            justify-content: center;
            margin-bottom: 0px;
            z-index: 2;
        }

        .post-container-media-media {
            padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    width: 1000px;
    overflow-x: auto;
 
    overflow-y: hidden;
}
        

       
   
       
        .media-container {
            max-width: 300px;
            max-height: 200px;
           /* overflow: hidden;*/
           display: contents;

        }

        .post-image {
            min-width: 100px;
    max-width: 100%;
    max-height: 50px;
        }

        .post-video {
           min-width: 100px;
    max-width: 100%;
    max-height: 50px;
        }

        .post-document {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #000;

        }
        fieldset#post-container-media-media {
    max-width: 400px;
}


        
        p.post-button {
    background-color: olive;
    margin-top: 0px;
    padding-top: 10px;
    padding-bottom: 10px;
}

       

        .media-container img {
  width: 100%;
  height: 100%;
}

button.contactt {
    padding: 5px;
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
}

@keyframes colorChange {
  0% {
    background-color: #f0f0f0;
  }
  100% {
    background-color: #dcdcdc; /* Slightly darker shade */
  }
}

fieldset#post-container {
    background-color: #f0f0f0; /* Initial background color */
  animation: colorChange 4s ease-in-out infinite alternate; /* Adjust animation duration and timing as needed */
    padding: 5px;
    border: 1px solid #ccc;
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

@media screen and (min-width: 900px) {
    fieldset#post-container {
    max-width: 468px;
    max-height: 864px;
}


div#post-container-media-media {
    max-width: 468px;
    max-height: 585px;
}
img.post-image {
    min-width: 468px;
    max-width: 468px;
    max-height: 500px;
    overflow-x: hidden;
    overflow-y: hidden;
}

video.post-video {
    min-width: 468px;
    max-width: 468px;
    max-height: 500px;
    min-height: 500px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}


  /* Add this CSS code to style the posts for small screens */
/* Default media query for smaller screens */
@media (max-width: 820px) {
    fieldset.post-container {
        min-width: 400px;
        max-width: 400px;
        margin-inline-start: 250px;
        max-height: 743.5px;
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 795px; 
    max-width: 795px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 468px;
    max-width: 468px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
:root {
    --offset: 25px;
}
/* Specific adjustment for 200px screen width */
@media (width: 280px) {
    fieldset.post-container {
        min-width: 270px;
        max-width: 270px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 220px; 
    max-width: 220px; 
    max-height: 100%;
    overflow-x: hidden;
}

video.post-video {
    min-width: 220px;
    max-width: 220px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 375px) {
    fieldset.post-container {
        min-width: 340px;
        max-width: 340px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 315px; 
    max-width: 315px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 315px;
    max-width: 315px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 390px) {
    fieldset.post-container {
        min-width: 360px;
        max-width: 360px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 330px; 
    max-width: 330px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 330px;
    max-width: 330px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 393px) {
    fieldset.post-container {
        min-width: 370px;
        max-width: 370px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 333px; 
    max-width: 333px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 333px;
    max-width: 333px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 360px) {
    fieldset.post-container {
        min-width: 340px;
        max-width: 340px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 335px; 
    max-width: 335px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 335px;
    max-width: 335px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 412px) {
    fieldset.post-container {
        min-width: 390px;
        max-width: 390px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset));
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 352px; 
    max-width: 352px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 352px;
    max-width: 352px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 820px) {
    fieldset.post-container {
        min-width: 800px;
        max-width: 800px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 760px; 
    max-width: 760px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 760px;
    max-width: 760px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 768px) {
    fieldset.post-container {
        min-width: 740px;
        max-width: 740px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 708px; 
    max-width: 708px; 
    max-height: 100%;
    overflow-x: hidden;
}
}

@media (width: 540px) {
    fieldset.post-container {
        min-width: 500px;
        max-width: 500px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 480px; 
    max-width: 480px; 
    max-height: 100%;
    overflow-x: hidden;
}
}




@media (width: 560px) {
    fieldset.post-container {
        min-width: 520px;
        max-width: 520px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 500px; 
    max-width: 500px; 
    max-height: 100%;
    overflow-x: hidden;
}
video.post-video {
    min-width: 500px;
    max-width: 500px;
    max-height: 585px;
    min-height: 585px;
    overflow-x: hidden;
    overflow-y: hidden;
}
}
@media (width: 320px) {
    fieldset.post-container {
        min-width: 300px;
        max-width: 300px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
    .post-container-media-media {
    padding: 5px;
    border: 1px solid #ccc;
    display: flex;
    max-width: calc(100% - var(--offset)); 
    overflow-x: auto;
    max-height: 300px;
}
img.post-image {
    min-width: 260px; 
    max-width: 260px; 
    max-height: 100%;
    overflow-x: hidden;
}
}







    </style>
  <style>
    <style>
    /* CSS styling remains unchanged */
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
      text-align: center;
    }
    
    .profile-details {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .profile-pic {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-right: 20px;
    }
    
    .profile-info {
      flex: 1;
      margin-left: 20px;
      
    }
    
    .profile-info h2 {
      margin: 0;
    }
    
    .edit-button {
      display: inline-block;
      padding: 8px 16px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .edit-button:hover {
      background-color: #45a049;
    }
    
    .save-button {
      display: none;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    input[type="text"] {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    
    .save-button {
      display: none;
    }
    

    /*post*/
      .center-container {
            display: flex;
            justify-content: center;
            /*margin-bottom: 20px;*/
            z-index: 2;
        }

        .post-container {
            padding: 5px;
            border: 1px solid #ccc;
        }
        
        fieldset#post-container {
    margin-inline-start: 0px;
}

        fieldset.post-container {
   /* min-width: 800px;*/
    margin-inline-start: 250px;
    /*max-height: 300px;*/
    max-width: 800px;
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
            min-width: 100px;
    max-width: 100%;
    max-height: 50px;
        }

        .post-video {
           min-width: 100px;
    max-width: 100%;
    max-height: 50px;
        }

        .post-document {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #000;

        }
        
        p.post-button {
    background-color: wheat;
    margin-top: 0px;
    padding-top: 10px;
    padding-bottom: 10px;
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
        /* Add this CSS code to style the posts for small screens */
/* Default media query for smaller screens */
@media (max-width: 820px) {
    fieldset.post-container {
        min-width: 400px;
        max-width: 400px;
        margin-inline-start: 250px;
    }
}

/* Specific adjustment for 200px screen width */
@media (width: 280px) {
    fieldset.post-container {
        min-width: 270px;
        max-width: 270px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 375px) {
    fieldset.post-container {
        min-width: 340px;
        max-width: 340px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 390px) {
    fieldset.post-container {
        min-width: 360px;
        max-width: 360px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 393px) {
    fieldset.post-container {
        min-width: 370px;
        max-width: 370px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 360px) {
    fieldset.post-container {
        min-width: 340px;
        max-width: 340px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 412px) {
    fieldset.post-container {
        min-width: 390px;
        max-width: 390px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 820px) {
    fieldset.post-container {
        min-width: 800px;
        max-width: 800px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 768px) {
    fieldset.post-container {
        min-width: 740px;
        max-width: 740px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}

@media (width: 540px) {
    fieldset.post-container {
        min-width: 500px;
        max-width: 500px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 1024px) {
    fieldset.post-container {
        min-width: 950px;
        max-width: 950px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 1280px) {
    fieldset.post-container {
        min-width: 1240px;
        max-width: 1240px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}

@media (width: 560px) {
    fieldset.post-container {
        min-width: 520px;
        max-width: 520px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
@media (width: 320px) {
    fieldset.post-container {
        min-width: 300px;
        max-width: 300px;
        margin-inline-start: 250; /* Adjust margin as needed */
    }
}
img.propics {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-left: 10px;
    cursor: pointer;
}
header .navigation {
    display: flex;
    margin-right: 100px;
}
.headerr img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-left: 10px;
    cursor: pointer;
    display:none;
}


  </style>
</head>
<header>
  <?php
  include 'hearder.php'; // You may need to correct the typo 'hearder' to 'header'
  ?>
</header>
<body>
<br><br><br><br><br><br>
  <div class="container">
    <h1>Profile Settings</h1>
    <div class="profile-details">
    
      <?php 
      if (isset($imageData)) {
          // Output the image after encoding to base64 to avoid potential XSS attacks
          echo '<img class="propics" src="data:' . 'image/jpeg' . ';base64,' . base64_encode($imageData) . '" />';
      } else {
          // Use a default profile image if the user doesn't have one
          echo '<img class="propics" src="profile-image.jpg" alt="Profile Image">';
      }
      ?>
     
      <div class="profile-info">
        <h2>
          <?php
          echo $name;
          ?>
        </h2>
        <p>Email: 
          <?php
          echo $email;
          ?>
        </p>
        <p>Location: <?php echo $location; ?></p>
        <p>Profession: Software Developer</p>
      </div>
      <button class="edit-button" onclick="enableEditing()">Edit</button>
      <button class="save-button" onclick="saveChanges()">Save</button>
    </div>
    <form id="profile-form" method="post" action="buyer_profilepic" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" value="<?php echo $name; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" value="<?php echo $email; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" id="location" value="<?php echo $location; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="profession">Profession</label>
        <input type="text" id="profession" value="Software Developer" disabled>
      </div>
      <input type="file" id="profile-picture-inputt" name="profile-picture-inputt" accept="image/*">
      <button type="submit">Upload</button>
    </form>
  </div>
  <?php
            
// Retrieve posts with documents
$sql = "SELECT userName, document, post_id, media_type, caption, price, property_type, location
FROM posts
WHERE post_id IN (SELECT post_id FROM posts GROUP BY post_id HAVING COUNT(*) > 1)
  AND user_id = $userID
  AND post_status = 'accept' ORDER BY created_at DESC";
        
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $posts = array(); // Create an array to store posts

    while ($row = $result->fetch_assoc()) {
        $posts[] = $row; // Add each post to the array
    }

    // Now you have all posts, and you can loop through them
    foreach ($posts as $row) {
        $postID = $row['post_id'];
        $documentData = $row['document'];
        $mediaType = $row['media_type'];
        $caption = $row['caption'];
        $location= $row['location'];
        $price= $row['price'];
        $property_type= $row['property_type'];
        $userName= $row['userName'];


        // Check if it's a new post ID
        if ($postID !== $currentPostID) {
            // Close the previous fieldset if it's not the first post
            if ($currentPostID !== null) {
                echo '</fieldset>';
                echo '</div>';
            }


             // Display the post container and button for the new post ID
             echo '<div class="center-container" style="display: flex; justify-content: center;  z-index: 2; "
             loading="lazy">';
                         echo '<fieldset id="post-container" class="post-container" style="margin-inline-start: 1px;" loading="lazy">';
                         echo '<div>';
                         // Retrieve the user profile picture
                 $sql = "SELECT profile_pic FROM employees WHERE username = ?";
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param("s", $userName);
                 $stmt->execute();
                 $result = $stmt->get_result();
             
                 if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                    
                     $profilePicture = $row['profile_pic'];
             
             
                     }
                 } else {
                     // The user email does not exist in the employee table
                     $sql = "SELECT profile_pic FROM buyers WHERE name = ?";
                     $stmt = $conn->prepare($sql);
                     $stmt->bind_param("s", $userName);
                     $stmt->execute();
                     $result = $stmt->get_result();
             
                     if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                    
                             $profilePicture = $row['profile_pic'];
                     
                     
                             }
                     } else {
                         // The user email does not exist in the buyers table either
                         $profilePicture = null;
                     }
                 }
             
                
             
                 echo '<p class="post-button" style="color: white; font-weight: bold; background-color: olive; margin-top: 0px; padding-top: 10px; padding-bottom: 10px; border: none; padding: 5px 10px; cursor: pointer; font-family: \'Arial\', sans-serif;" loading="lazy">';
             
                 // Check if the profile picture exists
                 if (!is_null($profilePicture)) {
                     // Display the profile picture
                     echo '<img class="profile-picture" style="width: 50px; height:50px; border-radius: 50%;  "src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" loading="lazy"/><br>';
                 }
                 
                 // Now, display the username
                 echo $userName . '</p><br>';
                 
                       echo '<p class="caption">Description: '.$caption.'</p><br>';
                         echo 'Location:  ' .$location.'<br>';
                         echo 'Property_type:  '.$property_type.'<br>';
                         echo 'Price:  '.$price.'<br><br>';
                         echo '<button class="contactt" style="background-color:#4CAF50;" onclick="showContactPopup()">Contact for more info</button><br>';
                         echo '</div>';

            // Display the post container and button for the new post ID
            echo '<div class="center-container-media"  justify-content: center;  z-index: 2;"
loading="lazy">';
            echo '<div id="post-container-media-media" class="post-container-media-media" style="margin-inline-start: 1px;" loading="lazy">';
           
   


            $currentPostID = $postID; // Update the current post ID
        }

        // Display the media (image, video, or document)
        echo '<div class="media-xxx" >';

        echo '<div class="media-container" >';

        if (!is_null($mediaType) && strpos($mediaType, 'image/') === 0) {
            // Display the image with fullscreen capability
            echo '<img class="post-image"  src="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" onclick="toggleFullscreen(this)" alt="Lazy Loaded Image" loading="lazy" />';
        } elseif (!is_null($mediaType) && strpos($mediaType, 'video/') === 0) {
            // Display the video
            echo '<video class="post-video"  alt="Lazy Loaded Image" loading="lazy" controls>';
            echo '<source src="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" type="' . $mediaType . '"onclick="toggleFullscreen(this)" >';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
        } elseif (!is_null($mediaType) && strpos($mediaType, 'application/') === 0) {
            // Display the document 
            echo '<a class="post-document" href="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '"  alt="Lazy Loaded Image" loading="lazy" download>Download Document</a>';
        } else {
            // Unsupported media type
           // echo 'Unsupported media type: ' . $mediaType;
        }

        echo '</div>';
        echo '</div>';
   
    }

    // Close the last fieldset and container
    
    echo '</div>';
   
    echo '</div>';
} else {
    echo "No posts with documents found.";
}
?>
   
   <script>
     function enableEditing() {
       var inputs = document.querySelectorAll('#profile-form input');
       var editButton = document.querySelector('.edit-button');
       var saveButton = document.querySelector('.save-button');
       
       inputs.forEach(function(input) {
         input.removeAttribute('disabled');
       });
       
       editButton.style.display = 'none';
       saveButton.style.display = 'inline-block';
     }
     
     function saveChanges() {
       var inputs = document.querySelectorAll('#profile-form input');
       var editButton = document.querySelector('.edit-button');
       var saveButton = document.querySelector('.save-button');
       
       inputs.forEach(function(input) {
         input.setAttribute('disabled', true);
       });
       
       editButton.style.display = 'inline-block';
       saveButton.style.display = 'none';
     }
   </script>
 </body>
 </html>
 