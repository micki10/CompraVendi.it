<?php
	$ad_id = $_REQUEST['id'];
	require_once "../dbConfig.php";	
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	
	$fetch_dir = "SELECT photo FROM ad WHERE id= '".$ad_id."' ;";
	$target_dir= $conn->query($fetch_dir);
	$target_dir = $target_dir->fetch_assoc();
	$target_dir = "../".urldecode($target_dir['photo']);
	delete_all($target_dir); //distruttiva !!!
	echo delete_ad_from_db($conn,$ad_id);
	
	
function delete_ad_from_db($db,$id){
	
	$remove_ad_qry = "DELETE FROM ad WHERE id = '".$id."' ;";
	if($db->query($remove_ad_qry))
		return "Annuncio rimosso correttamente";
	else
		return "something went wrong";
}
	
function delete_all($str) { 
    if (is_file($str)) {       
        return unlink($str); 
    } 
    elseif (is_dir($str)) {  
        $scan = glob(rtrim($str, '/').'/*'); 
        foreach($scan as $index=>$path) { 
            delete_all($path); 
        } 
        return @rmdir($str); 
    } 
} 
?>