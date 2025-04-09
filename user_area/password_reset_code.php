<?php
session_start();
include("../includes/connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $token){

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail = new PHPMailer(true);
    $mail->isSMTP();    
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'kwabenahlegacy18@gmail.com';                     //SMTP username
    $mail->Password   = '1234';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    
    $mail -> SMTPSecure = "tls";
    $mail->Port = 587; 

    $mail->setFrom('kwabenahlegacy18@gmail.com', $get_name);
    $mail->addAddress($get_email);
    $mail->isHTML(true);
    $mail->subject = "Reset password notification";
    $email_template = "
    <h2>Hello</h2>
    <h3>You are receiving this email because we received a passwordd reset request for your account</h3>
    <br/> <br/>
    <a href='http://localhost/qjenfoods/user_area/user_login.php/password_change.php?token=$token&email=$get_email'>Click me</a>
    ";
    $mail->Body = $email_template;
    $mail->send();

}

if(isset($_POST['password_reset_link'])){
    $email = $_POST['email'];
    $token = md5(rand());

    $check_email = "SELECT * FROM users WHERE user_email = '$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows($check_email_run)>0){
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['username'];
        $get_email = $row['user_email'];

        $update_token = "UPDATE users SET verify_token= '$token' WHERE user_email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run){
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = "We emailed a password link";
            header("Location: password_reset.php");
            exit(0);

        }else{
            $_SESSION['status'] = "something went wrong. #1";
            header("Location: password_reset.php");
            exit(0);

        }

    }else{
        $_SESSION['status'] = "No email found";
        header("Location: password_reset.php");
        exit(0);
    }


}

?>