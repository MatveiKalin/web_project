
$(document).ready(function() {

	$("#container_registration").css("display", "none");	
	$("#switch_input").css("background", "#fc4e3a");

	$("#switch_input").click(function() {
		$("#container_input").fadeIn("fast");	
		$("#container_registration").css("display", "none");

		$("#switch_input").css("background", "#fc4e3a");
		$("#switch_registration").css("background", "#274473");

		$("#container_registration").fadeOut("fast");	
	});	

	$("#switch_registration").click(function() {
		$("#container_registration").fadeIn("fast");	
		$("#container_input").css("display", "none");

		$("#switch_input").css("background", "#274473");
		$("#switch_registration").css("background", "#fc4e3a");

		$("#container_input").fadeOut("fast");	
	});			

});