<?php
// Enable error reporting
error_reporting(0);
ini_set('display_errors', 0);

// Include necessary files
include 'connect.php';
include 'worker_header.php';

// Validate and sanitize input data
$username2 = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$password2 = isset($_SESSION['password']) ? $_SESSION['password'] : '';

$username2 = trim($username2); // Remove leading/trailing whitespaces
$password2 = trim($password2); // Remove leading/trailing whitespaces

// Validate that username and password are not empty
if (empty($username2) || empty($password2)) {
  
    // Handle the case where the username is not set or empty
   // echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();


}

// Sanitize the input to prevent SQL injection
$username2 = $conn->real_escape_string($username2);
$password2 = $conn->real_escape_string($password2);

// Prepare and execute SQL query to retrieve the user ID
$sql = "SELECT id, email, full_name, profile_pic, Position, Phone_Number, Department, dateOfBirth FROM employees WHERE username='$username2' AND password = '$password2'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userID2 = $row['id'];
    $email = $row['email'];
    $fullname = $row['full_name'];
    $imageData = $row['profile_pic'];
    $position = $row['Position'];
    $number = $row['Phone_Number'];
    $Department = $row['Department'];
    $Dateofbirth = $row['dateOfBirth'];

    // Display the retrieved user ID
    //echo "User ID: " . $userID2 . '<br>';
} else {
    // User not found or multiple users with the same username exist
    echo "Error: Unable to retrieve user ID.";
    exit; // Stop further execution if user not found
}

$join = $conn->query("SELECT * FROM relationship WHERE worker_id = $userID2 AND Statues = 'accepted'");

$bond = array(); // Array to store buyers_id values

if ($join->num_rows > 0) {
    while ($row = $join->fetch_assoc()) {
        $bond[] = $row['buyers_id']; // Add each buyers_id to the array
    }
} else {
    // Handle the case when no row is found
    $bond = array(); // Empty array if no row is found
}

// Output the buyers_id values
foreach ($bond as $buyerbond) {
    //echo ' ' . $buyerbond;
}

if (isset($_POST['acpt'])) {
    $accept = $_POST['acpt'];

    // Sanitize the input to prevent SQL injection
    $accept = $conn->real_escape_string($accept);

    $updatest = $conn->query("UPDATE relationship SET Statues = 'accepted' WHERE Statues = 'pending' AND worker_id = '$userID2'");
    if ($updatest === TRUE) {
       // echo "Status updated to 'accepted' successfully.";
    } else {
        // echo "Error updating status: " . $conn->error;
    }
} elseif (isset($_POST['reject'])) {
    $reject = $_POST['reject'];

    // Sanitize the input to prevent SQL injection
    $reject = $conn->real_escape_string($reject);

    $updatest = $conn->query("UPDATE relationship SET Statues = 'rejected' WHERE Statues = 'pending' AND worker_id = '$userID2'");
    if ($updatest === TRUE) {
        // echo "Status updated to 'rejected' successfully.";
    } else {
        // echo "Error updating status: " . $conn->error;
    }
}

$edname = isset($_POST['edit-name']) ? $_POST['edit-name'] : '';
$edeid = isset($_POST['edit-employee-id']) ? $_POST['edit-employee-id'] : '';
$edposi = isset($_POST['edit-position']) ? $_POST['edit-position'] : '';
$eddept = isset($_POST['edit-department']) ? $_POST['edit-department'] : '';
$edmail = isset($_POST['edit-email']) ? $_POST['edit-email'] : '';
$edphone = isset($_POST['edit-phone']) ? $_POST['edit-phone'] : '';
$eddate = isset($_POST['edit-joining-date']) ? $_POST['edit-joining-date'] : '';

// Sanitize the input to prevent SQL injection
$edname = $conn->real_escape_string($edname);
$edeid = $conn->real_escape_string($edeid);
$edposi = $conn->real_escape_string($edposi);
$eddept = $conn->real_escape_string($eddept);
$edmail = $conn->real_escape_string($edmail);
$edphone = $conn->real_escape_string($edphone);
$eddate = $conn->real_escape_string($eddate);

