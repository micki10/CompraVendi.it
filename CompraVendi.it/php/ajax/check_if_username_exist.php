<?php
	$var = $_REQUEST['value'];
	$hint = "";	
	require "../dbConfig.php";
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
		exit('Could not connect');		
	}
	$sql = "SELECT * FROM user WHERE username = '".$var."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
		$hint = "Username in uso";
	echo $hint;
?>