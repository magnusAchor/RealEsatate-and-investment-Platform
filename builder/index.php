<?php
// index.php
include 'connect.php';
include 'indexcss.php';

if (isset($_GET['url'])) {
    $requestedUrl = $_GET['url'];
} else {
    $requestedUrl = ''; // Default page or action if no URL is provided
}

// Define your routes and their corresponding actions here
$routes = [
    '' => 'homePage',
    'xdcedefggsh' => 'aboutPage',
    '5667fhfgg78' => 'contactPage',
        '77gytuyh-mjhb' => 'buyersPage',
            'ghviu897-yuh' => 'worklistPage',
                'po8yugyt' => 'workspacePage',
                    'servgku7i7876s' => 'pstPage',
                    'bps434566' => 'bpsPage',
                    'ytyghyt6765' => 'empPage',
                    'arctft6r55' => 'achPage',
                    'conrtorrty'=>'cntPage',
   
];

if (array_key_exists($requestedUrl, $routes)) {
    $action = $routes[$requestedUrl];
    if (function_exists($action)) {
        call_user_func($action);
    } else {
        echo "404 Not Found"; // Action function doesn't exist
    }
} else {
    echo "404 Not Found"; // Route doesn't exist
}

function homePage() {
    //echo "Welcome to the Home Page!";
}

function aboutPage() {
   header("location: about");
}

function buyersPage() {
    header("location: buyers");
}
function worklistPage() {
    header("location: worklist");
}
function workspacePage() {
    header("location: workspace");
}
function pstPage() {
    header("location: service");
}
function bpsPage() {
    header("location: buyers_profile_setting");
}
function empPage() {
    header("Location: employersview?id=" . $_SESSION['pidsty']);
    exit; // It's a good practice to include an exit() after header redirects
}

function achPage() {
    header("location: architect");
}
function cntPage() {
    header("location: contractor");
}
?>
<header>
        <br><br><h1>Welcome to Villadin</h1><br><br>
    </header>
<!DOCTYPE html>
<html lang="en">
<head>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5523781481705920"
     crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    
    <meta data-react-helmet="true" id="theme-color" name="theme-color" content="#f1c40f"/>
    <meta name="description" content="We help you buy, sell, or build properties, and we also connect you with builders and contractors. We also offer a crypto exchange where you can buy, sell, and trade cryptocurrencies.

We are committed to providing our customers with the best possible experience. We offer a wide range of services, competitive prices, and excellent customer service.

Whether you are a first-time homebuyer or a seasoned investor, we can help you achieve your real estate goals. We also offer a variety of construction services to meet your needs, from small repairs to full-scale renovations.

And if you are interested in investing in cryptocurrency, we can help you get started. We offer a secure and easy-to-use platform where you can buy, sell, and trade cryptocurrencies.

We are the only company that offers all of these services under one roof. This makes us the most convenient and efficient option for your real estate, construction, and crypto needs.

Visit our website today to learn more about our services and how we can help you achieve your goals.

">
<link rel="icon" href="https://www.villadin.com/favicon">

   



    <title>Villadin: Your one-stop shop for real estate, construction, and crypto.</title>
    
       
</head>
<body>
    <?php
   // include 'preloader.php';
    ?>
    <div class="container">
        <div class="writtings">
            <h2>Welcome to a Place Where Business is Genuine</h1>
            <p>Hassle-free.</p>
            <p>Own a home from the convenience of your home.</p>
            <p>We appreciate and value your trust.</p>
        </div>
        <div class="login_form">
          
            <form action="login" method="POST">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <label for="email"></label>
                <input type="text" id="email" name="email" placeholder="Email" required>
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
                <div class="register-link">
                    Don't have an account? <a href="registerform">Register</a><br>
                   <a href="forgot_password"> Forgot Your Password? </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="ads" style="max-width: 400px; min-width: 400px; max-height: 50px;" >
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5523781481705920"
     crossorigin="anonymous"></script>
<!-- first try -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5523781481705920"
     data-ad-slot="7350067551"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

    <div class="post-display">
        <h4>Discover Properties for Sale, Lease, and Rental</h4>
           <div class="postted" style="display: none;">
   <?php
      include 'index_post.php';
   ?>
</div>

        </div>
</body>

<div id="footer">
    <footer class="footer">
        <div class="ftt_container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <!-- Widget 1 Content -->
                      <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>About US</h3>
                        </div>
                        <p class="bio">We help you buy, sell, or build properties, and we also connect you with builders and contractors. We also offer a crypto exchange where you can buy, sell, and trade cryptocurrencies.

We are committed to providing our customers with the best possible experience. </p>
                        
                    </div><!-- end clearfix -->
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <!-- Widget 2 Content -->
                     <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="https://villadin.com/">Home</a></li>
							<li><a href="about_index">About</a></li>

							<li><a href="abtdeveloper">About the developer</a></a></li>
							<li><a href="privacy_policy">Privacy_Policy</a></li>
							<li><a href="service_index">Service</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <!-- Widget 3 Content -->
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact Details</h3>
                        </div>

                        <ul class="footer-links">
                            <li><a href="mailto:#">villadin@villadin.com</a></li>
                            <li><a href="mailto:#">villastock@gmail.com</a></li>
                            <li>Port Harcourt, Nigeria</li>
                            <li><a href="https://chat.whatsapp.com/">Phone via WhatsApp</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div>
            </div>
        </div>
    </footer>
</div>


</div>

</html>
