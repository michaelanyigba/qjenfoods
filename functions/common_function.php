<?php
// include("./includes/connect.php");

// fuction for getting  products with the limit of products to be displayed
function get_products(){
    global $con;
    // condition to check isset or not
    if(!isset($_GET['category'])){
      if(!isset($_GET['brand'])){
    $select_query = "Select * from `products` order by rand() limit 0,8";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_assoc($result_query)){
     $product_id = $row['product_id'];
     $product_title = $row['product_title'];
     $product_description = $row['product_description'];
     $product_image1 = $row['product_image1'];
     $product_price = $row['product_price'];
     $category_id = $row['category_id'];
     $brand_id = $row['brand_id'];
     echo "<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
                <div class='product-item bg-light mb-4'>
                    <div class='product-img position-relative overflow-hidden'>
                        <img class='img-fluid w-100' src='./admin_area/product_images/$product_image1' alt=''>
                        <div class='product-action'>
                            <a class='btn btn-outline-dark btn-square' href='index.php?add_to_cart=$product_id'><i class='fa fa-shopping-cart'></i></a>
                            <a class='btn btn-outline-dark btn-square' href='./user_area/detail.php?product_id=$product_id'><i class='fa fa-info-circle'></i></a>
                        </div>
                    </div>
                    <div class='text-center py-4'>
                        <a class='h6 text-decoration-none text-truncate' href=''>$product_title</a>
                        <div class='d-flex align-items-center justify-content-center mt-2'>
                            <h5>$$product_price</h5><h6 class='text-muted ml-2'></h6>
                        </div>
                    </div>
                </div>
            </div> ";

    }
  }
}
}

// function for categories for index
function get_categories_for_index(){
    global $con;
$select_categories = "Select * from `categories`";
$result_categories= mysqli_query($con, $select_categories);
while( $row_data= mysqli_fetch_assoc($result_categories)){
  $category_title = $row_data['category_title'];
  $category_id = $row_data['category_id'];
  echo "<a href='./user_area/shop.php?category=$category_id' class='nav-item nav-link'>$category_title</a>";
}
}
// function for categories for user_area
function get_categories_for_user_area(){
    global $con;
$select_categories = "Select * from `categories`";
$result_categories= mysqli_query($con, $select_categories);
while( $row_data= mysqli_fetch_assoc($result_categories)){
  $category_title = $row_data['category_title'];
  $category_id = $row_data['category_id'];
  echo "<a href='shop.php?category=$category_id' class='nav-item nav-link'>$category_title</a>";
}
}

// product details
function product_details(){
    global $con;
    if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $select_query = "Select * from `products` where product_id=$product_id";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_assoc($result_query)){
     $product_id = $row['product_id'];
     $product_title = $row['product_title'];
     $product_description = $row['product_description'];
     $product_image1 = $row['product_image1'];
     $product_image2 = $row['product_image2'];
     $product_image3 = $row['product_image3'];
     $product_price = $row['product_price'];
     $category_id = $row['category_id'];
     $brand_id = $row['brand_id'];
     echo "<div class='row px-xl-5'>
            <div class='col-lg-5 mb-30'>
                <div id='product-carousel' class='carousel slide' data-ride='carousel'>
                    <div class='carousel-inner bg-light'>
                        <div class='carousel-item active'>
                            <img class='w-100 h-100' src='../admin_area/product_images/$product_image1' alt='Image'>
                        </div>
                        <div class='carousel-item'>
                            <img class='w-100 h-100' src='../admin_area/product_images/$product_image2' alt='Image'>
                        </div>
                        <div class='carousel-item'>
                            <img class='w-100 h-100' src='../admin_area/product_images/$product_image3' alt='Image'>
                        </div>
                    </div>
                    <a class='carousel-control-prev' href='#product-carousel' data-slide='prev'>
                        <i class='fa fa-2x fa-angle-left text-dark'></i>
                    </a>
                    <a class='carousel-control-next' href='#product-carousel' data-slide='next'>
                        <i class='fa fa-2x fa-angle-right text-dark'></i>
                    </a>
                </div>
            </div>
            <div class='col-lg-7 h-auto mb-30'>
                <div class='h-100 bg-light p-30'>
                    <h3>Name: $product_title</h3>
                    <h3 class='font-weight-semi-bold mb-4'> <span class='detail_price'> Price:</span> $$product_price</h3>
                    <p class='mb-4'>$product_description</p>
                    <div class='d-flex align-items-center mb-4 pt-2'>
                        <a href='detail.php?add_to_cart_for_user=$product_id' class='btn btn-primary px-3'><i class='fa fa-shopping-cart mr-1'></i> Add To
                            Cart</a>
                    </div>
                </div>
            </div>
        </div>";
  
    }
  }
  }

