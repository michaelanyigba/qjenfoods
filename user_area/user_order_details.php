<?php

include("../includes/connect.php");
include("../functions/common_function.php");

@session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] !== "user"){
  session_unset();
  session_destroy();
  header("Location: user_login.php");

}

if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id'];
}
if(isset($_SESSION['username'])){
  $session_username = $_SESSION['username'];

  // fetching user from the database
  $session_user = $con->prepare("SELECT * FROM users WHERE username = ?");
  $session_user->bind_param("s", $session_username);
  $session_user->execute();
  $session_user_result = $session_user->get_result();
  $session_user_row = $session_user_result->fetch_assoc();
  $session_user_id = $session_user_row['user_id'];

}


// query for cancelling order

if(isset($_POST['submit_cancel'])){
  $cancel_input = $_POST['cancel_input'];

  if($cancel_input === ''){
    $_SESSION['show_error'] = true;


  }else{
    $cancel_query_stmt = $con->prepare("UPDATE user_orders set cancel_reason_user=?, cancel_user_id = ? where order_id = ?");
    $cancel_query_stmt->bind_param("sii", $cancel_input, $session_user_id, $order_id);
    
    if($cancel_query_stmt->execute()){
      $cancel_status_query = $con->prepare("UPDATE user_orders set status= ? where order_id = ?");
      $cancel_status_query->bind_param("si", $status, $order_id);
      $status ="Cancelled";
      if($cancel_status_query->execute()){
        $_SESSION['show_success_cancel_order'] = true;

      }
  
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
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

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
                <div class="d-inline-flex align-items-center h-100">
                    <!-- <a class="text-body mr-3" href="">About</a> -->
                </div>
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
    <div id="success-alert-cancel-order" class="success-alert-cancel-order">Reason submitted successfully!</div>
    <div id="error-alert" class="error-alert">Reason field cannot be empty!</div> 
    <!-- alert ends -->

    <!-- orders starts -->
  <section class="h-100 gradient-custom">
    <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-12">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Order History, <span style="color: #a8729a;"><?php echo "".$_SESSION['username']."" ?></span>!</h5>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">All Orders</p>
            </div>
            <!-- codes  -->
             <?php
             if(isset($_GET['order_id'])){
              $order_id = $_GET['order_id'];
              $order_query = "Select * from `user_orders` where order_id = $order_id";
              $order_result = mysqli_query($con, $order_query);
              if($order_result->num_rows>0){
                $row = $order_result->fetch_assoc();
                $products = json_decode($row['products'], true);
                foreach($products as $product){
                  $product_ids = $product['product_id'];
                  $product_quantity = $product['quantity'];
                  $product_query = "Select * from `products` where product_id = $product_ids";
                  $product_result = mysqli_query($con, $product_query);
                  while($product_row = mysqli_fetch_assoc($product_result)){
                    $product_title = $product_row['product_title'];
                    $product_image = $product_row['product_image1'];
                    $product_description = $product_row['product_description'];
                    $product_price = $product_row['product_price'];
                    $product_category_id = $product_row['category_id'];
                    $category_query = "Select * from `categories` where category_id = $product_category_id";
                    $category_result = mysqli_query($con, $category_query);
                    $category_row = mysqli_fetch_assoc($category_result);
                    $category_title = $category_row['category_title'];
                    $sub_total = $product_price * $product_quantity;
  echo "
<div class='card shadow-0 border mb-4'>
              <div class='card-body'>
                <div class='row'>
                  <div class='col-md-2'>
                    <img src='../admin_area/product_images/$product_image'
                      class='img-fluid' alt='image'>
                  </div>
                  <div class='col-md-2 text-center d-flex justify-content-center align-items-center'>
                    <p class='text-muted mb-0'>$product_title</p>
                  </div>
                  <div class='col-md-2 text-center d-flex justify-content-center align-items-center'>
                    <p class='text-muted mb-0 small'>$category_title</p>
                  </div>
                  <div class='col-md-2 text-center d-flex justify-content-center align-items-center'>
                    <p class='text-muted mb-0 small'>Qty: $product_quantity</p>
                  </div>
                  <div class='col-md-2 text-center d-flex justify-content-center align-items-center'>
                    <p class='text-muted mb-0 small'>Price: <i class='fas fa-cedi-sign'></i>$product_price</p>
                  </div>
                  <div class='col-md-2 text-center d-flex justify-content-center align-items-center'>
                    <p class='text-muted mb-0 small'>Sub total: <i class='fas fa-cedi-sign'></i>$sub_total</p>
                  </div>
                </div>
              </div>
            </div>
      ";
            
                  }
                }
              }
            
            }

             ?>
                   
            <div class='d-flex justify-content-between pt-2'>
              <p class='fw-bold mb-0'>Order Details</p>
              <?php
                  $total_price = 0;
                  $price_query = "Select * from `user_orders` where order_id = $order_id";
                  $price_result = mysqli_query($con, $price_query);
                  $price_row = mysqli_fetch_assoc($price_result);
                  $total_price = $price_row['total_price'];
                  $order_date = $price_row['order_date'];
                  $invoice_number = $price_row['invoice_number'];
                  $status = $price_row['status'];
                  $cancel_reason_admin = $price_row['cancel_reason_admin'];
                  $cancel_reason_user = $price_row['cancel_reason_user'];
                  echo "<p class='text-muted mb-0'><span class='fw-bold me-4'>Total:</span> <i class='fas fa-cedi-sign'></i>$total_price</p>
                  </div>

                      <div class='d-flex justify-content-between pt-2'>
              <p class='text-muted mb-0'>Invoice Number : $invoice_number</p>
            </div>
            <div class='d-flex justify-content-between'>
              <p class='text-muted mb-0'>Invoice Date : $order_date</p>
            </div>
            <div class='d-flex justify-content-between'>
              <p class='text-green mb-0'>Order Status : $status</p>
            </div>";
              ?>

              <?php
              if($status === "Cancelled"){
                echo "<div class='d-flex justify-content-between mb-5'>
              <p class='text-green mb-0'>Reason for order cancel: $cancel_reason_admin $cancel_reason_user</p>
            </div>           ";
              }
              ?>
              <?php
              if($status !=="Cancelled" && $status !=="Delivered" && $status !=="Processing" ){
                echo "<div class='user_cancel_div' id='user_cancel_div'>
                <div class=''>Cancel Order: </div>
                <button onclick='showCancelInput()'><a>Cancel</a></button>
              </div>";
              }

              ?>
              <div class="cancel_input_div" id="cancel_input_div">
                <form method="post">
                <div><input name="cancel_input" placeholder="Reason for cancel order" type="text"></div>
                <div>
                  <button type="submit" name="submit_cancel" class="confirm">Confirm</button>
                </div>
                </form>
              </div>
           
            
          </div>
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
    function showCancelInput() {
        const div = document.getElementById("cancel_input_div");
        if (div.style.display === "none" || div.style.display === "") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
</script>

<script>
        function showSuccessAlert() {
        const alertBox = document.getElementById('success-alert-cancel-order');
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
        if (isset($_SESSION['show_success_cancel_order']) && $_SESSION['show_success_cancel_order']) {
            echo "showSuccessAlert();";
            unset($_SESSION['show_success_cancel_order']); // remove flag
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