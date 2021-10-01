/* slideshow manager of the details.php page to show the ad's images*/
index = 0;

function showimages(dir){
	// need to be url decoded
	//dir =  decodeURIComponent(dir.replace(/\+/g,' '));
	console.log(urlDecode(dir)); //need to include utilities.js
	dir = urlDecode(dir);
	var container = document.querySelector(".slideshow-container");
	var index = 1;
	var tempImg = new Image();
	tempImg.onload = function(){
	   appendImage();
	}
	var tryLoadImage = function(index){
	   tempImg.src = dir+"img"+index+'.jpg';
	}
	var appendImage = function(){
		var img = document.createElement('img');
		img.style.width="100%";
		img.setAttribute("src" , tempImg.src);
		img.setAttribute("class", "mySlides");
		img.setAttribute("alt", "ad_img");
		img.setAttribute("onclick", "fullscreen(this.src)");
		container.appendChild(img);
		tryLoadImage(++index);
	}
	tryLoadImage(index);
}

function next(){ //wired to next button. based on z-index manipulation
	var img = document.querySelectorAll(".mySlides");
	if(img.length == 0)
		return;
	if(index < img.length-1){
		index++;	
		img[index-1].style.zIndex = "1";}
	else{
		index = 0;
		img[img.length-1].style.zIndex = "1";
	}
	img[index].style.zIndex = "2";
}

function previous(){ //wired to previous button. based on z-index manipulation
	var img = document.querySelectorAll(".mySlides");
	if(img.length == 0)
		return;
	if (index > 0){
		index--;
		img[index+1].style.zIndex ="1";
	}
	else{
		index = img.length-1;
		img[0].style.zIndex ="1";
	}
	img[index].style.zIndex = "2";
}

function fullscreen(image_src){ //full screen visualizer 
	var image = new Image();
	var modal = document.querySelector(".modal-box");
	var close = document.createElement("span");
	image.src = image_src;
	image.setAttribute("class", "modal-content");
	modal.appendChild(image);
	close.setAttribute("class","close");
	close.appendChild(document.createTextNode("x"));
	close.setAttribute("onclick", "modal_close()");
	modal.appendChild(close);
	modal.style.display = "block";
	modal.style.zIndex = 3;
}

function modal_close(){ //close button
	var modal = document.querySelector(".modal-box");
	while(modal.firstChild){
		modal.removeChild(modal.lastChild);
	}
	modal.style.display = "none";
}

function showpopup(id) {
  var popup = document.getElementById(id);
  popup.classList.toggle("show");
}