function validation() {

	var errors = "";
	errors += emptyLogin();
	errors += emptyPass();
	errors += emptyEmail();
	errors += errorEmaill();

	//alert(errors);
	if (errors == "") {
		return true;
	}
	else {
		return false;
	}

}


function emptyLogin() {

	var login = document.getElementById('login').value;
	//alert(login);

	if (login == "") {
		$('#emptyLogin').css('display', 'inline');
		return "не введен логин";
	}
	else {
		$('#emptyLogin').css('display', 'none');
		return "";
	}
 
}

function emptyPass() {

	var password = document.getElementById('password').value;
	//alert(password);

	if (password == "") {
		$("#emptyPass").css("display", "inline");
		return "не введен пароль";
	}
	else {
		$("#emptyPass").css("display", "none");
		return "";
	}
 
}

function emptyEmail() {

	var email = document.getElementById('email').value;
	//alert(password);

	if (email == "") {
		$("#emptyEmail").css("display", "inline");
		return "не введен емэйл";
	}
	else {
		$("#emptyEmail").css("display", "none");
		return "";
	}
 
}

function errorEmaill() {

	var email = document.getElementById('email').value;

	if ( !((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || (/[^a-zA-Z0-9.@_-]/.test(email)) ) {
		$("#errorEmail").css("display", "inline");
		return "емэйл имеет неверный формат";
	}
	else {
		$("#errorEmail").css("display", "none");
		return "";
	}

}