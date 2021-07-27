<?php
session_start();
include('../includes/db_connect.inc.php');
include('../includes/header.php');
include('navbar.php');



if (!isset($_SESSION['user_name'])) {
    header("../login.php");
}
$username = $password = $cPassword = $nPassword = $fname = $lname = $dob = $bGroup = $email = $pNumber = $pPic = "";
$passwordErr = $cPasswordErr = $nPasswordErr = $visitstartedit = $visitendedit = $visitstarterror = $visitenderror = $visiterror = "";
$file =  $files = $filename = $filetmp = $fileext = $filecheck = $fileextstored = $destinationfile = $fileError = $fileerror = "";
$hashPass = "";
$error = 0;
$user = $_SESSION['user_name'];
$res = mysqli_query($conn, "SELECT * FROM `doctor` WHERE `d_name` = '$user';");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

$username = $userRow['d_name'];
$dbPassword = $userRow['d_pass'];
$fname = $userRow['d_fname'];
$lname = $userRow['d_lname'];
$dob = $userRow['d_dob'];
$bGroup = $userRow['d_bgroup'];
$email = $userRow['d_email'];
$pNumber = $userRow['d_phone'];
$dept = $userRow['d_department'];
$qualification = $userRow['d_qualification'];
$inst = $userRow['d_institution'];
$visitstart = $userRow['d_visitstart'];
// $visitstart = time("h:i A", strtotime($userRow['d_visitstart']));

$visitend = $userRow['d_visitend'];
$pPic = $userRow['d_image'];
$hospital=$userRow['d_hospital'];

if (empty($_POST['password'])) {
    $passwordErr = "Password cannot be empty!";
    $error = 1;
} else {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}

if (empty($_POST['cPassword'])) {
    $cPasswordErr = "Password cannot be empty!";
    $error = 1;
} else {
    $cPassword = mysqli_real_escape_string($conn, $_POST['cPassword']);
}
if (empty($_POST['nPassword'])) {
    $nPasswordErr = "Password cannot be empty!";
    $error = 1;
} else {
    $nPassword = mysqli_real_escape_string($conn, $_POST['nPassword']);
}

if ($cPassword == $nPassword) {
    if (password_verify($password, $dbPassword)) {
        $hashPass = password_hash($cPassword, PASSWORD_DEFAULT);
    } else {
        $error = 1;
    }
} else {
    $error = 1;
}





if (isset($_POST['passUpdate'])) {
    if ($error == 0) {
        $query = "UPDATE `doctor` SET `d_pass`='$hashPass' WHERE `d_name` = '$user';";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            echo '<script type=text/javaScript> alert("Password Updated") </script>';
            header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
            echo '<script type=text/javaScript> alert("Something wrong Password not updated!") </script>';
        }
    } else {
        echo '<script type=text/javaScript> alert("Something wrong Password not updated!") </script>';
    }
}


// -------------------------imgUodate----------------------------------//
if (isset($_POST['imgUpdate'])) {
    if (!empty($_FILES['file']['name'])) {

        $file = $_FILES['file'];
        $filename = $file['name'];

        $fileerror = $file['error'];
        $filetmp = $file['tmp_name'];

        $fileext = explode('.', $filename);
        $filecheck = strtolower(end($fileext));

        $fileextstored = array('png', 'jpg', 'jpeg');
        if (in_array($filecheck, $fileextstored)) {
            // echo "file inserted";
            $new_name = rand() . "." . $filecheck;
            $destinationfile = '../images/' . $new_name;
            move_uploaded_file($filetmp, $destinationfile);
            $query = "UPDATE `doctor` SET `d_image`='$destinationfile' WHERE `d_name` = '$user';";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                echo '<script type=text/javaScript> alert("Data Updated") </script>';
                header('Location: ' . $_SERVER['PHP_SELF']);
            } else {
                echo '<script type=text/javaScript> alert("Something wrong data not updated!") </script>';
            }
        } else {
            // echo "select an IMAGE";
            echo '<script type=text/javaScript> alert("select an IMAGE") </script>';
        }
    } else {
        // $fileError = "Nothing is selected in imgae";
        echo '<script type=text/javaScript> alert("Nothing is selected in imgae") </script>';
    }
}

// ----------------------------------------infoUpdate----------------------------------------//
if (isset($_POST['infoUpdate'])) {
    if (empty($_POST['visitstartedit'])) {
        $visitstarterror = "Select Starting time of visiting Hour";
        $error = 1;
    } else {
        $visitstartedit = $_POST['visitstartedit'];
    }
    if (empty($_POST['visitendedit'])) {
        $visitenderror = "Select Ending time of visiting Hour";
        $error = 1;
    } else {
        $visitendedit = $_POST['visitendedit'];
    }
   
    if (!empty($_POST['visitstartedit']) && !empty($_POST['visitendedit'])) {
        $query = "UPDATE `doctor` SET `d_fname`='$_POST[fname]',`d_lname`='$_POST[lname]',`d_dob`='$_POST[dob]',`d_bgroup`='$_POST[bGroup]',`d_email`='$_POST[email]',`d_phone`='$_POST[pNumber]' ,`d_department`='$_POST[dept]',`d_hospital`='$_POST[hospital]',`d_visitstart`='$_POST[visitstartedit]',`d_visitend`='$_POST[visitendedit]' WHERE `d_name` = '$user';";

        if ($_POST['visitstartedit'] < $_POST['visitendedit']) {
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                echo '<script type=text/javaScript> alert("Data Updated") </script>';
                header('Location: ' . $_SERVER['PHP_SELF']);
            } else {
                echo '<script type=text/javaScript> alert("Something wrong data not updated!") </script>';
            }
        }else{
         
            echo '<script type=text/javaScript> alert("Visiting Hour Incorrect...Profile not updated!") </script>'; 
        }
    }else{
        echo '<script type=text/javaScript> alert(" not updated!") </script>'; 
    }
}
include('sidebar.php');
?>

<div class="patientprofile">
    <div class="row">
        <div class="col-md-4 box">
            <div class="well">
                <img src="<?php echo $userRow['d_image']; ?> " class="doc-img">
                <div class="btn-group">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editimage"><i class="fa fa-picture-o"></i></button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editpass"><i class="fa fa-key"></i></button>
                </div>
                <h3><?php echo $userRow['d_name']; ?></h3>
                <p></p>
            </div>
        </div>
