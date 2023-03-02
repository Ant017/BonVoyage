<?php
include("config.php");
session_start();
error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$uid=$_SESSION['username'];
$a=mysqli_query($conn, "SELECT * FROM users WHERE username='$uid'");
$b=mysqli_fetch_array($a);

$oldpassword = md5($_POST['oldpassword']);
$newpassword = md5($_POST['newpassword']);
$conpassword = md5($_POST['conpassword']);

if(count($_POST)>0) {
	$result = mysqli_query($conn,"SELECT * from users WHERE username='$uid'");
	$row = mysqli_fetch_assoc($result);
	if(md5($_POST["oldpassword"]) == $row["password"]) {
		if($_POST["newpassword"] == $_POST["conpassword"]){
			mysqli_query($conn,"UPDATE users set password='" . md5($_POST["newpassword"]) . "' WHERE username='" . $uid . "'");
			echo "<script>alert('Password chnaged successfully.')</script>";
			header("Location: welcome.php");
		}
		else{
	 		echo "<script>alert('Password did not match.')</script>";
		}

	}
	else
	{
		echo "<script>alert('Old password is not correct.')</script>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
<link href="login.css" rel="stylesheet" type="text/css" />

</head>

<header>
		<a href="homeAfterLogin.php" class="logo">
			<img src="main_logo.png">
		</a>
		<ul>
			<li><a href="homeAfterLogin.php">Home</a></li>
			<li><a href="welcome.php" class="active">Profile</a></li>
			<li><a href="discover.php">Discover</a></li>
			
			<li><a href="gallery.php">Gallery</a></li>
			
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</header>

 <p class="login-text">Change Password</p>

	<p class="space"></p>

	<div class="container">
		<img src="nature_back.png" id="n_b">
		<img src="nature_front.png" id="n_f">
		<form action="" method="POST" class="login-email">
			
			
			<div class="input-group">
				
				<input type="password" name="oldpassword" size="25" class="fields" placeholder="Enter Old Password" required="required" />
			</div>
			<div class="input-group">
				
	<input type="password" name="newpassword" size="25" class="fields" placeholder="Enter New Password" required="required"/>
			</div>
			<div class="input-group">
				
				<input type="password" name="conpassword" size="25" class="fields" placeholder="Confirm New Password" required="required"/>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>
			
		</form>
	</div>

<!--div class="inputBox">
	<h3>Current Password :</h3>
	<input type="password" name="oldpassword" size="25" class="fields" placeholder="Enter Old Password" required="required" />
</div>

<div class="inputBox">
	<h3>New Password :</h3>
	<input type="password" name="newpassword" size="25" class="fields" placeholder="Enter New Password" required="required"/>
</div>

<div class="inputBox">
	<h3>Confirm New Password :</h3>
	<input type="password" name="conpassword" size="25" class="fields" placeholder="Confirm New Password" required="required"/>
</div>

</form>
</div>
<br />
<br /-->

</body>
</html>