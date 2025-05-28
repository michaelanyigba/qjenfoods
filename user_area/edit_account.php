<?php

include("../includes/connect.php");
include("../functions/common_function.php");

@session_start();


if(!isset($_SESSION['username'])){
    echo "<script>window.open('user_login.php', '_self')</script>";

}


$user_session_name = $_SESSION['username'];
$select_query = $con->prepare("SELECT * FROM `users` WHERE username = ?");
$select_query->bind_param("s", $user_session_name);
$select_query->execute();
$select_query_result = $select_query->get_result();
$row_fetch = $select_query_result->fetch_assoc();
$user_id = $row_fetch['user_id'];
$username = $row_fetch['username'];
$user_email = $row_fetch['user_email'];
$user_address = $row_fetch['user_address'];
$user_phone_number = $row_fetch['user_phone_number'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>QJEN FOODS</title>
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

    <style>
    #confirmBox {
      display: none;
      position: fixed;
      top: 25%;
      width: 70%;
      left: 20%;
      background: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      text-align: center;
      z-index: 10;
    }
    #overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 5;
    }

    #confirmBox button{
        border:none;
        padding: 10px;
        border-radius: 3px;
    }

    @media (min-width: 768px) {
        #confirmBox{
            width: 50%;
            height: 30%;
            align-items: center;
       
        }
    }
  </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
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
                    <span class="h1 text-uppercase text-primary bg-dark px-2">QJEN</span>
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
                        <span class="h1 text-uppercase text-dark bg-light px-2">QJEN</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">FOODS</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="../index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                </div>
                            </div>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->



    <!-- profile starts -->
    <div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
					<img src="img/user_profile_icon.png" alt="user image icon">
				</div>
                <?php
                            echo " <h5 class='user-name'>".$_SESSION['username']."</h5>";

                            ?>
				<!-- <h5 class="user-name">Yuki Hayashi</h5> -->
                <?php
                            $username= $_SESSION['username'];
                            $user_query = "Select * from `users` where username = '$username'";
                            $user_result = mysqli_query($con, $user_query);
                            $row_data = mysqli_fetch_array($user_result);
                            $user_email = $row_data['user_email'];
				            echo " <h6 class='user-email'>$user_email</h6>";
                ?>
			</div>
		</div>
	</div>
</div>
</div>

<!-- overlay -->
<div id="overlay"></div>

    <!-- Confirmation Container -->
<div id="confirmBox">
  <p>Are you sure you want to update your account?</p>
  <button type="button" onclick="submitForm()">Yes</button>
  <button onclick="hideConfirm()">No</button>
</div>
<!-- confirmation container ends -->
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
    <!-- Overlay for modal effect -->
    <form  id="updateForm" action="update_account.php" method="post">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Personal Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="fullName">Username</label>
					<input value="<?php echo $username ?>" name="user_username" type="text" class="form-control" id="fullName">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="eMail">Email</label>
					<input value="<?php echo $user_email ?>" name="user_email" type="email" class="form-control" id="eMail">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="phone">Phone</label>
					<input value="<?php echo $user_phone_number ?>" name="user_phone_number" type="text" class="form-control" id="phone">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="website">Address</label>
					<input value="<?php echo $user_address ?>" name="user_address" type="text" class="form-control" id="website">
				</div>
			</div>
		</div>
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
					<a href="profile.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
					<button type="button" onclick="showConfirm()" class="btn btn-primary">Update</button>
				</div>
			</div>
		</div>
	</div>
    </form>


</div>
</div>
</div>
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
  function showConfirm() {
    document.getElementById('confirmBox').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
  }

  function hideConfirm() {
    document.getElementById('confirmBox').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
  }

  function submitForm() {
    document.getElementById('updateForm').submit();
  }
</script>
</body>

</html>