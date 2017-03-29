
$(document).ready(function() {

	$("#container_registration").css("display", "none");	
	$("#switch_input").css("background", "#fc4e3a");

	$("#switch_input").click(function() {
		$("#container_input").fadeIn("fast");	
		$("#message_about_errors_input").fadeIn("fast");
		$("#container_registration").css("display", "none");

		$("#switch_input").css("background", "#fc4e3a");
		$("#switch_registration").css("background", "#274473");

		$("#message_about_errors_registration").fadeOut("fast");
		$("#container_registration").fadeOut("fast");	
	});	

	$("#switch_registration").click(function() {
		$("#container_registration").fadeIn("fast");	
		$("#message_about_errors_registration").fadeIn("fast");
		$("#container_input").css("display", "none");

		$("#switch_input").css("background", "#274473");
		$("#switch_registration").css("background", "#fc4e3a");

		$("#message_about_errors_input").fadeOut("fast");
		$("#container_input").fadeOut("fast");	
	});			

});