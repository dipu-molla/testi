<?php
  ob_start();
  session_start();
  if($_SESSION['name']!='resdnt'){
    header("location: login.php");
  }
  else{
  $username= $_SESSION['username'];
  
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>

    <?php
    $username = "";

      if (isset($_COOKIE["username"])) {

        $username = $_COOKIE["username"];
      }
      $username = strtoupper($username);
      ///echo "<h2>  WELCOME  </h2>";      
      echo "<h3> PATIENT PORTAL</h3>";
      echo "<br>";
      
      
    ?>

<fieldset>


 <?php include("../view/header.php");?>
 
  <font color="blue"><h2><b><font Background color="red">Home</b></h1></font></font>
 
 </fieldset>

  </body>
</html>