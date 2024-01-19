<?php
include 'connect.php';
$username = $_SESSION['username'];

// Prepare and execute SQL query to retrieve the user ID
$sql = "SELECT id FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userID = $row['id'];

    // Display the retrieved user ID
    echo "User ID: " . $userID;
} else {
    // User not found or multiple users with the same username exist
    echo "Error: Unable to retrieve user ID.";
}

// Retrieve posts with documents
$sql = "SELECT document, post_id, media_type, caption, price, property_type, location FROM posts WHERE post_id IN (SELECT post_id FROM posts GROUP BY post_id HAVING COUNT(*) > 1) AND post_status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $currentPostID = null; // Track the current post ID
    while ($row = $result->fetch_assoc()) {
        $postID = $row['post_id'];
        $documentData = $row['document'];
        $mediaType = $row['media_type'];
        $caption = $row['caption'];
        $location = $row['location'];
        $price = $row['price'];
        $property_type = $row['property_type'];

        // Check if it's a new post ID
        if ($postID !== $currentPostID) {
            // Close the previous fieldset if it's not the first post
            if ($currentPostID !== null) {
                echo '</fieldset>';
                echo '</div>';
            }

            // Display the post container and button for the new post ID
            echo '<div class="center-container">';
            echo '<fieldset class="post-container" style="min-width: 1000px;">';
            echo '<div>';
            echo '<form method="post" action="">';
            echo '<button type="submit" name="decline" value="' . $postID . '">Decline</button>';
            echo '<button type="submit" name="accept" value="' . $postID . '">Accept</button><br><br><br>';
            echo '<button class="post-button">Post ID: ' . $postID . '</button><br>';
            echo '<p class="caption">Heres Whats up: ' . $caption . '</p><br>';
            echo $location . '<br>';
            echo 'property_type: ' . $property_type . '<br>';
            echo 'price:' . $price;
            echo '</form>';
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

// Handle the form submission when the "Decline" button is clicked
if (isset($_POST['decline'])) {
    $declinedPostID = $_POST['decline'];
    // Perform the update to set the post_status to 'declined'
    $updateSql = "UPDATE posts SET post_status = 'declined' WHERE post_id = '$declinedPostID'";
    if ($conn->query($updateSql) === TRUE) {
        echo '<script>alert("Post with ID ' . $declinedPostID . ' has been declined.");</script>';
        // Refresh the page to reflect the updated post status
        echo '<script>window.location.href = window.location.href;</script>';
    } else {
        echo "Error updating post status: " . $conn->error;
    }
}
if (isset($_POST['accept'])) {
    $acceptPostID = $_POST['accept'];
    // Perform the update to set the post_status to 'declined'
    $updateSql = "UPDATE posts SET post_status = 'accept' WHERE post_id = '$acceptPostID'";
    if ($conn->query($updateSql) === TRUE) {
        echo '<script>alert("Post with ID ' . $acceptPostID . ' has been accepted.");</script>';
        // Refresh the page to reflect the updated post status
        echo '<script>window.location.href = window.location.href;</script>';
    } else {
        echo "Error updating post status: " . $conn->error;
    }
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
