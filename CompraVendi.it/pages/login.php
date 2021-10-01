<?php
	session_start();
	include  "../php/util/sessionUtil.php";
	if (isLogged()){
		session_unset(); 
		session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Michele Paolinelli">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="icon" type="image/png" sizes="16x16" href="../css/img/box-arrow-in-right.svg">
		<script  src="../js/utilities.js"></script>	
		<title>Accesso</title>
	</head>
	<body>

		<header>
			<div class="logo-container">
				<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:120px;"> </a>
			</div>
		</header>
		<div class="for-footer">
			<h2>Accedi</h2>
		
			<form action="../php/login_request.php" name="signin_form" method="post" >
				<fieldset  class="innerFieldset">
					<label>
						Username: <br>
						<input name="username"  type="text"  required pattern="[^&amp;&lt;&gt;]+" ><br>
					</label>
					<label>
						Password: <br>
						<input name="password" type="password"  id="password_box"  required pattern="[^&amp;&lt;&gt;]+" minlength="4" maxlength="15">
					</label>
					<input type="checkbox" id ="show_pwd" onclick="show_password('password_box')" ><label for="show_pwd" >Mostra</label><br>
					<br>
					<input type="submit" class="submitBtn" value="Accedi">
					<p>
					Non sei registrato ? <a href="signup.php">Registrati</a>, altrimenti <a href="../index.php">Torna alla Home</a> 
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