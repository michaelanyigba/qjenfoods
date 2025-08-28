<?php
include("../includes/connect.php");
include("../functions/common_function.php");

session_start();



// updating the quantity
if(isset($_POST['update_product_quantity'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = $con->prepare("UPDATE `cart_details` SET quantity = ? WHERE product_id = ?");
    $update_quantity_query->bind_param("si", $update_value, $update_id);
    if($update_quantity_query->execute()){
        header('location:cart.php');
    }
}

// removing product in cart
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    // $remove_sql = "Delete from `cart_details` where product_id=$remove_id";
    // $remove_result = mysqli_query($con, $remove_sql);
    $remove_sql = $con->prepare("DELETE FROM `cart_details` WHERE product_id = ?");
    $remove_sql->bind_param("i", $remove_id);
    if($remove_sql->execute()){
        $_SESSION['remove_cart'] = true;
        header("Location: cart.php");
        exit();

    }else{

    }
    

}
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
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                        <?php
                            if(!isset($_SESSION['username'])){
                                echo "<a href='user_login.php'> <button class='dropdown-item' type='button'>Login</button></a>";
                                echo "<a href='user_register.php'><button class='dropdown-item' type='button'>Register</button></a> ";
                            }else{
                                echo "<a href='profile.php'> <button class='dropdown-item'>My profile</button></a>";

                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="cart.php" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;"><?php cart_item(); ?></span>
                    </a>
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
                      <!-- search start -->
                      <div class="col-lg-4 col-6 text-left">
                <form action="search_product.php" method="get" id="search_data_product">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search for products" name="search_data" autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                 <button type="submit" class="search-btn" name="search_data_product"><i class="fa fa-search"></i></button>
                                
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        <!-- search end -->
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+233 593 808 316</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <!-- <a href="" class="nav-item nav-link">Shirts</a> -->
                        <?php
                         get_categories_for_user_area();

                         ?>
                    </div>
                </nav>
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
                                    <a href="cart.php" class="dropdown-item active">Shopping Cart</a>
                                </div>
                            </div> -->
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php cart_item(); ?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
     
    <!-- alert starts -->
    <div id="remove-cart" class="remove-cart">Product removed!</div>
    <!-- alert ends -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="../index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    
                <?php
                  global $con;
                  $get_ip_add = getIPAddress();
                  $total_price = 0;
                //   $cart_query= "Select * from `cart_details` where ip_address='$get_ip_add'";
                //   $result = mysqli_query($con, $cart_query);
                  // counting the rows
                //   $result_count = mysqli_num_rows($result);
                $cart_query = $con->prepare("SELECT * FROM `cart_details` WHERE ip_address = ?");
                $cart_query->bind_param("s", $get_ip_add);
                $cart_query->execute();
                $result_count = $cart_query->get_result();
                  if($result_count->num_rows > 0){
                    echo "<thead class='thead-dark'>
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class='align-middle'>";
                    while($row = $result_count->fetch_array()){
                        $product_id= $row['product_id'];
                        $quantity = $row['quantity'];
                        // $select_products= "Select * from `products` where product_id = '$product_id'";
                        // $result_products = mysqli_query($con, $select_products);
                        $select_products = $con->prepare("SELECT * FROM `products` WHERE product_id = ?");
                        $select_products->bind_param("i", $product_id);
                        $select_products->execute();
                        $select_products_result = $select_products->get_result();
                        while($row_product_price = $select_products_result->fetch_array()){
                            // product price is the sum of all the prices of the products
                          $product_price = array($row_product_price['product_price']);
                          $price_table= $row_product_price['product_price'];
                          $product_title= $row_product_price['product_title'];
                          $product_image1= $row_product_price['product_image1'];
                          $product_values = array_sum($product_price);
                          $product_row_price = $price_table * $quantity;
                          $total_price += $product_row_price;
                    ?>
                    
                        <tr>
                            <td class="align-middle cart_table_image"><img src="../admin_area/product_images/<?php echo $product_image1?>" alt="" style="width: 50px;"><?php echo $product_title ?> </td>
                            <td class="align-middle"><i class='fas fa-cedi-sign'></i><?php echo $price_table?></td>
                            <td class="align-middle">
                            <form action="" method="post">
                            <input type="hidden" name="update_quantity_id" value="<?php echo $product_id; ?>">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <input type="number" name="update_quantity" class="form-control form-control-sm bg-secondary border-0 text-center" min="1" value="<?php echo $quantity?>">
                                    <div class="input-group-btn">
                                        <button type="submit" name="update_product_quantity" class="btn btn-primary update_cart_btn"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                                </form>
                            </td>
                            <td class="align-middle"><i class='fas fa-cedi-sign'></i><?php echo $product_row_price?></td>
                            <td class="align-middle"><a href="cart.php?remove=<?php echo $product_id?>"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a></td>
                        </tr>
                        
                    <?php
           }
          } 
          }
          else{
            echo "<h4 class='text-gray text-center'>Your cart is empty</h4>";
          }

                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <!--  -->
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalPrice"><i class='fas fa-cedi-sign'></i><?php echo $total_price?></h5>
                        </div>
                        <?php
                   $get_ip_add = getIPAddress();
                   $cart_query= "Select * from `cart_details` where ip_address='$get_ip_add'";
                   $result = mysqli_query($con, $cart_query);
                   // counting the rows
                   $result_count = mysqli_num_rows($result);
                   if($result_count>0){
                    echo "<a href='checkout.php'><button class='btn btn-block btn-primary font-weight-bold my-3 py-3'>Proceed To Checkout</button></a>
";
                   }else{
                        echo "<a href='shop.php'><button class='btn btn-block btn-primary font-weight-bold my-3 py-3'>Continue shopping</button></a>
";
                   }
                   ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


   
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
        //pricePerItem is pricetable
        let price_table = <?php echo $price_table; ?>; // Fetching price from PHP
        let newtotalPrice = price_table;

        function increaseQuantity() {
            let quantityInput = document.getElementById("quantity");
            let totalPriceElement = document.getElementById("totalPrice");

            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;

            totalPrice = quantity * price_table; // Multiply quantity with price
            totalPriceElement.textContent = totalPrice;
        }

        function decreaseQuantity() {
            let quantityInput = document.getElementById("quantity");
            let totalPriceElement = document.getElementById("totalPrice");

            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;

                totalPrice = quantity * price_table; // Update total price
                totalPriceElement.textContent = totalPrice;
            }
        }
    </script>
      <script>
        function showRemoveCartAlert() {
        const alertBox = document.getElementById('remove-cart');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 2500);
        }
        <?php
        if (isset($_SESSION['remove_cart']) && $_SESSION['remove_cart']) {
            echo "showRemoveCartAlert();";
            unset($_SESSION['remove_cart']); // remove flag
        }
        ?>
  </script>
</body>

</html>