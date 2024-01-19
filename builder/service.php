<?php
include 'connect.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];

   

   
} else {
    // Handle the case where the username is not set or empty
    
    header("Location: index " );
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land & Real Estate Solutions</title>
    <script>
       // history.replaceState({}, null, '/servgku7i7876s');
        </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        h2 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 1.5rem;
        }
        .services-list {
            list-style: none;
            padding: 0;
        }
        .services-list li::before {
            content: '\2022';
            color: #007BFF;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .why-choose-us-list {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        .why-choose-us-list li::before {
            content: '\2022';
            color: #007BFF;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .disclaimer {
            font-size: 0.9rem;
            font-style: italic;
        }
        .cta-button {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1rem;
            transition: background-color 0.2s;
        }
        .cta-button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
         function buyers(){
            window.location.assign('buyers');
        }
    </script>
</head>
<body>
    <header>
        <h1>Welcome to our Land & Real Estate Solutions!</h1>
        <a href="#" onclick="buyers()">Home</a>
    </header>

    <div class="container">
        <p>
            At Land & Real Estate Solutions, we offer an innovative and comprehensive platform to bridge the gap between prospective buyers and sellers of lands and real estate properties. Our website is designed to cater to the needs of individuals who wish to invest in properties or build their dream homes from afar. Whether you're miles away from the location or facing time constraints, we have got you covered!
        </p>

        <h2>Our Services:</h2>
        <ul class="services-list">
            <li>Land Acquisition: Are you in search of the perfect plot to build your dream home or invest in real estate? Look no further! We provide a vast selection of premium lands and properties for sale. Browse through our listings to find the ideal piece of land that suits your preferences, location, and budget. Our listings are thoroughly vetted to ensure that you receive the best possible investment options.</li>
            <li>Remote Property Purchases: Our platform caters to buyers who are not physically present in the area but wish to purchase land or real estate remotely. Through our website, you can explore available properties, conduct virtual tours, and make secure online transactions. Our user-friendly interface ensures a seamless buying experience, and our customer support team is available to assist you throughout the process.</li>
            <li>Build Your Dream Home: Transform your vision into reality with our exclusive "Build Your Dream Home" feature. You can collaborate with experienced architects and builders directly from our website. Share your ideas, blueprints, and preferences, and let our team of professionals create a customized plan for your dream abode. From concept to completion, we guarantee a hassle-free and efficient building process.</li>
            <li>Hire Contractors & Workers: If you already own a piece of land and wish to construct your dream home on it, our platform allows you to connect with skilled contractors, builders, architects, and workers. Choose from a pool of experienced professionals who are ready to undertake your project. Through our website, you can review portfolios, read client reviews, and select the best-suited team for your requirements.</li>
            <li>Secure Transactions: Your security and privacy are our top priorities. We employ state-of-the-art encryption and secure payment gateways to ensure that your transactions are protected. Rest assured that your personal and financial information is safe with us.</li>
            <li>Expert Consultation: Our website offers access to expert real estate advisors who can guide you through the entire buying and building process. Whether you need assistance in choosing the right property, negotiating the best deal, or selecting the perfect team for your construction, our consultants are here to help.</li>
        </ul>

        <h2>Why Choose Us:</h2>
        <ul class="why-choose-us-list">
            <li>Extensive Property Listings: We boast an extensive and diverse range of properties, giving you the freedom to choose the perfect investment or residential option.</li>
            <li>Trusted Professionals: Our platform only collaborates with accredited architects, builders, and contractors, ensuring top-quality results for your dream home.</li>
            <li>Seamless User Experience: Our website is designed with user-friendliness in mind. Browse properties, hire professionals, and manage your projects with ease.</li>
            <li>Customer Support: Our dedicated customer support team is available round the clock to address any queries or concerns you may have.</li>
            <li>Peace of Mind: With Land & Real Estate Solutions, you can embark on your property journey with confidence, knowing that you are in capable hands.</li>
        </ul>

        <p>
            Take the first step towards your dream property today! Explore our website, register for free, and unlock a world of possibilities in the realm of land and real estate. Trust Land & Real Estate Solutions to make your dreams come true!
        </p>

        <p class="disclaimer">
            **Disclaimer:**
            All information provided on our website is for general informational purposes only and does not constitute professional advice. Users are encouraged to conduct thorough research and seek appropriate professional assistance before making any investment decisions or embarking on construction projects. Land & Real Estate Solutions shall not be liable for any loss or damage arising from the use of our platform or services.
        </p>

        <a href="#" class="cta-button">Get Started Now</a>
    </div>
</body>
</html>
