$(document).ready(function(){
	$.ajax({
		url: "php/init.php",
		data: "aaa=aaa",
		type: "POST",
		success: function(result){
			$("#login_user").html(result);
		},
		error: function() {
			alert("error");
		}
	});
});