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
        $buyer = $row['id'];

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

// Function to sanitize input data
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['pidsty'])) {
        $posttID = $_POST['pidsty'];
        $_SESSION['Pidsty'] = $posttID;
        $userID2 = $_SESSION['Pidsty'];

    }
    if (isset($_POST['nam'])) {
        $NAM = $_POST['nam'];
        $_SESSION['nam'] = $NAM;
    }
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE full_name = ? AND id = ?");
$stmt->bind_param("si", $_SESSION['nam'], $_SESSION['Pidsty']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $email = $row['email'];
    $fullname = $row['full_name'];
    $imageData = $row['profile_pic'];
   // $profilepics = base64_decode($imageData);
    $position = $row['Position'];
    $number = $row['Phone_number'];
    $Department = $row['Department'];
} else {
    echo "No records found.";
}

$cond = "SELECT * FROM relationship WHERE worker_id = ? AND Statues = 'accepted' AND buyers_id = ?";
$stmt = $conn->prepare($cond);
$stmt->bind_param("si",$_SESSION['Pidsty'], $buyer);
$stmt->execute();
$TES = $stmt->get_result();










?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Profile</title>
  <script>
       // history.replaceState({}, null, '/ytyghyt6765');
        </script>
  <script src="script.js">
  </script>
  <style>
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
    
    .button-container {
      text-align: center;
      margin-top: 20px;
    }
    
    .button-container button {
      padding: 8px 12px;
      background-color: #4a90e2;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      margin-right: 10px;
    }
    
    .button-container button:hover {
      background-color: #357bd8;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Employee Profile</h1>
    </div>
    
<div class="profile-picture">
    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Profile Picture">'; ?>
</div>

    
    <div class="attribute">
      <label>Name:</label>
      <div class="attribute-value" id="name">
        <?php $_SESSION['nam'];?>
      </div>
    </div>
    
    <div class="attribute">
      <label>Employee ID:</label>
      <div class="attribute-value" id="employee-id"><?php 
      echo  $_SESSION['Pidsty'];?>
      </div>
    </div>
    
    <div class="attribute">
      <label>Position:</label>
      <div class="attribute-value" id="position"> <?php echo $position;?></div>
    </div>
    
    <div class="attribute">
      <label>Department:</label>
      <div class="attribute-value" id="department"> <?php echo $Department;?></div>
    </div>
    
    <div class="attribute">
      <label>Email:</label>
      <div class="attribute-value" id="email"><?php 
      echo  $email;?></div>
    </div>
    
    <div class="attribute">
      <label>Phone Number:</label>
      <div class="attribute-value" id="phone"> <?php echo $number; ?></div>
    </div>
    
    <div class="attribute">
      <label>Date of Joining:</label>
      <div class="attribute-value" id="joining-date">2022-01-01</div>
    </div>
    
    <div class="button-container">
      <form method="post" action="create_relationship">
      <input type="hidden" name="buyer" value=" <?php echo $buyer; ?>">
      <input type="hidden" name="full_name" value=" <?php echo $_SESSION['nam']; ?>">
      <input type="hidden" name="position" value=" <?php echo $position; ?>">
      <input type="hidden" name="rel" value=" <?php echo $_SESSION['Pidsty']; ?>">
      <?php


if ($TES ->num_rows >0) {
  // Button will not be displayed
echo 'you employeed this worker'.'<br>'.'<br>';

} else {
  // Button will be displayed
  echo '<button type="submit">Hire</button>';
}
?>

  </form>
  <form method="post" action="Chat">
  <?php
if ($TES->num_rows >0) {
  // Button will not be displayed
echo '<button type="submit">chat</button>';
} else {

}
?>
</form>
    </div>
  </div>



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






  
  <script>

    function hireEmployee() {
      // Perform the hire action here
      console.log("Employee hired");
    }
    
    function startChat() {
      // Start the chat with the employee here
      console.log("Chat started");
    }
  </script>
</body>
</html>
