<?php

include("../includes/connect.php");

if(isset($_GET['delete_brand'])){
    $delete_id = $_GET['delete_brand'];

    // delete query
    $delete_brand = "Delete from `brands` where brand_id = $delete_id";
    $result_brand = mysqli_query($con, $delete_brand);
    if($result_brand){
        $delete_product = "Delete from `products` where brand_id = $delete_id";
        $result_brand = mysqli_query($con, $delete_product);
        echo "<script>alert('Brand deleted successfully')</script>";
        echo "<script>window.open('view_brand.php','_self')</script>";
    }
}


?>