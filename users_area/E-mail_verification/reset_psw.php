<?php 
    session_start() ;
    include("../../include/connect.php");
    include("../../functions/common_function.php");
?>
<?php
    if(isset($_POST["reset"])){
        $psw = $_POST["password"];

        $token = $_SESSION['token'];
        $Email = $_SESSION['email'];

        $hash = password_hash( $psw , PASSWORD_DEFAULT );

        $sql = mysqli_query($con, "SELECT * FROM `user_table` WHERE user_email='$Email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if($Email){
            $new_pass = $hash;
            mysqli_query($con, "UPDATE `user_table` SET user_password='$new_pass' WHERE user_email='$Email'");
            ?>
            <script>
                window.location.replace("../user_login.php");
                alert("<?php echo "your password has been succesful reset"?>");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
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
        <h2 class="text-center">Create New Password</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="#" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="New_psw" class="form-label" >New Password</label>
                        <input type="password" id="New_psw" class="form-control" placeholder="Enter new password" autocomplete="off" required="required" name="password">
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Reset" name="reset" class="bg-info py-2 px-3 border-0">
                    </div>

                </form>

            </div>
        </div>
    </div>
</body>
</html>