<?php
	require_once "../print_ads.php";
	require_once "../load_categories.php";

	$lim = $_REQUEST['limit'];
	$off = $_REQUEST['offset'];
	
	if(isset($_REQUEST['search']))
		$text = $_REQUEST['search'];
	else
		$text = "";
	if(isset($_REQUEST['region']))
		$region = $_REQUEST['region'];
	else
		$region = "Italia";
	if(isset($_REQUEST['category']))
		$category = $_REQUEST['category'];
	else
		$category = "Tutte";
	if(isset($_REQUEST['order']))
		$ord  = $_REQUEST['order'];
	else
		$ord = NULL;
	
	print_ads($text,$region,$category,$ord,$lim,$off);
	exit;
?>