<!DOCTYPE html>
<html lang="en">
<head>
<?php
include 'connect.php';
// Validate and sanitize input data
$username2 = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$password2 = isset($_SESSION['password']) ? $_SESSION['password'] : '';

$username2 = trim($username2); // Remove leading/trailing whitespaces
$password2 = trim($password2); // Remove leading/trailing whitespaces

// Sanitize the input to prevent SQL injection
$username2 = $conn->real_escape_string($username2);
$password2 = $conn->real_escape_string($password2);

// Prepare and execute SQL query to retrieve the user ID
$sql = "SELECT * FROM employees WHERE username='$username2' AND password = '$password2'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userID2 = $row['id'];
    $email = $row['email'];
    $fullname = $row['full_name'];
    $imageData = $row['profile_pic'];
    $position = $row['Position'];
    $number = $row['Phone_number'];
    $Department = $row['Department'];
    $Dateofbirth = $row['dateOfBirth'];

    // Display the retrieved user ID
    //echo "User ID: " . $userID2 . '<br>';
} else {
    // User not found or multiple users with the same username exist
    //echo "Error: Unable to retrieve user ID.";
    exit; // Stop further execution if user not found
}

?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        button[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #258cd1;
        }
    </style>
    <script>
        function Profile(){
            window.location.assign('architectdash.');
        }
        function Portfolio(){
            window.location.assign('portfolio');
        }
        </script>
    
</head>
<body>
    <header>
        <h1>Portfolio Form</h1>
        <div class="header">
        <div class="navigation">
   
        <a href="#architectdash." onclick= "Profile()">Home</a>
        </div>
        </div>
    </header>


    <div>
    <fieldset>
    <legend>work_sample</legend>
    <?php
    $sql = "SELECT * FROM portfolio WHERE user_id='$userID2' ";
$result = $conn->query($sql);


if ($result->num_rows == 1) {
    while ( $row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $skill_name = $row['skill_name'];
        $degree = $row['degree'];
        $image = $row['image_filename'];
        $institution = $row['institution'];
        $graduation= $row['graduation_year'];
        $job_title= $row['job_title'];
        $company = $row['company'];
        $company = $row['start_date'];
        $end_date = $row['end_date'];
        $title= $row['title'];
  
          
          echo '<label>';
          echo $title;
         echo $image ;
          echo '</label>';
          echo '<br>';
        }
      } else {
        echo " no work sample ";
      }
      ?>


    </fieldset>
            
    </div>


    <div>
    <fieldset>
    <legend>Skills</legend>
    <?php
    $sql = "SELECT * FROM portfolio WHERE user_id='$userID2' ";
$result = $conn->query($sql);


if ($result->num_rows == 1) {
    while ( $row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $skill_name = $row['skill_name'];
        $degree = $row['degree'];
        $image = $row['image_filename'];
        $institution = $row['institution'];
        $graduation= $row['graduation_year'];
        $job_title= $row['job_title'];
        $company = $row['company'];
        $company = $row['start_date'];
        $end_date = $row['end_date'];
        $title= $row['title'];
          
          echo '<label>';
 
         echo $skill_name;
          echo '</label>';
          echo '<br>';
        }
      } else {
        echo " no skill added ";
      }
      ?>


    </fieldset>
            
    </div>
    

   
<div>
    <fieldset>
    <legend>Degree</legend>
    <?php
    $sql = "SELECT * FROM portfolio WHERE user_id='$userID2' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
        while ( $row = $result->fetch_assoc()) {
            $user_id = $row['id'];
            $skill_name = $row['skill_name'];
            $degree = $row['degree'];
            $image = $row['image_filename'];
            $institution = $row['institution'];
            $graduation= $row['graduation_year'];
            $job_title= $row['job_title'];
            $company = $row['company'];
            $company = $row['start_date'];
            $end_date = $row['end_date'];
            $title= $row['title'];
          
          echo '<label>';
 
         echo 'Degree: '. $degree.'<br>';
         echo 'institution: '. $institution.'<br>';
         echo 'Graduation Year:'. $graduation.'<br>';
          echo '</label>';
          echo '<br>';
        }
      } else {
        echo " no degree added ";
      }
      ?>


    </fieldset>
            
    </div>

    </fieldset>
            
    </div>

    <div>
    <fieldset>
    <legend>Experience</legend>
    <?php
    $sql = "SELECT * FROM portfolio WHERE user_id='$userID2' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
        while ( $row = $result->fetch_assoc()) {
            $user_id = $row['id'];
            $skill_name = $row['skill_name'];
            $degree = $row['degree'];
            $image = $row['image_filename'];
            $institution = $row['institution'];
            $graduation= $row['graduation_year'];
            $job_title= $row['job_title'];
            $company = $row['company'];
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            $title= $row['title'];
          
          echo '<label>';
 
         echo 'job_tittle: '.$job_title.'<br>';
         echo 'Company: '.$company.'<br>';
         echo 'Start_date: '.$start_date.'<br>';
         echo 'End_date: '.$end_date.'<br>';

          echo '</label>';
          echo '<br>';
        }
      } else {
        echo " no Experience added ";
      }
      ?>


    </fieldset>
            
    </div>


    <div class="container">
        <form action="submit" method="post" enctype="multipart/form-data">
    <label for="type">Select Type:</label>
    <select name="type" id="type">
        <option value="work_sample">Work Sample</option>
        <option value="skill">Skill</option>
        <option value="education">Education</option>
        <option value="experience">Experience</option>
    </select>
    
    <!-- Input fields based on the selected type -->
    <div id="input-fields">
        <!-- Work Sample -->
        <div id="work_sample_fields" class="type-fields">
            <label for="sampleTitle">Sample Title:</label>
            <input type="text" name="sampleTitle" >
            
            <label for="workSample">Upload Work Sample (Image):</label>
            <input type="file" name="workSample" accept="image/*" >
        </div>
        
        <!-- Skill -->
        <div id="skill_fields" class="type-fields">
            <label for="skillName">Skill Name:</label>
            <input type="text" name="skillName" >
        </div>
        
        <!-- Education -->
        <div id="education_fields" class="type-fields">
            <label for="degree">Degree:</label>
            <input type="text" name="degree">
            
            <label for="institution">Institution:</label>
            <input type="text" name="institution" >
            
            <label for="graduation_year">Graduation Year:</label>
            <input type="text" name="graduation_year" >
        </div>
        
        <!-- Experience -->
        <div id="experience_fields" class="type-fields">
            <label for="job_title">Job Title:</label>
            <input type="text" name="job_title" >
            
            <label for="company">Company:</label>
            <input type="text" name="company" >
            
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" >
            
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" >
        </div>
    </div>
        <button type="submit">Add</button>
</form>
    </div>
    
   
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#type').change(function() {
            $('.type-fields').hide();
            $('#' + $(this).val() + '_fields').show();
        });
    });
</script>

    </div>
</body>
</html>


