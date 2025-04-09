<?php

include("../includes/connect.php");

if(isset($_POST['insert_product'])){
  $product_title = $_POST['product_title'];
  $description = $_POST['product_description'];
  $product_keywords = $_POST['product_keywords'];
  $product_category = $_POST['product_category'];
  $product_brands = $_POST['product_brand'];
  $product_price = $_POST['product_price'];
  $product_status = "true";

  // accessing images
  $product_image1 = $_FILES['product_image1']['name'];
  $product_image2 = $_FILES['product_image2']['name'];
  $product_image3 = $_FILES['product_image3']['name'];

  // accessing images tmp name
  $temp_image1 = $_FILES['product_image1']['tmp_name'];
  $temp_image2 = $_FILES['product_image2']['tmp_name'];
  $temp_image3 = $_FILES['product_image3']['tmp_name'];

  // checking if some of the fields are empty
  if($product_title=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_brands=='' or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3==''){
      echo "<script>alert('Please fill all the fields')</script>";
      exit();
  }else{
      // move images to the folder
      move_uploaded_file($temp_image1, "./product_images/$product_image1");
      move_uploaded_file($temp_image2, "./product_images/$product_image2");
      move_uploaded_file($temp_image3, "./product_images/$product_image3");

      // insert query to the database
      $insert_products = "insert into `products` (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) values ('$product_title','$description','$product_keywords','$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
      $result_query = mysqli_query($con, $insert_products);
      if($result_query){
          echo "<script>alert('Product added successfully')</script>";
      }
  }

}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Products</title>
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
            <span class="fa fa-bar"></span>
            <span class="fa fa-bar"></span>
            <span class="fa fa-bar"></span>
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
              <a class="active-menu" href="add_products.php"
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
              <h2>Add Products</h2>
              <h5>Love to see you.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />
          <!-- /. ROW  -->

          <!-- /. ROW  -->
          <div class="">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="product-name">
                <label for="" class="form-label">Product name</label>
                <input
                  type="text"
                  class="form-control"
                 name="product_title"
                 autocomplete="off"
                />
              </div>
              <div class="product-name">
                <label for="" class="form-label">Product Description</label>
                <input
                  type="text"
                  class="form-control"
                 name="product_description"
                 autocomplete="off"
                />
              </div>

              <div class="product-name">
                <label for="" class="form-label">Product Keywords</label>
                <input
                  type="text"
                  class="form-control"
                  name="product_keywords"
                  autocomplete="off"
                />
              </div>
              <div>
                <select name="product_category" class="form-select product-category" aria-label="Default select example">
                  <option value="">Select category</option>
                  <?php
                    $select_query = "Select * from `categories`";
                    $result_query= mysqli_query($con, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                    }
                     ?>
                </select>
              </div>
              <div>
                <select name="product_brand" class="form-select product-brand" aria-label="Default select example">
                  <option value="">Select brand</option>
                  <?php
                    $select_query = "Select * from `brands`";
                    $result_query= mysqli_query($con, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                    $brand_title = $row['brand_title'];
                    $brand_id = $row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                    }
                     ?>
                </select>
              </div>
              <div class="product-image">
                <label for="formFile" class="form-label">Product Image 1</label>
                <input class="form-control" type="file" id="formFile" name="product_image1">
              </div>
              <div class="product-image">
                <label for="formFile" class="form-label">Product Image 2</label>
                <input class="form-control" type="file" id="formFile" name="product_image2">
              </div>
              <div class="product-image">
                <label for="formFile" class="form-label">Product Image 3</label>
                <input class="form-control" type="file" id="formFile" name="product_image3">
              </div>

              <div class="product-price">
                <label for="" class="form-label">Product Price</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  name="product_price"
                  autocomplete="off"
                />
              </div>
              <input type="submit" name="insert_product" class="btn btn-primary" value="Insert product">
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
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
