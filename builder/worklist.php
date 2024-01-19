<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
include 'connect.php';
include 'hearder.php';

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];

 

 
} else {
  // Handle the case where the username is not set or empty
  echo '<script>alert("User not logged in");</script>';
  header("Location: index " );
  exit();
}
//$mail =$_SESSION['email']; 



  
  // Prepare and execute SQL query to retrieve the user ID
  $sql = "SELECT id FROM buyers WHERE name ='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $userID = $row['id'];

      // Display the retrieved user ID
      //echo "User ID: " . $userID;
  } else {
      // User not found or multiple users with the same username exist
      echo "Error: Unable to retrieve user ID.";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="buyer.css">
    <script>
    
       // history.replaceState({}, null, '/ghviu897-yuh');
        
function showPopup() {
  var popup = document.getElementById("popup");
  popup.classList.add("active");
}

function hidePopup() {
  var popup = document.getElementById("popup");
  popup.classList.remove("active");
}
</script>
<style>



@media (max-width: 768px) {
    .header {
    background-color: #000;
    color: #fff;
    padding: 20px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 2;
    
}

.header h1 {
    font-size: 8px;
    font-weight: 900;
    margin: 0;
}

.navigation {
    padding-right: 200px;
    font-size: 50%;
}
}

@media(width: 320px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 6px;

        }
}
@media(width: 375px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 30px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 9px;

        }
}
@media(width: 414px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 15px;

        }
}
@media(width: 390px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 12px;

        }
}
@media(width: 393px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 12px;

        }
}

@media(width: 360px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 9px;

        }
}
@media(width: 412px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    padding-left: 5px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 13px;

        }
}

@media(width: 768px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-right: 50px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: medium;
    margin: 20px;
    padding-left: 60px;
        }
}
@media(width: 540px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    padding-left: 20px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: xx-small;
    margin: 20px;

        }
}

@media(width: 280px){
    .header .navigation a {
            color: #fff;
    text-decoration: none;
    padding-left: 2px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: smaller;
    margin: 3px;

        }
}
</style>
</head>
<body>
    <?php
    include 'preloader.php';
    ?>
<br><br><br><br><br><br><br><br><h1>workspace</h><br><br>
    
    <div>
        <p>
    <?PHP
 
    $username =$_SESSION['username'];

   $bonding = "
    SELECT workspace_name, group_id, MAX(created_at) AS max_created_at
    FROM chat
    WHERE userName = '$username' AND workspace_name IS NOT NULL AND workspace_name != ''
    GROUP BY workspace_name, group_id
    ORDER BY max_created_at DESC
";




       $hired = $conn->query($bonding);

       $rows = array();
       
       if ($hired->num_rows > 0) {
         while ($hiredwrk = $hired->fetch_assoc()) {
           $rows[] = $hiredwrk;
         }
       
         foreach ($rows as $row) {
           $fullname = $row['workspace_name'];
           $jobtype = $row['group_id'];
       
           echo '<fieldset style="width: 500px; height: 100px; max-width: 358px;   ">';
           echo '<form method="post" action="workspace">';
           echo '<input type="hidden" id="workspace" name="workspace" value="'.$row['workspace_name'].'">';
           echo '<input type="hidden" id="groupid" name="groupid" value="'. $row['group_id'].'">';
           echo $fullname . '<br>';
           echo $jobtype.' ' ;
           echo '<button name="bond" type="submit" style="margin-left: 30px;">Chat</button>';
           echo '</form>';
           echo '</fieldset>';
         }
       } else {
         echo "$username.' your workspace is empty'";
       }
       
        
      ?>
      <p>
      </div>
      <button onclick="showPopup()">New Workspace</button>

<div id="popup" class="popup">
  <a href="#" onclick="hidePopup()">x</a>
  <h2>Create Workspace</h2>

  <form method="post" action="workspace">
    <label for="workspace">Name:</label>
    <input name="workspace" value=" "><br><br>

    <?php
    // Retrieve and display employed workers in the popup for workspace
    $bonding = "SELECT * FROM relationship WHERE buyers_id = $userID ORDER BY id DESC";
    $hired = $conn->query($bonding);

    if ($hired->num_rows > 0) {
      while ($hiredwrk = $hired->fetch_assoc()) {
        $fullname = $hiredwrk['full_name'];
        $workids = $hiredwrk['worker_id'];

        echo '<fieldset>';
        echo '<label>';
        echo '<input type="checkbox" name="createSpace[]" value="' . $workids . '"> ' . $fullname . ' (' . $workids . ')';
        echo '</label>';
        echo '</fieldset><br>';
      }
    } else {
      echo "No worker IDs found.";
    }
    ?>

    <br><br>
    <button type="submit" name="createGroup">Add</button>
  </form>
</div>

</body>
</html>
<script>
  var chat = $('input[name="workspace"]').val();
  var workspace = $('input[name=""]')
  </script>