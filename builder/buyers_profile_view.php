<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the necessary files
include 'connect.php';
include 'worker_header.php';

// Sanitize and validate the username from the session
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = filter_var($_SESSION['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
} else {
    // Handle the case where the username is not set or empty
   // echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();


}

// Sanitize and validate the buyers_id from the POST data
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $buyers_id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
} else {
    die("Error: Invalid buyer ID.");
}

// Retrieve buyer's email from the database
$lon = "SELECT * FROM users WHERE id = $buyers_id";
$lox = $conn->query($lon);
if ($lox->num_rows == 1) {
    $row = $lox->fetch_assoc();
    $email = $row['email'];

    // Display the retrieved user email
    //echo "User email: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
} else {
    // User not found or multiple users with the same ID exist
    echo "Error: Unable to retrieve user email.";
}

// Prepare and execute SQL query to retrieve buyer's information
$emi = "SELECT * FROM buyers WHERE email = '$email'";
$loc = $conn->query($emi);

if ($loc->num_rows == 1) {
    $row = $loc->fetch_assoc();
    $location = htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8');
    $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
    $full_name = htmlspecialchars($row['full_name'], ENT_QUOTES, 'UTF-8');
    $imageData = $row['profile_pic'];
    $profilepics = base64_encode($imageData);

    // Display the retrieved buyer information
    //echo "User name: " . $name;
} else {
    // Buyer not found or multiple buyers with the same email exist
    echo "Error: Unable to retrieve buyer information.";
}

// Prepare and execute SQL query to retrieve the user ID
$sql = "SELECT id FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userID = $row['id'];

    // Display the retrieved user ID
  //  echo "User ID: " . $userID;
} else {
    // User not found or multiple users with the same username exist
    echo "Error: Unable to retrieve user ID.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile View Page</title>
     <style>
        p.caption {
    max-height: 150px;
}

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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .profile-details {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-details img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h2 {
            margin: 0;
        }

        .profile-info p {
            margin: 5px 0;
        }

        .post {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        /*post*/
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
    </style>
</head>
<body>
    <header>
        <h1>Profile</h1>
    </header>

    <div class="container">
        <div class="profile-details">
            <?php echo '<img src="data:' . 'image/jpeg' . ';base64,' . base64_encode($imageData) . '" />'; ?>
            <div class="profile-info">
                <h2>
                    <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>
                </h2>
                <p>
                    <?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <p>
                    <?php echo htmlspecialchars($location, ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <p></p>
            </div>
        </div>

        <div class="posts">
            <h2>Uploaded Posts</h2>
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
            <!-- Add more posts here -->
        </div>
    </div>
</body>
</html>
