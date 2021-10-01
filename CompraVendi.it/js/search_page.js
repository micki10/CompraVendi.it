/* this functions are used in loadAds.php */

function findGetParameter(parameterName) { //used to keep selected research's filters 
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) 
			result = decodeURIComponent(tmp[1]);
    }
    return result;
}

function slider(range,label){ 	//draw the actual slider value
	var node = document.getElementById(label);
	var price = document.getElementById(range).value;
	if(node.childNodes[0])
		node.removeChild(node.childNodes[0]);	
	node.appendChild(document.createTextNode(price)); 
}								

function initialize(){ //run on load
	var selected_reg = findGetParameter('region');
	var selected_cat = findGetParameter('category');
	//console.log(selected_reg + " " + selected_cat);
	if(selected_cat != null)
		document.getElementById("categories_dropdown").namedItem(selected_cat).selected = true;
	if(selected_reg != null)
		document.getElementById("regioni").namedItem(selected_reg).selected = true;
	 setTimeout(function(){ refresh_thresholds(); }, 2000);
}

function refresh_thresholds(){  //keep the price range updated
	var prices = document.querySelectorAll('[id^="price_"]'); //get all ad's prices
	var l = prices.length;
	var max = 0;
	var str = "";
	var s = "";
	for(var i = 0; i < l; i++){
		str = prices[i].textContent;
		s = parseInt(str);
		if(s > max  && s != "NaN")
			max = s;
	}
	document.getElementById("selected_minprice").textContent = 0;
	document.getElementById("selected_maxprice").textContent= max;
	document.getElementById("minprice").setAttribute("max",max);
	document.getElementById("maxprice").setAttribute("max",max);
	document.getElementById("maxprice").setAttribute("value",max);
	slider('maxprice','selected_maxprice');
	slider('minprice','selected_minprice');
}

function filter(minprice,maxprice){	// linked to the button to filter ads
	console.log("filter function called");
	var min = document.getElementById(minprice).value;
	var max = document.getElementById(maxprice).value;
	filter_min = min;
	filter_max = max;
	filterResetHandler(min, max);
	var msg = document.querySelector("#results_number");
	var count = 0;
	var newmessage;
	//console.log(min+" "+max); //ok
	var toFilter = document.querySelectorAll(".ad_container");
	for(var i=0, l = toFilter.length; i<l; i++){ 
		toFilter[i].style.display = "flex";
		count += 1;
		var price = parseInt(toFilter[i].querySelector("#price_"+toFilter[i].id).textContent);
		console.log(price);
		if(price < min || price > max){
			toFilter[i].style.display = "none";
			count -=1;
		}
	}
	if(count == 0)
		newmessage = "Nessun risultato.";
	else
		newmessage = count + " risultati mostrati.";
	if(msg == null)	
		msg = document.createElement("p");
		msg.setAttribute("id", "results_number");
	msg.textContent = newmessage;
}

function filterResetHandler(min,max){ 	//reset the price based filtering
	var span = document.getElementById("resetFilter");
	if(span.firstChild)
		span.removeChild(span.childNodes[0]);
	var a = document.createElement("a");
	var img = new Image();
	img.src = "../css/img/x-circle.svg";
	img.setAttribute("alt","close");
	a.appendChild(document.createTextNode("Prezzo: "+min+" - "+max+" "));
	a.appendChild(img);
	span.appendChild(a);
	//span.style.visibility = "visible";
	var maxprice = document.getElementById("maxprice").max;
	a.addEventListener("click", function(){
		resetPriceRange(span);			
	});
}

function resetPriceRange(span){ //move the sliders to default values
	//span.style.visibility = "hidden";
	var maxrange = document.getElementById("maxprice");
	var minrange = document.getElementById("minprice");
	maxrange.value = maxrange.max;
	minrange.value=  0;
	slider('maxprice','selected_maxprice');
	slider('minprice','selected_minprice');
	filter("minprice", "maxprice");
}


/*-- Manage dynamic refresh --*/

var loading = false;
var limit = 10;		// window dimension, how  many ad to be loaded every scrolldown
var offset = 0;	// initially loaded
var ord = (findGetParameter("order")) ? (findGetParameter("order")) : ("default"); //check if an ordering criteria was previous set
function check_endofpage(){ // used to check when to engage ajax request . not used
	//console.log(window.innerHeight + " "+ document.body.scrollHeight + " " + window.pageYOffset);
	var buffer = 20;
		if((window.innerHeight + window.pageYOffset + buffer) >= document.body.scrollHeight){
			loading=true;
			load_more_ads();  
		}
		else
			loading = false;
		console.log("function check_endofpage called");
}

function button_handler(){ //wired to 'load more' button
		var toRemove = document.querySelector("#next_btn");
		toRemove.parentNode.removeChild(toRemove);
		loading = true;
		load_more_ads();
}
/*ajax request*/
	
function load_more_ads(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200 && loading == true) {
				console.log(this.response);
				append(this.response);
				loading = false;
				refresh_thresholds();
				filter('minprice', 'maxprice');
		}
		else
			return;
		};
	xmlhttp.open("GET", "../php/ajax/load_more_ads.php"+(window.location.search ? (window.location.search+"&") : ("?"))+"limit="+limit+"&offset="+offset+"&order="+ord, true);	//mantain the previous loaded ad's filters
	xmlhttp.send();
}

// append the response of ajax request (an html string)
function append(AjaxResponse){
	var container = document.querySelector(".content"); //the container of the ads
	var button = document.createElement("button"); //load more button 
	var msg = document.createElement("p");
	msg.setAttribute("id", "results_number");
	button.setAttribute("id", "next_btn");
	button.setAttribute("class", "blue_button");
	button.textContent = "Carica altri";
	button.setAttribute("onclick" , "button_handler()");


	if(AjaxResponse != "endoffile"){ 
			container.insertAdjacentHTML('beforeend', AjaxResponse);
			offset += limit; //to slide the window of the ajax request
			container.appendChild(button);
	}
	else{
		msg.textContent = ("Tutti i risultati caricati.");
		container.appendChild(msg);
	}	
}

/*/  nuove modifiche per l'ordinamento con ajax */
 //pulisce la vista
function clear_childs(container){
	while(container.firstChild) {
		container.removeChild(container.lastChild);
	}	
}

//funzione da linkare al onchange del select

function order_select_handler(index){
	var type = index.id;
	console.log("reorder_mysql called with order = "+type);
	clear_childs(document.querySelector(".content"));
	offset = 0;
	ord = type;
	loading = true; //trigger to allow ajax request 
	load_more_ads(); // function to fetch ads
}