if (!empty($edname)) {
    $editname = $conn->query("UPDATE employees SET `full_name` = '$edname' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($edposi)) {
    $editposi = $conn->query("UPDATE employees SET `Position` = '$edposi' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($eddept)) {
    $editdept = $conn->query("UPDATE employees SET `Department` = '$eddept' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($edphone)) {
    $editphone = $conn->query("UPDATE employees SET `Phone_Number` = '$edphone' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($eddate)) {
    $editdate = $conn->query("UPDATE employees SET `dateOfBirth` = '$eddate' WHERE id = $userID2 AND email = '$email'");
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Employee Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <style>
    /* Existing CSS styles */
    .fieldset {
    width: 20px;
    height: 50px;
}

button.search-button {
    margin-inline-start: 1px;
}
fieldset#post-container {
    margin-inline-start: 1px;
}

 body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  }
  
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .header {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: #ccc;
    margin: 0 auto;
    overflow: hidden;
  }
  
  .profile-picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .attribute {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .attribute label {
    flex-basis: 150px;
    font-weight: bold;
  }
  
  .attribute-value {
    flex-grow: 1;
  }
  
  .tab {
    display: inline-block;
    margin-right: 10px;
    padding: 10px;
    background-color: #ccc;
    cursor: pointer;
    border-radius: 4px;
  }
  
  .tab.active {
    background-color: #4a90e2;
    color: #fff;
  }
  
  .content {
    margin-top: 20px;
  }
  
  .tab-content {
    display: none;
  }
  
  .tab-content.active {
    display: block;
  }
  
  .edit-button {
    margin-top: 10px;
  }
  
  .edit-button button {
    padding: 8px 12px;
    background-color: #4a90e2;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }
  
  .edit-button button:hover {
    background-color: #357bd8;
  }
  
  .edit-form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
  }
  
  .edit-form input {
    flex-grow: 1;
    padding: 6px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .edit-form button {
    margin-left: 10px;
    padding: 6px 12px;
    background-color: #4a90e2;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }
  
  .edit-form button:hover {
    background-color: #357bd8;
  }

  /* New CSS styles for job postings */
  .search-form {
    margin-bottom: 20px;
  }

  .search-form input[type="text"],
  .search-form select {
    padding: 6px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 10px;
  }

  .search-form button {
    padding: 6px 12px;
    background-color: #4a90e2;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }

  .search-results {
    margin-top: 20px;
  }

  .job-posting {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .job-posting .title {
    font-weight: bold;
    margin-bottom: 5px;
  }

  .job-posting .description {
    margin-bottom: 5px;
  }

  .job-posting .company {
    color: #888;
    margin-bottom: 5px;
  }

  .job-posting .details {
    color: #888;
  }

 /*workspace css*/
 
  </style>
  <script>
    // Existing JavaScript functions
    function editAttributes() {
      document.querySelectorAll('.attribute-value').forEach(function(element) {
        element.contentEditable = true;
      });
    }
    
    function changeTab(tabId) {
      var tabs = document.querySelectorAll('.tab');
      var tabContents = document.querySelectorAll('.tab-content');
      
      tabs.forEach(function(tab) {
        tab.classList.remove('active');
      });
      
      tabContents.forEach(function(content) {
        content.classList.remove('active');
      });
      
      document.getElementById(tabId + '-tab').classList.add('active');
      document.getElementById(tabId).classList.add('active');
    }
    
    function updateProfilePicture() {
      var input = document.getElementById('profile-picture-input');
      var img = document.getElementById('profile-img');
      
      var file = input.files[0];
      var reader = new FileReader();
      
      reader.onloadend = function() {
        img.src = reader.result;
      }
      
      if (file) {
        reader.readAsDataURL(file);
      }
    }
    
    function updateAttribute(attributeId) {
      var value = document.getElementById('edit-' + attributeId).value;
      var attribute = document.getElementById(attributeId);
      attribute.textContent = value;
      attribute.contentEditable = false;
    }

    // New function to simulate job posting search
    function searchJobPostings() {
      var title = document.getElementById('search-title').value;
      var category = document.getElementById('search-category').value;
      var location = document.getElementById('search-location').value;
      var skills = document.getElementById('search-skills').value;

      // Simulated job postings data (replace with your actual data retrieval logic)
      var jobPostings = [
        {
          title: 'Software Developer',
          description: 'We are seeking a skilled software developer to join our team.',
          company: 'ABC Corporation',
          details: 'Location: New York, NY | Category: IT | Skills: Java, Python, SQL'
        },
        {
          title: 'Graphic Designer',
          description: 'We are looking for a talented graphic designer with a creative eye.',
          company: 'XYZ Designs',
          details: 'Location: Los Angeles, CA | Category: Design | Skills: Adobe Photoshop, Illustrator'
        },
        // Add more job postings as needed
      ];

      var searchResults = document.getElementById('search-results');
      searchResults.innerHTML = ''; // Clear previous results

      jobPostings.forEach(function(job) {
        // Filter job postings based on search parameters
        var matchesTitle = title ? job.title.toLowerCase().includes(title.toLowerCase()) : true;
        var matchesCategory = category ? job.details.toLowerCase().includes(category.toLowerCase()) : true;
        var matchesLocation = location ? job.details.toLowerCase().includes(location.toLowerCase()) : true;
        var matchesSkills = skills ? job.details.toLowerCase().includes(skills.toLowerCase()) : true;

        if (matchesTitle && matchesCategory && matchesLocation && matchesSkills) {
          var jobPostingElement = document.createElement('div');
          jobPostingElement.classList.add('job-posting');

          var titleElement = document.createElement('div');
          titleElement.classList.add('title');
          titleElement.textContent = job.title;
          jobPostingElement.appendChild(titleElement);

          var descriptionElement = document.createElement('div');
          descriptionElement.classList.add('description');
          descriptionElement.textContent = job.description;
          jobPostingElement.appendChild(descriptionElement);

          var companyElement = document.createElement('div');
          companyElement.classList.add('company');
          companyElement.textContent = job.company;
          jobPostingElement.appendChild(companyElement);

          var detailsElement = document.createElement('div');
          detailsElement.classList.add('details');
          detailsElement.textContent = job.details;
          jobPostingElement.appendChild(detailsElement);

          searchResults.appendChild(jobPostingElement);
        }
      });
    }
  </script>
</head>
<body>
  <div class="container">
    <!-- Existing content -->
    <div class="header">
      <h1>Employee Dashboard</h1>
    </div>
      
    <div class="profile-picture">
      <?php echo '<img class="propics" src="data:' . 'image/jpeg' . ';base64,' . base64_encode($imageData) . '" />'; ?>
    </div>
      
    <div class="attribute">
      <label>Full Name:</label>
      <div class="attribute-value" id="name"><?php echo $fullname; ?></div>
    </div>
      
    <div class="attribute">
      <label>Employee ID:</label>
      <div class="attribute-value" id="employee-id"><?php echo $userID2 ?></div>
    </div>
      
    <div class="attribute">
      <label>Position:</label>
      <div class="attribute-value" id="position"><?php echo $position; ?></div>
    </div>
      
    <div class="attribute">
      <label>Department:</label>
      <div class="attribute-value" id="department"><?php echo $Department; ?></div>
    </div>
      
    <div class="attribute">
      <label>Email:</label>
      <div class="attribute-value" id="email"><?php echo $email?></div>
    </div>
      
    <div class="attribute">
      <label>Phone Number:</label>
      <div class="attribute-value" id="phone"><?php echo $number; ?></div>
    </div>
      
    <div class="attribute">
      <label>Date of Birth:</label>
      <div class="attribute-value" id="joining-date"><?php echo $Dateofbirth; ?></div>
    </div>
      
    <div class="content">
      <div class="tabs">
        <!-- Existing tabs -->
        <div class="tab" onclick="changeTab('profile')">Profile Settings</div>
        <div class="tab" onclick="changeTab('notifications')">Notifications</div>
        <div class="tab" onclick="changeTab('job-postings')">Job Postings</div>
        <div class="tab" onclick="changeTab('proposals')">Proposals/Submissions</div>
        <div class="tab" onclick="changeTab('messages')">Clients</div>
        <div class="tab" onclick="changeTab('account')">Portfolio</div>
      </div>
    </div>



    <!-- Existing tab contents -->
    <div class="tab-content" id="profile-tab">
      <h2 >Profile Settings</h2>
      <p>Here you can upload a new profile picture:</p>
      <form method="post" action="" enctype="multipart/form-data">
        <input type="file" id="profile-picture-input" name="profile-picture-input" accept="image/*">
        <button type="submit" onclick="updateProfilePicture()">Upload</button>
        <div class="edit-form">
          <input type="text" id="edit-name" name="edit-name" placeholder="Name">
          <button type="submit" onclick="updateAttribute('name')">Update</button>
        </div>
        <div class="edit-form">
          <input type="text" id="edit-employee-id" name="edit-employee-id" placeholder="Employee ID">
          <button type="submit" onclick="updateAttribute('employee-id')">Update</button>
        </div>
        <div class="edit-form">
          <input type="text" id="edit-position" name="edit-position" placeholder="Position">
          <button type="submit" onclick="updateAttribute('position')">Update</button>
        </div>
        <div class="edit-form">
          <input type="text" id="edit-department" name="edit-department" placeholder="Department">
          <button type="submit" onclick="updateAttribute('department')">Update</button>
        </div>
        <div class="edit-form">
          <input type="email" id="edit-email" name="edit-email" placeholder="Email">
          <button type="submit" onclick="updateAttribute('email')">Update</button>
        </div>
        <div class="edit-form">
          <input type="tel" id="edit-phone" name="edit-phone" placeholder="Phone Number">
          <button type="submit" onclick="updateAttribute('phone')">Update</button>
        </div>
        <div class="edit-form">
          <input type="date" id="edit-joining-date" name="edit-joining-date" placeholder="Date of Joining">
          <button type="submit" onclick="updateAttribute('joining-date')">Update</button>
        </div>
      </form>
    </div>

    <div class="tab-content" id="notifications-tab">
      <h2>Notifications</h2>
      <p>Notification content goes here.</p>
      <?php
        $sql = "SELECT * FROM relationship where Statues = 'pending' AND worker_id = '$userID2' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $postID = $row['id'];
                $usernm =  $row['Statues'];
                $ml= $row['messages'];

                // Output the post ID as a button
                echo '<fieldset>';
                echo '<form method="post" action=" ">';

                echo '<p >' . $ml . '</p>';
                echo '<button type="submit" name="acpt" value="accept" class="post-button" >Accept </button>   ';
                echo '<button type="submit" name="reject" value="reject" class="posty" >Reject </button><br>';
                echo '</form>';
                echo '</fieldset>';
            }
        } else {
          echo "No notifications found.";
        }
      ?>
    </div>

    

    <div class="tab-content" id="proposals-tab">
      <h2>Proposals/Submissions</h2>
      <p>Proposal/submission content goes here.</p>
    </div>

    <div class="tab-content" id="messages-tab">
      <h2>Active Client</h2>
      <a href="worklist_worker">Proceed to the workspace</a>
        
      <p>Message content goes here.</p> 
      <?php 
        $join = $conn->query("SELECT * FROM relationship WHERE worker_id = $userID2 AND Statues = 'accepted'");
        $bond = array(); // Array to store buyers_id values

        if ($join->num_rows > 0) {
            while ($row = $join->fetch_assoc()) {
                $bond[] = $row['buyers_id']; // Add each buyers_id to the array
            }
        } else {
            // Handle the case when no row is found
            $bond = array(); // Empty array if no row is found
        }

        // Output the buyers_id values
        foreach ($bond as $buyerbond) {
            $bonding = "SELECT * FROM users WHERE id = $buyerbond ORDER BY id DESC ";
            $hired = $conn->query($bonding);
            $rows = array();

            if ($hired->num_rows > 0) {
                while ($hiredwrk = $hired->fetch_assoc()) {
                    $rows[] = $hiredwrk;
                }

                foreach ($rows as $row) {
                    $fullname = $row['first_name'];
                    $jobtype = $row['last_name'];
                    $buyerssid = $row['id'];

                    echo '<fieldset  style="width: 20px; height: 50px; ">';
                    echo '<form id="profile-form-' . $row['id'] . '" method="post" action="buyers_profile_view">';
                    echo '<a href="#" onclick="submitForm(' . $row['id'] . ')">' . $fullname . '</a><br>';
                    echo '<a href="#" onclick="submitForm(' . $row['id'] . ')">' . $jobtype . '</a><br>';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '</form>';

                    echo '<form method="post" action="Chat.">';
                    echo '<input type="hidden" name="chatted" value="' . $buyerssid . '">';
                   echo '<input type="hidden" name="fullnamee" value="' . $fullname . '">';
                    echo '<button name="bond" type="submit">Chat</button>';
                    echo '</form>';
                    echo '</fieldset><br>';

                    echo '<script>
                    function submitForm(formId) {
                      document.getElementById("profile-form-" + formId).submit();
                    }
                  </script>';
                }
            } else {
                echo "No worker IDs found.";
            }
        }
      ?>
    </div>

    <div class="tab-content" id="account-tab">
      <h2>Account</h2>
      <p>Account-related information goes here.</p>
    </div>
    
  </div>
  <div class="tab-content" id="job-postings-tab">
      <h2 class="jbp">Job Postings</h2>
     <div class="get_post" id="get_post">
      
        <?php
       
     include 'get_post.php';
    
       
      ?>
      </div>
    </div>
    <style>
    @media screen and (max-width: 900px){
fieldset#post-container {
    max-height: 924px;
    min-width: fit-content;
    width: 100%;
}
}
h2.jbp {
    margin-inline-start: 500px;
}
    </style>
</body>
</html>

<?php 
if (isset($_POST['acpt'])) {
  $accept = $_POST['acpt'];

  $updatest = $conn->query("UPDATE relationship SET Statues = 'accepted' WHERE Statues = 'pending' AND worker_id = '$userID2'");
  if ($updatest === TRUE) {
    //echo "Status updated to 'accepted' successfully.";
  } else {
    echo "Error updating status: " . $conn->error;
  }
} elseif (isset($_POST['reject'])) {
  $reject = $_POST['reject'];

  $updatest = $conn->query("UPDATE relationship SET Statues = 'rejected' WHERE Statues = 'pending' AND worker_id = '$userID2'");
  if ($updatest === TRUE) {
    //echo "Status updated to 'rejected' successfully.";
  } else {
   // echo "Error updating status: " . $conn->error;
  }
}





$edname = isset($_POST['edit-name']) ? $_POST['edit-name'] : '';
$edeid = isset($_POST['edit-employee-id']) ? $_POST['edit-employee-id'] : '';
$edposi = isset($_POST['edit-position']) ? $_POST['edit-position'] : '';
$eddept = isset($_POST['edit-department']) ? $_POST['edit-department'] : '';
$edmail = isset($_POST['edit-email']) ? $_POST['edit-email'] : '';
$edphone = isset($_POST['edit-phone']) ? $_POST['edit-phone'] : '';
$eddate = isset($_POST['edit-joining-date']) ? $_POST['edit-joining-date'] : '';


if (!empty($edname)) {
    $editname = $conn->query("UPDATE employees SET `full_name` = '$edname' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($edposi)) {
    $editposi = $conn->query("UPDATE employees SET `Position` = '$edposi' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($eddept)) {
    $editdept = $conn->query("UPDATE employees SET `Department` = '$eddept' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($edphone)) {
    $editphone = $conn->query("UPDATE employees SET `Phone_Number` = '$edphone' WHERE id = $userID2 AND email = '$email'");
}
if (!empty($eddate)) {
    $editdate = $conn->query("UPDATE employees SET `dateOfBirth` = '$eddate' WHERE id = $userID2 AND email = '$email'");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['profile-picture-input']) && $_FILES['profile-picture-input']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile-picture-input'];

        // Read the contents of the uploaded file
        $profilepicss = file_get_contents($file['tmp_name']);

        // Update the profile picture in the database
        $stmt = $conn->prepare("UPDATE employees SET profile_pic = ? WHERE email = ?");
        $stmt->bind_param("ss",  $profilepicss, $email);
        if ($stmt->execute()) {
            //echo "Profile picture updated successfully!";
            
            exit();
        } else {
           // echo "Error updating profile picture: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
       // echo "Error uploading profile picture: " . $_FILES['profile-picture-input']['error'];
    }
}

    

?>


