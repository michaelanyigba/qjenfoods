<?php
include("../includes/connect.php");
include("../functions/common_function.php");

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
</head>
<body>

<?php
            if(!isset($_SESSION['username'])){
                echo "<script>window.open('user_login.php','_self')</script>";
            }else{
                echo "<script>window.open('payment.php','_self')</script>";
            }
            
            
            ?>

    
</body>
</html>