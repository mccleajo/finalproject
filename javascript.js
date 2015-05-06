function validatelogin() {
	var validemail = validateloginemail();
	var validpassword = validateloginpassword();
	if ( validemail && validpassword ) {
		return true;
	}
	return false;

}

function validatenewuser() {
	var validfirstname = validatefirstname();
	var validlastname = validatelastname();
	var validusername = validateusername();
	var validemail = validateemail();
	var validpassword = validatepassword();
	if ( validfirstname && validlastname && validusername && validemail && validpassword ) {
		return true;
	}
	return false;
}
function validateforgotpassword() {
	var validemail = validateforgotpwemail();
	if (validemail) {
		return true;
	}
	return false;
}
function validatepost(){
	var validtitle = validatetitle();
	var validcontent = validatecontent();
	if (validtitle && validcontent){
		return true;
	}
	return false;
}
function validatefirstname(){
	var firstname=document.getElementById("firstname").value;
	if ( firstname.length < 1 ) {
		var error=document.getElementById("firstnameerror");
		error.style.color = "red";
		error.innerHTML = "Please enter a first name";
		return false;
	}
		var error=document.getElementById("firstnameerror");
		error.innerHTML="";
		return true;
}
function validatelastname(){
	var lastname=document.getElementById("lastname").value;
	if ( lastname.length < 1 ) {
		var error=document.getElementById("lastnameerror");
		error.style.color = "red";
		error.innerHTML = "Please enter a last name";
		return false;
	}
		var error=document.getElementById("lastnameerror");
		error.innerHTML="";
		return true;
}
function validateusername(){
	var username=document.getElementById("newuser").value;
	if ( username.length < 1 ) {
		var error=document.getElementById("usernameerror");
		error.style.color = "red";
		error.innerHTML = "Please enter a username";
		return false;
	}
		var error=document.getElementById("usernameerror");
		error.innerHTML="";
		return true;
}
function validatepassword(){
	var password=document.getElementById("newpw").value;
	if ( password.length < 8 ) {
		var error=document.getElementById("passworderror");
		error.style.color = "red";
		error.innerHTML = "Please enter a password with at least 8 characters.";
		return false;
	}
		var error=document.getElementById("passworderror");
		error.innerHTML="";
		return true;
}

function validateemail(){
	var email= document.getElementById("newemail").value ;
    var emailregex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (!emailregex.test(email)){
     // if (email.length < 1) {
        var error=document.getElementById("emailerror");
        error.style.color = "red";
        error.innerHTML = "Please enter a valid email address";
        return false;
      } 
      	var error=document.getElementById("emailerror");
     	error.innerHTML = "";
     	return true;

}
function validateforgotpwemail(){
	var email=document.getElementById("email").value;
	if ( email.length < 1 ) {
		var error=document.getElementById("forgotemailerror");
		error.style.color = "red";
		error.innerHTML = "Please enter an e-mail address";
		return false;
	}
		var error=document.getElementById("forgotemailerror");
		error.innerHTML="";
		return true;
}
function validateloginemail(){
	var email=document.getElementById("email").value;
	if ( email.length < 1 ) {
		var error=document.getElementById("emailerror");
		error.style.color = "red";
		error.innerHTML = "Please enter an e-mail address";
		return false;
	}
		var error=document.getElementById("emailerror");
		error.innerHTML="";
		return true;
}
function validateloginpassword(){
	var password=document.getElementById("password").value;
	if ( password.length < 1 ) {
		var error=document.getElementById("passworderror");
		error.style.color = "red";
		error.innerHTML = "Please enter a password";
		return false;
	}
		var error=document.getElementById("passworderror");
		error.innerHTML="";
		return true;
}
function validatelocation(){
	var address=document.getElementById("address").value;
	if ( address.length < 1 ) {
		var error=document.getElementById("locationerror");
		error.style.color = "red";
		error.innerHTML = "Please enter an address";
		return false;
	}
	var error=document.getElementById("locationerror");
	error.innerHTML="";
	return true;
}
function validatetitle(){
	var title=document.getElementById("title").value;
	if ( title.length < 1 ) {
		var error=document.getElementById("titleerror");
		error.style.color = "red";
		error.innerHTML = "Please enter a Title";
		return false;
	}
	var error=document.getElementById("titleerror");
	error.innerHTML="";
	return true;
}
function validatecontent(){
	var content=document.getElementById("content").value;
	if ( content.length < 1 ) {
		var error=document.getElementById("contenterror");
		error.style.color = "red";
		error.innerHTML = "Please enter a message";
		return false;
	}
	var error=document.getElementById("contenterror");
	error.innerHTML="";
	return true;
}