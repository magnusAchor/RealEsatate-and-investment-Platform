<?php
include 'connect.php';
include 'hearder.php';

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
    
    header("Location: https://villadin.com/" );
    exit();
}



// Prepare and execute SQL query to retrieve the user ID

// Sanitize Input and Use Prepared Statements
$wor = "SELECT worker_id FROM relationship WHERE Statues = 'accepted' AND buyers_id = ?";
$stmt = $conn->prepare($wor);
$stmt->bind_param("i", $userID); // Assuming the userID is an integer; use "s" for strings
$stmt->execute();
$workerid = $stmt->get_result();

if ($workerid->num_rows > 0) {
    while ($row = $workerid->fetch_assoc()) {
        $wrkID = $row['worker_id'];
    }
} else {
    echo "No worker IDs found.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta class="viewport" content="width=device-width, initial-scale=1.0">
  <meta data-react-helmet="true" id="theme-color" class="theme-color" content="#f1c40f"/>
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
  <?php
  include 'buyerscss.php';
  ?>
  
  

</head>
<body style="background-color:#f1c40f;">

<?php
//include 'preloader.php';
?>


  <!-- Tab Navigation -->
  
   <div id="nav"> 
  <nav>
    <ul >
      <li><a href="#select-property" onclick="openTab('select-property')">Select Property</a></li>
      <li><a href="#fund-escrow" onclick="openTab('fund-escrow')">Fund Escrow</a></li>
      <li><a href="#pay-milestone" onclick="openTab('pay-milestone')">Payment history</a></li>
      <li><a href="#hired-workers" onclick="openTab('hired-workers')">Hired-workers</a></li>
      <li><a href="#Employee" onclick="openTab('Employee')">Employ workers</a></li>
      <li><a href="#workspace" onclick="workspace()">Workspace</a></li>
    </ul>
  </nav>
</div>
<!-- new workspace -->
<br><br><br><br><br><br><br><br><br><br>
<div id="workspace">
<button id="chimney"  onclick="showPopup()">
<button style="margin-left: 40px;" onclick="showPopup()">
  <i class="house-icon"></i>🏗 New Workspace
</button><br>
  </div>


<div id="popup" class="popup">
  <span onclick="hidePopup()">&times;</span>
  <h2 class="crkwrk">Create Workspace</h2>

  <form method="post" action="workspace">
    <label for="workspace">Name:</label>
    <input class="workspace" value=" "><br><br>

    <?php
     // Retrieve and display employed workers in the popup for workspace
     $bonding = "SELECT * FROM relationship WHERE buyers_id = ?";
     $stmt = $conn->prepare($bonding);
     $stmt->bind_param("i", $userID);
     $stmt->execute();
     $hired = $stmt->get_result();
 
     if ($hired->num_rows > 0) {
         while ($hiredwrk = $hired->fetch_assoc()) {
             $fullname = htmlspecialchars($hiredwrk['full_name'], ENT_QUOTES, 'UTF-8');
             $workids = intval($hiredwrk['worker_id']);
 
             echo '<fieldset>';
             echo '<label>';
             echo '<input type="checkbox" class="createSpace[]" value="' . $workids . '"> ' . $fullname . ' (' . $workids . ')';
             echo '</label>';
             echo '</fieldset><br>';
         }
     } else {
         echo "No worker IDs found.";
     }
    ?>

    <br><br>
    <button type="submit" class="createGroup">Add</button>
  </form>
</div>
<div style="display: flex; flex-direction: column; align-items: center; margin-right: 250px;">
   
<?php
//include 'example.php';

//include 'save_post.php';
?>

  <!-- Tab Content -->
  <div class="tab-container">

    <!-- Select Property Tab -->
    <div id="select-property" class="tab active">
    
      <!-- Display post -->
      <div class="postted" style="display: none;">
      <?php
     include 'create_post.php';echo '<br><br>';
   ?>
   
 <form method="POST" action="searchengine" class="searchengine">
    <div class="searchengine">
        <input type="text" class="keywords" placeholder="Keywords">
        <input type="text" class="location" placeholder="Location">
        <input type="number" class="min_price" placeholder="Min Price">
        <input type="number" class="max_price" placeholder="Max Price">
        <input type="submit" value="Search">
    </div>
</form>



<br><br>


   <?php
     include 'get_post.php';
?>
</div>
</div>
    </div>

    <!-- Fund Escrow Tab -->
    <div id="fund-escrow" class="tab">
      <fieldset id="fund-escrow">
      <?php
      include 'collectpayment.php';
      ?>
      </fieldset>
    </div>

    <!-- Pay First Milestone Tab -->
    <div id="pay-milestone" class="tab">
    <div style=" overflow-x: auto;">
        <fieldset id="tracssddsds">
            <?php
            include 'transactionList.php';
            ?>
        </fieldset>
    </div>
</div>

    <!-- Employee workers Tab -->
    <div id="Employee" class="tab">
     <br> <h2 class="Empwrk">Employee Workers</h2><br><br>
      
      
      <form method="post" action="architect">
    
        <button class="buyersid" onclick="openNewPages()" type="submit" value="<?php echo $userID; ?>">Architect</button>
    
</form>
<form method="post" action="contractor">

        <button class="buyersid" onclick="openNewPagess()" type="submit" value="<?php echo $userID; ?>" >Contractor</button>
      
      
      </form>
    </div>

    <!-- Hired workers Tab -->
    <div id="hired-workers" class="tab">
      <h2 class"Hireswrk" style="margin-left: 250px;">Hired Workers</h2>
     
      <div class="hwks">
        
        <?php 
      $bonding = "SELECT * FROM relationship WHERE buyers_id = $userID ORDER BY id DESC";
      $hired = $conn->query($bonding);
      
      $rows = array();
      
      if ($hired->num_rows > 0) {
          while ($hiredwrk = $hired->fetch_assoc()) {
              $rows[] = $hiredwrk;
          }
      
          foreach ($rows as $row) {
              $fullname = $row['full_name'];
              $jobtype = $row['position'];
              $workids = intval($row['worker_id']);
      
              
    echo '<fieldset class="chat-fieldset" id="hired" style="box-shadow: black; border-block-color: red; border: black; color: cornflowerblue;">';
    echo '<form id="myForm" method="post" action="Chat">';
              
               // Retrieve the user profile picture
                 $sql = "SELECT profile_pic FROM employees WHERE id = ?";
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param("s", $workids);
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
                 
                 // Check if the profile picture exists
                 if (!is_null($profilePicture)) {
                     // Display the profile picture
                     echo '<img class="profile-picture" style="width: 60px; height: 60px; border-radius: 50%;  "src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" loading="lazy"/><br>';
                 }else {
                        echo '<img class="profile-picture" style="width: 60px; height:60px; border-radius: 50%;  "src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" loading="lazy"/><br>';
                     }
                 
             
   echo '<p class="wrkrname">' . htmlspecialchars($fullname) . ' - </p><br>';
echo '<p class="wrkrjb">' . htmlspecialchars($jobtype) . '</p><br><br>';

    echo '<input type="hidden" class="chatted" value="' . $workids . '">';
    echo '<input type="hidden" class="fullnamee" value="' . $fullname . '">';
   // echo '<button class="bond" type="submit">Chat</button>';
    echo '</form>';
    echo '</fieldset><hr>';
          }
      } else {
          echo "No worker  found.";
      }
        

      ?>
        </div>
    </div>
      
    </div>
    






  
</body>

<footer>
    <div class="footer-content">
      <p class="footer-cont">&copy; <?php echo date("Y"); ?> Villadin. All rights reserved.</p>
      
    </div>
  </footer>

</html>




