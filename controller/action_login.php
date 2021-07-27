<?php
      require "../controller/support.php";
      $username = "";
      $password = "";
      $error = "";

      if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_COOKIE["username"])) {
          $username = $_COOKIE["username"];
        }
        else {
          $username = "";
        }
        if (isset($_COOKIE["password"])) {
          $password = $_COOKIE["password"];
        }
        else {
          $password = "";
        }
      }

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST['username'])) {
          $username = $_POST['username'];
        }
        if (!empty($_POST['password'])) {
          $password = $_POST['password'];
        }
        if ($username === "" or $password === "") {
          $error = "username or password cannot be empty";
        }
        else {
          $readData = read();
          $userArr = json_decode($readData);

          for($i = 0; $i < count($userArr); $i++) {
            $user = $userArr[$i];
            if ($user->username === $username and $user->password === $password) {
              session_start();
              $_SESSION['name'] = "resdnt";
              $_SESSION['username'] =$username;
              header ("location: ../view/index.php");
              setcookie("username", $username, time() + 86400);
              setcookie("user", json_encode($user), time() + 86400);
              // header("Location: ../view/index.php");
            }
            else {
              // $error = "username or password doesn't match";
              header("location: error.php");

            }
          }
        }
      }
    ?>