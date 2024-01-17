<?php
    include("../include/connect.php");
    include("../functions/common_function.php");
    @session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flippy Shopping-Registration</title>
    <!-- css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="user_login.php" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label" >Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                    </div>
                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label" >Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" name="user_login" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1 mb-0"><a href="user_registration.php" class="text-blue text-decoration-none"> Forgot Password</a></p>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ?<a href="user_registration.php" class="text-danger text-decoration-none"> Register</a></p>
                    </div>

                </form>

            </div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['user_login'])){
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];

        $select_query = "SELECT * FROM `user_table` WHERE username = '$user_username'";
        $result = mysqli_query($con,$select_query);
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        $usser_name = $row_data['username'];
        $user_ip = getIPAddress();

        // ////
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     $_SESSION['name'] = $_POST['user_username'];
            
        //     if($_SESSION['name']) {
        //         header('location: demotest.php');
        //     }
        // }


        // cart item
        $select_query_cart = "SELECT * FROM `cart_details` WHERE username = '$usser_name'";
        $select_cart = mysqli_query($con,$select_query_cart);
        $row_count_cart = mysqli_num_rows($select_cart);

        if($row_count>0){
            $_SESSION['username'] = $user_username;
            if(password_verify($user_password,$row_data['user_password'])){
                // echo "<script>alert('Login successful')</script>";
                if($row_count==1 and $row_count_cart==0){
                    $_SESSION['username'] = $user_username;
                    echo "<script>alert('Login successful')</script>";
                    echo "<script>window.open('profile.php','_self')</script>";
                }else{
                    $_SESSION['username'] = $user_username;
                    echo "<script>alert('Login successful')</script>";
                    echo "<script>window.open('payment.php','_self')</script>";
                }
            }else{
                echo "<script>alert('Invalid Credentials')</script>";
            }
        }else{
            echo "<script>alert('Invalid Credentials')</script>";
        }
    }
?>