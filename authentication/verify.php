<?php
require('../db/conn.php');
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    // Check if token exists in the database
    $sql = "SELECT * FROM customers WHERE email=? AND token=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        // Mark email as verified
        $sql_update = "UPDATE customers SET is_verified=1, token=NULL WHERE email=?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "s", $email);
        mysqli_stmt_execute($stmt_update);
        echo "<script>alert('Email verified successfully! Redirecting...');
        window.location.href='./login.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Invalid verification link or token expired.');
        window.location.href='./account_verify.php';
        </script>";
        exit();
}
} else {
    echo 
    "<script>alert('error encountered');
    window.location.href='./account_verify.php';
    </script>";
    exit();
}
?>
