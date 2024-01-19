<?php
include 'connect.php';
$name=$_SESSION['username'];
$email=$_SESSION['email'];
$transactionReference='bitethtx-'.uniqid();
$_SESSION['transactionReference']=$transactionReference;
$publicKey= 'FLWPUBK_TEST-c091bbdbcb44f05d483d497bda710b12-X';
$redirectUrl= 'https://villadin.com/paid.com';
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
    
    header("Location: index " );
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #payment-container {
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .payment-details {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .payment-form {
            margin-top: 20px;
            text-align: center;
        }

        .payment-form label {
            display: block;
            margin-bottom: 5px;
        }

        .payment-form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .payment-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .payment-button:hover {
            background-color: #258cd1;
        }
    </style>
</head>

<body>
    <div id="payment-container">
        <h1>Payment Page</h1>

        <?php
        // Rest of your PHP code
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the payment type is fixed
            if ($_POST["paymentType"] === "fixed") {
                $description=$_POST['paymentDescription'];
                $fixedAmount = $_POST["fixedAmount"];
                $releaseDate = $_POST["releaseDate"];
                $selectedUsers = isset($_POST['createSpace']) ? $_POST['createSpace'] : [];
                $fxdpric='fixedprice';
        
        foreach ($selectedUsers as $userWithFullName) {
            // Split the value to get the ID and name
            list($user, $fullname) = explode('|', $userWithFullName);
            
            // Verify if $user is a valid number
            if (is_numeric($user)) {
                // Cast $user to an integer to ensure it is handled as an integer value
                $user = (int)$user;
        
        
        
                $insertQuery = "INSERT INTO payment (Userid, user1_name, workerid, worker_name, amount, releasedate, description, buyersemail, transactionReference, statuess, milestonelabel) VALUES ($userID, '$name', $user, '$fullname', '$fixedAmount', '$releaseDate', '$description', '$email', '$transactionReference', 'pending', '$fxdpric')";
                
                if ($conn->query($insertQuery)) {
                    //echo "Payment details inserted successfully!<br>";
                } else {
                    //echo "Error inserting payment details: " . $conn->error . "<br>";
                }
            }
        }
        
        
                // Process fixed payment data...
        
                
        
                echo '<form class="payment-form"  method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">';
                    echo "Selected Worker: Name:$fullname<br><br>";
                    echo "Fixed Payment Details:<br><br>";
                    echo'discription: '. $description.'<br><br>';
                    echo "Fixed Amount: $fixedAmount<br><br>";
                    echo "Release Date: $releaseDate<br><br>";
                    echo '  <div>';
                    echo '    Your order is ₦' . $fixedAmount;
                    echo '  </div><br>';
                    echo '  <input type="hidden" name="public_key" value="' . $publicKey . '" />';
                    echo '  <input type="hidden" name="customer[email]" value="' . $email . '" />';
                    echo '  <input type="hidden" name="customer[name]" value="' . $name . '" />';
                    echo '  <input type="hidden" name="tx_ref" value="' . $transactionReference . '" />';
                    echo '  <input type="hidden" name="amount" value="' . $fixedAmount . '" />';
                    echo '  <input type="hidden" name="currency" value="NGN" />';
                    echo '  <input type="hidden" name="meta[token]" value="54" />';
                    echo '  <input type="hidden" name="redirect_url" value="' . $redirectUrl . '" />';
                    echo '  <button type="submit" id="start-payment-button">Pay Now</button>';
                    echo '</form>';
        
            } elseif ($_POST["paymentType"] === "milestone") {
                $milestoneAmounts = $_POST["milestoneAmount"];
                $milestoneDates = $_POST["milestoneDate"];
                $description = $_POST['paymentDescription'];
            
                $selectedUsers = isset($_POST['createSpace']) ? $_POST['createSpace'] : [];
            
                foreach ($selectedUsers as $userWithFullName) {
                    // Split the value to get the ID and name
                    list($user, $fullname) = explode('|', $userWithFullName);
            
                    // Verify if $user is a valid number
                    if (is_numeric($user)) {
                        // Cast $user to an integer to ensure it is handled as an integer value
                        $user = (int)$user;
            
                        echo "Selected Worker:  Name:$fullname<br><br>";
                        // Process milestone payment data...
                        $totalMilestoneAmount = 0;
            
                        echo "Milestone Payment Details for $fullname:<br><br>";
                        for ($i = 0; $i < count($milestoneAmounts); $i++) {
                            $milestoneLabel = "Milestone " . ($i + 1);
                            $milestoneAmount = $milestoneAmounts[$i];
                            $milestoneDate = $milestoneDates[$i];
            
                            echo "$milestoneLabel Amount: $milestoneAmount<br><br>";
                            echo "$milestoneLabel Date: $milestoneDate<br><br>";
            
                            // Insert milestone payment into the payment table
                            $insertQuery = "INSERT INTO payment (Userid, user1_name, workerid, worker_name, amount, releasedate, description, buyersemail, transactionReference, statuess, milestonelabel) VALUES ($userID, '$name', $user, '$fullname', $milestoneAmount, '$milestoneDate', '$description', '$email', '$transactionReference', 'pending', '$milestoneLabel')";
            
                            if ($conn->query($insertQuery)) {
                               // echo "$milestoneLabel Payment inserted successfully!<br>";
                            } else {
                               // echo "Error inserting $milestoneLabel Payment: " . $conn->error . "<br>";
                            }
            
                            $totalMilestoneAmount += $milestoneAmount;
                        }
            
                        // Display Flutterwave payment form for each selected worker
                        echo '<form class="payment-form"  method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">';
                        echo '  <div>';
                        echo '    Your order is ₦' . $totalMilestoneAmount;
                        echo '  </div><br>';
                        echo '  <input type="hidden" name="public_key" value="' . $publicKey . '" />';
                        echo '  <input type="hidden" name="customer[email]" value="' . $email . '" />';
                        echo '  <input type="hidden" name="customer[name]" value="' . $name . '" />';
                        echo '  <input type="hidden" name="tx_ref" value="' . $transactionReference . '" />';
                        echo '  <input type="hidden" name="amount" value="' . $totalMilestoneAmount . '" />';
                        echo '  <input type="hidden" name="currency" value="NGN" />';
                        echo '  <input type="hidden" name="meta[token]" value="54" />';
                        echo '  <input type="hidden" name="redirect_url" value="'.$redirectUrl.'" />';
                        echo '  <button type="submit" id="start-payment-button">Pay Now</button>';
                        echo '</form>';
                    }
                }
            }
            
            
            
        }
        ?>

    </div>
</body>
</html>
