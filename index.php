<?php
session_start();

require "Data/data.php";

if (isset($_COOKIE['useid']) && isset($_COOKIE['usemailuser'])) {
    $id = $_COOKIE['useid'];
    $mailuser = $_COOKIE['usemailuser'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($mailuser === hash('sha256', $row['email'])) {
		$_SESSION['email'] = $row['email'];
        $_SESSION['nama'] = $row['username'];	
    }
}


if (isset($_SESSION['nama'])) {
	header("location: mainPage.php");
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style6.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">

</head>
<body>
	<img src="logo.jpeg">
	<img class="wave" src="img/satu.svg">
	<div class="container">
		<div class="img">
			<img src="img/working1.png" >
		</div>
		<div class="login-content">
			<form action="" method="post">
				<!-- <img src="img/avatar.svg"> -->
				<h2 class="title">Agenda Harian</h2>
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
            	<!-- <a href="register.php">belum punya akun? sign Up</a> -->
            	<a href="https://wa.me/6287818735781" target="_blank">Untuk bantuan, silahkan hubungi CS</a>
            	<input type="submit" class="btn" value="Login" name="submit">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
<h1></h1>
</body>
</html>



<?php



if(isset($_POST['submit'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");

	if(mysqli_num_rows($query) === 1){
		$row = mysqli_fetch_assoc($query);


		// if(password_verify($password, $row["password"])){
		if($password === $row["password"]){

			if($row['username'] == "admin"){
				$_SESSION['nama'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				header('Location: admin.php');
			}else{
				$_SESSION['email'] = $row['email'];
				$_SESSION['nama'] = $row['username'];
				header("Location: mainPage.php");

				setcookie('useid', $row['id'] , time() + 720000, '/'); 
				setcookie('usemailuser',  hash('sha256', $email), time() + 720000, '/'); 
			}

		}else{
			echo"<script>
					Swal.fire({
						icon: 'info',
						title: 'Oops...',
						text: 'Username/password tidak sesuai!'
					})
				</script>";
		}

	}else{
		echo"<script>
					Swal.fire({
						icon: 'info',
						title: 'Oops...',
						text: 'Username/password tidak sesuai!'
					})
			</script>";
	}
}