<?php
	session_start();
	include  "../util/sessionUtil.php";
	require "../dbConfig.php";
	if (!isLogged()){
		header('Location: ../../index.php');
		exit;
    }
	$newpwd = $_POST['pwd'];
	if($newpwd === ""){
		echo "password is null";
		return;
	}
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
		exit('Could not connect');		
	}
	$actual = "SELECT password from user WHERE username = '".$_SESSION['username']."';";
	$result = $conn->query($actual);
	$row = $result->fetch_assoc();
	if (($row['password']) === $newpwd){
		echo  "Same Password";
		return;
	}
	$newpwd  = $conn->real_escape_string($newpwd);
	$qry = "UPDATE user SET password = '".$newpwd."' WHERE username = '".$_SESSION['username']."';";
	if($conn->query($qry))
		echo "update success";
	else
		echo "error executing query";

?>