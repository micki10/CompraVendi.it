//function to check if username exist during register 

function check_username(str, id) {
	var node = document.getElementById(id);
		if(node.childNodes[0])
			node.removeChild(node.childNodes[0]);
	  if (str.length == 0) {
		return;
	  } else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200) {
					node.appendChild(document.createTextNode(this.responseText)); 
		  }
		};
		xmlhttp.open("GET", "../php/ajax/check_if_username_exist.php?value="+str, true);
		xmlhttp.send();
	  }
}