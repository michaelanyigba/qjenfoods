<?php

include("../includes/connect.php");
include("../functions/common_function.php");

session_start();

if(!isset($_SESSION['username'])){
    echo "<script>window.open('user_login.php', '_self')</script>";

}

if(isset($_POST['order_mode'])){

    $all_products_json=[];
    $order_receiving_mode= $_POST['receiving_mode'];
    $order_payment_mode= $_POST['payment_mode'];

    if($order_receiving_mode=='' or $order_payment_mode==''){
        $_SESSION['show_error'] = true;
        header("Location: payment.php");
        exit();
    }
    else{

  

    // select the user
$username = $_SESSION['username'];
// fetching the user id
// $get_user= "Select * from `users` where username= '$username' ";
// $user_query = mysqli_query($con, $get_user);
// $user_row = mysqli_fetch_assoc($user_query);
$get_user = $con->prepare("SELECT * FROM `users` WHERE username = ?");
$get_user->bind_param("s", $username);
$get_user->execute();
$get_user_result = $get_user->get_result();
$user_row = $get_user_result->fetch_assoc();
$user_id = $user_row['user_id'];

    // getting total price and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
// $cart_query_price = "Select * from `cart_details` where ip_address = '$get_ip_address'";
// $result_cart_price = mysqli_query($con, $cart_query_price);
$cart_query_price = $con->prepare("SELECT * FROM `cart_details` WHERE ip_address = ?");
$cart_query_price->bind_param("s", $get_ip_address);
$cart_query_price->execute();
$result_cart_price = $cart_query_price->get_result();
$invoice_number = mt_rand();
// $status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);
while($row_price = mysqli_fetch_array($result_cart_price)){
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity'];
    // $select_product = "Select * from `products` where product_id= $product_id";
    // $run_price = mysqli_query($con, $select_product);
    $select_product = $con->prepare("SELECT * FROM `products` WHERE product_id = ?");
    $select_product->bind_param("i", $product_id);
    $select_product->execute();
    $run_price = $select_product->get_result();
    while($row_product_price = mysqli_fetch_array($run_price)){
        $product_price = array($row_product_price['product_price']);
        $price_table = $row_product_price['product_price'];
        $product_values = array_sum($product_price);
        $product_row_price = $price_table * $quantity;
        $total_price += $product_row_price;


    }
}

// fetching for all the products
// $all_product_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
// $product_result = mysqli_query($con, $all_product_query);
$all_product_query = $con->prepare("SELECT * FROM `cart_details` WHERE ip_address = ?");
$all_product_query->bind_param("s", $get_ip_address);
$all_product_query->execute();
$product_result = $all_product_query->get_result();
if($product_result -> num_rows>0){
    $all_products = [];

    while($row =$product_result->fetch_assoc()){
        $all_products[] =["product_id"=> $row['product_id'], "quantity"=>$row['quantity']];
    }
    $all_products_json = json_encode($all_products);
}

// echo $all_products_json;
// getting quantity from cart
$get_cart= "Select * from `cart_details` ";
$result_cart = mysqli_query($con, $get_cart);
$total_products = mysqli_num_rows($result_cart);


// inserting data into the orders database
// $insert_orders = "Insert into `user_orders` (user_id, total_price, invoice_number, total_products, order_date, order_receiving_mode, order_payment_mode, products, status) values ($user_id, $total_price, $invoice_number, $total_products, NOW(), '$order_receiving_mode', '$order_payment_mode','$all_products_json','Pending')";
//  $result_query = mysqli_query($con, $insert_orders);
$insert_orders = $con->prepare("INSERT INTO `user_orders` (user_id, total_price, invoice_number, total_products, order_date, order_receiving_mode, order_payment_mode, products, status) VALUES (?,?,?,?,NOW(),?,?,?,'Pending')");
$insert_orders->bind_param("iiissss",$user_id, $total_price, $invoice_number, $total_products,$order_receiving_mode, $order_payment_mode, $all_products_json);
$insert_orders->execute();

    //  after order is sent to orders database then we delete orders from cart
// $empty_cart = "Delete from `cart_details` where ip_address = '$get_ip_address'";
$empty_cart = $con->prepare("DELETE FROM `cart_details` WHERE ip_address = ?");
$empty_cart->bind_param("s", $get_ip_address);
// $result_delete = mysqli_query($con, $empty_cart);
if($empty_cart->execute()){
    header("Location: profile.php");
    $_SESSION['show_success'] = true;
    exit();

}


 

}


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Q-JEN FOODS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <!-- <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div> -->
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Q-JEN</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">FOODS</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+233 593 080 316</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

        <!-- Navbar Start -->
      <div class="container-fluid bg-dark mb-10">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-dark w-100" data-toggle="collapse">
                </a>
      
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Q-JEN</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">FOODS</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="../index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                </div>
                            </div> -->
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
      </div>
    <!-- Navbar End -->

    <!-- alert starts -->
    <div id="success-alert" class="success-alert">Order placed successfully!</div>
    <div id="error-alert" class="error-alert">Please select all fields!</div>
    <!-- alert ends -->


    <!-- orders starts -->
  <section class="h-100 gradient-custom">
    <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-sm-12 col-lg-10 col-xl-12">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h3 class="text-muted mb-0 text-center">Proceed with order</h3>
          </div>

          <form action="" method="post">
          <div class="card-body p-4 h-100 ">
                <div class="d-flex justify-content-around payment-card-body">
                        <div class="payment-card-inn"> 
                            <h5>Mode of receiving order</h5>
                            <select  name="receiving_mode" class="form-select select_for_payment" aria-label="Default select example">
                                <option value="">Select receiving mode</option>
                                <option value="Pickup">Pickup</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                        </div>
                <div>
                <div>
                        <h5>Payment options</h5>
                        <select onchange='toggleInputField()' id='payment_mode' name="payment_mode" class="form-select select_for_payment" aria-label="Default select example">
                        <option value="">Select payment mode</option>
                        <option value="Mobile money">Mobile money</option>
                        <option value="Credit card">Credit card</option>
                        <option value="Cash">Cash</option>
                        </select>
                </div>
                <div id="mobile_money_number_div" class="mt-2 mobile_money_number_div" style='display: none;' >
                    <p>Mobile money number</p>
                    <h6>+233 593 808 316</h6>
                </div>
            </div>
            </div>
            <button class="btn btn-primary payment-button" name="order_mode" type="submit">Place order</button>
          </div>
          </form>
        </div>
      </div>
    </div>
   </div>
  </section>
<!-- orders end -->

 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Accra, Ghana</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>qjen@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="./../index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="profile.php"><i class="fa fa-angle-right mr-2"></i>My Profile</a>
                            <a class="text-secondary mb-2" href="profile.php"><i class="fa fa-angle-right mr-2"></i>My Orders</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <!-- <img class="img-fluid" src="img/payments.png" alt=""> -->
            </div>
        </div>
 </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        function toggleInputField() {
            const select = document.getElementById("payment_mode");
            const mobile_money_number = document.getElementById("mobile_money_number_div");
            
            if (select.value === "Mobile money") {
                mobile_money_number.style.display = "block";
            } else {
                mobile_money_number.style.display = "none";
            }
        }
    </script>

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