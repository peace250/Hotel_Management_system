<?php
require('../db/conn.php');

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SSL;
use PHPMailer\PHPMailer\Exception;
// load phpmailer.
require '../vendor/autoload.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $password = htmlspecialchars(trim($_POST['password']));
    $email = htmlspecialchars(trim($_POST['email']));
    // select from the DB
    $sql_select = "SELECT * FROM users WHERE email= ?  ";
    $stmt = mysqli_prepare($conn, $sql_select);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $fetch = mysqli_fetch_assoc($result);
    if (!$fetch) {
        echo "<script>
    alert('EMail not found!');
    </script>";
        exit();
    }
    if (!password_verify($password, $fetch['password'])) {
        echo "<script>alert('Incorrect password!');</script>";
        exit();
    }
    // Check if account is verified
    if ($fetch['is_verified'] == 0) {
        echo "<script>alert('Please verify your email before logging in.');
        window.location.href='./verify.php'
        </script>";
        // Generate a Verification Token if not verified
        $verification_token = bin2hex(random_bytes(32)); // Secure random token
        $update_token_query = "UPDATE users SET verification_token=? WHERE email=?";
        $stmt_update = mysqli_prepare($conn, $update_token_query);
        mysqli_stmt_bind_param($stmt_update, "ss", $verification_token, $email);
        mysqli_stmt_execute($stmt_update);
        exit();
    
 

    //verification link..
    $verification_link = "http://localhost/Project1_/authentication/verify.php?email=" . urlencode($email) . "&token=" . $verification_token;
    // password Verification.
    // EMail generation Area!
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Use your mail server (e.g., smtp.mailtrap.io)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'peacemuhayimana0@gmail.com'; // Your Gmail address
        $mail->Password   = 'ttduxvhqagwdxeai'; // Use an **App Password** if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption (SSL or TLS)
        $mail->Port       = 587; // Use 465(SMTP) for SSL, 587 for TLS
        //Recipients
        $mail->setFrom('peacemuhayimana0@gmail.com', 'ITUZE_HOTEL');
        $mail->addAddress($email,$fetch['name']); //Add a recipient
        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Email verification Link';
        $mail->Body    = "Click <a href='$verification_link'>here</a> to verify your email and access the dashboard";
       
        if ($mail->send()) {
            // Send Email
            echo "
    <script>
    alert('Verification email sent!');
    </script>
    ";
        } else {
            echo "
    <script>
    alert('Email could not be sent!');
    </script>
    ";
        }
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }exit();


}
    // sessions and redirections
    $_SESSION['user'] = $fetch['name'];
    $_SESSION['role'] = $fetch['role'];
    if ($fetch['role'] == 'admin') {
        echo header("location: ../admin/dashboard.php");
    } elseif ($fetch['role'] == 'customer') {
        echo header("location: ../customer/dashboard.php");
    } elseif ($fetch['role'] == 'staff') {
        echo header("location: ../staff/dashboard.php");
    }
    exit();
} 
