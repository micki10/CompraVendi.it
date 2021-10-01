/* visual effects and controls*/

function accordion_manager(){ //expand sections in userProfile.php
	var acc = document.getElementsByClassName("accordion");
	var i;
	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener("click", function() {
		/* Toggle between adding and removing the "active" class,
		to highlight the button that controls the panel */
		this.classList.toggle("active");

		/* Toggle between hiding and showing the active panel */
		var panel = this.nextElementSibling;
		if (panel.style.display === "block") {
		  panel.style.display = "none";
		} else {
		  panel.style.display = "block";
		}
	  });
	} 
}

function showToast(text,state){			/*display a toast when the function is called*/
	var x = document.getElementById("popup");
	if(state == 0){ //turn red
		x.style.backgroundColor= "rgba(255, 0, 0, 0.2)";
		x.style.border = "1px solid rgba(255, 0, 0, 0.8)";
	}
	x.appendChild(document.createTextNode(text));
	fadeIn(x,0.8);
	setTimeout(function(){x.style.opacity=0;},3000);
}
 
function fadeIn(element, finalOpacity){ //animation to fade in the toast
    var op = 0.1;  // initial opacity
    if (op >= finalOpacity)
    	return;
    
    var timer = setInterval(function () {
        if (op >= finalOpacity){
            clearInterval(timer);
            op = finalOpacity;
        }
        element.style.opacity = op;
        op += op * 0.04;
    }, 28);
}