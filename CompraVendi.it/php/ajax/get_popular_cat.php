<?php
	include "../load_categories.php";
	$howmany = $_REQUEST['howmany'];
	$result = load_popular_categories($howmany);
	$row = $result->fetch_assoc();
	$returnstring = $row['id'].",".$row['category'].";";
	while($row = $result->fetch_assoc()){
		$returnstring = $returnstring.$row['id'].",";
		$returnstring = $returnstring.$row['category'].";";
	}
	echo $returnstring;
?>