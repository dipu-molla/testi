
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
   <!--  <style media="screen">
     
    </style> -->

    <title>Login Form</title>
  </head>
  <body>
    

    <h1>Login Form</h1>

    <form action="../controller/action_login.php" method="POST">
      <label for="username">Username: </label>
      <input type="text" name="username" id="username" required>
      <br>
      <label for="password">Password: </label>
      <input type="password" name="password" id="password" required>
      <br>
      <button type="submit"><b>Login</b></button>
      <a href="../view/registration-form.php">you have not account please create account</a>

    </form>
    <span><?php $error?></span>
  </body>
</html>