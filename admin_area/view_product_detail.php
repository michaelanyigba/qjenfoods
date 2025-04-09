<?php
include("../includes/connect.php");

if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id'];
}

if(isset($_POST['update_status'])){
  $order_status = $_POST['order_status'];
  $update_order_status = "update `user_orders` set status = '$order_status' where order_id = $order_id";
  $update_result = mysqli_query($con, $update_order_status);
  if($update_result){
    echo "<script>alert('Order updated successfully')</script>";
  }else{
    echo "<script>alert('An error occured')</script>";

  }

}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Qjen Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    

    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="./assets/css/responsive.css">

    <style>

        .order-container {
            max-width: 980px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .section-title {
          background: #202020;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .order_status{
          display: flex;
          align-items:center;
        }
        .fa-check{
          color: #f00;
        }
        .status_btn{
          align-items: center;
          margin-top: 10px;
          margin-left: 5px;
        }
    </style>
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
          <a class="navbar-brand" href="index.html">Qjen Admin</a>
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
              <a class="" href="index.php"
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
                ><i class="fa fa-bar-chart-o fa-3x"></i> Processing orders</a
              >
            </li>
            <li>
              <a href="delivered_order.php"
                ><i class="fa fa-truck fa-3x" aria-hidden="true"></i> Delivered Orders</a
              >
            </li>
            <li>
              <a class="active-menu" href="cancelled_order.php"
                ><i class="fa fa-ticket fa-3x" aria-hidden="true"></i> Cancelled Orders</a
              >
            </li>
            <li>
              <a href="view_user.php"
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
              <h2>Admin Dashboard</h2>
              <h5>Welcome Jhon Deo , Love to see you back.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />
        
          <!-- order starts -->
          <div class="container order-container">
    <h2 class="text-center mb-4">Order Details</h2>
    <?php
    if(isset($_GET['order_id'])){
      $order_id = $_GET['order_id'];
      $select_order_query = "Select * from `user_orders` where order_id = '$order_id'";
      $order_result = mysqli_query($con, $select_order_query);
      $order_row = mysqli_fetch_assoc($order_result);
      $order_total_price = $order_row['total_price'];
      $order_date = $order_row['order_date'];
      $payment_mode = $order_row['order_payment_mode'];
      $receiving_mode = $order_row['order_receiving_mode'];
      // fetching the user information
      $user_id = $order_row['user_id'];
      $user_query = "Select * from `users` where user_id = '$user_id'";
      $user_result = mysqli_query($con, $user_query);
      $user_row = mysqli_fetch_assoc($user_result);
      $username = $user_row['username'];
      $user_email = $user_row['user_email'];
      $user_address = $user_row['user_address'];
      $user_phone_number = $user_row['user_phone_number'];
     
    }

    ?>

    <!-- Order Summary -->
    <div class="mb-4">
        <h5 class="section-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Summary</h5>
        <p><strong>Order ID:</strong> # <?php echo $order_id?></p>
        <p><strong>Order Date:</strong> <?php echo $order_date?></p>
        <p><strong>Total Price: </strong>$<?php echo $order_total_price?></p>
        <p><strong>Payment Method:</strong> <span class="badge bg-success"><?php echo $payment_mode?></span></p>
        <p><strong>Order Receiving Mode:</strong> <span class="badge bg-success"><?php echo $receiving_mode?></span></p>
        <form action="" method="post">
        <div class="order_status">
        <p><strong>Order Status:</strong>
        <?php
        $order_status = "Select status from `user_orders` where order_id = '$order_id'";
        $order_status_result = mysqli_query($con, $order_status);
        $order_result_row = mysqli_fetch_assoc($order_status_result);
        $order_status = $order_result_row['status'];
        echo " <select class='form-select form-select-sm d-inline-block w-auto' name='order_status'>
                <option value='$order_status'>$order_status</option>
                <option value='Processing'>Processing</option>
                <option value='Delivered'>Delivered</option>
                <option value='Cancelled'>Cancelled</option>
            </select>";
        ?>  
        </p><button name="update_status" class="status_btn"><i class="fa fa-check" aria-hidden="true"></i></button>
        </div>
        </form>
    </div>
  

    <!-- User Details -->
    <div class="mb-4">
        <h5 class="section-title"><i class="fa fa-user" aria-hidden="true"></i> Customer Information</h5>
        <p><strong>Name: </strong> <?php echo $username?></p>
        <p><strong>Email: </strong> <?php echo $user_email?></p>
        <p><strong>Phone: </strong> <?php echo $user_phone_number?></p>
        <p><strong>Address: </strong><?php echo $user_address?></p>
    </div>

    <!-- Product Details -->
    <div>
        <h5 class="section-title"><i class="fa fa-envelope" aria-hidden="true"></i> Products Ordered</h5>
        <table class="table table-bordered text-center table-responsive ">
        <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>

        <?php
              // fetching product information
         $products = json_decode($order_row['products'], true);
         foreach($products as $product){
           $product_ids = $product['product_id'];
           $product_quantity = $product['quantity'];
           $product_query = "Select * from `products` where product_id = $product_ids";
           $product_result = mysqli_query($con, $product_query);
           while($product_row = mysqli_fetch_assoc($product_result)){
             $product_title = $product_row['product_title'];
             $product_price = $product_row['product_price'];
             $product_total = $product_quantity * $product_price;
             echo "<tbody>
                <tr>
                    <td>$product_title</td>
                    <td>$product_quantity</td>
                    <td>$ $product_price</td>
                    <td>$ $product_total</td>
                </tr>
            </tbody>";

           }
       
         }
        ?>
          
          
        </table>
    </div>
</div>

            <!-- orders end -->
    
       
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
