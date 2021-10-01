<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
		<meta name = "author" content = "Michele Paolinelli">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="icon" type="image/png" sizes="16x16" href="../css/img/pen.svg">
		<script  src="../js/utilities.js"></script>	
		<script  src="../js/ajax/check_user.js"></script>	
		<title>Registrati</title>
	</head>
	<body onsubmit="return check_pwd()">
		<header>
			<div class="logo-container">
				<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:120px;"> </a>
			</div>
		</header>
		<div class="for-footer">
			<h2>Registrati</h2>
			<form id ="frm" action="../php/signup_request.php" name="signin_form" method="post" >

						<fieldset name="myData" class="innerFieldset">
							<label>
								E-mail: *<br>
								<input name="email" size="30" type="email"  required pattern="[^&amp;&lt;&gt;]+"><br>
							</label>
							<label>
								Username: *<br>
								<input onkeyup="check_username(this.value,'show_error')"   name="username" size="30" type="text"  required pattern="[^&amp;&lt;&gt;]+"><span id="show_error" class="text_error"></span>
							</label>
							<br>
							<label>
								Nome: *<br>
								<input name="name" size="15" type="text"  placeholder="Mario"
											pattern="[a-zA-Z\s]+" required><br>
							</label>
							<label>
								Cognome: *<br>
								<input name="surname" size="15" type="text" placeholder="Rossi"
											pattern="[a-zA-Z\s]+" required><br>
							</label>
							<label>
								Password: *<br>
								<input id="password_box1" name="password" size="30" type="password" required pattern="[^&amp;&lt;&gt;]+" minlength="4" maxlength="15" >
							</label>
							<input type="checkbox" id="show_pwd" onclick="show_password('password_box1')"><label for='show_pwd'>Mostra</label><br>
							<label>
								Conferma Password: *<br>
								<input id="password_box2" name="repassword" size="30" type="password" onkeyup="return errlistener('password_box1','password_box2')" required pattern="[^&amp;&lt;&gt;]+" minlength="4" maxlength="15" ><span id="pwd_err" class="text_error"></span><br>
							</label>
							<label>
								Tel: <br>
								<input name="tel" size="15" type="tel" placeholder="Es: 3401234567" 
											pattern="[0-9]{9,10}" ><br>
							</label>
							<label>
								Indirizzo:<br>
								<input name="address" size="35"  type="text" pattern="[^&amp;&lt;&gt;]+"><br>
							</label>
							<div class="text_error">
								<sup>*</sup> Campi obbligatori
							</div><br>
							<input type='submit' class="submitBtn" value="Registrati" >
							<p>
							Sei gi&agrave; registrato ? <a href="login.php">Effettua il login</a> , altrimenti <a href="../index.php">Torna alla Home</a> 
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