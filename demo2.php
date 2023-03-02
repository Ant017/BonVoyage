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
$e=$b['email'];

$id=$_POST['package'];
$p=mysqli_query($conn, "SELECT * FROM packages WHERE name='$id'");
$q=mysqli_fetch_array($p);
$rate=$q['amount'];

$pack=$_POST['package'];
$j=$_POST['journey'];
$m=$_POST['members'];
$d=$_POST['date'];

$amount=$m*$rate;

if($j!=NULL && $m!=NULL && $d!=NULL)
{

	$sql = "SELECT * FROM bookings WHERE email='$e' intersect SELECT * FROM bookings WHERE package='$pack'";
	$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql=mysqli_query($conn, "INSERT INTO bookings(email,package,members,journey,amount,date,status) VALUES('$e','$pack','$m','$j','$amount','$d','0')");
			$result = mysqli_query($conn, $sql);
			if ($result) {
				$notification = "Package added!";
				
			} else {
				$notification = "Woops! Something went wrong!";
			}
		} else {
			$notification = "Package Already Exists.";
		}
		
}
header("Location: welcome.php");

?>