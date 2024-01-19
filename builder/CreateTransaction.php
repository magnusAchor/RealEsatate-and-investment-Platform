<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /*popup*/
        /* Styles for the popup container */
/* Styles for the popup container */
/* Styles for the popup container */
#popup2 {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    width: 80%; /* Set the width of the popup */
    max-height: 70%; /* Set a maximum height for the popup */
    overflow-y: auto; /* Enable vertical scrolling when content exceeds the height */
}

/* Rest of the CSS remains unchanged */


/* Styles for the close button */
.close {
    position: absolute;
    top: 5px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

.close:hover {
    color: #f00;
}

.milestone label {
    display: block;
    margin-bottom: 5px;
}

.milestone input,
.milestone select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.milestone button {
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.milestone button[type="submit"] {
    background-color: #008CBA;
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


        // Function to show the popup
function showPopup() {
    document.getElementById('popup2').style.display = 'block';
}

// Function to close the popup
function closePopupp() {
    document.getElementById('popup2').style.display = 'none';
}

// Attach the showPopup function to the button click event
document.getElementById('showPopupBtn').addEventListener('click', showPopup);

    
    
 function addMilestone() {
    const milestoneContainer = document.getElementById('milestoneContainer');
    const newMilestone = document.createElement('div');
    newMilestone.classList.add('milestone');
    newMilestone.innerHTML = `
      <label>Buyer Email:</label>
      <input type="email" name="buyer_email" required><br><br>
      <label>Seller Email:</label>
      <input type="email" name="seller_email" required><br><br>
      <label>Description:</label>
      <input type="text" name="milestone_description[]" required><br><br>
      <label>Amount:</label>
      <input type="number" name="milestone_amount[]" step="0.01" required><br><br>
      <label>Currency:</label>
      <select name="currency" required>
        <option value="usd">USD</option>
        <option value="eur">EUR</option>
        <!-- Add more currency options as needed -->
      </select><br><br>
      <label>Due Date:</label>
      <input type="date" name="due_date[]" required><br><br>
    `;
    milestoneContainer.appendChild(newMilestone);
  };
</script>
</head>
<body>
<button id="showPopupBtn" onclick="showPopup()">Click Me!</button>

<!--popup for creating transaction -->
<div id="popup2" style="max-height: 50%; overflow-y: auto;">
        <span class="close" onclick="closePopupp()">&times;</span>
        <p>This is a popup! You can put any content here.</p>
        
    

<form id="milestoneForm" method="post">
  <div id="milestoneContainer">
    <div class="milestone">
      <label>Buyer Email:</label>
      <input type="email" name="buyer_email" required><br><br>
      <label>Seller Email:</label>
      <input type="email" name="seller_email" required><br><br>
      <label>Description:</label>
      <input type="text" name="milestone_description[]" required><br><br>
      <label>Amount:</label>
      <input type="number" name="milestone_amount[]" step="0.01" required><br><br>
      <label>Currency:</label>
      <select name="currency" required>
        <option value="usd">USD</option>
        <option value="eur">EUR</option>
        <!-- Add more currency options as needed -->
      </select><br><br>
      <label>Due Date:</label>
      <input type="date" name="due_date[]" required><br><br>
    </div>
  </div>
  <button type="button" id="addMilestoneBtn" onclick="addMilestone()">Add New Milestone</button>
  <button type="submit">Create Transaction</button>
</form>

</div>
    
</body>
</html>
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

// Assuming the form is submitted and the milestone data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $milestoneDescriptions = $_POST['milestone_description'];
  $milestoneAmounts = $_POST['milestone_amount'];
  $payerCustomers = $_POST['buyer_email'];
  $beneficiaryCustomers = $_POST['seller_email'];
  $dueDates = $_POST['due_date'];

  // Form values for currency and description
  $currency = $_POST['currency']; // Assuming the currency is selected from a dropdown/select input
  $transactionDescription = $milestoneDescriptions[0]; // Assuming the first milestone description is used as the overall transaction description

  // Validate email addresses
  function validateEmail($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  $isValidBuyerEmail = validateEmail($payerCustomers);
  $isValidSellerEmail = validateEmail($beneficiaryCustomers);

  if (!$isValidBuyerEmail || !$isValidSellerEmail) {
    echo 'Invalid email address. Please enter valid buyer and seller email addresses.';
    exit; // Stop further processing
  }

  // Build the items array based on the milestone data received
  $items = array();
  foreach ($milestoneDescriptions as $index => $description) {
    $items[] = array(
      'description' => $description,
      'schedule' => array(
        array(
          'payer_customer' => $payerCustomers,
          'amount' => $milestoneAmounts[$index],
          'beneficiary_customer' => $beneficiaryCustomers,
          'due_date' => $dueDates[$index],
        ),
      ),
      'title' => $description,
      'inspection_period' => '259200',
      'type' => 'milestone', // Milestone item
      'quantity' => '1',
    );

    // Add broker_fee item for each milestone
    $items[] = array(
      'type' => 'broker_fee', // Broker fee for the milestone
      'schedule' => array(
        array(
          'payer_customer' => $payerCustomers, // Buyer
          'amount' => $milestoneAmounts[$index] * 0.1, // 10% commission for the milestone
          'beneficiary_customer' => 'me', // Broker
        ),
      ),
    );
  }

  // Continue with the rest of the PHP code for the API call using the $items array.

  // ... (remaining code for the API call)
  // ... (previous code)

// Continue with the rest of the PHP code for the API call using the $items array.

$api_url = 'https://api.escrow.com/2017-09-01/transaction';
$api_username = 'kutiyoung@gmail.com'; // Replace with your Escrow.com API username
$api_password = 'Donjazzy200'; // Replace with your Escrow.com API password

// Set up cURL options for the API call
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_USERPWD => $api_username . ':' . $api_password,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
  CURLOPT_POSTFIELDS => json_encode(
    array(
      'currency' => $currency,
      'items' => $items,
      'description' => $transactionDescription,
      'parties' => array(
        array(
          'customer' => 'me',
          'role' => 'broker',
        ),
        array(
          'customer' => $payerCustomers, // Assuming the buyer email is used for the API call
          'role' => 'buyer',
        ),
        array(
          'customer' => $beneficiaryCustomers, // Assuming the seller email is used for the API call
          'role' => 'seller',
        ),
      ),
    )
  )
));

// Execute the cURL request
$output = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
  echo 'cURL Error: ' . curl_error($curl);
}

// Close the cURL session
curl_close($curl);

// Process the API response (output)
echo $output;


}
?>
