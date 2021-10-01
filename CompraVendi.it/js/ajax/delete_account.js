/* warning: these function will remove permanently data on db */
function delete_user(){
	if(window.confirm("Eliminando il tuo account, verranno rimossi  i tuoi dati personali e tutti i dati relativi ai tuoi annunci. Vuoi procedere ?")){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200 ) {
				alert(this.responseText);
				window.open("../index.php", "_top");	
		  }
		  else	return;
		};
		xmlhttp.open("GET", "../php/ajax/delete_user.php", true);
		xmlhttp.send();
	}
	else
		return;
}

function delete_ad(id){
	if(window.confirm("Sei sicuro di voler rimuovere il tuo Annuncio?"))
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200 ) {
				alert(this.responseText);
				update_ad_view(id);
		  }
		  else	return;
		};
		xmlhttp.open("GET", "../php/ajax/delete_ad.php?id="+id, true);
		xmlhttp.send();		
		
	}
	else return;
}

function update_ad_view(id){ //remove ad card when a ad is removed
	var container = document.querySelector("#myadsview");
	var ads = container.querySelectorAll(".ad_card");
	for(var i=0; i < ads.length; i++){	
		if(ads[i].id == id){
			container.removeChild(ads[i]);
			console.log(id);
		}
	} 	
}