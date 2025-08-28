<?php

include("../includes/connect.php");
include("../functions/common_function.php");

@session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] !== "user"){
    session_unset();
    session_destroy();
    header("Location: user_login.php");

}

// fetching the user_id 

$username = $_SESSION['username'];
$user_query = $con->prepare("SELECT * FROM users WHERE username = ?");
$user_query->bind_param("s", $username);
$user_query->execute();
$user_result = $user_query->get_result();
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['user_id'];
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
                    <a class="text-body mr-3" href="">Home</a>
                    <a class="text-body mr-3" href="">Shop</a>
                    <a class="text-body mr-3" href="contact.php">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
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
        <div class="container-fluid bg-dark mb-30">
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
        <div id="success-alert-cancel-order" class="success-alert-cancel-order">Cancel reason submitted successfully!</div>
        <div id="success-alert" class="success-alert">Order placed successfully!</div>
        <div id="error-alert" class="error-alert">Fill select all fields!</div>
    <!-- alert ends -->

    <!-- profile starts -->
    <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="img/user_profile_icon.png" alt="profile_image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <?php
                            echo " <h5>".$_SESSION['username']."</h5>";

                            ?>

                            <?php
                            $username= $_SESSION['username'];

                            $user_query = $con->prepare("SELECT * FROM users WHERE username = ?");
                            $user_query->bind_param("s", $username);
                            $user_query->execute();
                            $user_result = $user_query->get_result();
                            $row_data = $user_result->fetch_array();
                            $user_email = $row_data['user_email'];
                            echo "<h6>$user_email</h6>";
                            ?>
                                  
                                    <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="my-orders-tab" data-toggle="tab" href="#my-orders" role="tab" aria-controls="profile" aria-selected="false">My Orders</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="edit_account.php"><p class="profile-edit-btn btn" >Edit Account</p></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p class="account-link-head">ACCOUNT LINKS</p>
                            <div class="account-links">
                            <a href="password_reset.php">CHANGE PASSWORD</a><br/>
                            <a href="logout.php">LOGOUT</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    
                            <?php
                            $username= $_SESSION['username'];
                              $user_query = $con->prepare("SELECT * FROM users WHERE username = ?");
                            $user_query->bind_param("s", $username);
                            $user_query->execute();
                            $user_result = $user_query->get_result();
                            $row_data = $user_result->fetch_array();

                            $username = $row_data['username'];
                            $user_email = $row_data['user_email'];
                            $user_phone_number = $row_data['user_phone_number'];
                            $user_address = $row_data['user_address'];
                            echo "
                                        <div class='row'>
                                            <div class='col-md-6 about-me'>
                                                <label>Username</label>
                                            </div>
                                            <div class='col-md-6 about-me'>
                                                <p>$username</p>
                                            </div>
                                        </div>
                            
                                          <div class='row'>
                                            <div class='col-md-6 about-me'>
                                                <label>Email</label>
                                            </div>
                                            <div class='col-md-6 about-me'>
                                                <p>$user_email</p>
                                            </div>
                                        </div>

                                           <div class='row'>
                                            <div class='col-md-6 about-me'>
                                                <label>Phone</label>
                                            </div>
                                            <div class='col-md-6 about-me'>
                                                <p>$user_phone_number</p>
                                            </div>
                                        </div>

                                           <div class='row'>
                                            <div class='col-md-6 about-me'>
                                                <label>Address</label>
                                            </div>
                                            <div class='col-md-6 about-me'>
                                                <p>$user_address</p>
                                            </div>
                                        </div>
                                         ";
                            ?>
                            </div>
                            <div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-orders-tab">
                            <table class="table table-responsive">

                            <?php
                            $number=0;
                            $order_query = $con->prepare("SELECT * FROM user_orders WHERE user_id = ? ORDER BY order_date DESC");
                            $order_query->bind_param("i", $user_id);
                            $order_query->execute();
                            $order_result= $order_query->get_result();
                             if($order_result->num_rows ==0){
                                echo "<div class='text-dark text-center m-3'>You have no orders yet</div>";


                             }else{
                                echo "<thead>
                                    <tr class='text-center'>
                                    <th scope='col'>Number</th>
                                    <th scope='col'>Products</th>
                                    <th scope='col'>Price</th>
                                    <th scope='col'>Date</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";
                            while($order_row= mysqli_fetch_assoc($order_result)){
                                $total_price = $order_row['total_price'];
                                $status = $order_row['status'];
                                $total_products = $order_row['total_products'];
                                $order_date = $order_row['order_date'];
                                $order_id = $order_row['order_id'];
                                $number ++;
                                echo "<tr>
                            <th scope='row' class='text-center'><span></span>$number</th>
                            <td class='text-center'>$total_products</td>
                            <td class='text-center'><i class='fas fa-cedi-sign'></i>$total_price</td>
                            <td class='text-center date-text'>$order_date</td>
                            <td class='text-center'>$status</td>
                            <td class='text-center'><a href='user_order_details.php?order_id=$order_id'>View</a></td>
                            </tr>";
                            }
                             }

                                      
                            ?>
                                    
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>


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