<?php 

	include 'config.php'; 

	session_start();

	error_reporting(0);

	if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Satisfy&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<header>
		<a href="home.php" class="logo">
			<img src="main_logo.png">
		</a>
		<ul>
			<li><a href="home.php" class="active">Home</a></li>
			<li><a href="login.php">Guest Login</a></li>
			<li><a href="admin.php">Admin Login</a></li>
			<li><a href="register.php">Registration</a></li>
			<li><a href="#myModal" id="myBtn">Contact</a></li>
		</ul>
	</header>

	<section>
		<img src="leaf.png" id="leaf">
		<img src="nature_back.png" id="n_b">
		<h1 id="text">BonVoyage</h1>
		<a href="#f" id="explore">Explore</a>
		<img src="nature_front.png" id="n_f">
	</section>

	<div class="bg-grad">
	<section class="features" id="f">
		<div class="feature-container">

			<div class="feature-box">
				<div class="f-img">
					<img src="travel.png">
				</div>
				<div class="f-text">
					<h2>Discover</h2>
					<p>Learn about places!</p>
					<a href="discover.php"><button class="main-btn">Visit</button></a>
				</div>
			</div>

			<div class="feature-box">
				<div class="f-img">
					<img src="travel2.png">
				</div>
				<div class="f-text">
					<h2>Packages</h2>
					<p>Choose your next tour!</p>
					<a href="#packages"><button class="main-btn" onclick="hidebutton(this)">Visit</button></a>
				</div>
			</div>

			<div class="feature-box">
				<div class="f-img">
					<img src="icon3.png">
				</div>
				<div class="f-text">
					<h2>Gallery</h2>
					<p>Find mindblowing images!</p>
					<a href="gallery.php"><button class="main-btn">Visit</button></a>
				</div>
			</div>

		</div>
	</section>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Email admin: antika.noor98@gmail.com</p>
    <br>
    <p>or</p>
    <br>
    <p>Phone: 01775903550</p>
  </div>

</div>

	<!--available packages table-->
	<div class="packages" id="demo" style="display:none">
			<span class="subHead">Current Packages<br/></span><br />
			<span class="subsubHead">Hi there! Log in or create an account for booking.<br/></span><br />

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
				while($y=mysqli_fetch_array($x))  //fetches a row
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

	</div>


	<footer>

		<ul class="social-icons">
			<li><a href="https://web.facebook.com/groups/661166580670281"> <ion-icon name="logo-facebook"></ion-icon></a></li>
			<li><a href="https://twitter.com/?lang=en"> <ion-icon name="logo-twitter"></ion-icon></a></li>
			<li><a href="https://www.pinterest.com/"><ion-icon name="logo-pinterest"></ion-icon></a></li>
			<li><a href="https://www.instagram.com/"><ion-icon name="logo-instagram"></ion-icon></a></li>
		</ul>
		<ul class="menuu">
			<li>email: antika.noor98@email.com</li>
			
		</ul>
		<p>@2022 Bonvoyage | All Rights Reserved</p>
		
	</footer>

	<script>
		let leaf = document.getElementById('leaf');
		let text = document.getElementById('text');
		let explore = document.getElementById('explore');

		window.addEventListener('scroll', function(){
			let value = window.scrollY;
			leaf.style.top = value * 0.5 + 'px';
			text.style.marginRight = value * 4 + 'px';
			explore.style.marginTop = value * 0.5 + 'px';
		})


		function hidebutton(x)
			{
				var elem=document.getElementById('demo')
				elem.style.display='block';
			}
		
	</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


</body>
</html>

