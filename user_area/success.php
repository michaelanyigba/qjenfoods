<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

if($_SESSION['role']){
    $user_role = $_SESSION['role'];

}
if($_SESSION['username']){
    $username = $_SESSION['username'];

}

if($_SESSION['cart']){
    $cart_item = $_SESSION['cart'];
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success</title>
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
    <script>
        setTimeout(() => {
            <?php if($username && $user_role === 'admin'):?>
            window.location.href = "../admin_area/index.php"; 
            <?php elseif($username && $user_role === 'sub_admin'):?>
            window.location.href = "../admin_area/index.php"; 
            <?php elseif ($user_role ==='user' && $cart_item ==='item_in_cart' ):?>
            window.location.href = "cart.php"; 
            <?php elseif ($user_role ==='user' && $cart_item === "no_item_in_cart"):?>
            window.location.href = "../index.php"; 
            <?php else: ?>
            window.location.href = "user_login.php"; 
            <?php endif;?>
        }, 2000);// redirecting the user in 2 seconds
    </script>

<style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            display: flex;
            justify-content: center; /* Centers horizontally */
            align-items: center; /* Centers vertically */
            height: 100vh; /* Full viewport height */
            margin: 0;
            background-color: #fff;
        }
        .message-box {
            color: white;
         
        }
        .tick{
            font-size: 60px;
        }
        .main{
            background-color:blue;
            width: 400px;
            display:flex;
            justify-content:center;
            align-items: center;
            border-radius: 10px;

        }
    </style>
</head>
<body>
    <div class="main">
<div class="message-box">
    <h2>Login Successful</h2>
    <div class="tick">
    <i class="fa fa-check tick" aria-hidden="true"></i>
    </div>
    <p>Redirecting in 0 seconds</p>

    </div>
    </div>
</body>
</html>