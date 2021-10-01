<?php
	session_start();
    include "../php/util/sessionUtil.php";
	include "../php/load_categories.php";
    if (!isLogged()){
			header('location: ../pages/signup.php?errorMessage=Per inserire un annuncio devi essere registrato');
		    exit;
    }
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Michele Paolinelli">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Inserisci Annuncio</title>
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="icon" type="image/png" sizes="16x16" href="../css/img/cloud-plus.svg">
		<script src="../js/utilities.js"></script>	
	</head>
	<body onsubmit="return check_photos()">
		<header>
			<div class="logo-container">
				<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:120px;"> </a>
			</div>
		</header>
		<div class="for-footer">
			<h2><?php echo $_SESSION['username'];?>, inserisci i dati del tuo Annuncio :</h2>
			<form id ="frm_ad" action="../php/insertAd.php" name="insert_form" method="post" enctype="multipart/form-data" >
					<fieldset name="myAd" class="innerFieldset">
						<label>Seleziona la Categoria</label><br>
							<select name="categories_dropdown1" id="categories_dropdonwn1">
							<?php 
								$res = load_categories();
								while($row = $res->fetch_assoc()) {
								echo "<option>".$row['category']."</option>";
								}
								echo "</select>";
							?>
						<label><br>
							Titolo<br>
							<input name="title" size="30" type="text"  required pattern="[^&amp;&lt;&gt;]+"><br>
						</label>
						<label>
							Descrizione<br>
							<textarea name="description" required rows="6" cols="50"></textarea><br>
						</label><hr>
						<label class="myButton">Carica foto (max 5 file, jpeg [2MB]) <input  type="file" onchange="return check_photos()" id="fileUpload[]" name="fileUpload[]" multiple  accept="image/jpeg"></label>
						 <div class="preview">	
							<p>Nessun file selezionato</p>
						</div>
						<label>
							Prezzo<br>
							<input name="price"	id="price"	type="number" min="0" placeholder='&#8364;'  >
						</label>
						<br>
						<label>Regione</label><br>
						<select id="regioni" name="region_dropdown">
							<option value="Abruzzo">Abruzzo</option>
							<option value="Basilicata">Basilicata</option>
							<option value="Calabria">Calabria</option>
							<option value="Campania">Campania</option>
							<option value="Emilia-Romagna">Emilia-Romagna</option>
							<option value="Friuli-Venezia-Giulia">Friuli-Venezia Giulia</option>
							<option value="Lazio">Lazio</option>
							<option value="Liguria">Liguria</option>
							<option value="Lombardia">Lombardia</option>
							<option value="Marche">Marche</option>
							<option value="Molise">Molise</option>
							<option value="Piemonte">Piemonte</option>
							<option value="Puglia">Puglia</option>
							<option value="Sardegna">Sardegna</option>
							<option value="Sicilia">Sicilia</option>
							<option value="Toscana">Toscana</option>
							<option value="Trentino-Alto-Adige">Trentino-Alto Adige</option>
							<option value="Umbria">Umbria</option>
							<option value="Valle-dAosta">Valle d'Aosta</option>
							<option value="Veneto">Veneto</option>
						</select>
						<br>
						<input type="submit" class="submitBtn" value="Inserisci">
						<br>
						<p>
							<a href="../index.php">Torna alla Home</a> 
						</p>
					</fieldset>
					<?php
						if (isset($_GET['errorMessage'])){
										echo '<div class="sign_in_error">';
										echo '<span>' . $_GET['errorMessage'] . '</span>';
										echo '</div>';
						}
					?>
			</form>
		</div>
		<div class="footer">
			<div class="footer-bottom">
				<h5>
					<a href="mailto:info@compravendi.it">| Contatti |</a>
					<a href="./../html/privacy.html" >| Informativa sulla privacy |</a>
					<a href="./../html/terms.html">| Termini di utilizzo |</a>		
					<a href="#top">| Torna Su &#x2934;|</a>
				</h5>
				<small>&copy;CompraVendi.it |  Michele Paolinelli | Progetto Didattico</small>
			</div>
		</div>
	</body>
</html>