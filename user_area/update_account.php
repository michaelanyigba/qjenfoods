<?php

include("../includes/connect.php");
include("../functions/common_function.php");

session_start();

if(!isset($_SESSION['username'])){
    echo "<script>window.open('user_login.php', '_self')</script>";

}


$user_session_name = $_SESSION['username'];
$select_query = $con->prepare("SELECT * FROM `users` WHERE username = ?");
$select_query->bind_param("s", $user_session_name);
$select_query->execute();
$select_query_result = $select_query->get_result();
$row_fetch = $select_query_result->fetch_assoc();
$user_id = $row_fetch['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// $update_id = $user_id;
$username = $_POST['user_username'];
$user_email = $_POST['user_email'];
$user_address = $_POST['user_address'];
$user_phone_number = $_POST['user_phone_number'];

    $update_data = $con->prepare("UPDATE `users` SET username =? , user_email=?, user_address=?, user_phone_number=? WHERE user_id = ?");
    $update_data->bind_param("ssssi",$username, $user_email, $user_address, $user_phone_number, $user_id);
    if($update_data->execute()){
        echo "<script>window.open('logout.php', '_self')</script>";
    }else{
        echo "could not update the account";

    }

}
?>