//   function for all products
function get_all_products(){
    global $con;
    // condition to check isset or not
    if(!isset($_GET['category'])){
      if(!isset($_GET['brand'])){
    $select_query = "Select * from `products` order by rand()";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_assoc($result_query)){
     $product_id = $row['product_id'];
     $product_title = $row['product_title'];
     $product_description = $row['product_description'];
     $product_image1 = $row['product_image1'];
     $product_price = $row['product_price'];
     $category_id = $row['category_id'];
     $brand_id = $row['brand_id'];
     echo "<div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
                        <div class='product-item bg-light mb-4'>
                            <div class='product-img position-relative overflow-hidden'>
                                <img class='img-fluid w-100' src='../admin_area/product_images/$product_image1' alt=''>
                                <div class='product-action'>
                                    <a class='btn btn-outline-dark btn-square' href='shop.php?add_to_cart_for_user=$product_id'><i class='fa fa-shopping-cart'></i></a>
                                    <a class='btn btn-outline-dark btn-square' href='detail.php?product_id=$product_id'><i class='fa fa-info-circle'></i></a>
                                </div>
                            </div>
                            <div class='text-center py-4'>
                                <a class='h6 text-decoration-none text-truncate' href=''>$product_title</a>
                                <div class='d-flex align-items-center justify-content-center mt-2'>
                                    <h5>$$product_price</h5>
                                </div>
                            </div>
                        </div>
                    </div>";
  
    }
  }
  }
  }

  // getting unique categories
function get_all_categories(){
    global $con;
    // conditio to check isset or not
    if(isset($_GET['category'])){
      $category_id = $_GET['category'];
    $select_query = "Select * from `products` where category_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    // counting the number of rows
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows==0){
      echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
    }
    while($row = mysqli_fetch_assoc($result_query)){
     $product_id = $row['product_id'];
     $product_title = $row['product_title'];
     $product_description = $row['product_description'];
     $product_image1 = $row['product_image1'];
     $product_price = $row['product_price'];
     $category_id = $row['category_id'];
     $brand_id = $row['brand_id'];
     echo "<div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
                        <div class='product-item bg-light mb-4'>
                            <div class='product-img position-relative overflow-hidden'>
                                <img class='img-fluid w-100' src='../admin_area/product_images/$product_image1' alt=''>
                                <div class='product-action'>
                                    <a class='btn btn-outline-dark btn-square' href='shop.php?add_to_cart_for_user=$product_id'><i class='fa fa-shopping-cart'></i></a>
                                    <a class='btn btn-outline-dark btn-square' href='detail.php?product_id=$product_id'><i class='fa fa-info-circle'></i></a>
                                </div>
                            </div>
                            <div class='text-center py-4'>
                                <a class='h6 text-decoration-none text-truncate' href=''>$product_title</a>
                                <div class='d-flex align-items-center justify-content-center mt-2'>
                                    <h5>$$product_price</h5>
                                </div>
                            </div>
                        </div>
                    </div>";
  
    }
  }
  }

  // fuction for searching  products on index page
