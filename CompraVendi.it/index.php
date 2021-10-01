<?php 
	include "./php/load_categories.php";
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Michele Paolinelli">
    	<meta name = "keywords" content = "compra,vendi,usato,nuovo,acquista,annuncio,prezzo,occasione">
   	 	<link rel="icon" type="image/png" sizes="16x16" href="./css/img/house.svg">
		<link rel="href" href="./img/italia_regioni.svg" type="image/svg+xml">
		<link rel="stylesheet" href="./css/compravendi.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/images.css" type="text/css" media="screen">
		<script  src="./js/utilities.js"></script>		
		<script  src="./js/effects.js"></script>
		<script  src="./js/ajax/draw_popular_categories.js"></script>
		<title>CompraVendi - Compra e vendi in modo sostenibile</title>
	</head>
	<?php	
		if(isset($_GET['login'])){
			echo	"<body onload='showToast(".'&apos;Login Effettuato&apos;'.",1)'>";
		}
		else	
		if(isset($_GET['ad'])){
			echo	"<body onload='showToast(".'&apos;Annuncio Inserito&apos;'.",1)'>";
		}
		else
		if(isset($_GET['errorMessage'])){
			echo	"<body   onload=showToast('".$_GET['errorMessage']."',0)>";
		}
		else
			echo "<body>";
		
		if(isset($_GET['register'])){
			header('location: ./pages/login.php');
		}

	?>
		<header>
			<div id="popup" class = 'popup'>
			</div>
			<div class="logo-container">
				<a href="index.php"> <img  src="./css/img/logo.png" alt="logo.png"> </a>
			</div>
			<div class="navbar">
				<a href="./pages/loadAds.php">Cerca Annunci</a>
				<a href="./pages/insertform.php">Inserisci Annuncio</a>
				<a href="./pages/loadAds.php?order=latest">Ultimi inseriti</a>
				<?php
					session_start();
					include "./php/util/sessionUtil.php";
					if(!isLogged()){
						echo"	<a href='./pages/login.php' id='login_btn'>Login</a>";
						echo"	<a href='./pages/signup.php' id='reg_btn'>Registrati</a>";
					}
					else{
							echo	"<div class='dropdown'>";
								echo	"<button class ='dropbtn'>";
								echo 	$_SESSION['username'];
								echo 	"</button>";
								echo 	"<div class='dropdown-content'>";
								echo	"<a href='./pages/userProfile.php'>Profilo</a>";
								echo	"<a href='./pages/userProfile.php#myads'>I miei annunci</a>";
								echo 	"<a href='./php/logout.php'>Logout</a>";
								echo 	"</div>";
							echo	"</div>";
					}
				?>
					<form action="./pages/loadAds.php" method="GET">
					<div class="search-container">
							<input type="text" placeholder="Cerca.." name="search" pattern="[^&amp;&lt;&gt;]+">
							<button type="submit" class="submitBtn">Cerca</button>
					</div>
					</form>
			</div>
		</header>
		<div class="page_wrapper ">
			<div class="container_mappa ">
				<object id="mappa" name="mapparegioni" type="image/svg+xml" data="./img/italia_regioni.svg">
				Your browser does not support SVG
				</object>
			</div>
			<div class="popular_categories">
				<h2>Inizia ora !</h2>
				<p>Utilizza la barra per cercare tramite una parola chiave, oppure esplora per categoria.</p>
				<hr>
				<h3>Categorie in primo piano</h3>
						<!-- filled onload with ajax-->
			</div>
		</div>
		<footer class="footer">
			<div class="footer-bottom">
				<h5>
					<a href="mailto:info@compravendi.it">| Contatti |</a>
					<a href="./html/privacy.html" >| Informativa sulla privacy |</a>
					<a href="./html/terms.html">| Termini di utilizzo |</a>	
					<a href="./html/wiki.html">| Istruzioni |</a>						
					<a href="#top">| Torna Su &#x2934;|</a>
				</h5>
				<small>&copy;CompraVendi.it |  Michele Paolinelli | Progetto Didattico</small>
			</div>
		</footer>
		<script>
			draw_popular_categories(4);
		</script>
	</body>
</html>