<?php
// Turn off error reporting (remove these lines in production)
error_reporting(0);
ini_set('display_errors', 0);

session_start();
include 'connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $userType = htmlspecialchars($_POST['userType'], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];
    $number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
    $fst_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
    $lst_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
    $mid_name = htmlspecialchars($_POST['middle_name'], ENT_QUOTES, 'UTF-8');
    $_city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $pst_code = htmlspecialchars($_POST['post_code'], ENT_QUOTES, 'UTF-8');
    $contry = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
    $line_one = htmlspecialchars($_POST['line1'], ENT_QUOTES, 'UTF-8');
    $line_2 = htmlspecialchars($_POST['line2'], ENT_QUOTES, 'UTF-8');
    $stte = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
    $mail = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $status = 'ongoing';

    $fullname = $fst_name . ' ' . $lst_name . ' ' . $mid_name;
    $location = $_city . ' ' . $stte . ' ' . $contry;

    // Check if the user is already registered
    $alreadyRegistered = false;

    if ($userType == 'buyer') {
        // Use prepared statement to prevent SQL injection
        $buyerCheckQuery = "SELECT * FROM buyers WHERE email = ?";
        $buyerStmt = $conn->prepare($buyerCheckQuery);
        $buyerStmt->bind_param('s', $mail);
        $buyerStmt->execute();
        $buyerResult = $buyerStmt->get_result();

        if ($buyerResult->num_rows > 0) {
            $alreadyRegistered = true;
        } else {
            // Prepare and execute SQL query using prepared statements
            $sql = "INSERT INTO users (username, password, status, phone_number, first_name, last_name, middle_name, city, post_code, country, line1, line2, state, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sbc = "INSERT INTO buyers (name, email, password, full_name, location, phone_number) VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssssssss', $username, $password, $status, $number, $fst_name, $lst_name, $mid_name, $_city, $pst_code, $contry, $line_one, $line_2, $stte, $mail);

            $stmt2 = $conn->prepare($sbc);
            $stmt2->bind_param('ssssss', $username, $mail, $password, $fullname, $location, $number);

            if ($stmt->execute() && $stmt2->execute()) {
                echo "Registration successful!";
                header("Location: login_form.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt->close();
            $stmt2->close();
        }
    } elseif ($userType == 'worker') {
        // Use prepared statement to prevent SQL injection
        $workerCheckQuery = "SELECT * FROM employees WHERE username = ?";
        $workerStmt = $conn->prepare($workerCheckQuery);
        $workerStmt->bind_param('s', $username);
        $workerStmt->execute();
        $workerResult = $workerStmt->get_result();

        if ($workerResult->num_rows > 0) {
            $alreadyRegistered = true;
        } else {
            // Prepare and execute SQL query using prepared statements
            $sbc = "INSERT INTO employees (username, password, email, full_name, phone_number) VALUES (?, ?, ?, ?, ?)";
            $sql = "INSERT INTO users (username, password, status, phone_number, first_name, last_name, middle_name, city, post_code, country, line1, line2, state, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sbc);
            $stmt->bind_param('sssss', $username, $password, $mail, $fullname, $number);

            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param('ssssssssssssss', $username, $password, $status, $number, $fst_name, $lst_name, $mid_name, $_city, $pst_code, $contry, $line_one, $line_2, $stte, $mail);

            if ($stmt->execute() && $stmt2->execute()) {
                echo "Registration successful!";
                header("Location: login_form");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }

            $stmt->close();
            $stmt2->close();
        }
    }

    // Display an alert if the user is already registered
    if ($alreadyRegistered) {
        echo "<script>alert('User is already registered.')</script>";
        // Redirect or perform any other necessary actions
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href=" ">
    <style>
       body {
    background-color: #f1c40f;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 400px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

select {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

.alert {
    background-color: #f44336;
    color: #fff;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
}
@media screen and (max-width: 768px) {
    .container {
    max-width: 300px;
    padding: 30px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
}
    </style>
</head>
<body>
    <?php
    include 'preloader.php';
    ?>
    <div class="container">
        <h2>Registration Form</h2>
        <form id="myForm" action="" method="POST">
            <fieldset>
                <legend>Who are you registering as?</legend>
                <select id="userType" name="userType" required>
                    <option value="">Select an option</option>
                    <option value="buyer">Employer/buyer</option>
                    <option value="worker">Worker/company</option>
                </select>
            </fieldset>

            <br>
            <label for="username"></label>
<input type="text" id="username" name="username" placeholder="Username" required>
<br>
<label for="password"></label>
<input type="password" id="password" name="password" placeholder="Password" required>
<br>
<label for="phone_number"></label>
<input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" required><br><br>

<label for="first_name"></label>
<input type="text" name="first_name" id="first_name" placeholder="First Name" required><br><br>

<label for="last_name"></label>
<input type="text" name="last_name" id="last_name" placeholder="Last Name" required><br><br>

<label for="middle_name"></label>
<input type="text" name="middle_name" id="middle_name" placeholder="Middle Name"><br><br>

<label for="city"></label>
<input type="text" name="city" id="city" placeholder="City" required><br><br>

<label for="post_code"></label>
<input type="text" name="post_code" id="post_code" placeholder="Postal Code" required><br><br>

<label for="country"></label>
<input type="text" name="country" id="country" placeholder="Country" required><br><br>

<label for="line1"></label>
<input type="text" name="line1" id="line1" placeholder="Address Line 1"><br><br>

<label for="line2"></label>
<input type="text" name="line2" id="line2" placeholder="Address Line 2"><br><br>

<label for="state"></label>
<input type="text" name="state" id="state" placeholder="State" required><br><br>

<label for="email"></label>
<input type="email" id="email" name="email" placeholder="Email" required>

            <br>
            <button type="submit" value="Register">Register</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault();

        // Get the form data
        var formData = $(this).serialize();

        // Send the form data to PHP scripts using AJAX
        $.ajax({
            url: 'register',
            type: 'post',
            data: formData,
            success: function(response) {
                if (response.includes("User is already registered")) {
                    alert("User is already registered");
                } else {
                    // Handle the response from the PHP script
                    alert("Registration successful!");
                    // You can perform additional actions based on the response
                    window.location.href = "login_form"; // Redirect to login page
                }
            }
        });

        $.ajax({
            url: 'CreateEscrowCustomers',
            type: 'post',
            data: formData,
            success: function(response) {
                // Handle the response from the second PHP script
                console.log(response);
                // You can perform additional actions based on the response
            }
        });
    });
});
//history.replaceState({}, null, '/5667fhfgg78');
    </script>
</body>
</html>
