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
    $delete_id = $_POST['category_id'];

    // delete query
    $delete_category = $con->prepare("DELETE FROM `categories` WHERE category_id = ?");
    $delete_category->bind_param("i", $delete_id);
    if($delete_category->execute()){
        $delete_product = $con->prepare("DELETE FROM `products` WHERE category_id = ?");
        $delete_product->bind_param("i", $delete_id);
        $delete_product->execute();
        $_SESSION['show_success_delete'] = true;
        header("Location: view_category.php");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

           <!--alert starts  -->
           <div id="success-alert" class="success-alert">Category deleted successfully!</div>
           <div id="error-alert" class="error-alert">Something went wrong!</div>
             <!-- alert ends -->


             <script>
        function showSuccessAlert() {
        const alertBox = document.getElementById('success-alert');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 2500);
        }
        function showErrorAlert() {
        const alertBox = document.getElementById('error-alert');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 2500);
        }

        // Trigger from PHP using session
        <?php
        if (isset($_SESSION['show_success']) && $_SESSION['show_success']) {
            echo "showSuccessAlert();";
            unset($_SESSION['show_success']); // remove flag
        }
        ?>
        <?php
        if (isset($_SESSION['show_error']) && $_SESSION['show_error']) {
            echo "showErrorAlert();";
            unset($_SESSION['show_error']); // remove flag
        }
        ?>
  </script>
  
</body>
</html>