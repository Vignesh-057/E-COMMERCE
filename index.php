<?php
    include("./include/connect.php");
    include('functions/common_function.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flippy Shopping</title>
    <!-- css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
    <style>
      body{
          overflow-x: hidden;
      }
    </style>
  </head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
          <div class="container-fluid">
            
            <img src="./images/logo.jpg" alt="" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="display_all.php">Products</a>
                </li>
                <?php
                    if(isset($_SESSION['username'])){
                      echo "<li class='nav-item'>
                              <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                          </li>";
                    }else{
                      echo "<li class='nav-item'>
                              <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
                          </li>";

                    }
                ?>
                
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                </li>
              </ul>
              <form class="d-flex" action="search_product.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
                <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
              </form>
            </div>
          </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
          <ul class="navbar-nav me-auto">

            <?php
                if(!isset($_SESSION['username'])){
                  echo "<li class='nav-item'>
                          <a class='nav-link' href='#'>Welcome Guest</a>
                        </li>";
                }else{
                  echo "<li class='nav-item'>
                          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                        </li>";
                }

                if(!isset($_SESSION['username'])){
                  echo "<li class='nav-item'>
                          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                        </li>";
                }else{
                  echo "<li class='nav-item'>
                          <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                        </li>";
                }
            ?>

          </ul>
        </nav>

        <!-- Third child -->
        <div class="bg-light">
          <h3 class="text-center">Flippy Store</h3>
          <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <!-- fourth child -->
        <div class="row px-1">
          <div class="col-md-10">
            <!-- products -->
            <div class="row">
              <!-- fetching products -->
              <?php
                  //calling function
                  cart();
                  getproducts();
                  get_unique_categories();
                  get_unique_brands();
                  $ip = getIPAddress();  
                  //echo 'User Real IP Address - '.$ip;

                  // $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMTT 0,9";
                  // $result_query = mysqli_query($con,$select_query);
                  // // $row = mysqli_fetch_assoc($result_query);
                  // // echo $row['product_title'];
                  // while($row = mysqli_fetch_assoc($result_query)){
                  //   $product_id = $row['product_id'];
                  //   $product_title = $row['product_title'];
                  //   $product_description = $row['product_description'];
                  //   // $product_keywords = $row['product_keywords'];
                  //   $category_id = $row['category_id'];
                  //   $brand_id = $row['brand_id'];
                  //   $product_image1 = $row['product_image1'];
                  //   $product_price = $row['product_price'];
                  //   echo "<div class='col-md-4 mb-2'>
                  //           <div class='card'>
                  //             <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                  //             <div class='card-body'>
                  //               <h5 class='card-title'>$product_title</h5>
                  //               <p class='card-text'>$product_description</p>
                  //               <a href='#' class='btn btn-info'>Add to cart</a>
                  //               <a href='#' class='btn btn-secondary'>View more</a>
                  //             </div>
                  //           </div>
                  //         </div>";
                  // }
              ?>


              <!-- <div class="col-md-4 mb-2">
                <div class="card">
                  <img src="./images/Dairymilk.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-info">Add to cart</a>
                    <a href="#" class="btn btn-secondary">View more</a>
                  </div>
                </div>
              </div> -->
              <!-- row end -->
            </div>
            <!-- column end-->
          </div>


              

             

              

              <!-- <div class="col-md-4 mb-2">
                <div class="card">
                  <img src="./images/Capsicum.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-info">Add to cart</a>
                    <a href="#" class="btn btn-secondary">View more</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-2">
                <div class="card">
                  <img src="./images/Capsicum.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-info">Add to cart</a>
                    <a href="#" class="btn btn-secondary">View more</a>
                  </div>
                </div>
              </div> -->

            

          <!-- sidenav -->
          <div class="col-md-2 bg-secondary p-0">
            <!-- brands to be displayed -->
            <ul class="navbar-nav me-auto text-center">
              <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
              </li>
              <?php
                getbrands();
              ?>
            </ul>

            <!-- categories to be displayed -->
            <ul class="navbar-nav me-auto text-center">
              <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
              </li>
              <?php
                  getcategories();
              ?>
            </ul>
          </div>
          
        </div>

        <!-- last child -->
        <!-- include footer -->
        <?php
            include('./include/footer.php');
        ?>
    </div>










    <!-- js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>