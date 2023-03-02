<?php 

	include 'config.php';
	session_start();
	error_reporting(0);

	if($_GET['a']!=NULL)
	{
		$d=$_GET['a'];
		mysqli_query($conn, "UPDATE bookings SET status='1' WHERE id='$d'");
		header('Location: ' . 'adminArea.php' . '#cust');
	}

?>