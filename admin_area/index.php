﻿<?php
include("../includes/connect.php");
session_start();

  
if(!isset($_SESSION['username']) || $_SESSION['role'] !=="admin" && $_SESSION['role'] !=="sub_admin"){
  session_unset();
  session_destroy();
  header("Location: ../user_area/user_login.php");
}

$_SESSION['username'];
$username = $_SESSION['username'];


// fetching the number of products
$products_sql = "SELECT * FROM `products`";
$product_result = mysqli_query($con, $products_sql);
$products_row = mysqli_num_rows($product_result);

// fetching the number of categories
$categories_sql = "SELECT * FROM `categories`";
$categories_result = mysqli_query($con, $categories_sql);
$categories_row = mysqli_num_rows($categories_result);

// fetching the number of brands
$brands_sql = "SELECT * FROM `brands`";
$brands_result = mysqli_query($con, $brands_sql);
$brands_row = mysqli_num_rows($brands_result);

// fetching the number of users
$users_sql = "SELECT * FROM `users`";
$users_result = mysqli_query($con, $users_sql);
$users_row = mysqli_num_rows($users_result);





?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
 
    

    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="./assets/css/responsive.css">
  </head>
  <body>
    <div id="wrapper">
      <nav
        class="navbar navbar-default navbar-cls-top"
        role="navigation"
        style="margin-bottom: 0"
      >
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target=".sidebar-collapse"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><?php echo $username?> Admin</a>
        </div>
        <div
          style="
            color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;
          "
        >
          <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
        </div>
      </nav>
      <!-- /. NAV TOP  -->
      <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
              <img
                src="assets/img/find_user.png"
                class="user-image img-responsive"
              />
            </li>

            <li>
              <a class="active-menu" href="index.php"
                ><i class="fa fa-dashboard fa-3x"></i> Dashboard</a
              >
            </li>
            <?php
            if($_SESSION['role']==="admin"){
              echo "<li><a class='' href='add_products.php'><i class='fa fa-desktop fa-3x'></i>Add products</a>
            </li>";
            }

            ?>
            
            <li>
              <a href="view_products.php"
                ><i class="fa fa-qrcode fa-3x"></i> View Products</a
              >
            </li>
            <?php
            if($_SESSION['role'] === "admin"){
              echo "<li>
              <a href='insert_category.php'
                ><i class='fa fa-chevron-down fa-3x'></i> Add Categories</a
              >
            </li>";
            }
            ?> 
            <li>
              <a href="view_category.php"
                ><i class="fa fa-check-circle fa-3x"></i> View Categories</a
              >
            </li>
            <?php
            if($_SESSION['role'] === "admin"){
              echo "<li>
              <a class='' href='insert_brand.php'
                ><i class='fa fa-bell-o fa-3x'></i> Add Brands</a
              >
            </li>";
            }
            ?> 
            <li>
              <a href="view_brand.php"
                ><i class="fa fa-bar-chart-o fa-3x"></i> View Brands</a
              >
            </li>
            <li>
              <a href="processing_order.php"
                ><i class="fa fa-suitcase fa-3x" aria-hidden="true"></i> Processing Orders</a
              >
            </li>
            <li>
              <a href="delivered_order.php"
                ><i class="fa fa-truck fa-3x" aria-hidden="true"></i> Delivered Orders</a
              >
            </li>
            <li>
              <a class="" href="cancelled_order.php"
                ><i class="fa fa-ticket fa-3x" aria-hidden="true"></i> Cancelled Orders</a
              >
            </li>
            <?php
            if($_SESSION['role']=== "admin"){
              echo "<li><a href='view_user.php'><i class='fa fa-rocket fa-3x'></i> View Users</a
              >
            </li>";
            }
            ?>  

            <?php
            if($_SESSION['role']=== "admin"){
              echo "   <li>
              <a href='add_member.php'
                ><i class='fa-solid fa-people-arrows fa-3x'></i> Add Members</a
              >
            </li'";
            }
            ?>
            <?php
            if($_SESSION['role']=== "admin"){
              echo "     <li>
              <a href='view_member.php'
                ><i class='fa-solid fa-people-line fa-3x'></i> View Members</a
              >
            </li>";
            }
            ?>
       
          </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h2>Admin Dashboard</h2>
              <h5>Welcome <span class="text-danger"><?php echo $username?></span>, Love to see you back.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />
          <div class="row">
            <a href="view_products.php"><div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                  <i class="fa fa-qrcode"></i>
                </span>
                <div class="text-box">
                  <p class="main-text text-center"><?php echo $products_row?>  </p>
                  <p class="text-muted">Products</p>
                </div>
              </div>
            </div></a>
            
            <a href="view_category.php"><div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-bars"></i>
                </span>
                <div class="text-box">
                  <p class="main-text text-center"><?php echo $categories_row?>  </p>
                  <p class="text-muted">Categories</p>
                </div>
              </div>
            </div></a>
            <a href="view_brand.php">   <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                  <i class="fa fa-list-alt"></i>
                </span>
                <div class="text-box">
                  <p class="main-text text-center"><?php echo $brands_row?> </p>
                  <p class="text-muted">Brands</p>
                </div>
              </div>
            </div></a>

            <a href="view_user.php"><div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box">
                  <p class="main-text text-center">All</p>
                  <p class="text-muted">Users</p>
                </div>
              </div>
            </div></a>
         
          </div>
          <!-- /. ROW  -->
          <hr />
          <!-- table should come here -->
          <div class="panel panel-default">
                        <div class="panel-heading">
                            New Orders
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                         

                                <?php
                                
                                
                              // fetching of orders
                              $order_sql = "Select * from `user_orders` where status = 'Pending' ORDER BY order_date DESC";
                              $order_result = mysqli_query($con, $order_sql);
                              if(mysqli_num_rows($order_result)==0){
                                echo "<div class='text-center text-danger'>No new orders yet!</div>";
                              }else{
                                echo "  <thead>
                                <tr>
                                    <th class='text-center'>Order id</th>
                                    <th class='text-center'>Invoice</th>
                                    <th class='text-center'>Date / Time</th>
                                    <th class='text-center'>Total products</th>
                                    <th class='text-center'>Total price</th>
                                    <th class='text-center'>Status</th>
                                    <th class='text-center'>Action</th>
                                </tr>
                            </thead>";
                              
                                while($order_row = mysqli_fetch_assoc($order_result)){
                                  $invoice_number = $order_row['invoice_number'];
                                  $order_id = $order_row['order_id'];
                                  $total_products = $order_row['total_products'];
                                  $total_price = $order_row['total_price'];
                                  $order_date = $order_row['order_date'];
                                  $status = $order_row['status'];

                                ?>
                                  
                                    <tbody>
                                        <tr>
                                            <td class="text-center"># <?php echo $order_id?></td>
                                            <td class="text-center"><?php echo $invoice_number?></td>
                                            <td class="text-center"><?php echo $order_date?></td>
                                            <td class="text-center"><?php echo $total_products?></td>
                                            <td class="text-center"><i class='fas fa-cedi-sign'></i><?php echo $total_price?></td>
                                            <td class="text-center"><?php echo $status?></td>
                                            <td class="text-center"><a href="view_product_detail.php?order_id=<?php echo $order_id?>" class=" btn btn-success text-white text-decoration-none">View</a></td>
                                        </tr>
                                    </tbody>
                                    <?php
                                      }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
    
       
        <!-- /. PAGE INNER  -->
      </div>
      <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
