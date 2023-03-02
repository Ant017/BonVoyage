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
	<title>Your Profile</title>
</head>
<body>

	<header>
		<a href="homeAfterLogin.php" class="logo">
			<img src="main_logo3.png">
		</a>
		<ul>
			<li><a href="homeAfterLogin.php">Home</a></li>
			<li><a href="welcome.php" class="active">Profile</a></li>
			<li><a href="discover.php">Discover</a></li>
			<li><a href="#demo" onclick="hidebutton(this)">Packages</a></li>
			<li><a href="gallery.php">Gallery</a></li>
			<li><a href="changePass.php">Change Password</a></li>
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

		<!--available packages table-->
	<div class="packages2" id="demo" style="display:none">
			<span class="subHead">Current Packages<br/></span><br />
			<span class="subsubHead">All yours to book!<br/></span><br />

			<table border="0" cellpadding="5" cellspacing="5" class="tab">
			<tr class="tabrow">
				<th class="tabheader">Sr.No.</th>
				<th class="tabheader">Package Name</th>
				<th class="tabheader">Amount Per Member</th>
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
					</tr>
					
				<?php }
			} 

			?>	
			</table>

		</div>
		<!--end of available packages table-->

		<div class="book" id="book">
			<h1 class="heading">
				Book Now!<br>
				<p class="sub">Search for available places!</p>
			</h1>

			<p class="space"></p>

			<div class="row">
				
				<form method="POST" class="f" action="demo2.php">
					<div class="inputBox">
						<h3>Where to?</h3>
						
						<select name="package" class="fields" required>
							 <option value="" selected="selected" disabled="disabled" class="textt">Select Package</option>
							 <?php
							 $x=mysqli_query($conn, "SELECT * FROM packages");
							 while($y=mysqli_fetch_array($x))
							 {
							 ?>
							<option value="<?php echo $y['name'];?>"><?php echo $y['amount']."/- ".$y['name'];?></option>
							<?php } ?>
							</select>
					</div>

					<div class="inputBox">
						<h3>How many?</h3>
						<input type="number" placeholder="No. of Guests" name="members">
					</div>

					<div class="inputBox">
						<h3>Journey by?</h3>
						
						<select name="journey" class="fields" required>
							<option value="" selected="selected" disabled="disabled">Ticket By</option>
							<option value="Air">Air</option>
							<option value="Train">Train</option>
							<option value="Bus">Bus</option>
						</select>
					</div>

					<div class="inputBox">
						<h3>Date</h3>
						<input type="date" name="date">
					</div>

					<div class="inputBox">
						<button name="submit" type="submit" class="btn">BOOK NOW!</button>
					</div>

				</form>

			</div>


		</div>

		<!-- Display upcoming tours -->

		<div class="current">
			
			<span class="subHead">My Upcoming Journeys<br /></span><br />

			<table border="0" cellpadding="5" cellspacing="5" class="tab">
			<tr class="tabrow">
				<th class="tabheader">Sr.No.</th>
				<th class="tabheader">Package Name</th>
				<th class="tabheader">Journey By</th>
				<th class="tabheader">Total Amount</th>
				<th class="tabheader">Members</th>
				<th class="tabheader">Date</th>
				<th class="tabheader">Status</th>
				
			</tr>
			<?php
			$u=1;
			$x=mysqli_query($conn, "SELECT * FROM bookings WHERE email='$e' AND date>=CAST(CURRENT_TIMESTAMP AS DATE)");
			while($y=mysqli_fetch_array($x))
			{
				?>
			<tr class="tabrow">
			<td class="tabdata"><?php echo $u;$u++;?></td>
			<td class="tabdata"><?php echo $y['package'];?></td>
			<td class="tabdata"><?php echo $y['journey'];?></td>
			<td class="tabdata"><?php echo $y['amount'] . "/-";?></td>
			<td class="tabdata"><?php echo $y['members'];?></td>
			<td class="tabdata"><?php echo $y['date'];?></td>
			<?php if($y['status']==0)
			{ ?>
				<td class="tabdata">Pending</td>
			
			<?php } else { ?>
			<td class="tabdata">Approved</td>
			<?php }
			?>
			
			</tr>
			<?php } ?>
			</table>
		</div>

		<!-- Display past journey history -->

		<div class="viewmine">
			
			<span class="subHead">History of My Journeys<br /></span><br />

			<table border="0" cellpadding="5" cellspacing="5" class="tab">
			<tr class="tabrow">
				<th class="tabheader">Sr.No.</th>
				<th class="tabheader">Package Name</th>
				<th class="tabheader">Journey By</th>
				<th class="tabheader">Total Amount</th>
				<th class="tabheader">Members</th>
				<th class="tabheader">Date</th>
				<th class="tabheader">Status</th>
			</tr>
			<?php
			$u=1;
			$x=mysqli_query($conn, "SELECT * FROM bookings WHERE email='$e' AND date<CAST(CURRENT_TIMESTAMP AS DATE) ORDER BY date");
			while($y=mysqli_fetch_array($x))
			{
				?>
			<tr class="tabrow">
			<td class="tabdata"><?php echo $u;$u++;?></td>
			<td class="tabdata"><?php echo $y['package'];?></td>
			<td class="tabdata"><?php echo $y['journey'];?></td>
			<td class="tabdata"><?php echo $y['amount'] . "/-";?></td>
			<td class="tabdata"><?php echo $y['members'];?></td>
			<td class="tabdata"><?php echo $y['date'];?></td>
			<?php if($y['status']==0)
			{ ?>
				<td class="tabdata">Pending</td>
			
			<?php } else { ?>
			<td class="tabdata">Approved</td>
			<?php }
			?>
			
			</tr>
			<?php } ?>
			</table>
		</div>

		<script>
		
		function hidebutton(x)
			{
				var elem=document.getElementById('demo')
				elem.style.display='block';
			}
		
	</script>
		
		<div class="wave1"></div>
		<div class="wave2"></div>
		<div class="wave3"></div>
		<div class="wave4"></div>

		</div>


		
		

</body>
</html>