<?php 
	session_start();
    include  "../util/sessionUtil.php";
	include "../getUserInfo.php";
    if (!isLogged()){
		    header('Location: ../../index.php');
		    exit;
    }	
	$phone = $_REQUEST['phone'];
	$addr = $_REQUEST['addr'];
	require "../dbConfig.php";
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
		exit('Could not connect');		
	}
	$actual = "SELECT show_phone, show_address FROM user_preferences WHERE username_fk = '".$_SESSION['username']."' ;";
	$result = $conn->query($actual);
	$row = $result->fetch_assoc();
	if($row['show_phone'] == $phone && $row['show_address'] == $addr){
		echo "same value";
		return;
	}
	$update_qry = "UPDATE user_preferences SET show_phone = ".$phone.", show_address = ".$addr." WHERE username_fk = '".$_SESSION['username']."' ;";
	if($conn->query($update_qry))
		echo "update success";
	else
		echo "error executing query";
	
	return;
?>