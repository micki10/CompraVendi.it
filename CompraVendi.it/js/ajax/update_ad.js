/* file global statement*/
var form = document.forms[0];
form.addEventListener("submit", function(event){
  event.preventDefault();
});

	var id = window.location.search;	//get the ad id from $get
	id = id.substring(4);
 
/* end of global statement*/

function upload_photo(){ // request = 1, image upload
	fd = new FormData(form);
	fd.append("id", id); //send the id to get ad info
	fd.append("request", 1); // flag
	fd.delete("description"); // not necessary
	fd.delete("price"); //not necessary
	var req = new XMLHttpRequest();
	req.open ("POST", "../php/ajax/update_ad.php", true);
		req.onload = function() {
	 if (this.status == 200 ) {
			//alert(this.responseText);
			if(this.responseText != "error uploading"){
				if(this.responseText =="limit of 5 files reached"){
					alert("Attenzione, hai raggiunto il numero massimo di file !");
					return;
				}
				else{
					var path = this.responseText.substring(3, this.responseText.lastIndexOf('/'));
					path = path +"/";
					clear_preview(document.querySelector(".preview")); // clear the upload preview
					index=1; //reset the view
					clear_container();
					showadImages(path);
				}
			}
			else return;	
	  }
	  else	alert("Error "+ this.status +" occurred when trying to upload your file");
	};
	req.send(fd);
}

function update_ad(){ //wired to the main submit button
	fd = new FormData(form);
	fd.append("id", id);
	fd.append("request", 3);
	fd.delete("fileUpload"); // this scenario requires only text inputs
	var req = new XMLHttpRequest();
	req.open ("POST", "../php/ajax/update_ad.php", true);	
	req.onload = function() {
	 if (this.status == 200 ) {
			if(req.responseText == "update success"){
				alert("Annuncio Aggiornato");
				window.open("../pages/userProfile.php", "_top"); //redir to main userprofile page
			}
			else
			alert(req.responseText);
	  }
	  else	alert("Error "+ this.status +" occurred when trying to perform request");
	};
	req.send(fd);
}

function remove_img(path){ // wired to the trash  icon on img preview
	if(window.confirm("Sei sicuro di voler rimuovere l'immagine?")){

		var arr = path.split('/');	//remove img name from path 
		var last = arr[arr.length-1] || arr[arr.length-2]; //remove img name from path 
		last = last.split('?')[0];
		fd = new FormData(form);
		fd.delete("description");
		fd.delete("price");
		fd.delete("fileUpload");
		fd.append("id", id);
		fd.append("request", 2);
		fd.append("path" , last);
		var req = new XMLHttpRequest();
		req.open ("POST", "../php/ajax/update_ad.php", true);
		req.onload = function() {
		 if (this.status == 200 ) {
				if(this.responseText == 1){
					alert("Immagine rimossa dal server ");
					var dir = path;
					dir = dir.substring(0, dir.lastIndexOf('/'));
					dir = dir+"/";
					index=1;
					//update_photo_view(last);
					clear_container();
					showadImages(dir);
				}
				else	alert("Errore");
		  }
		  else	alert("Error "+ this.status +" occurred when trying to upload your file");
		};
		req.send(fd);
	}
	else	
		return;
}
//unused
function update_photo_view(imgname){ // to remove the deleted image thumbnail
	var name = imgname.split(".")[0];
	var container = document.querySelector("#photo_container");
	var toRemove = document.getElementById(name);
	container.removeChild(toRemove);
}