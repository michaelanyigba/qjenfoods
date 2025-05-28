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

if(isset($_POST['register_user'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_confirm_password = $_POST['user_confirm_password'];
    $hash_password= password_hash($user_password, PASSWORD_DEFAULT);

    $sub_admin ="sub_admin";

    if($user_username ==''){
        $_SESSION['message'] = "Username field cannot be empty!";
        $_SESSION['msg_type'] = "error"; // For error messages
    }elseif($user_email ==''){
        $_SESSION['message'] = "Email field cannot be empty!";
        $_SESSION['msg_type'] = "error"; // For error messages
    }elseif($user_password==''){
        $_SESSION['message'] = "Password field cannot be empty!";
        $_SESSION['msg_type'] = "error"; // For error messages
    }elseif($user_password==''){
        $_SESSION['message'] = "Confirm password field cannot be empty!";
        $_SESSION['msg_type'] = "error"; // For error messages
    }elseif(strlen($user_password)<7){
        $_SESSION['message'] = "Password should be more than 7 characters!";
        $_SESSION['msg_type'] = "error"; // For error messages

    }elseif(!preg_match('/[A-Za-z]/', $user_password) || !preg_match('/\d/', $user_password)){
        $_SESSION['message'] = "Password must contain both letters and numbers!";
        $_SESSION['msg_type'] = "error"; // For error messages
    }
    else{
         // select query

      $select_query = $con->prepare("SELECT * FROM `users` WHERE username = ? OR user_email = ?");
      $select_query->bind_param("ss", $user_username, $user_email);
      $select_query->execute();
      $result_query = $select_query->get_result();  
      if ($result_query && $result_query->num_rows > 0) {
        $_SESSION['message'] = "Username or email already exist!";
        $_SESSION['msg_type'] = "error"; // For error messages
    }elseif($user_password!=$user_confirm_password){
        $_SESSION['message'] = "Password does not match!";
        $_SESSION['msg_type'] = "error"; // For error messages
  
  
    }else{
   // insert query
  $insert_query = $con->prepare("INSERT INTO `users` (username, user_email, user_password, role) VALUES (?,?,?,?)");
  $insert_query->bind_param("ssss", $user_username, $user_email, $user_password, $sub_admin);
   if($insert_query->execute()){
    $_SESSION['show_success_member'] = true;
       header("Location: view_member.php");
       exit();
   }else{
    $_SESSION['message'] = "An error occured!";
    $_SESSION['msg_type'] = "error"; // For error messages
   }
    }
}

}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Member</title>
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
  <style>
        .message {
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
              <a class='active-menu' href='add_member.php'
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
              <h2>Add Member</h2>
              <h5>Love to see you back.</h5>
            </div>
          </div>
          <hr />

                  <!--alert starts  -->
              <div id="success-alert-member" class="success-alert-member">Member added successfully!</div>
             <div id="error-alert-member" class="error-alert-member">Failed to add member!</div>
             <!-- alert ends -->

          <!-- form starts -->
           <div>
           <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='message {$_SESSION['msg_type']}'>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']); // Remove message after displaying it
                }
            ?>
               <form method="post" autocomplete="off">
                  <div data-mdb-input-init class="form-outline register_user_input_div">
                  <label class="form-label">Username</label>
                    <input type="text" autocomplete="off" name="user_username" class="form-control form-control-lg" />
                  </div>
                  <div data-mdb-input-init class="form-outline register_user_input_div">
                  <label class="form-label">Email </label>
                    <input type="email"  autocomplete="off" name="user_email" class="form-control form-control-lg" />
                  </div>
                  <div data-mdb-input-init class="form-outline register_user_input_div">
                  <label class="form-label">Password</label>
                    <input type="password" name="user_password" autocomplete="off" class="form-control form-control-lg" />
                  </div>
                  <div data-mdb-input-init class="form-outline register_user_input_div">
                  <label class="form-label" >Confirm password</label>
                    <input type="password" name="user_confirm_password" autocomplete="off" class="form-control form-control-lg" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark register_member_btn" name="register_user" type="submit">Register</button>
                  </div>
                </form>
           </div>
           <!-- form ends -->
          
        
    
       
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
        function showSuccessAlert() {
        const alertBox = document.getElementById('success-alert');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 2500);
        }
        function showSuccessMemberAlert() {
        const alertBox = document.getElementById('success-alert-member');
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
        function showErrorMemberAlert() {
        const alertBox = document.getElementById('error-alert-member');
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
  </script>
  </body>
</html>
