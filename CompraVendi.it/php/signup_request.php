<?php
	require "dbConfig.php";
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	
	$email = $_POST["email"];
	$username = $_POST["username"];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$tel = $_POST['tel'];
	$address = $_POST['address'];
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$email = $conn->real_escape_string($email);
	$username = $conn->real_escape_string($username); 
	$name = $conn->real_escape_string($name);
	$surname = $conn->real_escape_string($surname);
	$password = $conn->real_escape_string($password);
	$repassword = $conn->real_escape_string($repassword);
	$tel = $conn->real_escape_string($tel);
	$address = $conn->real_escape_string($address); 
	
	if($password != $repassword){
		$errorMessage = " Password mismatch ";
	}
	else{
		$user_check_query = "SELECT * FROM user	WHERE username='$username' OR email='$email' LIMIT 1";
		$result = $conn->query($user_check_query);
		$numRow = mysqli_num_rows($result);
		if ($numRow > 0) { // if user exists
			$errorMessage = "username or email already exists";
			header('location: ../pages/signup.php?errorMessage=' . $errorMessage );
		}
		else{
			$sql = "INSERT INTO user (username,password,name,surname,address,email,phone) 
					VALUES ('" .$username. "','" .$password. "','".$name."','".$surname."','".$address."','".$email."','".$tel."')";
			$preferences ="INSERT INTO user_preferences (username_fk) VALUES ('".$username."')";
			if ($conn->query($sql) === TRUE) {
				mkdir("../img/ads/$username", 0700);
				$conn ->query($preferences);
			} else {
				$errorMessage = "Error executing query - user directory not created ";
			}
		}
	}
	if($errorMessage != "")
		header('location: ../pages/signup.php?errorMessage=' . $errorMessage );
	else
		header('location: ../index.php?register=true');
	$conn->close();
?>