<?php
	session_start();
    include  "../php/util/sessionUtil.php";
	include "../php/print_ads.php";
	include "../php/getUserInfo.php";
    if (!isLogged()){
		    header('Location: ../index.php');
		    exit;
    }
	$res = getUserInfo($_SESSION['username']);
	$record = $res->fetch_assoc();			//fetching user infos
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Michele Paolinelli">
		<link rel="icon" type="image/png" sizes="16x16" href="../css/img/gear.svg">
		<link rel="stylesheet" href="../css/compravendi.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/bounce_animation.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/myad_dashboard.css" type="text/css" media="screen">
		<script  src="../js/effects.js"></script>	
		<script  src="../js/utilities.js"></script>	
		<script  src="../js/ajax/update_field.js"></script>
		<script  src="../js/ajax/delete_account.js"></script>	
		<title>Profilo Utente</title>
	</head>
	<body onload="accordion_manager()">
		<header>
			<div class="logo-container">
				<a href="../index.php"> <img  src="../css/img/logo.png" alt="logo.png" style="height:120px;"> </a>
			</div>
			<div id="popup" class="popup">
				<span>Modifiche Effettuate</span>		<!-- showed after an update -->
			</div>
		</header>
		<div class="center for-footer">
			<h2><?php echo $record['username']; ?></h2>
				
			<button class='accordion'>Dati Personali</button>
				<div class='panel' style='display: block;'>
					<table>
						<tr>
							<td><label>Nome</label></td>
							<td><input type='text' disabled value='<?php echo $record['name']; ?>'></td>
							<td></td>
						</tr>
						<tr>
							<td><label>Cognome</label></td>
							<td><input type='text' disabled value='<?php echo $record['surname']; ?>'></td>
							<td></td>
						</tr>
						<tr>
							<td><label>Indirizzo</label></td>
							<td><input type='text' id='addr_field'  value='<?php echo $record['address']; ?>'></td>
							<td><button  type='button' class='myButton' onclick="update_field('addr_field')">Aggiorna</button></td>
						</tr>
						<tr>
							<td><label>E-Mail</label></td>
							<td><input type='email'  id ='email_field' value ='<?php echo $record['email']; ?>'></td>
							<td><button type='button' class='myButton' onclick="update_field('email_field')">Aggiorna</button></td>
						</tr>
						<tr>
							<td><label>Telefono</label></td>
							<td><input type ='tel' pattern='[0-9]{9,10}' id='phone_field' value ='<?php echo $record['phone']; ?>'></td>
							<td><button type='button' class='myButton' onclick="update_field('phone_field')">Aggiorna</button></td>
						</tr>
					</table>
				</div>
			<button class='accordion'>Password</button>
				<div class='panel'>
					<table>
						<tr>
							<td><label>Password</label></td>
							<td><input type='password' id='password_box'  disabled value ='<?php echo $record['password']; ?>'></td>
							<td><input type='checkbox' id='show_pwd' onclick="show_password('password_box')"><label for='show_pwd'>Mostra </label></td>
						</tr>
					</table>
					<details>
						<summary>Modifica Password</summary>
						<table>
							<tr>
								<td><label for='password_box1'>Nuova Password</label></td>
								<td><input type='password' id ='password_box1' minlength="4" maxlength="15"><br></td>
								<td><input type='checkbox' id='checkbox1' onclick="show_password('password_box1')"  ><label for='checkbox1'>Mostra Password</label></td>
								
							</tr>	
							<tr>
								<td><label for='password_box2'>Conferma Password</label></td>
								<td><input type='password' id ='password_box2' onkeyup="errlistener('password_box1','password_box2')" minlength="4" maxlength="15" ></td>
								<td><span class ="text_error" id="pwd_err"></span></td>
							</tr>
							<tr>
								<td><input type='submit' class="myButton" onclick="update_password('password_box1','password_box2')" value="Conferma"></td>
								<td></td>
								<td></td>
							</tr>	
						</table>
					</details>
				</div>	
			<button class='accordion' id="myads" >Gestione Annunci</button>	
				<div class ='panel' id="myadsview">
					<?php 
						myAds();
					?>
				</div>			
			<button class='accordion'>Gestione Account</button>
				<div class='panel'>
					<input type='checkbox' id='checktel' name='checktel' <?php if($record['show_phone'] == 1)	echo " checked";?>
					><label for='checktel'>Mostra il mio numero di 	telefono nelle ricerche degli annunci</label>
					<br>
					<input type='checkbox' id='checkaddr' name='checkaddr'<?php if($record['show_address'] == 1)	echo " checked";?>
					><label for='checkaddr'>Mostra il mio indirizzo nelle ricerche degli annunci</label>
					<br>
					<button  class='myButton' onclick="update_flags('checktel','checkaddr')">Salva Modifiche</button>
					<button class="remove_btn" onclick="delete_user()">Elimina account</button>
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