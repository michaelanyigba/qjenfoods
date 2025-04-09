<?php

include("../includes/connect.php");

if(isset($_GET['delete_category'])){
    $delete_id = $_GET['delete_category'];

    // delete query
    $delete_category = "Delete from `categories` where category_id = $delete_id";
    $result_category = mysqli_query($con, $delete_category);
    if($result_category){
        $delete_product = "Delete from `products` where category_id = $delete_id";
        $result_category = mysqli_query($con, $delete_product);
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('view_category.php','_self')</script>";
    }
}


?>