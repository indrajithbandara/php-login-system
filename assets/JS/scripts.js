//registration scripts

if($("reg-email").val() == null && $("reg-password").val() == null && $("conf-password").val() == null){
	$("#submit").attr("disabled", "disabled");  // unclickable
}


	$("#submit").removeAttr("disabled");    // clickable
	$("#submit").css("background", "#0098cb");


// Trying to find a way to disable submit button when input feilds are empty and enable it when they all have values.