function search_product_for_index(){
    global $con;
    if(isset($_GET['search_data_product'])){
    $search_data_value = $_GET['search_data'];
    $search_query = "Select * from `products` where product_keywords like '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows==0){
      echo "<h2 class='search-warning'>No product match for this search</h2>";
    }
    while($row = mysqli_fetch_assoc($result_query)){
     $product_id = $row['product_id'];
     $product_title = $row['product_title'];
     $product_description = $row['product_description'];
     $product_image1 = $row['product_image1'];
     $product_price = $row['product_price'];
     $category_id = $row['category_id'];
     $brand_id = $row['brand_id'];
     echo "<div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
                        <div class='product-item bg-light mb-4'>
                            <div class='product-img position-relative overflow-hidden'>
                                <img class='img-fluid w-100' src='../admin_area/product_images/$product_image1' alt=''>
                                <div class='product-action'>
                                    <a class='btn btn-outline-dark btn-square' href='shop.php?add_to_cart_for_user=$product_id'><i class='fa fa-shopping-cart'></i></a>
                                    <a class='btn btn-outline-dark btn-square' href='detail.php?product_id=$product_id'><i class='fa fa-info-circle'></i></a>
                                </div>
                            </div>
                            <div class='text-center py-4'>
                                <a class='h6 text-decoration-none text-truncate' href=''>$product_title</a>
                                <div class='d-flex align-items-center justify-content-center mt-2'>
                                    <h5>$$product_price</h5>
                                </div>
                            </div>
                        </div>
                    </div>";
  
    }
  }
  }


  // getting ip address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
  //whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
  }  
  // $ip = getIPAddress();  
  // echo 'User Real IP Address - '.$ip;  
  
  
  // adding items to cart
  function add_to_cart_index(){
    if(isset($_GET['add_to_cart'])){
      global $con;
      $get_ip_add = getIPAddress();
      $get_product_id = $_GET['add_to_cart'];
      // checking if item is already added to cart
      $select_query= "Select * from `cart_details` where ip_address='$get_ip_add' and
       product_id=$get_product_id";
       $result_query = mysqli_query($con, $select_query);
       $num_of_rows = mysqli_num_rows($result_query);
       if($num_of_rows>0){
         echo "<script>alert('Product already in cart')</script>";
        //  redirect to the index page
        echo "<script>window.open('index.php','_self')</script>";
       }else{
        $insert_query= "insert into `cart_details` (product_id, ip_address, quantity) values ($get_product_id, '$get_ip_add', 1)";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Product added to cart successfully')</script>";
        // when user clicks on okay it should direct them to the index page
        echo "<script>window.open('index.php','_self')</script>";
  
       }
      }
  
  }
  // adding items to cart
  function add_to_cart_for_user_area(){
    if(isset($_GET['add_to_cart_for_user'])){
      global $con;
      $get_ip_add = getIPAddress();
      $get_product_id = $_GET['add_to_cart_for_user'];
      // checking if item is already added to cart
      $select_query= "Select * from `cart_details` where ip_address='$get_ip_add' and
       product_id=$get_product_id";
       $result_query = mysqli_query($con, $select_query);
       $num_of_rows = mysqli_num_rows($result_query);
       if($num_of_rows>0){
         echo "<script>alert('Product already in cart')</script>";
        //  redirect to the index page
        echo "<script>window.open('shop.php','_self')</script>";
       }else{
        $insert_query= "insert into `cart_details` (product_id, ip_address, quantity) values ($get_product_id, '$get_ip_add', 1)";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Product added to cart successfully')</script>";
        // when user clicks on okay it should direct them to the index page
        echo "<script>window.open('shop.php','_self')</script>";
  
       }
      }
  
  }

  // counting the number of items in the cart
function cart_item(){
    global $con;
  $get_ip_address = getIPAddress();
  $cart_query = "Select * from `cart_details` where ip_address = '$get_ip_address'";
  $result_cart = mysqli_query($con, $cart_query);
  $count_products = mysqli_num_rows($result_cart);
  
  echo $count_products;
  }

?>






