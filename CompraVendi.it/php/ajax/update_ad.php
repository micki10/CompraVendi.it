<?php

	require_once "../dbConfig.php";
	require_once "../print_ads.php";
	
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$info = getAdInfo($id)->fetch_assoc();
		$info['photo'] = urldecode($info['photo']);
	}
	else{
		echo "no ad identifier provided. aborting ...";
		exit;
	}
	$request = $_POST['request'];
	
	if($request == 1){ // image upload
		if($_FILES['fileUpload']['name'] != ""){
			$howmany = count_images("../".$info['photo']);
			if($howmany >= 5){
				echo "limit of 5 files reached";
				exit;
			}
			 //$filename = $_FILES['fileUpload']['name'];
			 $extension = pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
			/* Location */
			$newName = "img".($howmany+1);
			$location = "../".$info['photo'].$newName.".".$extension;
			
			$uploadOk = 1;
			$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

			// Check image format
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			 && $imageFileType != "gif" ) {
				 $uploadOk = 0;
			}

			if($uploadOk == 0){
				 echo "error uploading";
			}else{
				 /* Upload file */
				 if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$location)){
					 echo $location;
				 }else{
					 echo "error uploading";
				 }
			}
		}
	}
	if($request == 2){ //image delete
		$dir = "../".$info['photo'];
		$path = "../".$info['photo'].$_POST['path']; //$_POST['path'] is the file name
		$return_text = 0;
		// Check file exist or not
		if( file_exists($path) ){
		   // Remove file
			unlink($path);
			//reorder($dir,$_POST['path']);
			img_rename($dir);
		   // Set status
		   $return_text = 1;
		}else{
		   // Set status
		   $return_text = 0;
		}
		// Return status
		echo $return_text;
		exit; 
	}

	if($request == 3){ // price and/or description edit
		$description = $_POST['description'];
		$price = $_POST ['price'];
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
			exit('Could not connect');		
		}
		$description = $conn->real_escape_string($description);
		$price = $conn->real_escape_string($price);
		$id = $conn->real_escape_string($id);
		$actual = "SELECT description, price FROM ad WHERE id = '".$id."';";
		$result = $conn->query($actual);
		$row = $result->fetch_assoc();
		if (($row['price']) === $price && ($row['description']) == $description){
			echo  "same value";
			return;
		}
		$qry = "UPDATE ad SET description = '".$description."' , price = '".$price."'  WHERE id = '".$id."';";
		if($conn->query($qry))
			echo "update success";
		else
			echo "error executing query";
	}

function count_images($dir){ //to check maximum file allowed 
		$files = array_diff(scandir($dir, 1), array('..', '.'));
		return count($files);
}

function img_rename($dir){  //keep ordered images file name
	$count = 1;
	if ($handle = opendir($dir)) {
		while ($file = readdir($handle)) {
			if($file != "." && $file != ".."){
				$newName = "img".$count++.".jpg";
				rename($dir.$file, $dir.$newName);
			}
		}
    closedir($handle);
	}
}
?>