<?php
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    
    header("Location: index " );
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Reset some default styles */
        body {
            margin: 0;
            padding: 0;
        }

        /* Footer styles */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            min-width: 800px;
        }

        .footer p {
            font-size: 14px;
        }

        .footer .social-icons {
            margin-top: 10px;
        }

        .footer .social-icons a {
            display: inline-block;
            color: #fff;
            text-decoration: none;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <!-- Rest of your website content -->
    </body>
    <footer>
        <br>
    <div class="footer">
        <p> Copyright © 2023 Villadin. All rights reserved.</p>
        <div class="social-icons">
            <a href="#">jobconstruct <i class="fab fa-facebook"></i></a><br><br>
            <a href="aboutdeveloper"><i class="develoer">About The Developer</i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
    </footer>
</html>
