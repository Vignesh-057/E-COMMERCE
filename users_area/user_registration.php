<?php session_start(); ?>
<?php
    include("../include/connect.php");
    include("../functions/common_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flippy Shopping-Registration</title>
    <!-- css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label" >Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                    </div>
                    <!-- email -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label" >Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email">
                    </div>
                    <!-- image -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label" >User Image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                    </div>
                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label" >Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                    </div>
                    <!-- confirm password -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label" >Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required="required" name="conf_user_password">
                    </div>
                    <!-- address -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label" >Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address">
                    </div>
                    <!-- contact -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label" >Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" name="user_register" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ?<a href="user_login.php" class="text-danger text-decoration-none"> Login</a></p>
                    </div>

                </form>

            </div>
        </div>
    </div>
</body>
</html>
<!-- php code -->
<?php
    if(isset($_POST['user_register'])){
        $user_username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $hash_password = password_hash($user_password,PASSWORD_DEFAULT);
        $conf_user_password = $_POST['conf_user_password'];
        $user_address = $_POST['user_address'];
        $user_contact = $_POST['user_contact'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_ip = getIPAddress();
        
        ///php mailer function start
        // <?php    
        $email = $_POST["user_email"];
        $password = $_POST["user_password"];

		//my code;
		$username = $_POST["user_username"];

        $select_query = "SELECT * FROM `user_table` WHERE username = '$user_username' or user_email = '$user_email'";
        $result = mysqli_query($con,$select_query);
        $row_count = mysqli_num_rows($result);

        if(!empty($email) && !empty($password)){
            if($row_count > 0){
                ?>
                <script>
                    alert("Username or email already exist!");
                </script>
                <?php
            }else if($user_password!=$conf_user_password){
                echo "<script>alert('Password do not match')</script>";
            }else{
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                //$result = mysqli_query($con, "INSERT INTO login (username, email, password, status) VALUES ('$username', '$email', '$password_hash', 0)");
                move_uploaded_file($user_image_tmp,"./user_images/$user_image");
                $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile, status)
                VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact', 0)";
                $sql_execute = mysqli_query($con,$insert_query);

                if($sql_execute){
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "E-mail_verification/Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='vigneshnvz007@gmail.com';
                    $mail->Password='qbiufkhdodhqdqlr';
    
                    $mail->setFrom('vigneshnvz007@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["user_email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your verify code";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Programming with Lam</b>
                    https://www.youtube.com/channel/UCKRZp3mkvL1CBYKFIlxjDdg";
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "Register Failed, Invalid Email "?>");
                                    </script>
                                <?php
                            }else{
                                ?>
                                <script>
                                    alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                    window.location.replace('E-mail_verification/otp.php');
                                </script>
                                <?php
                            }
                }
            }
        }
        ///php mailer function end
        
        // //select query
        // $select_query = "SELECT * FROM `user_table` WHERE username = '$user_username' or user_email = '$user_email'";
        // $result = mysqli_query($con,$select_query);
        // $row_count = mysqli_num_rows($result);
        // if($row_count>0){
        //     echo "<script>alert('Username already and Email exist')</script>";
        // }
        // else if($user_password!=$conf_user_password){
        //     echo "<script>alert('Password do not match')</script>";
        // }
        
        // else{
        //     //insert query
        //     move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        //     $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile, status)
        //     VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact', 0)";
        //     $sql_execute = mysqli_query($con,$insert_query);
        //     if($sql_execute){
        //         echo "<script>alert('data inserted')</script>";
        //     }else{
        //         die(mysqli_error($con));
        //     }
        // }


        // selecting cart items
        $usser_id = userid();
        $select_cart_items = "SELECT * FROM `cart_details` WHERE user_id = $usser_id";
        $result_cart = mysqli_query($con,$select_cart_items);
        $row_count = mysqli_num_rows($result_cart);
        if($row_count>0){
            $_SESSION['username'] = $user_username;
            echo "<script>alert('You have items in your cart')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }else{
            echo "<script>window.open('../index.php','_self')</script>";
        }

    }
?>