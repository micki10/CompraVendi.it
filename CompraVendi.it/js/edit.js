
/* function to draw the thumbnails and control panel(remove btn) of images that are current on the server, triggered on page load */
/*it try to append images based on the file naming criteria( img[index].ext */
/*it is important to keep the images filenames without jump ex(img1, img3, img4, missing img2)*/

var index = 1;

function showadImages(dir){
	//console.log(dir);
	dir = urlDecode(dir);
	//console.log(dir);
	var container = document.querySelector("#photo_container");
	var tempImg = new Image();
	tempImg.onload = function(){
	   appendImage();
	}

	var tryLoadImage = function(index){
	   tempImg.src = dir+"img"+index+".jpg"+"?date=" + (new Date()).getTime() ;
	   tempImg.onerror = function(){ 
						console.log("not found");
		}
	}
	var appendImage = function(){

		var div = document.createElement("div");
		div.setAttribute("class", "ad_card");
		div.style.width = "182px";
		div.style.height = "122px";
		div.setAttribute("id", "img"+index);
		
		var overlay = document.createElement("div");
		overlay.setAttribute("class", "overlay");
		
		var object = document.createElement("object");
		object.setAttribute("class", "img_format");
		object.setAttribute("data", tempImg.src);//+"?date=" + (new Date()).getTime() );
		
		var image = document.createElement("img");
			image.setAttribute("class", "img_format");
			image.src = '../css/img/placeholder-480x320-1.jpg' ;
			image.setAttribute("alt", "no_img_found");
			
		var trash = document.createElement("img");
			trash.setAttribute("class", "control");
			trash.src = '../css/img/trash.svg' ;
			trash.setAttribute("id", index);
			trash.setAttribute("alt", "trash");
			trash.style.left= "170px"; 
			trash.style.top= "110px";
			trash.setAttribute("onclick", "remove_img('"+tempImg.src+"')");
		
		object.appendChild(image);
		overlay.appendChild(object);
		div.appendChild(overlay);
		div.appendChild(trash);
		var add = container.firstChild;
		container.insertBefore(div, add);
		tryLoadImage(++index);
	}
	tryLoadImage(index);
}

function clear_container(){	
	return document.querySelectorAll(".ad_card").forEach(el => el.remove());
}
