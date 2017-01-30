$(document).ready(function() {
	$("#login").click(function() {
		var name = $("#name").val();
	//	var z=/^[a-zA-Z]\w{0,9}$/;
		var z=/^\w{0,9}$/;
		if(!z.test(name)){
			alert("请正确输入用户名!!");
			return ;
		}

		var pwd = $("#pwd").val();
		if(pwd == ""){
			alert("密码不能为空!");
			return ;
		}
		$.ajax({
			url:  "php/login.php",
			type: "POST",
			dataType: "text",
			async : false,
			data: "name="+name+"&password="+pwd,
			success: function (result){
				if(result === "1") {
					window.location.href = "lp.html";
				}else {alert(result);}
			},
			error: function (){
				alert("error");
			}
		});
	});
});