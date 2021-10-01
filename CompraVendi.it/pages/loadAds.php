<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Michele Paolinelli">
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/slider.css" type="text/css" media="screen">
		<script  src="../js/effects.js"></script>	
		<script  src="../js/utilities.js"></script>	
		<script  src="../js/search_page.js"></script>
		<link rel="icon" type="image/png" sizes="16x16" href="../css/img/bicycle.svg">
		<title>Annunci </title>
	</head>
	<body onload = "initialize()"> <!-- onscroll="check_endofpage()" -->
		<header>
			<div class="logo-container">
				<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:120px;"> </a>
			</div>
			<div class="navbar">
					<?php
						session_start();
						include "../php/util/sessionUtil.php";
						function update_param($name, $value)
						{
							$params = $_GET;
							unset($params[$name]);
							$params[$name] = $value;
							return basename($_SERVER['PHP_SELF']).'?'.http_build_query($params);
						}
						if(!isLogged()){
							echo"	<a href='./login.php' id='login_btn'>Login</a>";
							echo"	<a href='./signup.php' id='reg_btn'>Registrati</a>";
						}
						else{
							echo	"<div class='dropdown'>";
							echo	"<button class ='dropbtn'>";
							echo 	$_SESSION['username'];
							echo 	"</button>";
							echo 	"<div class='dropdown-content'>";
							echo	"<a href='./userProfile.php'>Profilo</a>";
							echo	"<a href='./userProfile.php#myads'>I miei annunci</a>";
							echo	"<a href='./insertform.php' >Inserisci Annuncio</a>";
							echo 	"<a href='../php/logout.php'>Logout</a>";
							echo 	"</div>";
							echo	"</div>";
						}
					?>
					<form id="mainsearch" method="get" name="mainsearch_form">
						<label>Cosa Cerchi ?</label>
						<input type="text" id="searchBar" name ="search" placeholder="Cerca ..." pattern="[^&amp;&lt;&gt;]+">
						<label>Categoria</label>
						<select id="categories_dropdown" name="category">
							<option id="Tutte">Tutte</option>
							<?php 
								include "../php/load_categories.php";
								$res = load_categories();
								while($row = $res->fetch_assoc()) {
								echo "<option id=".$row['id_category']." value=".$row['id_category'].">".$row['category']."</option>";
								}
								echo "</select>";
							?>
						<label>Regione</label>
						<select id="regioni" name="region">
						<option id="Italia" value="Italia">Italia</option>
						<option id="Abruzzo" value="Abruzzo">Abruzzo</option>
						<option id="Basilicata" value="Basilicata">Basilicata</option>
						<option id="Calabria" value="Calabria" >Calabria</option>
						<option id="Campania" value="Campania">Campania</option>
						<option id="Emilia-Romagna" value="Emilia-Romagna">Emilia-Romagna</option>
						<option id="Friuli-Venezia-Giulia" value="Friuli-Venezia-Giulia">Friuli-Venezia Giulia</option>
						<option id="Lazio" value="Lazio">Lazio</option>
						<option id="Liguria" value="Liguria">Liguria</option>
						<option id="Lombardia" value="Lombardia">Lombardia</option>
						<option id="Marche" value="Marche">Marche</option>
						<option id="Molise" value="Molise">Molise</option>
						<option id="Piemonte" value="Piemonte">Piemonte</option>
						<option id="Puglia" value="Puglia">Puglia</option>
						<option id="Sardegna" value="Sardegna">Sardegna</option>
						<option id="Sicilia" value="Sicilia">Sicilia</option>
						<option id="Toscana" value="Toscana">Toscana</option>
						<option id="Trentino-Alto-Adige" value="Trentino-Alto-Adige">Trentino-Alto Adige</option>
						<option id="Umbria" value="Umbria">Umbria</option>
						<option id="Valle-dAosta" value="Valle-dAosta">Valle d'Aosta</option>
						<option id="Veneto" value="Veneto">Veneto</option>
						</select>
						<input type="submit" id="top_bar_btn" class="submitBtn" value="Cerca">
					</form>
			</div>
		</header>
		<div class="wrapper for-footer">
			<div class="leftcolumnwrap">
				<div class="leftcolumn">
					<div class="searchfilters">
						<h4 style="text-align:center;">Filtri Ricerca:</h4>
						<label for="minprice">Prezzo min</label>
						<input class="slider" type="range" min="0"  step="1" value="0" id="minprice" onmousemove="slider('minprice','selected_minprice')"><label id="selected_minprice"></label><br>
						<label for="maxprice">Prezzo max</label>
						<input class="slider" type="range" min="0"  step="1" id="maxprice" onmousemove="slider('maxprice','selected_maxprice')"><label id="selected_maxprice"></label><br>
						<button class="myButton" type="button" onclick="filter('minprice','maxprice')">Applica</button>
					</div>
				</div>
			</div>
			<div class="contentwrap">
				<div class ="content_header">
					<div class="parameters">
						<span class="regionmap"><a href="<?php echo update_param('region','Italia'); ?>" >Regione: Italia</a>
						<?php
							if(isset($_GET['region']))
								if($_GET['region'] != 'Italia')
								echo "<img src='../css/img/arrow-right.svg' alt='arrow-right' ><a href='' >".$_GET['region']."</a>";
						?>
						</span>
						&nbsp;
						<span class = "regionmap" id="categoryReset"><a href ="<?php echo update_param('category','Tutte'); ?>" >Categoria: Tutte</a>
							<?php 
								if(isset($_GET['category']))
									if($_GET['category'] != "Tutte")
									echo "<img src='../css/img/arrow-right.svg' alt='arrow-right' ><a href='' >".get_category_name($_GET['category'])."</a>";
							?>
						</span>
						&nbsp;
						<span class = "regionmap" id="resetFilter"></span>
						&nbsp;
						<?php if(isset($_GET['search']) && ($_GET['search'] != "")){
							$newurl = update_param('search','');
							echo " <span class = 'regionmap'><a href='".$newurl."'>Ricerca : ".$_GET['search']." <img src='../css/img/x-circle.svg' alt='resetsearch'></a>
									</span>"; 
						}
						?>
					</div>
					<label for="order_dropdown" id="order_label">Ordina Per</label>
					<select id="order_dropdown" onchange = "order_select_handler(this[selectedIndex])">
						<option  id="default">Default</option>
						<option  id="asc">Prezzo Crescente</option>
						<option	 id="desc">Prezzo Decrescente</option>
						<option  id="latest">Recenti</option>
					</select>
				</div>
				<div class="content">

				</div>
			</div>
			<div class="rightcolumnwrap">
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
		<script>
			loading = true;
			load_more_ads();
		</script>
	</body>
</html>