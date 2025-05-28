<?php

include("../includes/connect.php");
session_start();


  
if(!isset($_SESSION['username']) || $_SESSION['role'] !=="admin" && $_SESSION['role'] !=="sub_admin"){
    session_unset();
    session_destroy();
    header("Location: ../user_area/user_login.php");
  }
  
  $_SESSION['username'];
  $username = $_SESSION['username'];

if(isset($_POST['confirm_delete'])){
    $delete_id = $_POST['brand_id'];

    // delete query

    $delete_brand = $con->prepare("DELETE FROM `brands` WHERE brand_id = ?");
    $delete_brand->bind_param("i", $delete_id);
    if($delete_brand->execute()){
        $delete_product = "Delete from `products` where brand_id = $delete_id";
        $delete_product = $con->prepare("DELETE FROM `products` WHERE brand_id =?");
        $delete_product->bind_param("i", $delete_id);
        $delete_product->execute();

        $_SESSION['show_success_delete'] = true;
        header("Location: view_brand.php");
        exit();
    }
}


?>