<?php session_start();
      //Put session start at the beginning of the file
?>

<!DOCTYPE html>
<html>
<head>
    <title>Print Name</title>
</head>
<body>

<p>Your Name is: <?php echo $_SESSION['name']; ?></p>   


</body>
</html>