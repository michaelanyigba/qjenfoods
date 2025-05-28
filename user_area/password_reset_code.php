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
    $mail->Password   = 'hoem qdum phsc izav';                               //SMTP password
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
    <a href='http://localhost/qjenfoods/user_area/password_change.php?token=$token&email=$get_email'>Click this link</a>
    ";
    $mail->Body = $email_template;
    $mail->send();

}

if(isset($_POST['password_reset_link'])){
    $email = $_POST['email'];
    $token = md5(rand());

    // $check_email = "SELECT * FROM users WHERE user_email = '$email' LIMIT 1";
    // $check_email_run = mysqli_query($con, $check_email);
    $check_email = $con->prepare("SELECT * FROM `users` WHERE user_email = ? LIMIT 1");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email_result = $check_email->get_result();

    if($check_email_result->num_rows >0){
        $row = mysqli_fetch_array($check_email_result);
        $get_name = $row['username'];
        $get_email = $row['user_email'];

        // $update_token = "UPDATE users SET verify_token= '$token' WHERE user_email='$get_email' LIMIT 1";
        // $update_token_run = mysqli_query($con, $update_token);
        $update_token = $con->prepare("UPDATE users SET verify_token = ? WHERE user_email = ? LIMIT 1");
        $update_token->bind_param("ss", $token, $get_email);

        if($update_token->execute()){
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['message'] = "We emailed you a password link";
            $_SESSION['msg_type'] = "success";
            header("Location: password_reset.php");
            // exit(0);

        }else{
            $_SESSION['message'] = "Something went wrong";
            $_SESSION['msg_type'] = "error";
            header("Location: password_reset.php");
            // exit(0);

        }

    }else{
        $_SESSION['message'] = "No email found";
        $_SESSION['msg_type'] = "error";
        header("Location: password_reset.php");
        // exit(0);
    }


}

if(isset($_POST['password_update'])){
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $hash_password= password_hash($new_password, PASSWORD_DEFAULT);
    $token = $_POST['password_token'];

    if(!empty($token)){
        if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
            // $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1 ";
            // $check_token_run = mysqli_query($con, $check_token);
            $check_token = $con->prepare("SELECT verify_token FROM users WHERE verify_token = ? LIMIT 1");
            $check_token->bind_param("s", $token);
            $check_token->execute();
            $check_token_result = $check_token->get_result();
            if($check_token_result->num_rows >0){
                if ($new_password == $confirm_password) {
                    // $update_password = "UPDATE users SET user_password='$hash_password' WHERE verify_token ='$token' LIMIT 1";
                    // $update_password_run = mysqli_query($con, $update_password);
                    $update_password = $con->prepare("UPDATE users SET user_password = ? WHERE verify_token = ? LIMIT 1");
                    $update_password->bind_param("ss", $hash_password, $token);
                    if ($update_password->execute()) {

                        $new_token = md5(rand())."funda";
                        // $update_to_new_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token ='$token' LIMIT 1";
                        // $update_to_new_token_run = mysqli_query($con, $update_to_new_token);
                        $update_to_new_token = $con->prepare("UPDATE users SET verify_token = ? WHERE verify_token = ? LIMIT 1");
                        $update_to_new_token->bind_param("ss", $new_token, $token);
                        $update_to_new_token->execute();

                        $_SESSION['message'] = "Password updated successfully";
                        $_SESSION['msg_type'] = "success";
                        header("Location: user_login.php");
                        exit();

                        } else {
                            $_SESSION['message'] = "Could not update the password. Something went wrong!";
                            $_SESSION['msg_type'] = "error";
                            header("Location: password_change.php?token=$token&email=$email");
                            exit();
                            }
                    }else{
                        $_SESSION['message'] = "Password and confirm password does not match!";
                        $_SESSION['msg_type'] = "error";
                        header("Location: password_change.php?token=$token&email=$email");
                        exit();
                    }

            }else{
                $_SESSION['message'] = "Invalid token!";
                $_SESSION['msg_type'] = "error";
                header("Location: password_change.php?token=$token&email=$email");
                exit();

            }
        }else{
            $_SESSION['message'] = "No token available!";
            $_SESSION['msg_type'] = "error";
            header("Location: password_reset.php");
            exit();


        }
    }

}

?>