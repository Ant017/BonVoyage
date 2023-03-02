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

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Satisfy&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Lato:wght@300;400&family=Satisfy&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="welcome.css">
	<title>Admin Profile</title>
</head>
<body>

	<header>
		<a href="#" class="logo">
			<img src="main_logo3.png">
		</a>
		<ul>
			
			<li><a href="#" class="active">Workplace</a></li>
			<li><a href="#book">Manage sites</a></li>
			<li><a href="#cust">customer orders</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</header>

	<section id="occ">
		<div class="welcome">
		<?php
			echo "Welcome, " . $_SESSION['username'] . "!";
		?>
		</div>
		<img src="ocean.png" id="oc">
	</section>

	<!--booking-->
	<div class="waves">
		<div class="book" id="book">
			<h1 class="headingg">
				Create New Package<br>
				<p class="sub"></p>
			</h1>

			<p class="space"></p>

			<div class="row">
				
				<form method="POST" action="demo.php">

					<div class="inputBox">
						<h3>Package name</h3>
						<input type="text" name="name" placeholder="Enter Holiday Package Name" size="40" required="required"  autocomplete="off" />
					</div>

					<div class="inputBox">
						<h3>Amount per Member</h3>
						<input type="text" name="amount" placeholder="Enter Amount Per Member" size="40" required="required"  autocomplete="off" />
					</div>

					<div class="inputBox">
						<button name="submit" value="ADD" class="btn">Submit</button>
					</div>

				</form>

			</div>


		</div>

		<div>
			<?php 
				echo $notification;
			?>
		</div>

		<!-- view available packages table -->

		<div class="packages" id="demo" style="display:none">
			<span class="subHead">Current Packages<br/></span><br />

			<table border="0" cellpadding="5" cellspacing="5" class="tab">
			<tr class="tabrow">
				<th class="tabheader">Sr.No.</th>
				<th class="tabheader">Package Name</th>
				<th class="tabheader">Amount Per Member</th>
				<th class="tabheader">Delete</th>
			</tr>


			<?php
			$u=1;
			$x=mysqli_query($conn, "SELECT * FROM packages");
			$total=mysqli_num_rows($x);

			if ($total!=0) {
				while($y=mysqli_fetch_array($x))
				{ ?>
					<tr class="tabrow">
					<td class="tabdata"><?php echo $u; $u++; ?></td>
					<td class="tabdata"><?php echo $y['name'];?></td>
					<td class="tabdata"><?php echo $y['amount'] . "/-";?></td>
					<td class="tabdata"><a href="delete.php?del=<?php echo $y['name'];?>" class="delbutton">Delete</a></td>
					</tr>
					
				<?php }
			} 

			?>	
			</table>

		</div>	

		<div class="buttonDiv">
		<button type="button" class="button" onclick="hidebutton(this)">View current packages</button>
		</div>

		<div class="space"></div>

		<script>
			function hidebutton(x)
			{
				document.getElementById('demo').style.display='block';
				x.style.display = 'none';
			}
		</script>

		<!-- end of available packages table -->

		<!-- view customer orders table -->

		<div class="packages3" id="demo2" style="display:none">

			 <span class="subHead">Customers Booking<br /></span><br />

			<table border="0" cellpadding="5" cellspacing="5" class="tab">
			<tr class="tabrow">
				<th class="tabheader">Sr.No.</th>
				<th class="tabheader">E-Mail</th>
				<th class="tabheader">Package Name</th>
				<th class="tabheader">Journey By</th>
				<th class="tabheader">Total Amount</th>
				<th class="tabheader">Members</th>
				<th class="tabheader">Date</th>
				<th class="tabheader">Status</th>
				<th class="tabheader">Delete</th>
			</tr>
			<?php
			$u=1;
			$x=mysqli_query($conn, "SELECT * FROM bookings");
			while($y=mysqli_fetch_array($x))
			{
				?>
			<tr class="tabrow">
			<td class="tabdata"><?php echo $u;$u++;?></td>
			<td class="tabdata"><?php echo $y['email'];?></td>
			<td class="tabdata"><?php echo $y['package'];?></td>
			<td class="tabdata"><?php echo $y['journey'];?></td>
			<td class="tabdata"><?php echo $y['amount'] . "/-";?></td>
			<td class="tabdata"><?php echo $y['members'];?></td>
			<td class="tabdata"><?php echo $y['date'];?></td>
			<?php if($y['status']==0)
			{
				
			?> <td class="tabdata"><a href="approval.php?a=<?php echo $y['id'];?>" class="delbutton">Approve</a></td>
			<?php } else { ?>
			<td class="tabdata">Approved</td>
			<?php }
			?>
			<td class="tabdata"><a href="delete.php?del2=<?php echo $y['id'];?>" class="delbutton">Delete</a></td>
			</tr>
			<?php } ?>
			</table>
		</div>

		<div class="buttonDiv">
			<button type="button" id="cust" class="button" onclick="hidebutton2(this)">View customer orders</button>
		</div>

		<script>
			function hidebutton2(x)
			{
				document.getElementById('demo2').style.display='block';
				x.style.display = 'none';
			}
		</script>

		<!-- end of view customer orders table -->

		<div class="wave1"></div>
		<div class="wave2"></div>
		<div class="wave3"></div>
		<div class="wave4"></div>
		
	</div>

</body>
</html>