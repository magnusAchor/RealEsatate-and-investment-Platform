<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta data-react-helmet="true" id="theme-color" name="theme-color" content="#f1c40f"/>
  <title>User Dashboard</title>
  <link rel="stylesheet" type="text/css" href="buyer.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script>
function toggleFullscreen(element) {
    if (!document.fullscreenElement) {
        if (element.requestFullscreen) {
            element.requestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}
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
        
        .searchengine {
    margin-inline-start: 275px;
}

.searchengine {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-inline-start: inherit;
    
}

.searchengine input[type="text"],
.searchengine input[type="number"] {
    flex: 1; /* Allow form elements to grow and fill available space */
    max-width: 200px; /* Set a maximum width to prevent them from growing too much */
}

/* Media query for smaller screens */
@media (max-width: 900px) {
    .searchengine input[type="text"],
    .searchengine input[type="number"] {
        flex: auto; /* Reset flex property for better responsiveness */
        max-width: 50px; /* Remove max-width restriction */
    }
    .searchengine {
    
    margin-inline-start: 4px;
    
}

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
</head>
<body>
    <!-- Your HTML content here -->
    <!-- Contact Popup -->
    <div class="contact-popup" id="contactPopup">
        <div class="contact-popup-content">
            <div class="contact-info">
                <label>Contact Information:</label>
                <span>Name: Magnus Achor</span>
                <span>Email: villastock@villadin.com</span>
                <span>Phone: +2349152326481</span>
            </div>
            <a href="https://api.whatsapp.com/send?phone=+2349152326481" class="whatsapp-button" target="_blank">Chat on WhatsApp</a>
            <button onclick="closeContactPopup()">Close</button>
        </div>
    </div>

    <script>
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


        const element = document.getElementById('post-container');

       
/*
if (window.matchMedia("(max-width: 375px)").matches) {
    element.style.minWidth = "200px";
    element.style.maxWidth = "200px";
} else if (window.matchMedia("(max-width: 414px)").matches) {
    element.style.minWidth = "300px";
    element.style.maxWidth = "300px";
    // Set other styles or handle the case here

} else if (window.matchMedia("(max-width: 675px)").matches) {
    element.style.minWidth = "400px";
    element.style.maxWidth = "400px";
    // Set other styles or handle the case here

} else {
    // Reset the styles or set default values here
    element.style.minWidth = "auto";
    element.style.maxWidth = "none";
}
*/


    </script>
    <br><br>
    <form method="POST" action="searchengine" class="searchengine">
    <div class="searchengine">
        <input type="text" name="keywords" placeholder="Keywords">
        <input type="text" name="location" placeholder="Location">
        <input type="number" name="min_price" placeholder="Min Price">
        <input type="number" name="max_price" placeholder="Max Price">
        <input type="submit" value="Search">
    </div>
</form>


</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    // Include database connection code here
    include 'connect.php';

    // Initialize search criteria
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
    $max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';

    // Build the SQL query dynamically
    $sql = "SELECT userName, document, post_id, media_type, caption, price, property_type, location FROM posts WHERE post_status = 'accept'";

    if (!empty($keywords)) {
        $sql .= " AND (caption LIKE '%$keywords%' OR location LIKE '%$keywords%')";
    }

    if (!empty($location)) {
        $sql .= " AND location LIKE '%$location%'";
    }

    if (!empty($min_price)) {
        $sql .= " AND price >= $min_price";
    }

    if (!empty($max_price)) {
        $sql .= " AND price <= $max_price";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $currentPostID = null; // Initialize the current post ID

            while ($row = mysqli_fetch_assoc($result)) {
                $postID = $row['post_id'];
                $documentData = $row['document'];
                $mediaType = $row['media_type'];
                $caption = $row['caption'];
                $location = $row['location'];
                $price = $row['price'];
                $property_type = $row['property_type'];
                $userName = $row['userName'];

                // Check if it's a new post ID
                if ($postID !== $currentPostID) {
                    // Close the previous fieldset if it's not the first post
                    if ($currentPostID !== null) {
                        echo '</fieldset>';
                        echo '</div>';
                    }

                    // Display the post container and button for the new post ID
                    echo '<div class="center-container" style="display: flex; justify-content: center;  z-index: 2;" loading="lazy">';
                    echo '<fieldset id="post-container" class="post-container" style="margin-inline-start: 1px;" loading="lazy">';
                    echo '<div>';

                    // Retrieve the user profile picture
                    $profilePicture = '';

                    $sql = "SELECT profile_pic FROM employees WHERE username = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $userName);
                    $stmt->execute();
                    $resultProfile = $stmt->get_result();

                    if ($resultProfile->num_rows > 0) {
                        $profileRow = $resultProfile->fetch_assoc();
                        $profilePicture = $profileRow['profile_pic'];
                    } else {
                        // The user email does not exist in the employee table
                        $sql = "SELECT profile_pic FROM buyers WHERE name = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $userName);
                        $stmt->execute();
                        $resultProfile = $stmt->get_result();

                        if ($resultProfile->num_rows > 0) {
                            $profileRow = $resultProfile->fetch_assoc();
                            $profilePicture = $profileRow['profile_pic'];
                        }
                    }

                    echo '<p class="post-button" style="color: white; font-weight: bold; background-color: olive; margin-top: 0px; padding-top: 10px; padding-bottom: 10px; border: none; padding: 5px 10px; cursor: pointer; font-family: \'Arial\', sans-serif;" loading="lazy">';

                    // Check if the profile picture exists
                    if (!empty($profilePicture)) {
                        // Display the profile picture
                        echo '<img class="profile-picture" style="width: 50px; height:50px; border-radius: 50%;" src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" loading="lazy"/><br>';
                    }

                    // Now, display the username
                    echo $userName . '</p><br>';

                    echo '<p class="caption">Description: ' . $caption . '</p><br>';
                    echo 'Location: ' . $location . '<br>';
                    echo 'Property_type: ' . $property_type . '<br>';
                    echo 'Price: ' . $price . '<br><br>';
                    echo '<button class="contactt" style="background-color:#4CAF50;" onclick="showContactPopup()">Contact for more info</button><br>';
                    echo '</div>';

                    // Display the post container and button for the new post ID
                    echo '<div class="center-container-media" style="justify-content: center;  z-index: 2;" loading="lazy">';
                    echo '<div id="post-container-media-media" class="post-container-media-media" style="margin-inline-start: 1px;" loading="lazy">';
                    $currentPostID = $postID; // Update the current post ID
                }

                // Display the media (image, video, or document)
                echo '<div class="media-xxx">';
                echo '<div class="media-container">';

                if (!empty($mediaType) && strpos($mediaType, 'image/') === 0) {
                    // Display the image with fullscreen capability
                    echo '<img class="post-image" src="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" onclick="toggleFullscreen(this)" alt="Lazy Loaded Image" loading="lazy" />';
                } elseif (!empty($mediaType) && strpos($mediaType, 'video/') === 0) {
                    // Display the video
                    echo '<video class="post-video" alt="Lazy Loaded Image" loading="lazy" controls>';
                    echo '<source src="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" type="' . $mediaType . '" onclick="toggleFullscreen(this)" >';
                    echo 'Your browser does not support the video tag.';
                    echo '</video>';
                } elseif (!empty($mediaType) && strpos($mediaType, 'application/') === 0) {
                    // Display the document
                    echo '<a class="post-document" href="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" alt="Lazy Loaded Image" loading="lazy" download>Download Document</a>';
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
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
