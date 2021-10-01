<?php
	function get_category_name($id){			//given an id , return category name
		$result = load_categories();
		while($row = $result->fetch_assoc()) {
			if($row['id_category'] == $id)
				return $row['category'];
		}
		return "Tutte";
	}
	
	function load_categories(){		//used to populate the <select> 
	
		require "dBConfig.php";
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		  return NULL;
		}
		$sql = "SELECT *  FROM category order by category ASC";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		} else {
		return NULL;
		}
		$conn->close();
	}
	
	function load_popular_categories($howmany){		//return the first $howmany categories ordered by number of ads 
		if( $howmany <= 0)
			return NULL;
		require "dBConfig.php";
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		  return NULL;
		}
		$sql = "SELECT ad.id_category as id, category, count(*) as quanti 
				FROM ad INNER JOIN category on(ad.id_category = category.id_category) 
				GROUP BY ad.id_category 
				ORDER BY quanti DESC
				LIMIT ".$howmany.";";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return NULL;
		}
		$conn->close();
	}
	
?>