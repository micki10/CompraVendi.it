// functions to update user info in userProfile.php

function update_field(id){ // id stand for options: phone, address, email
		var element = document.getElementById(id);
		var x = element.value; // x is the new value of the field to update
		var ValidityState = element.validity;
		var isValid = ValidityState.valid;	//check the field with html5 
		var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200) {
				if (this.responseText == "update success"){
					showToast();
				}
				else
					bounce(element);
		  }
		  else	return;
		};
		if(isValid == true){
			xmlhttp.open("POST", "../php/ajax/update_field.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("value="+x+"&type="+id);
		}
		else{	
			bounce(element);
		}
}

function update_password(id1, id2){ // to perform ajax request of password update 
	var obj1 = document.getElementById(id1);
	var obj2 = document.getElementById(id2);
	var pwd1 = obj1.value;
	var pwd2 = obj2.value;
	if(pwd1 != pwd2){
		bounce(obj1);
		bounce(obj2);
		document.getElementById("pwd_err").innerHTML = "Password non coincidono";
		return;
	}
	var validation = obj1.validity.valid;
	console.log(validation);
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200 ) {
			if (this.responseText == "update success"){
					showToast();
					setTimeout(function(){window.location.href="../pages/login.php"},1500);
			}
			else{
					bounce(obj1);
					bounce(obj2);
					//alert(this.responseText);
				}
		}
		  else	return;
		};
		if(validation == true){
			xmlhttp.open("POST", "../php/ajax/update_pwd.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("pwd="+pwd1);
		}
		else{	
			bounce(obj1);
			bounce(obj2);
		}
}

function update_flags(phoneflag, addrflag){		//update userdata's visibility flags request
	var pflag = document.getElementById(phoneflag).checked;
	var aflag = document.getElementById(addrflag).checked;
	pflag = (pflag == true)?(1):(0);
	aflag = (aflag == true)?(1):(0);
	console.log(pflag + " "+ aflag);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200)
		if (this.responseText == "update success"){
					showToast();
		}
	};
	xmlhttp.open("GET", "../php/ajax/update_flags.php?phone="+pflag+"&addr="+aflag, true);
	xmlhttp.send();
}

/*these function are ridondant*/

function showToast(){ // to show toast
	var x = document.getElementById("popup");
	fadeIn(x,0.8);
	setTimeout(function(){x.style.opacity=0;},3000);
}

function fadeIn(element, finalOpacity){
    var op = 0.1;  // initial opacity
    if (op >= finalOpacity)
    	return;
    
    var timer = setInterval(function () {
        if (op >= finalOpacity){
            clearInterval(timer);
            op = finalOpacity;
        }
        element.style.opacity = op;
        op += op * 0.05;
    }, 25);
}

function bounce(id){
	var inputField = id;
	var input = inputField.value;
	inputField.classList.add("bounce");
		setTimeout(function() {
		  //remove the class so animation can occur as many times as user triggers event, delay must be longer than the animation duration and any delay.
		  inputField.classList.remove("bounce");
		}, 1000); 
}