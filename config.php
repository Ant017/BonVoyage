<?php

$server = "localhost"; //returns host name
$user = "root"; //root is the folder where a PHP script is running.
$pass = ""; 
$database = "login"; //name of database

$conn = mysqli_connect($server, $user, $pass, $database); //connects database to the server

if (!$conn) {
	die("<script>alert('Connection Failed')</script>");
}

?>