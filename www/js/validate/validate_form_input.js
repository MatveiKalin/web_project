function validate_input() {

	var error = "";

	error += validateEmailInput(document.getElementById("user_name_input").value);
	error += validatePasswordInput(document.getElementById("password_input").value);
	

	if (error == "") {
		return true;
	}
	else {
		//alert(error);
		$("#message_about_errors_input").html(error);
		$("#message_about_errors_input").css("display", "block");
		$("#message_about_errors_input").css("top", "0");
		return false;
	}

}



function validatePasswordInput(field) {

	if (field == "") {
		$("#password_input").css("border", "1px solid red");
		$("#password_input").css("background", "pink");
		return "Не введен пароль. <br />";
	}
	else {
		$("#password_input").css("border", "1px solid green");
		$("#password_input").css("background", "#CDFC7E");
		return "";
	}
}

function validateEmailInput(field) {

	if (field == "") {
		$("#user_name_input").css("border", "1px solid red");
		$("#user_name_input").css("background", "pink");
		return "Не введен логин или адрес электронной почты. <br />";
	}
	else {
		$("#user_name_input").css("border", "1px solid green");
		$("#user_name_input").css("background", "#CDFC7E");
		return "";
	}

}
