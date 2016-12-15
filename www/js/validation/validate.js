
function validate() {
	var text_error = "";

	text_error = text_error +  funcEmtyLogin();
	text_error = text_error + funcEmtyPass();
	text_error = text_error + funcEmtyEmail();
	text_error = text_error + funcErrorEmail();

	if (text_error == "") {
		return true;
	}
	else {
		return false;
	}
}

function funcEmtyLogin() {

	if (document.getElementById('login').value == "") {
		$("#empty_login").css("display", "inline");
		return "Не введен логин";
	}
	else {
		$("#empty_login").css("display", "none");
		return "";
	}
}

function funcEmtyPass() {

	if (document.getElementById('pass').value == "") {
		$("#empty_pass").css("display", "inline");
		return "Не введен пароль";
	}
	else {
		$("#empty_pass").css("display", "none");
		return "";
	}
}

function funcEmtyEmail() {

	if (document.getElementById('email').value == "") {
		$("#empty_email").css("display", "inline");
		return "Не введен email";
	}
	else {
		$("#empty_email").css("display", "none");
		return "";
	}
}

function funcErrorEmail() {

	var email = document.getElementById('email').value;

	if ( !((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || (/[^a-zA-Z0-9.@_-]/.test(email)) ) {
		$("#error_email").css("display", "inline");
		return "Электронный эдрес имеет неверный формат";
	}
	else {
		$("#error_email").css("display", "none");
		return "";
	}

}