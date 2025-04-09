<?php

include("../includes/connect.php");

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

    $select_user_query = "Select * from `users` where user_id = '$user_id'";
    $select_result = mysqli_query($con, $select_user_query);
    $select_user_row = mysqli_fetch_assoc($select_result);
    $username = $select_user_row['username'];
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Users</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
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
          <a class="navbar-brand" href="index.php">Qjen Admin</a>
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
                  <a href="index.php"
                    ><i class="fa fa-dashboard fa-3x"></i> Dashboard</a
                  >
                </li>
                <li>
                  <a class="" href="add_products.php"
                    ><i class="fa fa-desktop fa-3x"></i>Add products</a
                  >
                </li>
                <li>
                  <a href="view_products.php"
                    ><i class="fa fa-qrcode fa-3x"></i> View Products</a
                  >
                </li>
                <li>
                  <a href="insert_category.php"
                    ><i class="fa fa-chevron-down fa-3x"></i> Add Categories</a
                  >
                </li>
                <li>
                  <a href="view_category.php"
                    ><i class="fa fa-check-circle fa-3x"></i> View Categories</a
                  >
                </li>
                <li>
                  <a href="insert_brand.php"
                    ><i class="fa fa-bell-o fa-3x"></i> Add Brands</a
                  >
                </li>
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
                <li>
                  <a class="active-menu" href="view_user.php"
                    ><i class="fa fa-rocket fa-3x"></i> View Users</a
                  >
                </li>
              </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h2><?php echo $username?>'s Order</h2>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />

          <!-- start coding from here -->
          <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">All orders</div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    class="table table-striped table-bordered table-hover"
                  >
                  <?php
                                
                                
                                // fetching of orders
                                $user_order_sql = "Select * from `user_orders` where user_id = '$user_id'";
                                $user_order_result = mysqli_query($con, $user_order_sql);
                                if(mysqli_num_rows($user_order_result)==0){
                                  echo "<div class='text-center text-danger'>This user does not have an order yet!</div>";
                                }else{
                                  echo "  <thead>
                                  <tr>
                                      <th class='text-center'>Order id</th>
                                      <th class='text-center'>Total products</th>
                                      <th class='text-center'>Total price</th>
                                      <th class='text-center'>Date</th>
                                      <th class='text-center'>Status</th>
                                  </tr>
                              </thead>";
                                
                                  while($user_order_row = mysqli_fetch_assoc($user_order_result)){
                                    $order_id = $user_order_row['order_id'];
                                    $total_price = $user_order_row['total_price'];
                                    $total_products = $user_order_row['total_products'];
                                    $order_date = $user_order_row['order_date'];
                                    $status = $user_order_row['status'];
  
                                  ?>

                    <tbody>
                      <tr class="text-center">
                        <td><?php echo $order_id?></td>
                        <td><?php echo $total_products ?></td>
                        <td><?php echo $total_price ?></td>
                        <td><?php echo $order_date ?></td>
                        <td><?php echo $status ?></td>
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
          </div>
          <!-- /. ROW  -->
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
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
