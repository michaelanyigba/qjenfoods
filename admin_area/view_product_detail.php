<?php
include("../includes/connect.php");
session_start();

  
if(!isset($_SESSION['username']) || $_SESSION['role'] !=="admin" && $_SESSION['role'] !=="sub_admin"){
  session_unset();
  session_destroy();
  header("Location: ../user_area/user_login.php");
}

$_SESSION['username'];
$username = $_SESSION['username'];
if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id'];
}

// fetching user
if(isset($_GET['order_id'])){
  // $user_query_fetch = "Select * from `users` where username = '$username'";
  $user_query_fetch = $con->prepare("SELECT * FROM `users` WHERE username = ?");
  $user_query_fetch->bind_param("s", $username);
  $user_query_fetch->execute();
  $user_result_fetch = $user_query_fetch->get_result();
  $user_row_fetch = $user_result_fetch->fetch_assoc();
  $user_fetch_id = $user_row_fetch['user_id'];
}



if(isset($_POST['update_status'])){

  $order_status = $_POST['order_status'];
  $cancel_reason =$_POST['cancel_reason'];
  if($order_status === 'Cancelled' && $cancel_reason !==''){
    $update_order_status_reason = $con->prepare("UPDATE `user_orders` SET status = ?, cancel_reason_admin=?, cancel_user_id =? WHERE order_id = ? ");
    $update_order_status_reason->bind_param("ssii", $order_status, $cancel_reason, $user_fetch_id, $order_id);
    if($update_order_status_reason->execute()){
      $_SESSION['show_success'] = true;
    
    }else{
      $_SESSION['show_error'] = true;
  
    }
  }elseif($order_status === 'Cancelled' && $cancel_reason ===''){
    $_SESSION['show_cancel_error'] = true;
  }
   else{
    // $update_order_status = "update `user_orders` set status = '$order_status'  where order_id = $order_id";
    // $update_result = mysqli_query($con, $update_order_status);
    $update_order_status = $con->prepare("UPDATE `user_orders` SET status = ? WHERE order_id = ?");
    $update_order_status->bind_param("si", $order_status, $order_id);
    if($update_order_status->execute()){
      $_SESSION['show_success'] = true;
    }else{
      $_SESSION['show_error'] = true;
  
    }
 
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    

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

           <!--alert starts  -->
           <div id="success-alert" class="success-alert">Order status updated successfully!</div>
             <div id="error-alert" class="error-alert">Failed to update order status!</div>
             <div id="error-cancel-alert" class="error-cancel-alert">Give reason to cancel order!</div>
             <!-- alert ends -->
        
          <!-- order starts -->
          <div class="container order-container">
    <h2 class="text-center mb-4">Order Details</h2>
      <?php
      if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        $select_order_query = $con->prepare("SELECT * FROM `user_orders` WHERE order_id = ?");
        $select_order_query->bind_param("i", $order_id);
        $select_order_query->execute();
        $select_order_result = $select_order_query->get_result();
        $order_row = $select_order_result->fetch_assoc();
        $order_total_price = $order_row['total_price'];
        $order_date = $order_row['order_date'];
        $payment_mode = $order_row['order_payment_mode'];
        $receiving_mode = $order_row['order_receiving_mode'];
        $cancel_reason_admin = $order_row['cancel_reason_admin'];
        $cancel_reason_user = $order_row['cancel_reason_user'];
        // fetching the user information
        $user_id = $order_row['user_id'];
        $user_query = $con->prepare("SELECT * FROM `users` WHERE user_id = ?");
        $user_query->bind_param("i", $user_id);
        $user_query->execute();
        $user_query_result = $user_query->get_result();
        $user_row = $user_query_result->fetch_assoc();
        $username = $user_row['username'];
        $user_email = $user_row['user_email'];
        $user_address = $user_row['user_address'];
        $user_phone_number = $user_row['user_phone_number'];
        
      
      }

      ?>

    <!-- Order Summary -->
    <div class="mb-4">
    <?php

        $order_status_sql = $con->prepare("SELECT status, cancel_user_id FROM `user_orders` WHERE order_id = ?");
        $order_status_sql->bind_param("i", $order_id);
        $order_status_sql->execute();
        $order_status_result = $order_status_sql->get_result();
        $order_result_row = $order_status_result->fetch_assoc();
        $order_status = $order_result_row['status'];
        $cancel_user_id = $order_result_row['cancel_user_id'];

        if($order_status === "Cancelled"){
          $cancel_user_sql = $con->prepare("SELECT * FROM `users` WHERE user_id = ?");
          $cancel_user_sql->bind_param("i", $cancel_user_id);
          $cancel_user_sql->execute();
          $cancel_user_result = $cancel_user_sql->get_result();
          $cancel_user_row = $cancel_user_result->fetch_assoc();
          $cancel_username = $cancel_user_row['username'];
        }

        ?>
        <h5 class="section-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Summary</h5>
        <p><strong>Order ID:</strong> # <?php echo $order_id?></p>
        <p><strong>Order Date:</strong> <?php echo $order_date?></p>
        <p><strong>Total Price: </strong><i class='fas fa-cedi-sign'></i><?php echo $order_total_price?></p>
        <p><strong>Payment Method:</strong> <span class="badge bg-success"><?php echo $payment_mode?></span></p>
        <p><strong>Order Receiving Mode:</strong> <span class="badge bg-success"><?php echo $receiving_mode?></span></p>
        <p><strong>Order Status:</strong> <?php echo $order_status?></p>
        <p id="cancel_reason_user"><strong class="mb-2">Cancel Reason ( <?php echo $username?> ): <?php echo $cancel_reason_user?> </strong></p>
        <p id="cancel_reason_admin"><strong class="mb-2">Cancel Reason ( <?php if(!empty($cancel_username)){echo $cancel_username;} else {echo "None";}?> ): <?php echo $cancel_reason_admin?> </strong></p>

        <form method="post">
        <div class="order_status">
        <?php   
        echo " <select class='status-select' name='order_status' onchange='toggleInputField()' id='status'>
                <option value='$order_status'>$order_status</option>
                <option value='Processing'>Processing</option>
                <option value='Delivered'>Delivered</option>
                <option value='Cancelled'>Cancelled</option>
            </select>
            
    ";
        ?>  
        <button name="update_status" class="status_btn" id="update_status"><i class="fa fa-check" aria-hidden="true"></i></button>
        </div>

    <div id='cancelReasonDiv' style='display: none; margin-top: 10px;'>
        <label for='cancel_reason'>Reason for Cancellation:</label>
        <input type='text' name='cancel_reason' id='cancel_reason'>
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
          $product_query = $con->prepare("SELECT * FROM `products` WHERE product_id = ?");
          $product_query->bind_param("i", $product_ids);
          $product_query->execute();
          $product_query_result = $product_query->get_result();
           while($product_row =  $product_query_result->fetch_assoc()){
             $product_title = $product_row['product_title'];
             $product_price = $product_row['product_price'];
             $product_total = $product_quantity * $product_price;
             echo "<tbody>
                <tr>
                    <td>$product_title</td>
                    <td>$product_quantity</td>
                    <td><i class='fas fa-cedi-sign'></i>$product_price</td>
                    <td><i class='fas fa-cedi-sign'></i>$product_total</td>
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

    <script>
        function toggleInputField() {
            const select = document.getElementById("status");
            const inputDiv = document.getElementById("cancelReasonDiv");
            
            if (select.value === "Cancelled") {
                inputDiv.style.display = "block";
            } else {
                inputDiv.style.display = "none";
            }
        }
    </script>

    <script>
          const select_div = document.getElementById("status");
          const update_status = document.getElementById("update_status");
          const cancel_reason_admin = document.getElementById("cancel_reason_admin");
          if (select_div.value === "Cancelled") {
            select_div.style.display = "none";
            update_status.style.display = "none";
            } else {
              select_div.style.display = "block";
              update_status.style.display = "block";
            }

            if(select_div.value === "Delivered"){
              cancel_reason_admin.style.display = "none";
              cancel_reason_user.style.display = "none";
              update_status.style.display = "none";
              select_div.style.display = "none";
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
        function showErrorCancelAlert() {
        const alertBox = document.getElementById('error-cancel-alert');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 2500);
        }

        // Trigger from PHP using session
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
        <?php
        if (isset($_SESSION['show_cancel_error']) && $_SESSION['show_cancel_error']) {
            echo "showErrorCancelAlert();";
            unset($_SESSION['show_cancel_error']); // remove flag
        }
        ?>
  </script>
  </body>
</html>
