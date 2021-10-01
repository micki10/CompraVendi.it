<?php
	require_once "../php/print_ads.php";
	require_once "../php/getUserInfo.php";
	require_once "../php/load_categories.php";
	
	$res = "";
	$row = "";
	if(isset($_GET['id'])){
			$res = getAdInfo($_GET['id']);
			if($res === NULL){
				echo "AD NOT FOUND";
				exit;
			}
			else{
			$row = $res->fetch_assoc();
			$user_row = getUserInfo($row['username'])->fetch_assoc();
			}
	}
	else{
		echo "FORBIDDEN";	
		exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Michele Paolinelli">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/images.css" type="text/css" media="screen">
		<script src="../js/effects.js"></script>	
		<script src="../js/utilities.js"></script>	
		<script src="../js/slideshow.js"></script>	
		<?php echo"<title>".$row['title']." - Dettagli Annuncio</title>";?>
	</head>
	<?php 
		echo "<body onload = ".'"showimages('."'".$row['photo']."'".')"'."> ";
	?>
		<header>
			<div class="logo-container">
			<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:80px;"> </a>
			</div>
		</header>
		<div class = "modal-box">
		</div>
		<div class = "wrapper for-footer">
			<div class="leftcolumnwrap" style="width: 15%;">
				<div class="leftcolumn">
				</div>
			</div>
			<div class="contentwrap" style="width: 70%; max-width: 940px;" >
				<div class="content" style="background : rgba(204, 255, 221, 0.5);">
					<div class="grid-container ">
						<div class="slideshow">
							<div class= "slideshow-container">
							<div class="prev" onclick="previous()">&#10094;</div>
							<div class="next" onclick="next()">&#10095;</div>
							</div>
						</div>
						<div class="details">
							<h3><?php echo $row['title']; ?></h3>
								<p>Inserito da 
									<?php echo $row['username']." il ".$row['ad_tstamp']." in ".get_category_name($row['id_category']); ?>
								</p>
								<br>
								<h2 style="color:#22ddaa;"><?php echo $row['price']."&#8364;"; ?>
								</h2>
								<br>
								<p><img src="../css/img/geo-alt.svg" alt="position"> <?php echo $row['item_region']; ?>
								</p>
								<br>
								<h4>Descrizione</h4>
								<p><?php echo $row['description']; ?></p>
						</div>
						<div class="bottom">
							<?php
							echo "<a href='mailto:".$row['email']."' class='submitBtn' >Contatta il proprietario</a>";
							?><br>
							<button class ="myButton"<?php if($user_row['show_phone'] == 0) echo " disabled";?>
							 onclick = "showpopup('phone_pup')">Mostra Telefono</button>
							 <span class="popuptext" id="phone_pup"><?php if($user_row['show_phone'] == 1) echo $user_row['phone'];?></span>
							 <br>
							<button class ="myButton"<?php if($user_row['show_address'] == 0) echo " disabled";?> onclick="showpopup('addr_pup')" >Mostra Indirizzo</button>
							<span class="popuptext" id="addr_pup"><?php if($user_row['show_address'] == 1) echo $user_row['address'];?></span>
						</div>
					</div>	
				</div>
			</div>
			<div class="rightcolumnwrap" style = "width:15%;">
				<div class="rightcolumn">
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="footer-bottom">
				<h5>
					<a href="mailto:info@compravendi.it">| Contatti |</a>
					<a href="./../html/privacy.html" >| Informativa sulla privacy |</a>
					<a href="./../html/terms.html">| Termini di utilizzo |</a>		
					<a href="#top">| Torna Su &#x2934;|</a>
				</h5>
				<small>&copy;CompraVendi.it |  Michele Paolinelli | Progetto Didattico</small>
			</div>
		</footer>
	</body>
</html>