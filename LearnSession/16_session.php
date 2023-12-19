<?php
   session_start();
   $_SESSION['username'] = "vignesh";
   $_SESSION['password'] = "secert";
   $_SESSION['email'] = "secert@gmail.com";

   echo "data saved in session";
?>