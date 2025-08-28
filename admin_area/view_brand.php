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

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Brands</title>
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
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  </head>
  <style>
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
      background-color: #fff;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
      text-align: center;
    }
  </style>
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
                  <a class="active-menu" href="view_brand.php"
                    ><i class="fa fa-bar-chart-o fa-3x"></i> View Brands</a
                  >
                </li>
                <li>
              <a href="processing_order.php"
                ><i class="fa fa-suitcase fa-3x" aria-hidden="true"></i> Processing orders</a
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
              <h2>View Brands</h2>
              <h5>Love to see you.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />

             <!-- alerts starts -->
             <div id="success-alert" class="success-alert">Brand updated successfully!</div>
             <div id="success-alert-delete" class="success-alert-delete">Brand deleted successfully!</div>
             <div id="error-alert" class="error-alert">Brand already exist!</div>
             <div id="field-error-alert" class="field-error-alert">Field cannot be empty!</div>
             <!-- alert ends -->

                <!-- Modal Container -->
            <div id="deleteModal" class="modal">
              <div class="modal-content">
                <p>Do you want to delete this brand?</p>
                <form method="POST" action="delete_brand.php">
                  <input type="hidden" name="brand_id" id="modalBrandId">
                  <button type="submit" name="confirm_delete">Yes</button>
                  <button type="button" onclick="closeModal()">No</button>
                </form>
              </div>
            </div>
            <!-- Modal ends -->

          <!-- start coding from here -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">All Brands</div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table
                    class="table table-striped table-bordered table-hover text-center"
                  >
                    <thead>
                      <tr>
                        <th class="text-center">Brand id</th>
                        <th class="text-center">Brand name</th>

                        <?php
                        if($_SESSION['role']==="admin"){
                          echo "<th class='text-center'>Edit</th>
                        <th class='text-center'>Delete</th>";
                        }
                        ?>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $select_brands= "Select * from `brands`";
                    $result = mysqli_query($con, $select_brands);
                    $number= 0;
                    while ($row = mysqli_fetch_assoc($result)){
                        $brand_id = $row['brand_id'];
                        $brand_title = $row['brand_title'];
                        $number ++;

    ?>
                      <tr>
                      <td><?php echo $number ?></td>
                      <td><?php echo $brand_title ?></td>
                      <?php
                        if($_SESSION['role']==="admin"){
                          echo "<td><a href='edit_brand.php?edit_brand=$brand_id'><i class='fa fa-pencil pencil'></i></a></td>
                          <td><a onclick='confirmDelete($brand_id)'><i class='fa fa-trash-o trash' aria-hidden='true'>
                          </i></a></td>
                          ";
                        }
                        ?>
                      </tr>

                      <?php
            }
?>
                    </tbody>
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
    <!-- for deleting brand -->


<script>
        function showSuccessAlert() {
        const alertBox = document.getElementById('success-alert');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 2500);
        }
        function showSuccessAlertDelete() {
        const alertBox = document.getElementById('success-alert-delete');
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
        if (isset($_SESSION['show_success_delete']) && $_SESSION['show_success_delete']) {
            echo "showSuccessAlertDelete();";
            unset($_SESSION['show_success_delete']); // remove flag
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

<script>
function confirmDelete(brandId) {
  document.getElementById('modalBrandId').value = brandId;
  document.getElementById('deleteModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('deleteModal').style.display = 'none';
}
</script>
  </body>
</html>
