<?php
	function getUserInfo($utente){
		require "dBConfig.php";
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		  return NULL;
		}
		$sql = "SELECT *  FROM user INNER JOIN user_preferences ON(user.username = user_preferences.username_fk) 
				WHERE username = '$utente'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		} else {
		return NULL;
		}
		$conn->close();
	}
?>