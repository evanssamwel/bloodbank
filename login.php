<?php
require 'functions/functions.php';
require_once 'connection.php';

session_start();
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sub'])) {
    $user = test_input($_POST['user']);
    $pass = test_input($_POST['pass']);

    // Secure SQL query with placeholders
    $query = $db->prepare("SELECT * FROM login WHERE user = :user AND pass = :pass");
    $query->bindParam(':user', $user, PDO::PARAM_STR);
    $query->bindParam(':pass', $pass, PDO::PARAM_STR);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_OBJ);

    if ($res) {
        $_SESSION['user'] = $user;
        header("Location: home.php");
        exit;
    } else {
        echo "<script>alert('Wrong username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <style>
        body {
            margin: 5%;
            color: white;
            font: 600 16px/18px 'Open Sans', sans-serif;
            background-color: #121212;
        }
        .login-wrap {
            max-width: 400px;
            margin: auto;
            background: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .login-form .group {
            margin-bottom: 20px;
        }
        .login-form .group .label {
            color: white;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .login-form .group .input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: none;
        }
        .login-form .group .button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form .group .button:hover {
            background: darkgreen;
        }
        .foot-lnk {
            text-align: center;
            margin-top: 10px;
        }
        .foot-lnk a {
            color: #d5e2dc;
            text-decoration: none;
        }
    </style>
  </head>
<body>


			</form>

   

<div class="login-wrap">
  <div class="login-html">

  <form action="" method="post">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

            <div class="login-form">
      <div class="sign-in-htm">
        <div class="group">
          <form action="home.php">
          <label for="user" class="label">Username</label>
          <input id="user" type="text" class="input" name="user">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="pass" type="password" class="input" data-type="password" name="pass">
        </div>
        <div class="group">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Keep me Signed in</label>
        </div>
        <div class="group">
          <input type="submit" style="background-color: green; color: white" class="button" name="sub" value="Log In">
        </div>
          <div class="group">
            <a href="forgot.php">Forgot Password</a>


        

      <?php
      
      $user= $pass="";
      if(isset($_POST['sub']))
      {

        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $q=$db-> prepare("SELECT * from login where user='$user' && pass='$pass'");
        $q->execute();
        $res=$q->fetchAll(PDO::FETCH_OBJ);
        if($res)
        {
         $_SESSION['user']=$user;
        header("Location:home.php");
        }
        else
        {
          echo"<script>alert('Wrong email or password')</script>";
        }
          
          function test_input($data){
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;

          }

      }
      ?>
      	<div class="footer-left">
				<h3></span></h3>
				
             <div class="hr"></div>
        <div class="foot-lnk">
          <a href="forgot.html"></a>
        </div>
      </div>
