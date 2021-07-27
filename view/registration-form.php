<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      body {
        box-sizing: border-box;
      }
      input {
        margin-bottom: 3px;
        width: 255px;
      }
      label {
        display: inline-block;
        width: 160px;
      }
      .required {
        color: orange;
      }
      .error {
        padding-left: 12px;
        color: red;
      }
    </style>
    <title>Registration Form</title>
  </head>
  <body>

    <?php
      require "../controller/support.php";
      $username = "";
      $password = "";
      $verify_password = "";
      $regErr = "";
      $flag = false;

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if(!empty($_POST['username'])) {
          $username = input($_POST['username']);
        }
        else {
          $flag = true;
        }
        if(!empty($_POST['password'])) {
          $password = input($_POST['password']);
        }
        if(!empty($_POST['verify_password'])) {
          $verify_password = input($_POST['verify_password']);
        }
        if ($password != $verify_password) {
          $flag = true;
        }

        if (!$flag) {
          $existing_data = read();

          if(empty($existing_data)) {
            $objArr[] = array("username" => $username, "password" => $password);
            $result = write(json_encode($objArr));
          }
          else {
            $existing_data_decode = json_decode($existing_data);

            array_push($existing_data_decode, array("username" => $username, "password" => $password));
            write("");
            $result = write(json_encode($existing_data_decode));
          }

          setcookie("username", $username, time() + 86400);
      		setcookie("password", $password, time() + 86400);

      		header("Location: ../view/login.php");
        }
        else {
          $regErr = "<p class='error'>* field is empty please fillup the field</p>";
      	}
      }
    ?>

    <h1 style="text-align: center;">Registration Form</h1>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" autocomplete="off" method="POST">
      <fieldset>
        <legend><b>Account Information</b></legend>
        <label for="username">Username<span class="required">*</span>: </label>
        <input type="text" name="username" value="<?php echo $username; ?>" />
        <br>
        <label for="password">Password<span class="required">*</span>: </label>
        <input type="password" name="password" value="<?php echo $password; ?>" />
        <br>
        <label for="verify-Password">Re-enter Password<span class="required">*</span>: </label>
        <input type="password" name="verify_password" value="<?php echo $verify_password; ?>"><span class="error"><?php if($password != $verify_password) echo "password doesn't match"; ?></span>
      </fieldset>

      <br />
      <button type="submit"><b>Submit</b></button>
      <a href="../view/login.php">Already have an account</a>
    </form>

    <?php echo $regErr; ?>
  </body>
</html>