<?php
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}
// Retrieve posts with documents
$sql = "SELECT document, post_id, media_type, caption FROM posts WHERE post_id IN (SELECT post_id FROM posts GROUP BY post_id HAVING COUNT(*) > 1) AND user_id = ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $currentPostID = null; // Track the current post ID
    while ($row = $result->fetch_assoc()) {
        $postID = $row['post_id'];
        $documentData = $row['document'];
        $mediaType = $row['media_type'];
        $caption = $row['caption'];

        // Check if it's a new post ID
        if ($postID !== $currentPostID) {
            // Close the previous fieldset if it's not the first post
            if ($currentPostID !== null) {
                echo '</fieldset>';
                echo '</div>';
            }

            // Display the post container and button for the new post ID
            echo '<div class="center-container">';
            echo '<fieldset class="post-container">';
            echo '<div>';
            echo '<button class="post-button">Post ID: ' . $postID . '</button><br>';
            echo '<p class="caption">Heres Whats up: '.$caption.'</p><br>';
            echo '</div>';

            $currentPostID = $postID; // Update the current post ID
        }

        // Display the media (image, video, or document)
        echo '<fieldset class="inner-fieldset">';
        echo '<div class="media-container">';

        if (!is_null($mediaType) && strpos($mediaType, 'image/') === 0) {
            // Display the image
            echo '<img class="post-image" src="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" />';
        } elseif (!is_null($mediaType) && strpos($mediaType, 'video/') === 0) {
            // Display the video
            echo '<video class="post-video" controls>';
            echo '<source src="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" type="' . $mediaType . '">';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
        } elseif (!is_null($mediaType) && strpos($mediaType, 'application/') === 0) {
            // Display the document
            echo '<a class="post-document" href="data:' . $mediaType . ';base64,' . base64_encode($documentData) . '" download>Download Document</a>';
        } else {
            // Unsupported media type
           // echo 'Unsupported media type: ' . $mediaType;
        }

        echo '</div>';
        echo '</fieldset>';
    }

    // Close the last fieldset and container
    echo '</fieldset>';
    echo '</div>';
} else {
    echo "No posts with documents found.";
}

?>


<!DOCTYPE html>
<html>
<head>
    
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
    </style>
</head>
<body>
    <!-- Your HTML content here -->
</body>
</html>
