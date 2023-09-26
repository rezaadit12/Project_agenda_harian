<?php
session_start();

require "Data/data.php";

if (isset($_COOKIE['useid']) && isset($_COOKIE['usemailuser'])) {
    $id = $_COOKIE['useid'];
    $mailuser = $_COOKIE['usemailuser'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($mailuser === hash('sha256', $row['email'])) {
        $_SESSION['nama'] = $row['username'];	
    }
}


if (isset($_SESSION['nama'])) {
	header("location: mainPage.php");
}


if(isset($_POST['submit'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");

	if(mysqli_num_rows($query) === 1){
		$row = mysqli_fetch_assoc($query);


		if(password_verify($password, $row["password"])){

			if($row['username'] == "admin"){
				$_SESSION['nama'] = $row['username'];
				header('Location: admin.php');
			}else{

				$_SESSION['nama'] = $row['username'];
				header("Location: mainPage.php");
				setcookie('useid', $row['id'] , time() + 720000, '/'); 
				setcookie('usemailuser',  hash('sha256', $email), time() + 720000, '/'); 
			}

		}else{
			echo"<script>
					alert('Email/Password tidak sesuai!');
				</script>";
		}

	}else{
		echo"<script>
			alert('Email/Password tidak sesuai!');
		</script>";
	}
}
?>

			
<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<img class="wave" src="img/begron.svg">
	<div class="container">
		<div class="img">
			<img src="img/working1.png" >
		</div>
		<div class="login-content">
			<form action="" method="post">
				<!-- <img src="img/avatar.svg"> -->
				<h2 class="title">Welcome</h2>
				<div class="input-div one">
					<div class="i">
							<i class="fas fa-user"></i>
					</div>
					<div class="div">
							<h5>Email</h5>
							<input type="email" class="input" name="email" required>
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
            	<a href="register.php">belum punya akun? sign Up</a>
            	<input type="submit" class="btn" value="Login" name="submit">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>