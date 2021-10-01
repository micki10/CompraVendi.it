
function draw_popular_categories(howmany){ // on index.php, request of categories with larger ad number
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200 ) {
			draw(this.responseText);
		  }
		  else	return;
		};
		xmlhttp.open("GET", "./php/ajax/get_popular_cat.php?howmany="+howmany, true);
		xmlhttp.send();
}

function draw(serialized_categories){ // get a string in format ([id],[name];),([id],[name];) and de-serialize them to be displayed
	var colors = ["#2650ff", "#f2a700", "#9924ff", "#07bb9c"]; //some colors
	var cats = serialized_categories.split(";"); 
	
	var parent = document.querySelector(".popular_categories");
	 for(var i = 0; i < cats.length-1; i++){
		var node = document.createElement("div");
		var a = document.createElement("a");
		node.setAttribute("class","category_card");
		node.setAttribute("style", "background-color: "+colors[i%colors.length]+"; border: 2px solid "+colors[i%colors.length]+";");
		var text = document.createElement("h4");
		var sub = cats[i].split(",");
		var id = sub[0];
		var catname = sub[1];
		text.textContent = catname;
		node.appendChild(text);
		a.href = "./pages/loadAds.php?category="+id;
		a.appendChild(node);
		//node.onclick = function (){ window.open('./html/loadAds.php?category='+id,'_top');};
		parent.appendChild(a);
	 }
	var all = document.createElement("a");
	all.textContent="Mostra in Tutte";
	all.setAttribute("href", "./pages/loadAds.php");
	parent.appendChild(all);
}