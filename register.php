<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: homeAfterLogin.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);  //md5() encrypts the password
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {  //email is not currently in database
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Registration Successful!')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something went wrong!')</script>";
			}
		} else {
			echo "<script>alert('Sorry! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password did not match.')</script>";
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
	<title>Registration</title>
</head>
<body>

	<header>
		<a href="home.php" class="logo">
			<img src="main_logo.png">
		</a>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="login.php">Guest Login</a></li>
			<li><a href="admin.php">Admin Login</a></li>
			<li><a href="register.php" class="active">Registration</a></li>
			<li><a href="#">Contact</a></li>
			
		</ul>
	</header>

	<p class="login-text">Register</p>

	<p class="space"></p>
	
	<div class="container">
		<img src="nature_back.png" id="n_b">
		<img src="nature_front.png" id="n_f">

		<form action="" method="POST" class="login-email">

			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>

			<div class="input-group">
				<button name="submit" class="btn">Sign up</button>
			</div>
			<p class="login-register-text">Already have an account?&nbsp;<a href="login.php">Login Here</a></p>
		</form>
	</div>

</body>
</html>