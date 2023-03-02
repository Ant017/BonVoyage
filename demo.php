<?php

include 'config.php';

session_start();

error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
}

$aid=$_SESSION['username'];
$a=mysqli_query($conn, "SELECT * FROM admin WHERE username='$aid'");
$b=mysqli_fetch_array($a);
$name=$b['username'];
$n=$_POST['name'];
$am=$_POST['amount'];

if($n!=NULL && $am!=NULL)
{


		$sql = "SELECT * FROM packages WHERE name='$n'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO packages(name,amount) VALUES('$n','$am')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				$notification = "Package added!";
				
			} else {
				$notification = "Woops! Something went wrong!";
			}
		} else {
			$notification = "Package Already Exists.";
		}


	/*$sql=mysqli_query($conn, "INSERT INTO packages(name,amount) VALUES('$n','$am')");
	if(!$sql->num_rows > 0)
	{
		echo "<script>alert('Package added!')</script>";
	}
	else
	{
		echo "<script>alert('Package already exists!')</script>";
	}*/
}

header("Location: adminArea.php");

?>