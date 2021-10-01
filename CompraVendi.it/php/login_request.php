<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$errorMessage = login($username, $password);
	if($errorMessage === null)
		header('location: ../index.php?login=true');
	else
		header('location: ../pages/login.php?errorMessage=' . $errorMessage );

	function login($username, $password){   
		if ($username != null && $password != null){
			$userId = authenticate($username, $password);
    		if ($userId != -1 ){
    			session_start();
				$_SESSION['username'] = $username;
    			return null;
    		}
	
    	} else
    		return 'You should insert something';
    	
    	return 'Username and password not valid.';
	}
	function authenticate ($username, $password){ 
		require "dbConfig.php";	
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$username = $conn->real_escape_string($username);
		$password = $conn->real_escape_string($password);

		$sql = "select * from user where username='" . $username . "' AND password='" . $password . "'";

		$result = $conn->query($sql);
		$numRow = mysqli_num_rows($result);
		if ($numRow != 1)
			return -1;
		$conn->close();
		$userRow = $result->fetch_assoc();
		$conn->close();
		return $userRow['username'];
	}
?>