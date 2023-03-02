<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Satisfy&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Lato:wght@300;400&family=Satisfy&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="gallery.css">
	<title>Gallery</title>
</head>
<body>
	<header>
		<a href="home.php" class="logo">
			<img src="main_logo.png">
		</a>
	</header>
	<div class="wrapper">
		<div class="heading">Gallery</div>
		<nav>
			<div class="items">
				<span class="item active" data-name="all">All</span>
				<span class="item" data-name="mountain">Moutain</span>
				<span class="item" data-name="sea">Sea</span>
				<span class="item" data-name="lake">Lake</span>
				<span class="item" data-name="waterfalls">Waterfalls</span>
				<span class="item" data-name="forest">Forest</span>
			</div>
		</nav>

		<!--images-->
		<div class="gallery">
			<div class="image" data-name="lake">
				<span><img src="bagerhat.jpg" alt=""></span>
				<p class="text">Bagerhat, Khulna</p>
			</div>
			<div class="image" data-name="forest">
				<span><img src="bagh.jpg" alt=""></span>
				<p class="text">Royal Bengal Tiger in Shundarbans</p>
			</div>
			<div class="image" data-name="mountain">
				<span><img src="bichanakandi.jpg" alt=""></span>
				<p class="text">Bichanakandi, Sylhet</p>
			</div>
			<div class="image" data-name="lake">
				<span><img src="boga.jpg" alt=""></span>
				<p class="text">Boga Lake, Bandarban</p>
			</div>
			<div class="image" data-name="sea">
				<span><img src="cox.jpg" alt=""></span>
				<p class="text">Paragliding in Cox's Bazar</p>
			</div>
			<div class="image" data-name="sea">
				<span><img src="cox2.jpg" alt=""></span>
				<p class="text">Cox's Bazar Sea Beach</p>
			</div>
			<div class="image" data-name="sea">
				<span><img src="cox3.png" alt=""></span>
				<p class="text">Cox's Bazar Sea Beach</p>
			</div>
			<div class="image" data-name="mountain">
				<span><img src="dim.jpg" alt=""></span>
				<p class="text">Dim Pahar, Bandarban</p>
			</div>
			<div class="image" data-name="sea">
				<span><img src="inani.jpg" alt=""></span>
				<p class="text">Inani Sea Beach, Cox's Bazar</p>
			</div>
			<div class="image" data-name="sea">
				<span><img src="kuakata.jpg" alt=""></span>
				<p class="text">Kuakata, Barisal</p>
			</div>
			<div class="image" data-name="waterfalls">
				<span><img src="nafa.jpg" alt=""></span>
				<p class="text">Nafakhum waterfalls, Bandarban</p>
			</div>
			<div class="image" data-name="forest">
				<span><img src="nijhum.jpg" alt=""></span>
				<p class="text">Nijhum dwip, Bhola</p>
			</div>
			<div class="image" data-name="mountain">
				<span><img src="nilgiri.jpg" alt=""></span>
				<p class="text">Nilgiri, Bandarban</p>
			</div>
			<div class="image" data-name="sea">
				<span><img src="potenga.jpg" alt=""></span>
				<p class="text">Potenga Sea Beach, Chittagong</p>
			</div>
			<div class="image" data-name="lake">
				<span><img src="rangamati.jpg" alt=""></span>
				<p class="text">Rangamati, Chittagong</p>
			</div>
			<div class="image" data-name="forest">
				<span><img src="satkhira.jpg" alt=""></span>
				<p class="text">Satkhira, Khulna</p>
			</div>
			<div class="image" data-name="mountain">
				<span><img src="srimangal.jpg" alt=""></span>
				<p class="text">Srimangal, Sylhet</p>
			</div>
			<div class="image" data-name="forest">
				<span><img src="swamp.jpg" alt=""></span>
				<p class="text">Ratargul Swamp Forest, Sylhet</p>
			</div>
			<div class="image" data-name="waterfalls">
				<span><img src="amia.jpg" alt=""></span>
				<p class="text">Amiakhum waterfalls, Bandarban</p>
			</div>
			<div class="image" data-name="waterfalls">
				<span><img src="khoia.jpg" alt=""></span>
				<p class="text">Khoiyachhora waterfalls, Chittagong</p>
			</div>

		</div>
	</div>
		<!--full screen image preview-->

		<div class="preview-box">
			<div class="details">
				<span class="title">Image category: </span>
				<span class="icon fas fa-times"></span>
			</div>
			<div class="image-box">
				<img src="ban.jpg" alt="">
			</div>
		</div>

		<div class="shadow"></div>

	<script>
		const filterItem = document.querySelector(".items");
		const filterImg = document.querySelectorAll(".image");

		window.onload = ()=>{
			filterItem.onclick = (selectedItem)=>{
				if (selectedItem.target.classList.contains("item")) {
					filterItem.querySelector(".active").classList.remove("active");
					selectedItem.target.classList.add("active");
					let filterName = selectedItem.target.getAttribute("data-name");
					filterImg.forEach((image)=>{
						let filterImages = image.getAttribute("data-name");
						if((filterImages == filterName) || filterName == "all"){
							image.classList.remove("hide");
							image.classList.add("show");
						}
						else{
							image.classList.add("hide");
							image.classList.remove("show");
						}
					});
				}
			}
			for(let index = 0; index < filterImg.length; index++) {
				filterImg[index].setAttribute("onclick", "preview(this)");
			}
		}

		const previewBox = document.querySelector(".preview-box"),
		previewImg = previewBox.querySelector("img"),
		categoryName = previewBox.querySelector(".title"),
		closeIcon = previewBox.querySelector(".icon"),
		shadow = document.querySelector(".shadow");

		function preview(element){
			let selectedPrevImg = element.querySelector("img").src;
			let selectedImgCategory = element.getAttribute("data-name");
			categoryName.textContent = selectedImgCategory;
			previewImg.src = selectedPrevImg;
			previewBox.classList.add("show");
			shadow.classList.add("shhow");
			closeIcon.onclick = ()=>{
				previewBox.classList.remove("show");
				shadow.classList.remove("shhow");
			}
		}
	</script>
</body>
</html>