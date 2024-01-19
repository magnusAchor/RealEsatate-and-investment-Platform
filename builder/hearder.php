<?php
// Assuming you have already connected to the database and initialized the $conn variable
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
    
    header("Location: https://villadin.com/ " );
    
    exit();
}
$username = $_SESSION['username'];
$email=$_SESSION['email'];
//echo $email;
//echo $username;
$query = "SELECT * FROM buyers WHERE name = '$username' AND email='$email'";
$result = $conn->query($query);

if (!$result) {
    echo "Query failed: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profileImage = $row['profile_pic'];
        // Rest of your code
    } else {
        echo "No matching records found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta data-react-helmet="true" id="theme-color" name="theme-color" content="#f1c40f"/>
    <script>
        function Profile() {
            window.location.assign('buyers_profile_setting');
        }

        function About() {
            window.location.assign('about');
        }

        function buyers() {
            window.location.assign('buyers');
        }

        function service() {
            window.location.assign('service');
        }

        function submitForm() {
            document.getElementById("logoutForm").submit();
        }
    </script>
    <style>
        /* Reset some default styles */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Header styles */
        .header {
            background-color: #000;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 2;
}
        

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            margin-top: 5px; /* Add margin to separate h1 and p */
        }

        .header .logo {
            font-size: 18px;
            font-weight: bold;
        }

        .header .navigation {
            display: flex;
        }

        .header .navigation a {
            color: #fff;
    text-decoration: none;
    margin-left: 60px;
    font-family: cursive;
    FONT-WEIGHT: 400;
    font-size: medium;
    margin: 30px;

        }

        .headerr {
            display: flex;
            align-items: center;
        }

        .headerr img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
            cursor: pointer;
        }
        .header {
    
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 2;
}

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
    <div class="header">
        <div>
            <h1>Job Construct</h1>
            <p>Builders power</p>
        </div>
        
        <div class="logo"></div>
        <div class="navigation">
            <a href="#" onclick="buyers()">Home</a>
            <a href="#about" onclick="About()">About</a>
            <a href="#" onclick="service()">Services</a>
            <a href="#buyers_profile" onclick="Profile()">Profile</a>
            <div class="headerr">
            
                <button onclick="logout()">Logout</button>
            
            <?php
    if (isset($profileImage)) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($profileImage) . '" alt="Profile Image" onclick="window.location.href=\'buyers_profile_setting\';">';
    } else {
        echo '<img src="default-profile-image.jpg" alt="Default Profile Image" onclick="window.location.href=\'buyers_profile_setting\';">';
       
    }
    ?>

        </div>
        </div>
       
    </div>

   
 <script>
        function logout() {
            // Create a new anchor element
            var logoutLink = document.createElement('a');
            logoutLink.href = 'Logout?logout=true';
            logoutLink.textContent = 'Logout';

            // Simulate a click on the anchor link to trigger logout
            logoutLink.click();
        }
    </script>
</body>
</html>
