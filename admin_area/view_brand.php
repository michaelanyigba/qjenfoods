<?php

include("../includes/connect.php");

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
          <a href="#" class="btn btn-danger square-btn-adjust">Logout</a>
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
                  <a class="active-menu" href="view_brand.php"
                    ><i class="fa fa-bar-chart-o fa-3x"></i> View Brands</a
                  >
                </li>
                <li>
                  <a href="view_user.php"
                    ><i class="fa fa-rocket fa-3x"></i> View Users</a
                  >
                </li>
                <li>
                  <a href="table.php"
                    ><i class="fa fa-table fa-3x"></i> Table Examples</a
                  >
                </li>
                <li>
                  <a href="form.php"><i class="fa fa-edit fa-3x"></i> Forms </a>
                </li>
    
                <li>
                  <a href="#"
                    ><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span
                      class="fa arrow"
                    ></span
                  ></a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="#">Second Level Link</a>
                    </li>
                    <li>
                      <a href="#">Second Level Link</a>
                    </li>
                    <li>
                      <a href="#"
                        >Second Level Link<span class="fa arrow"></span
                      ></a>
                      <ul class="nav nav-third-level">
                        <li>
                          <a href="#">Third Level Link</a>
                        </li>
                        <li>
                          <a href="#">Third Level Link</a>
                        </li>
                        <li>
                          <a href="#">Third Level Link</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="blank.php"
                    ><i class="fa fa-square-o fa-3x"></i> Blank Page</a
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
              <h2>View Brands</h2>
              <h5>Love to see you.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />

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
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
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
                      <td><a href="edit_brand.php?edit_brand=<?php echo $brand_id?>"><i class="fa fa-pencil pencil"></i></a></td>
                        <td><a onclick='return confirmDelete(event);' href="delete_brand.php?delete_brand=<?php echo $brand_id ?>"><i class="fa fa-trash-o trash" aria-hidden="true"></i></a></td>
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
    function confirmDelete(event) {
        event.preventDefault(); // Prevent the default action
        let userConfirmed = confirm("Are you sure you want to delete this brand?");
        if (userConfirmed) {
            window.location.href = event.currentTarget.href; // Proceed with deletion
        }
    }
</script>
  </body>
</html>
