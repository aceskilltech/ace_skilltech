<?php
require './PHPMailer.php';
require './SMTP.php';
require './Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    try {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';

        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->Port       = 587;
        $mail->Username   = "paradigmace23@gmail.com"; // SMTP account username
        $mail->Password   = "efhgmrdfirtoiqib"; // app key password         
        $mail->SMTPSecure = 'tls';   

        // Recipient email address
        $mail->addAddress('paradigmace23@gmail.com'); // Replace with the recipient's email address

        $mail->Subject = 'User from AceSkillTech.com';

        // Email body
        $mail->Body = "<h2>Submission From User</h2>
                       <p><strong>Name:</strong> $name</p>
                       <p><strong>Email:</strong> $email</p>
                       <p><strong>Message:</strong><br>$message</p>";

        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message";

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo '<script>alert("Email Sent");</script>';
            echo '<script>window.location.href = "index.html";</script>'; // Redirect to a success page
        }
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}
?>
