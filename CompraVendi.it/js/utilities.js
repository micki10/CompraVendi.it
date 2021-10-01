/*collection of functions that are used in various pages */

function check_pwd(){
	var pwd1 = document.getElementById("password_box1");
	var pwd2 = document.getElementById("password_box2");	
	if(pwd1.value != pwd2.value){
		alert("Le due password non coincidono !");
		return false;
	}
	return true;
}
/* < Photos upload client-side handling > */
function check_photos() {
	var fileUpload = document.getElementById("fileUpload[]");
	if(fileUpload.files[5]){
		alert("Attenzione: massimo 5 file !");
		reset_input_file("Nessuno file selezionato");
		return false;
	} 
	else
	if (typeof (fileUpload.files) != "indefined") {
		var toolarge;
		for( var i=0; i<5; i++){
			if(fileUpload.files[i]){
				var size = parseFloat(fileUpload.files[i].size / 1024).toFixed(2);
				if (size >= 2000.00){
					i=5;
					toolarge=true;
				}
			}
		}
		if (toolarge){
			alert("La dimensione massima per file \xE8 di 2 MB !");
			reset_input_file("Nessuno file selezionato");
			return false;
		}
		draw_preview(fileUpload,0);
		return true;
		
	} else {
		alert("This browser does not support HTML5.");
		reset_input_file("Nessuno file selezionato");
		return false;
	}
}

function draw_preview(fileUpload,flag){ //used in edit.php //flag used to decide if print upload btn, because the function is used on different pages
	var preview = document.querySelector(".preview");
	clear_preview(preview);
		/*container.insertBefore(div, add);*/
	const curFiles = fileUpload.files;
	for(const file of curFiles) {
		const image = document.createElement('img');
		image.style.width = "180px";
		image.style.height = "120px";
		image.src = URL.createObjectURL(file);
		preview.appendChild(image);
	}
	var clear_btn = document.createElement("button");
	clear_btn.setAttribute("class", "remove_btn");
	clear_btn.setAttribute("type", "button");
	clear_btn.appendChild(document.createTextNode("Rimuovi"));
	clear_btn.setAttribute("onclick", "reset_input_file('')");
	preview.appendChild(document.createElement("br"));
	if(flag == 1){
		var upload_button = document.createElement("button");
		upload_button.setAttribute("class", "myButton");
		upload_button.setAttribute("type", "button");
		upload_button.setAttribute("onclick", "upload_photo()");
		upload_button.appendChild(document.createTextNode("Upload"));
		preview.appendChild(upload_button);
	}
	preview.appendChild(clear_btn);
}

function clear_preview(preview){ //self-explanatory
	while(preview.firstChild) {
		preview.removeChild(preview.firstChild);
	}	
}

function reset_input_file(textmessage){
	var fileUpload = document.getElementById("fileUpload[]");
	var prev = document.querySelector(".preview")
	clear_preview(prev);
	var p = document.createElement("p");
	p.textContent = textmessage;
	prev.appendChild(p);
	if(fileUpload == null)
			return;
	else fileUpload.value = "";
}

/* </end of Photos upload client-side handling> */

function show_password(id){
	var pwd = document.getElementById(id);
	if(pwd.type === "password")
			pwd.type = "text";
	else
			pwd.type = "password";	
}

function show_textbox() {
	var x = document.getElementById('textbox');
		x.style.display = 'inline';
}

function disablePrice(){
	var x = document.getElementById("price");
	if(x.disabled)
			x.disabled = false;
	else
			x.disabled = true;
}

function errlistener(id1,id2){	//password error handling
	var obj1 = document.getElementById(id1);
	var obj2 = document.getElementById(id2);
	var pwd1 = obj1.value;
	var pwd2 = obj2.value;
	var node = document.getElementById("pwd_err");
	var sub = document.querySelector("input[type='submit']");
	if(pwd1 != pwd2){
		if(node.childNodes[0])
			return;	
		else{	
			node.appendChild(document.createTextNode("Le password non coincidono"));  
			sub.disabled= true;
		}
	}
	else{
		if(node.childNodes[0])
			node.removeChild(node.childNodes[0]);
		sub.disabled= false;	
	}
}

function urlDecode(path){  //used to decode path of ad's images
	return decodeURIComponent(path.replace(/\+/g,' ')); //replace " " instead of %20
}