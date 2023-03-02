<?php
include("config.php");
error_reporting(0);

if($_GET['del']!=NULL)
{
	$d=$_GET['del'];
	mysqli_query($conn, "DELETE FROM packages WHERE name='$d'");
	header('Location: ' . 'adminArea.php' . '#cust');
}

elseif ($_GET['del2']!=NULL) {
	$d=$_GET['del2'];
	mysqli_query($conn, "DELETE FROM bookings WHERE id='$d'");
	header('Location: ' . 'adminArea.php' . '#cust');
}

elseif ($_GET['del3']!=NULL) {
	$d=$_GET['del3'];
	mysqli_query($conn, "DELETE FROM bookings WHERE id='$d'");
	header('Location: ' . 'welcome.php' . '#current');
}
	
?>