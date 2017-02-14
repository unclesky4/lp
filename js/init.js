$(document).ready(function(){
	$.ajax({
		url: "php/init.php",
		data: "a=a",
		type: "POST",
		success: function(result){
			$("#login_user").html(result);
		},
		error: function() {
			alert("error");
		}
	});
});