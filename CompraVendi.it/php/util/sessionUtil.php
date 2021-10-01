<?php
	
	//setSession: set $_SESSION properly
	function setSession($username){
		$_SESSION['username'] = $username;
	}
	//isLogged: check if user has logged in and, if it is the case, returns the username
	function isLogged(){		
		if(isset($_SESSION['username']))
			return $_SESSION['username'];
		else
			return false;
	}

?>