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


if(isset($_GET['edit_category'])){
    $category_id = $_GET['edit_category'];
    $select_category = $con->prepare("SELECT * FROM `categories` WHERE category_id = ?");
    $select_category->bind_param("i", $category_id);
    $select_category->execute();
    $select_result = $select_category->get_result();
    $row_category = $select_result->fetch_assoc();
    $category_title = $row_category['category_title'];

}

// editing of product

if(isset($_POST['edit_category'])){
  $category_title = $_POST['category_title'];

  if($category_title == ''){
    $_SESSION['show_field_error'] = true;
    header("Location: edit_category.php?edit_category=$category_id");
    exit();
  }

  // $select_category_sql = "Select * from `categories` where category_title = '$category_title'";
  // $select_category_result = mysqli_query($con, $select_category_sql);
  // $category_number = mysqli_num_rows($select_category_result);
  $select_category_sql = $con->prepare("SELECT * FROM `categories` WHERE category_title = ?");
  $select_category_sql->bind_param("s", $category_title);
  $select_category_sql->execute();
  $select_category_sql_result = $select_category_sql->get_result();
  if($select_category_sql_result->num_rows >0){
    $_SESSION['show_error'] = true;
    header("Location: edit_category.php?edit_category=$category_id");
    exit();
  }else{
    $update_category = $con->prepare("UPDATE `categories` SET category_title =? WHERE category_id = ?");
    $update_category->bind_param("si", $category_title, $category_id);
    if($update_category->execute()){
      $_SESSION['show_success'] = true;
      header("Location: view_category.php");
      exit();
  
    }else{
      header("Location: view_category.php");
      exit();
    }

  }
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Category</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="assets/css/responsive.css">
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
          <a class="navbar-brand" href="index.php"><?php echo $username?> Admin</a>
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
                ><i class="fa fa-bar-chart-o fa-3x"></i> Processing Orders</a
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
              <h2>Edit Category</h2>
              <h5>Love to see you.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />

           <!--alert starts  -->
           <div id="success-alert" class="success-alert">Category updated successfully!</div>
                <div id="error-alert" class="error-alert">Category already exist!</div>
                <div id="field-error-alert" class="field-error-alert">Field cannot be empty!</div>
             <!-- alert ends -->
              
          <!-- start coding here -->
           <div>
            <form action="" method="post">
                <div class="product-name">
                    <label for="" class="form-label">Category</label>
                    <input
                      type="text"
                      class="form-control"
                      name="category_title"
                      value="<?php echo $category_title ?>"
                      autocomplete="off"
                    />
                  </div>
                  <input type="submit" name="edit_category" class="btn btn-primary insert-btn">
            </form>
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
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

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
        function showFieldErrorAlert() {
        const alertBox = document.getElementById('field-error-alert');
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
        if (isset($_SESSION['show_field_error']) && $_SESSION['show_field_error']) {
            echo "showFieldErrorAlert();";
            unset($_SESSION['show_field_error']); // remove flag
        }
        ?>
  </script>
  </body>
</html>