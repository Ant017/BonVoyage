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
			$message = "Password Changed Sucessfully";
		}
		else{
	 		$message = "old Password is not correct";
		}

	}
	else
	{
		$message = "Password did not match";
	}
}

header("Location: changePass.php")

?>