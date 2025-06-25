<?php
include 'include/config.php';
session_start();

if(isset($_POST['token']) && isset($_POST['new_password'])) {
    $token = mysqli_real_escape_string($connection, $_POST['token']);
    $new_password = md5($_POST['new_password']);
    
    // Simplified query without token_expiry
    $sql = "UPDATE donor SET 
            password='$new_password', 
            reset_token=NULL 
            WHERE reset_token='$token'";
            
    if(mysqli_query($connection, $sql)) {
        $_SESSION['success_message'] = "Password updated successfully. You can now login with your new password.";
        header("Location: signin.php");
    } else {
        $_SESSION['error_message'] = "Failed to update password. Please try again.";
        header("Location: reset_password.php?token=" . $token);
    }
    exit();
} 

header("Location: forgot_password.php");
exit();
