<!DOCTYPE html>
<html>
<head>
    <title>Escrow.com Customer Information</title>
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Styles... */
        .container {
            display: none;
        }



        
    </style>
    <script>
        $(document).ready(function () {
            $("#buttonnull").click(function (e) { 
                e.preventDefault();
                // Show the container with class 'container' when the button is clicked
                $(".container").show();
            });
        });


       
    </script>
</head>
<body>



   <hi>Still under construction proceed to escrow.com for better transaction</h1>

    <div class="container1">
        <h2>Escrow.com Customer Information</h2>
        <form id="customerForm" action="" method="POST">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="api_key">API Key:</label>
            <input type="text" id="api_key" name="api_key" required><br><br>

            <button type="submit">Get Customer Information</button>
        </form>
    </div>

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
            $userID = $row['id'];
    
            // Display the retrieved user ID (escape the output for security)
           // echo "User ID: " . htmlspecialchars($userID, ENT_QUOTES, 'UTF-8');
        } else {
            // User not found or multiple users with the same username exist
            echo "Error: Unable to retrieve user ID.";
        }
    
       
    } else {
        // Handle the case where the username is not set or empty
        echo '<script>alert("User not logged in");</script>';
        header("Location: index " );
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $api_key = $_POST['api_key'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.escrow.com/2017-09-01/customer/me',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERPWD => $email . ':' . $api_key,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $output = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        

        if ($output === false) {
            echo "cURL Error: " . curl_error($curl);
        } else {
            // Check if the output is "null"
            if ($httpCode==200) {
                echo "API Response: Begin Transcation .<br>";
                // Show the button to register for escrow if the output is "null"
              include 'CreateTransaction.php';
                
            } else {
                echo "API Response:<br>";
                echo $output;
                echo '<button id="buttonnull">Register for escrow</button>';
            }
        }
    }

    
    

        
        

    ?>




    <!-- "Registration For Escrow Services" section with class 'container' -->
    <div class="container" style="display: none;">
    <h2>Escrow.com Customer Registration</h2>
        <form id="customerForm" action="" method="POST">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" required><br><br>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required><br><br>

            <label for="middle_name">Middle Name:</label>
            <input type="text" name="middle_name" id="middle_name"><br><br>

            <label for="city">City:</label>
            <input type="text" name="city" id="city" required><br><br>

            <label for="post_code">Postal Code:</label>
            <input type="text" name="post_code" id="post_code" required><br><br>

            <label for="country">Country:</label>
            <input type="text" name="country" id="country" required><br><br>

            <label for="line1">Address Line 1:</label>
            <input type="text" name="line1" id="line1"><br><br>

            <label for="line2">Address Line 2:</label>
            <input type="text" name="line2" id="line2"><br><br>

            <label for="state">State:</label>
            <input type="text" name="state" id="state" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>

            <button type="submit">Create Customer</button>
        </form>
   

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phone_number = $_POST['phone_number'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];
        $city = $_POST['city'];
        $post_code = $_POST['post_code'];
        $country = $_POST['country'];
        $line1 = $_POST['line1'];
        $line2 = $_POST['line2'];
        $state = $_POST['state'];
        $email = $_POST['email'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.escrow.com/2017-09-01/customer',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERPWD => 'kutiyoung@gmail.com:16314_SXMRCoNvIOZaeNkiRzdVQF4wua0glm9ImJorDj9B2SZGoYcVtrGVQAAkqerx8BFE',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode(
                array(
                    'phone_number' => $phone_number,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'middle_name' => $middle_name,
                    'address' => array(
                        'city' => $city,
                        'post_code' => $post_code,
                        'country' => $country,
                        'line2' => $line2,
                        'line1' => $line1,
                        'state' => $state,
                    ),
                    'email' => $email,
                )
            )
        ));

        $output = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode === 200 ) {
            echo '<script>alert("Customer created! Check your email to proceed.");</script>';
        } else {
            echo '<script>alert("Error: Unable to create customer. Please try again later.");</script>';
            echo 'Error Code: ' . $httpCode . '<br>';
            echo 'Error Message: ' . $output . '<br>';
        }
    }
    ?>
     </div>

</body>
</html>


