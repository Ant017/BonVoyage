<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);


	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: adminArea.php");
	}
	else{
		echo "<script>alert('Email or Password is wrong')</script>";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Satisfy&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="login.css">
	<title>Admin Login</title>
</head>
<body>

	<header>
		<a href="home.php" class="logo">
			<img src="main_logo.png">
		</a>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="login.php">Guest Login</a></li>
			<li><a href="admin.php"  class="active">Admin Login</a></li>
			<li><a href="register.php">Registration</a></li>
			<li><a href="#">Contact</a></li>
			
		</ul>
	</header>

	<p class="login-text">Admin Login</p>

	<p class="space"></p>

	<div class="container">
		<img src="nature_back.png" id="n_b">
		<img src="nature_front.png" id="n_f">
		<form action="" method="POST" class="login-email">
			
			
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Are you a guest?&nbsp;<a href="register.php">Register Here</a></p>
		</form>
	</div>

</body>
</html>