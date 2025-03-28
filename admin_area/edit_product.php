<?php

include("../includes/connect.php");

if(isset($_GET['edit_product'])){
    $edit_id = $_GET['edit_product'];
    $get_data = "Select * from `products` where product_id = $edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];

    // fetching the name of the category
    $select_category = "Select * from `categories` where category_id = $category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];

    // fetching the name of the category
    $select_brand = "Select * from `brands` where brand_id = $brand_id";
    $result_brand = mysqli_query($con, $select_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand['brand_title'];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Products</title>
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
              <h2>Edit Product</h2>
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
                 value="<?php echo $product_title ?>"
                 autocomplete="off"
                />
              </div>
              <div class="product-name">
                <label for="" class="form-label">Product Description</label>
                <input
                  type="text"
                  class="form-control"
                 name="product_description"
                 value="<?php echo $product_description ?>"
                 autocomplete="off"

                />
              </div>

              <div class="product-name">
                <label for="" class="form-label">Product Keywords</label>
                <input
                  type="text"
                  class="form-control"
                  name="product_keywords"
                  value="<?php echo $product_keywords ?>"
                  autocomplete="off"
                />
              </div>
              <div>
              <label for="" class="form-label">Product Category</label>
                <select name="product_category" class="form-select product-category" aria-label="Default select example">
                  <option value="<?php echo $category_title?>"><?php echo $category_title?></option>
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
              <label for="" class="form-label">Product Brands</label>
                <select name="product_brand" class="form-select product-brand" aria-label="Default select example">
                  <option value="<?php echo $brand_title?>"><?php echo $brand_title?></option>
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
                <img src="./product_images/<?php echo $product_image1 ?>" class="edit_product_image" alt="">
              </div>
              <div class="product-image">
                <label for="formFile" class="form-label">Product Image 2</label>
                <input class="form-control" type="file" id="formFile" name="product_image2">
                <img src="./product_images/<?php echo $product_image2 ?>" class="edit_product_image" alt="">
              </div>
              <div class="product-image">
                <label for="formFile" class="form-label">Product Image 3</label>
                <input class="form-control" type="file" id="formFile" name="product_image3">
                <img src="./product_images/<?php echo $product_image3 ?>" class="edit_product_image" alt="">
              </div>

              <div class="product-price">
                <label for="" class="form-label">Product Price</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  name="product_price"
                  value="<?php echo $product_price?>"
                  autocomplete="off"
                />
              </div>
              <input type="submit" name="edit_product" class="btn btn-primary" value="Edit product">
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


<!-- editing the products -->

<?php
if(isset($_POST['edit_product'])){
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_image1 = $_FILES['product_image1'];
    $product_image2 = $_FILES['product_image2'];
    $product_image3 = $_FILES['product_image3'];
    $product_price = $_POST['product_price'];
    // echo $product_title;

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    
    // the temporary name of the images
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // checking for the empty fields
    // this checking of the empty fields will not work because of the required properties given in the input fields
    if($product_title == '' or $product_desc== '' or $product_keywords == '' or $product_category =='' or $product_brand == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '' or $product_price == ''){
        echo "<script>alert('Please fill all the fields')</script>";
    }else{
        move_uploaded_file($temp_image1 , "./product_images/$product_image1");
        move_uploaded_file($temp_image2 , "./product_images/$product_image2");
        move_uploaded_file($temp_image3 , "./product_images/$product_image3");

        // query to update the data
        $update_product = "update `products` set product_title = '$product_title', product_description = '$product_desc', product_keywords='$product_keywords', category_id = '$product_category', brand_id = '$product_brand', product_image1= '$product_image1', product_image2= '$product_image2', product_image3 = '$product_image3', product_price = '$product_price', date= NOW() where product_id = $edit_id";

        $result_update = mysqli_query($con, $update_product);
        if($result_update){
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('view_products.php','_self')</script>";

        }else{
            echo "<script>alert('There was a problem updating the product')</script>";
        }
    }
}


?>