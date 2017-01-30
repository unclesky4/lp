$(document).ready(function () {
	
	$.ajax({
		url: "php/index_init.php",
		type: "POST",
		dataType: "json",    //necssary
		data: "a=a",
		success: function(result) {
			$.each(result.data,function(idx,item) {
				//alert(item.addr);
				$("#time").html(item.Time);
				$("#addr").html(item.addr);
			})
		},
		error: function(){
			alert("error");
		}
	});

	$("#reg_btn").click(function () {   //订票
		var cmd = $("#reg_command").val();
		var academy = $("#reg_select").find("option:selected").text(); //获取select 选中的 text
		var name = $("#reg_name").val();
		var lphone = $("#reg_lphone").val();
		var sphone = $("#reg_sphone").val();
		
		if(cmd === ""){
			alert("请输入口令!");
			return ;
		}

		var z1=/^[\u4e00-\u9fa5]{2,6}$/;   //只能输入汉字
		if((!z1.test(name))) {
			alert("姓名只能输入2-6个汉字!!");
			return ;
		}
		var z2=/^\d{11}$/;
		if(!z2.test(parseInt(lphone)) || lphone === "") {
			alert("请输入11位手机长号!");
			return ;
		}
		var z3=/^\d{6}$/;
		if(!z3.test(parseInt(sphone)) || sphone === "") {
			alert("请输入6位手机短号!");
			return ;
		}
		$.ajax({
			url: "php/reg.php",
			type: "POST",
			async: false,
			data: "cmd="+cmd+"&academy="+academy+"&name="+name+"&lphone="+lphone+"&sphone="+sphone,
			success: function(result) {
				alert(result);
				$("#reg_name").val("");
				$("#reg_lphone").val("");
				var sphone = $("#reg_sphone").val("");
			},
			error: function(){
				alert("error");
			}
		});
	});
	
	$("#abolish_btn").click(function () {    //取消订票
		var cmd = $("#abolish_command").val();
		var name = $("#abolish_name").val();
		var lphone = $("#abolish_lphone").val();

		if(cmd === ""){
			alert("请输入口令!");
			return ;
		}

		var z1=/^[\u4e00-\u9fa5]{2,6}$/;   //只能输入汉字
		if((!z1.test(name))) {
			alert("姓名只能输入2-6个汉字!!");
			return ;
		}
		var z2=/^\d{11}$/;
		if(!z2.test(parseInt(lphone)) || lphone === "") {
			alert("请输入11位手机长号!");
			return ;
		}
		$.ajax({
			url: "php/rm_reg.php",
			type: "POST",
			async: false,
			data: "cmd="+cmd+"&name="+name+"&lphone="+lphone,
			success: function(result) {
				alert(result);
				$("#abolish_name").val("");
				$("#abolish_lphone").val("");
			},
			error: function(){
				alert("error");
			}
		});
	});
	
	$("#check_btn").click(function () {     //确认订票
		var cmd = $("#check_command").val();
		var name = $("#check_name").val();
		var lphone = $("#check_lphone").val();

		if(cmd === ""){
			alert("请输入口令!");
			return ;
		}

		var z1=/^[\u4e00-\u9fa5]{2,6}$/;   //只能输入汉字
		if((!z1.test(name))) {
			alert("姓名只能输入2-6个汉字!!");
			return ;
		}
		var z2=/^\d{11}$/;
		if(!z2.test(parseInt(lphone)) || lphone === "") {
			alert("请输入11位手机长号!");
			return ;
		}
		$.ajax({
			url: "php/check_info.php",
			type: "POST",
			async: false,
			data: "cmd="+cmd+"&name="+name+"&lphone="+lphone,
			success: function(result) {
				alert(result);
			},
			error: function(){
				alert("error");
			}
		});
	});
	
});