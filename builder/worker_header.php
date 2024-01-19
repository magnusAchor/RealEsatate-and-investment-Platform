<?php
include 'connect.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    //echo '<script>alert("User not logged in");</script>';
    header("Location: index " );
    exit();
}?>
<!DOCTYPE html>
<html>
<head>
<script>
        function Profile(){
            window.location.assign('architectdash.');
        }
        function Portfolio(){
            window.location.assign('portfolio');
        }
        function about(){
            window.location.assign('about');
        }
        function services(){
            window.location.assign('service');
        }
        </script>
    <style>
        /* Reset some default styles */
      
        /* Header styles */
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
        }

        .header .logo {
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
        }

        .header .navigation {
            display: inline-block;
            margin-left: 20px;
        }

        .header .navigation a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }


.headerr img {
    width: 10opx;
    height: 100px;
    border-radius: 500%;
    margin-left: 600px;
}
    </style>
</head>
<body>
    


    <div class="header">
   
    
        <h1>Job Construct</h1>
        <p>Builders power</p>
        <div class="logo">villadin</div>
        <div class="navigation">
            <a href="#architectdash." onclick= "Profile()">Home</a>
            <a href="#" onclick= "about()">About</a>
            <a href="#" onclick= "services()">Services</a>
            <a href="#"onclick="Portfolio()">Portfolio</a>
        
    
     

        </div>
    </div>

    <!-- Rest of your website content -->

</body>
</html>
