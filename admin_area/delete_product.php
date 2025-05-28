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
    $delete_id = $_POST['product_id'];

    // delete query
    $delete_product = $con->prepare("DELETE FROM `products` WHERE product_id = ?");
    $delete_product->bind_param("i", $delete_id);

    if($delete_product->execute()){
      $_SESSION['show_success_delete'] = true;
      header("Location: view_products.php");
      exit();
    }else{
      header("Location: view_products.php");
      exit();
    }
}


?>