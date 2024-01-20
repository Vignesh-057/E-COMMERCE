<?php
    include("../../include/connect.php");
    include("../../functions/common_function.php");
    @session_start();
?>
<?php 
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
            mysqli_query($con, "UPDATE `user_table` SET status = 1 WHERE user_email = '$email'");
            ?>
             <script>
                alert("Verfiy account done, you may sign in now");
                window.location.replace("../user_login.php");
             </script>
             <?php
        }

    }

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
        <h2 class="text-center">OTP Verification</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="#" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="otp" class="form-label" >OTP</label>
                        <input type="text" id="otp" class="form-control" placeholder="Enter your OTP" autocomplete="off" required="required" name="otp_code">
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Verify" name="verify" class="bg-info py-2 px-3 border-0">
                    </div>

                </form>

            </div>
        </div>
    </div>
</body>
</html>