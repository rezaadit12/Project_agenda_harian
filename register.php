<?php
session_start();

if (isset($_SESSION['nama'])) {
	header("location: mainPage.php");
}

require 'Data/data.php';

if(isset($_POST['submit'])){
	if(register($_POST) > 0){
		echo "<script>
				alert('Data berhasil ditambahkan')
				document.location.href = 'index.php';
			</script>";
	}else{
        echo "<script>
                alert('Terjadi kesalahan, coba lagi!');
            </script>";
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="css/style5.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="img/wave.png">
    <div class="container">

        <div class="login-content">
            <form action="" method="post">
                <!-- <img src="img/avatar.svg"> -->
                <h2 class="title">New Account?</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" class="input" name="username" autocomplete="off" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input" name="email" autocomplete="off" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                    <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm Password</h5>
                        <input type="password" class="input" name="confirmPassword" required>
                    </div>
                </div>
                <input type="submit" class="btn" value="Sign Up" name="submit">
            </form>
        </div>
        <div class="img">
            <img src="img/studying.png">
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>