<?php
	session_start();
    include  "../util/sessionUtil.php";
	include "../getUserInfo.php";
    if (!isLogged()){
		    header('Location: ../../index.php');
		    exit;
    }	
	$val = $_REQUEST['value'];
	$type = $_REQUEST['type'];
	$user = $_SESSION['username'];
	require "../dbConfig.php";
	switch($type){
		case 'addr_field':
			$field = 'address';
			break;
		case 'email_field':
			$field = 'email';
			break;
		case 'phone_field':
			$field = 'phone';
	}
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
		exit('Could not connect');		
	}
	$actual = "SELECT * from user WHERE username = '".$_SESSION['username']."';";
	$result = $conn->query($actual);
	$row = $result->fetch_assoc();
	if (($row[$field]) === $val){
		echo  "same value";
		return;
	}
	$val  = $conn->real_escape_string($val);
	$qry = "UPDATE user SET ".$field." = '".$val."' WHERE username = '".$_SESSION['username']."';";
	if($conn->query($qry))
		echo "update success";
	else
		echo "error executing query";
?>