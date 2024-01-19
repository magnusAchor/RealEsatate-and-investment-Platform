<?php
include 'connect.php';
// Include the PHPMailer library
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the user's email address from the form
$email = $_POST['forgot'];

// Generate a unique token
$token = bin2hex(random_bytes(32));

// Calculate token expiry (e.g., 1 hour from now)
$expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Construct the reset link
$resetLink = 'https://villadin.com/reset_password?token=' . $token;

// Create a new PHPMailer instance
$mail = new PHPMailer(true); // Set 'true' to enable exceptions

$confirm = "SELECT * FROM users WHERE email = ? ";
$stmt = $conn->prepare($confirm);
$stmt->bind_param("s", $email);
$stmt->execute();
$confirmResult = $stmt->get_result();
$crlt = $confirmResult->fetch_assoc();
if($confirmResult->num_rows === 1){


try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = '*******'; // Replace with your SMTP host
    $mail->Port = ***; // Replace with your SMTP port
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl'; // Use 'ssl' or 'tls' based on your server settings
    $mail->Username = '***********'; // Replace with your email address
    $mail->Password = '*******'; // Replace with your email password

    // Set sender and recipient
    $mail->setFrom('villastock@villadin.com', 'Villadin'); // Replace with your email address and name
    $mail->addAddress($email); // User's email address

    // Email content
    $mail->Subject = 'Password Reset';
    $mail->Body = "Click the following link to reset your password: $resetLink";

    // Send the email
    $gone=$mail->send();
   // echo "Password reset email sent.";
    if ($gone){
    
    // Construct the SQL query for insertion
    $tokeninsert = "INSERT INTO password_reset_tokens (email, token, expiry) VALUES ('$email', '$token', '$expiry')";
        
    // Execute the query
    if (mysqli_query($conn, $tokeninsert)) {
        echo "Password reset email sent .";
    } else {
        echo "Error itn: " . mysqli_error($conn);
    }
}else {
    echo "Error sending email: " . $mail->ErrorInfo;
}
} catch (Exception $e) {
    echo "Error sending email: " . $mail->ErrorInfo;
}}else{
    echo'this email is not registered';
}
?>
