<?php
include 'connect.php';
// Include any necessary files and configuration

// Get the token from the URL parameter
$token = $_GET['token'];

// Initialize variables
$validToken = false;
$email = '';

$tokenQuery = "SELECT * FROM password_reset_tokens WHERE token = ? AND expiry > NOW()";
$stmt = $conn->prepare($tokenQuery);
$stmt->bind_param("s", $token);
$stmt->execute();
$tokenResult = $stmt->get_result();
$tokenData = $tokenResult->fetch_assoc();

if ($tokenData) {
    // Token is valid
    $validToken = true;
    $email = $tokenData['email'];
}

$message = ''; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($validToken) {
        $newPassword = $_POST['new_password'];

        // Update the user's password in the 'users' table
        if ($result = $conn->query("SELECT * FROM users WHERE email = '$email'")) {
            if ($result->num_rows > 0) {
                $updatePasswordQuery = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
            }
        }

        // Execute the 'users' table update query first
        if (isset($updatePasswordQuery)) {
            if ($conn->query($updatePasswordQuery)) {
                $message = "Password reset successful for 'users' table. You can now log in with your new password.";
            } else {
                $message = "Error updating password " . $conn->error;
            }
        } else {
            $message = "No matching record found  for update.";
        }

        // Check if the email exists in 'buyers' or 'employees' tables
        if ($result = $conn->query("SELECT * FROM buyers WHERE email = '$email'")) {
            if ($result->num_rows > 0) {
                $updatePasswordQuery = "UPDATE buyers SET password = '$newPassword' WHERE email = '$email'";
                if ($conn->query($updatePasswordQuery)) {
                    $message = 'Password reset successful .';
                } else {
                    $message = 'Error updating password  ' . $conn->error;
                }
            }
        }

        if ($result = $conn->query("SELECT * FROM employees WHERE email = '$email'")) {
            if ($result->num_rows > 0) {
                $updatePasswordQuery = "UPDATE employees SET password = '$newPassword' WHERE email = '$email'";
                if ($conn->query($updatePasswordQuery)) {
                    $message = 'Password reset successful ';
                } else {
                    $message = 'Error updating password  ' . $conn->error;
                }
            }
        }
    } else {
        $message = "Invalid or expired token. Password reset failed.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .reset-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }
        p.error-message {
            color: #ff0000;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Reset Password</h2>
       <?php echo '<p style="color:green;">' . $message . '</p>'; ?> <!-- Display the message here -->
        <?php if ($validToken): ?>
            <form action="" method="post">
                <label>New Password:</label>
                <input type="password" name="new_password" required>
                <button type="submit">Reset Password</button>
            </form>
        <?php else: ?>
            <p class="error-message">Invalid or expired token. Password reset failed.</p>
        <?php endif; ?>
    </div>
</body>
</html>
