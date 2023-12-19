<?php
    session_start();
    if(isset($_SESSION['username'])){
        echo "Welcome ".$_SESSION['username']."<br>";
        echo "And your password is ".$_SESSION['password']."<br>";
        echo "And email is ".$_SESSION['email'];
    }else{
        echo "please login again";

    }
   
?>