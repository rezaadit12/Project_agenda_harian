<?php
require 'prosesregis.php';
    if( isset($_POST["register"])) {

        if( registrasi($_POST) > 0) {
            echo "<script> alert('user berhasil ditambahkan!');</script>";
        } else {
            echo mysqli_error($conn);
        }

    }
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link rel="stylesheet" href="register.css">
 </head>
 <body>
    <div class="center">
        <h1>New Account?</h1>
        <form method="post">
            <div class="txt_field">
                <input type="email" name="email" id="email" required>
                <span></span>
                <label > Email</label>
            </div>
            <div class="txt_field">
                <input type="text" name="username" id="username" required>
                <span></span>
                <label > Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id ="password" required>
                <span></span>
                <label > Password</label>
            </div>
            <div class="regis">
            Already Have an Account? <a href="login.php">Sign In</a>
                </div>
                <input type="submit" name="" value="Register">
        </form>
        <img class= "study" src="studying.png" alt="img" width="300" height="300">
    </div>
    </body>
</html>