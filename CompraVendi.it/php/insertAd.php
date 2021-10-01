<?php 
	session_start();
	require "dbConfig.php";
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$username= $_SESSION['username'];
	$cat = $_POST['categories_dropdown1'];
	$title = $_POST['title'];
	$descr = $_POST['description'];
	$price = $_POST['price'];
	$region = $_POST['region_dropdown'];

	$cat = $conn->real_escape_string($cat);
	$title = $conn->real_escape_string($title);
	$descr = $conn->real_escape_string($descr);
	$price = $conn->real_escape_string($price);
	$region = $conn->real_escape_string($region);
	
	$find_category_id = "SELECT id_category FROM category where category='$cat' LIMIT 1;";
	$result = $conn->query($find_category_id);
	$row = $result->fetch_assoc();
	$cat_id= $row["id_category"];

	$target_dir="../img/ads/$username/$title/";
	$tocreate_dir = $target_dir;
	/*new code*/
	$target_dir = urlencode($target_dir); //db is filled with encoded path
	/*new code end*/
	$insert_query = " INSERT INTO ad (title,description,price,photo,username,item_region,id_category) 
						VALUES ('$title','$descr','$price','$target_dir','$username','$region','$cat_id'); ";
	
	if($conn->query($insert_query)){
			mkdir($tocreate_dir, 0700);
			$errorMessage = uploadPhotos($tocreate_dir);
	}
	else
		$errorMessage = "databaseError";
	
	if($errorMessage != ""){
		$errorMessage = urlencode($errorMessage);
		header('location: ../index.php?errorMessage=' . $errorMessage );
	}
	else{
		header('location: ../index.php?ad=true');
	}
		
function uploadPhotos($dir){
	$files = rearrange($_FILES);
	$count = 0;
	foreach ($files as $file) {
		if (UPLOAD_ERR_OK === $file['error']) {
			$fileName = basename($file['name']);
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext !="gif"){
				return  "imageError";
			}
			else{
				$count++;
				$newName = "img".$count.".".$ext;
				move_uploaded_file($file['tmp_name'], $dir.DIRECTORY_SEPARATOR.$newName);
			}
		}
	}
}
function rearrange($files){
    foreach($files as $key1 => $val1) {
        foreach($val1 as $key2 => $val2) {
            for ($i = 0, $count = count($val2); $i < $count; $i++) {
                $newFiles[$i][$key2] = $val2[$i];
            }
        }
    }
    return $newFiles;
}
?>
