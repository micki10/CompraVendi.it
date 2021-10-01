<?php
	//main function to append elements to loadAds.php. on page onload it's called once, then via ajax request it append results.
	function print_ads($text,$region,$category,$ord,$limit,$offset){ //	parameters : $_GET parameters that specify "where" clause and "order by" clause in select query
		require "dBConfig.php";
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			return NULL;
		}
		$whereclause = NULL;
		if($ord != NULL){ 
			switch($ord)
			{
				case "latest" :
					$ord = "ORDER BY ad_tstamp DESC ";
					break;
				case "desc" :
					$ord = "ORDER BY price DESC ";
					break;
				case "asc" :
					$ord = "ORDER BY price ASC ";
					break;
				default:
					$ord = "";
					break;
			}
		}
		if($limit != NULL)
			$ord = $ord."LIMIT ".$limit." OFFSET ".$offset;
		$condition = "WHERE " ;
		$text = $conn->real_escape_string($text);
		$expr = "'%".$text."%'";
			$condition = $condition."title COLLATE UTF8_GENERAL_CI LIKE ".$expr." ";
		if($region != "Italia")
			$condition = $condition."AND item_region ='".$region."' ";
		if($category != "Tutte")
			$condition = $condition."AND ad.id_category ='".$category."' ";
		
		$orderclause= $ord;
		$res = retrieve_ads($condition,$ord);
		/*if($offset == 0){ //on top of the first results	
			echo	"<h3>Annunci in ".$region."</h3>";
			echo 	"<h5 style='text-align:center;'>Risulati per '".$text."' in ".get_category_name($category)."</h5>"; 
		}*/
		if($res != NULL){ //if some records found
			$numrow = $res->num_rows;
				while($row = $res->fetch_assoc()) {
					echo 	"<div class='ad_container' id='".$row['id']."'> 	";
					echo	"	<div class='ad_section'>	";
					echo	"		<h4>".$row['title']."</h4><br>	";	
					echo	"<object data='".str_replace(" ", "%20", urldecode($row['photo']))."img1.jpg'>";
					echo 	"		<img src='../css/img/placeholder-480x320-1.jpg' alt='immagine' > ";
					echo 	"</object>";
					echo	"	</div>";
					echo	"	<div class='ad_section'>";
					echo	"		<h4>Descrizione</h4>";
					echo	"		<div class='ad_description'>";
					echo	"			<p>".$row['description']."</p>";
					echo	"		</div>";
					echo	"		<label>Inserito da ".$row['username']." il </label><label id ='timestmp_".$row['id']."'>".$row['ad_tstamp']."</label>";

					echo	"</div>";
					echo	"<div class='ad_section'>";
					echo	"		<h4>Dettagli</h4>";
					echo	"<table>";
					echo	"<tr><td><h5>Prezzo: </h5></td><td><p id='price_".$row['id']."'>".$row['price']."&#8364;</p></td></tr>";
					echo	"<tr><td><h5>Regione: </h5></td><td><p id='itm-reg_".$row['id']."'>".$row['item_region']."</p></td></tr>";
					echo	"<tr><td><h5>Categoria: </h5></td><td><p>".$row['category']."</p></td></tr>";
					echo 	"</table>";
					echo	"<button class='myButton' onclick=\"window.open('./details.php?id=".$row['id']."')\">Apri Annuncio</button>";
					echo	"</div>";
					echo	"</div>";
				}
			}
			else	
				/*if($offset == 0) //if at the first load no ad were found
					echo "endoffile"; //<p id='results_number'>Nessun risultato.</p>";
				else*/
					echo "endoffile"; //no more records found  //used by the function to append final message
			//echo	"<p id='results_number'>".$numrow." risultati mostrati.</p>";
		//else 
	}

	function retrieve_ads($where,$order){			//used to return all records from db parameting the where an order clause
		require "dBConfig.php";
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			return NULL;
		}		
		$default_query = "	SELECT id, title, photo, description, username, ad_tstamp, price, item_region, category 
							FROM ad INNER JOIN category ON(ad.id_category = category.id_category) ";
		$final_query = $default_query;
		if($where != NULL){		//queueing where clause
			$final_query = $default_query.$where;
		}
		if($order !=NULL)		//queueing clause
			$final_query = $final_query.$order;
		//print_r($final_query);
		$final_query = $final_query.";";
		$result = $conn->query($final_query);
		if ($result->num_rows > 0) {
			return $result;
		} 
		else
			return NULL;
		
		$conn->close();
	}
	
	function getAdInfo($id){			//used to retrieve the ad record info
		require "dBConfig.php";
		if($id === NULL)
			return "id Annuncio non valido";
		$query = "SELECT id, title, description, price, photo, ad.username, item_region, id_category, ad_tstamp, address, email, phone from ad INNER JOIN user ON (ad.username = user.username) WHERE id = '".$id."' ;";
		$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		  return NULL;
		}
		$result = $conn -> query($query);
		if($result->num_rows === 1)
			return $result;
		else
			return NULL;
	}
	
	function myAds(){			//used in userProfile.php to show user ads dashboard
		$user = $_SESSION['username'];
		$whereclause = "WHERE username ='".$user."' ;";
		$ads = retrieve_ads($whereclause, NULL);
		if($ads != NULL){
			while($row = $ads->fetch_assoc()) {
				echo "<div class='ad_card' id=".$row['id'].">";
				echo "	<div class='overlay'>";
				echo "		<h4>".$row['title']."</h4>";
				echo "		<object data='".str_replace(" ", "%20", urldecode($row['photo']))."img1.jpg' class='img_format'>";
				echo "			<img src='../css/img/placeholder-480x320-1.jpg' alt='immagine' class='img_format'>";
				echo "		</object>
						</div>";
				echo 	"<img class='control' alt='trash' src='../css/img/trash.svg' onclick='delete_ad(".$row['id'].")'>";
				echo	"<img class='control' alt='wrench' style='left: 165px;' src='../css/img/wrench.svg' onclick=\"window.open('./edit.php?id=".$row['id']."','_top') \" >";
				echo	"<img class='control' alt='eye' style='left: 140px;' src='../css/img/eye.svg' onclick=\"window.open('./details.php?id=".$row['id']."') \" >";
				echo "</div>";
			}
		}
		else
			echo "<h5 id='results_number'>Nessun Annuncio Inserito</h5>";
	}
?>
