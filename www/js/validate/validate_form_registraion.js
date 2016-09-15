function validate_registration() {

	var error = "";

	error += validateName(document.getElementById("user_name_registration").value);
	error += validateSecondName(document.getElementById("second_name_registration").value);
	error += validateLogin(document.getElementById("login_registration").value);
	error += validatePassword(document.getElementById("password_registration").value, document.getElementById("repeat_password_registration").value);
	error += validateEmail(document.getElementById("e_mail").value);

	if (error == "") {
		return true;
	}
	else {
		//alert(error);
		$("#message_about_errors_registration").html(error);
		$("#message_about_errors_registration").css("display", "block");
		$("#message_about_errors_registration").css("top", "0");
		return false;
	}

}


function validateName(field) {

	if (field == "") {
		$("#user_name_registration").css("border", "1px solid red");
		$("#user_name_registration").css("background", "pink");
		return "Не введено имя. <br />";
	}
	else 
	if (/\d+/.test(field)) {
		$("#user_name_registration").css("border", "1px solid red");
		$("#user_name_registration").css("background", "pink");
		return "В имени могут быть только буквы. <br />";
	}
	else {
		$("#user_name_registration").css("border", "1px solid green");
		$("#user_name_registration").css("background", "#CDFC7E");
		return "";
	}

}


function validateSecondName(field) {

	if (field == "") {
		$("#second_name_registration").css("border", "1px solid red");
		$("#second_name_registration").css("background", "pink");
		return "Не введена фамилия. <br />";
	}
	else 
	if (/\d+/.test(field)) {
		$("#second_name_registration").css("border", "1px solid red");
		$("#second_name_registration").css("background", "pink");
		return "В фамилии могут быть только буквы. <br />";
	}
	else {
		$("#second_name_registration").css("border", "1px solid green");
		$("#second_name_registration").css("background", "#CDFC7E");
		return "";
	}
	
}


function validateLogin(field) {

	if (field == "") {
		$("#login_registration").css("border", "1px solid red");
		$("#login_registration").css("background", "pink");
		return "Не введен логин. <br />";
	}
	else {
		$("#login_registration").css("border", "1px solid green");
		$("#login_registration").css("background", "#CDFC7E");
		return "";
	}
	
}


function validatePassword(field1, field2) {

	if ( (field1 == "") && (field2 == "") ) {
		$("#password_registration").css("border", "1px solid red");
		$("#password_registration").css("background", "pink");
		$("#repeat_password_registration").css("border", "1px solid red");
		$("#repeat_password_registration").css("background", "pink");
		return "Пароль и его подтверждение не введено. <br />";
	}
	else
	if (field1 == "") {
		$("#password_registration").css("border", "1px solid red");
		$("#password_registration").css("background", "pink");
		return "Не введен пароль. <br />";
	}
	else 
	if (field2 == "") {
		$("#repeat_password_registration").css("border", "1px solid red");
		$("#repeat_password_registration").css("background", "pink");
		return "Не введен подтверждающий пароль. <br />";
	}
	else
	if (field1 != field2) {
		$("#password_registration").css("border", "1px solid red");
		$("#password_registration").css("background", "pink");
		$("#repeat_password_registration").css("border", "1px solid red");
		$("#repeat_password_registration").css("background", "pink");
		return "Пароли не совпадают <br />";
	}
	else {
		$("#password_registration").css("border", "1px solid green");
		$("#password_registration").css("background", "#CDFC7E");
		$("#repeat_password_registration").css("border", "1px solid green");
		$("#repeat_password_registration").css("background", "#CDFC7E");
		return "";
	}
}

function validateEmail(field) {

	if (field == "") {
		$("#e_mail").css("border", "1px solid red");
		$("#e_mail").css("background", "pink");
		return "Не введен адрес электронной почты. <br />";
	}
	else 
	if ( !((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || (/[^a-zA-Z0-9.@_-]/.test(field)) ) {
		$("#e_mail").css("border", "1px solid red");
		$("#e_mail").css("background", "pink");
		return "Электронный эдрес имеет неверный формат";
	}
	else {
		$("#e_mail").css("border", "1px solid green");
		$("#e_mail").css("background", "#CDFC7E");
		return "";
	}

}
