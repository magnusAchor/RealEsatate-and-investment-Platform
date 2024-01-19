<?php


// Check if the username is set and not empty
include 'connect.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];


} else {
    // Handle the case where the username is not set or empty
    
   // header("Location: index " );
    //exit();
}
//include 'hearder.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta data-react-helmet="true" id="theme-color" name="theme-color" content="wheat"/>
    <title>Document</title>
    <!-- Include this JavaScript snippet on the redirected page (about) -->
<script>
// Use the replaceState method to change the URL without triggering a new request
//history.replaceState({}, null, '/xdcedefggsh');
</script>

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        p {
            margin-bottom: 20px;
        }

        section {
            margin-bottom: 40px;
        }

        section h2 {
            color: #007bff;
            margin-bottom: 10px;
        }

        section p {
            margin: 0;
        }

        ul {
            list-style: disc;
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        footer {
            text-align: center;
            color: #888;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .header {
    margin-inline-start: -20px;
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
    <script>
     function buyers(){
            window.location.assign('index');
        }
</script>
</head>
<body>
    <br><br><br><br><br>
    <h1>Title: Bridging the Gap: Your Gateway to Seamless Real Estate Transactions and Dream Home Construction</h1>

    <p><strong>Introduction:</strong></p>

    <p>Welcome to our innovative online platform designed to revolutionize the way people buy land and real estate while ensuring their dream homes become a reality. Our website is the ultimate destination for individuals seeking to acquire property, regardless of geographical constraints. Whether you're thousands of miles away or just a stone's throw from your desired location, we're here to connect you with the perfect plot and all the professionals you need to create your dream home.</p>

    <section>
        <h2>Section 1: Empowering Your Real Estate Aspirations</h2>

        <p>At our website, we understand that distance and logistical challenges should never hinder you from owning your dream property. We bring you a seamless, user-friendly platform that bridges the gap between buyers and sellers, making real estate transactions smoother and more accessible than ever before.</p>

        <h3>1.1 Extensive Land and Real Estate Listings:</h3>
        <p>Our website boasts an extensive database of land and real estate listings from diverse locations. You can browse through various options, view property details, access high-quality images, and even take virtual tours to explore the possibilities.</p>

        <h3>1.2 Personalized Assistance:</h3>
        <p>Our team of experienced real estate professionals is always available to assist you in finding the perfect property that aligns with your preferences and budget. We offer personalized support to ensure your journey towards land ownership is both enjoyable and rewarding.</p>
    </section>

    <section>
        <h2>Section 2: Building Your Dream Home</h2>

        <p>Once you've acquired the ideal land, our services don't stop there. We empower you to transform your dreams into reality by offering an extensive network of architects, contractors, builders, and skilled workers to build your dream home.</p>

        <h3>2.1 Your Vision, Our Expertise:</h3>
        <p>Collaborate with talented architects and designers from our platform who can bring your vision to life. Whether you seek contemporary aesthetics or traditional charm, our professionals have the expertise to turn your ideas into stunning architectural designs.</p>

        <h3>2.2 Trusted Contractors and Builders:</h3>
        <p>We understand the significance of reliable contractors and builders in constructing your dream abode. Our platform hosts a network of trusted professionals, each vetted to ensure quality workmanship and timely project completion.</p>

        <h3>2.3 Seamless Project Management:</h3>
        <p>Through our website, you can efficiently manage your project, keep track of progress, and communicate directly with the involved parties. Our integrated platform simplifies the construction process, providing transparency and ease of coordination.</p>
    </section>

    <section>
        <h2>Section 3: Advantages of Using Our Website</h2>

        <h3>3.1 Global Reach, Local Expertise:</h3>
        <p>Our platform extends its reach beyond geographical boundaries, allowing international buyers to explore real estate opportunities across the globe. With our local experts, you gain valuable insights into the nuances of each region, ensuring informed decisions.</p>

        <h3>3.2 Security and Transparency:</h3>
        <p>We prioritize the security of your transactions. Our website implements robust encryption protocols and follows industry best practices to safeguard your sensitive data, ensuring a secure environment for all users.</p>

        <h3>3.3 Time and Cost-Efficiency:</h3>
        <p>By streamlining the entire real estate journey and home construction process, we save you time and money. Our website eliminates the need for countless physical meetings, making the experience convenient and cost-effective.</p>
    </section>
    <a href="#" onclick="buyers()">Back</a>

    <footer>
        <p>Thank you for choosing us as your partner in achieving your real estate dreams.</p>
        <p>Contact us at <a href="villadin@villadin.com">villadin@villadin.com</a> for any inquiries.</p>
    </footer>
</body>
</html>
