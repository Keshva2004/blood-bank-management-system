<?php
include 'include/config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM donor WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate token and expiry time
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Update token and expiry in the database
        $update = "UPDATE donor SET reset_token=?, token_expiry=? WHERE email=?";
        $stmt2 = $connection->prepare($update);
        $stmt2->bind_param("sss", $token, $expiry, $email);
        $stmt2->execute();

        // Send email with PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';     // Gmail SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'kavyapatel00211@gmail.com';  // Your Gmail address
            $mail->Password = 'mrmr jzlr yebe nqij';    // App Password, not Gmail login password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('kavyapatel00211@gmail.com', 'Blood Bank');
            $mail->addAddress($email);     // Recipient's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Link';
            $mail->Body = "Hi,<br><br>Click the link below to reset your password:<br><a href='http://localhost/bloodbankproject/reset_password.php?token=$token'>Reset Password</a>";

            // Send the email
            $mail->send();
            echo 'Reset link has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not registered.";
    }
}
?>
