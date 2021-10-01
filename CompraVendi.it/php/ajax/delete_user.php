
<?php 
  	session_start();
	include "../util/sessionUtil.php";
	if (!isLogged()){
		header('location: ../../index.php');
		exit;
    }	
	$username= $_SESSION['username'];
	$target_dir="../../img/ads/$username/";
	
	delete_all($target_dir);
	echo delete_all_from_db();
	session_unset(); 
    session_destroy();
	exit;
	
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

function delete_all_from_db() {
	require "../dbConfig.php";	
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	/*db is configured to cascade ONDELETE ,so all records in ad table will be dropped*/
	$remove_user_qry = "DELETE FROM user WHERE username = '".$_SESSION['username']."' ;";
	
	if($conn->query($remove_user_qry))
		return "account rimosso correttamente";
	else
		return "something went wrong";
}

  
?> 
