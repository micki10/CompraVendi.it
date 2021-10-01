<?php
	session_start();
    require_once "../php/util/sessionUtil.php";
	require_once "../php/print_ads.php";
	require_once "../php/load_categories.php";
    if (!isLogged()){
			header('location: ../pages/signup.php?errorMessage=FORBIDDEN');
		    exit;
    }
	if (!isset($_GET['id'])){
		echo "FORBIDDEN";
		exit;
	}
	$info = getAdInfo($_GET['id']);
	if($info == NULL){
		echo "AD NOT FOUND";
		exit;
	}
	else{
		$info = $info->fetch_assoc();
		if($info['username'] != $_SESSION['username']){
			echo "THIS IS NOT YOUR AD !!!";
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Michele Paolinelli">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Modifica Annuncio</title>
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/myad_dashboard.css" type="text/css" media="screen">
		<link rel="icon" type="image/png" sizes="16x16" href="../css/img/wrench.svg">
		<script  src="../js/edit.js"></script>	
		<script  src="../js/utilities.js"></script>
	</head>
	<body onload = "showadImages('<?php echo  $info['photo'];  ?>')">
		<header>
			<div class="logo-container">
				<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:120px;"> </a>
			</div>
		</header>
		<div class ="for-footer">
			<h3>Modifica Annuncio</h3>
			<form name="update_form" id="update_form"  method="post" enctype="multipart/form-data">
				<fieldset class="innerFieldset" style ="width: 600px;">
						<label>Categoria</label><br>
							<select id="categories_dropdonwn1" disabled>
								<option><?php echo get_category_name($info['id_category']);?></option>
							</select>
							<br>
					<label>Titolo</label>
					<br>
					<input type='text' value="<?php echo $info['title']; ?>" disabled><br>
						<label>
							Descrizione
						</label>
						<br>
						<textarea name="description" required rows="6" cols="60" ><?php echo $info['description']; ?></textarea>
						<br>
					<p>Foto</p>
					<div id="photo_container">
							<div class="preview"></div>
							<label for="fileUpload[]" id="inputfile" style= "cursor: pointer;">  
								<img class="img_format" src = "../css/img/add-svgrepo-com.svg" alt="addimage">
								<input type ="file" id="fileUpload[]" name="fileUpload"  accept="image/jpeg" onchange="draw_preview(this,1)">
								
							</label>
							
					</div>
					<br>
					<label>
						Prezzo
					</label>
					<br>
					<input name="price"	id="price"	type="number"  min="0"  value='<?php echo $info['price']; ?>' placeholder='&#8364;' >
					<br>
					<label>Regione</label>
					<br>
					<select id="regioni"  disabled>
					<option><?php echo $info['item_region']; ?></option> 
					</select>
					<br><br>
					<input type="submit" class="submitBtn" value="Aggiorna" onclick= "update_ad()" >
					<a href="./userProfile.php">Torna Indietro</a>
				</fieldset>
			</form>

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
	<script src="../js/ajax/update_ad.js"></script>
	</body>
</html>