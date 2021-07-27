<?php
  // ob_start();
  session_start();
  if($_SESSION['name']!='resdnt'){
    header("location: login.php");
  }
  else{
  $username= $_SESSION['username'];
  
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
</head>
<body>
<?php include("../view/header.php");?>
<h1>Username: dipu</h1>


</body>
</html>
