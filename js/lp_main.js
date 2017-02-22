$(document).ready(function(){
	var z = /^\d{8}$/;

	var tb = $("#reg_info").DataTable({   //显示订票信息
		"processing": true,
		"serverSide": true,
		"lengthMenu": [20,40,70,110],  //自定义长度菜单的选项
		"ajax": {
			"url": "php/show_person.php",
			"type": "POST",
		},
		"dom": 'lBfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "columnDefs": [ {                //自动创建按钮
        	"targets": -1,
        	"data": null,
        	"defaultContent": "<input type='checkbox' class='yn'>"
        } ]
	});

	$("#yes").click(function() {    //获取被选中的复选框--确认订票
		var data = new Array();
		$(".yn").each(function() {
			if($(this).is(':checked')) {
				var content = tb.row( $(this).parents('tr') ).data();
				data.push(content[0]);
			}
		});
		//alert(data);
		if(data.length == 0) {
			alert("没有数据!");
			return;
		}
		$.ajax({
			url: "php/confirm.php",
			type: "POST",
			async: false,
			data: "action=1&data="+data,
			success: function(rs) {
				alert(rs);
				tb.ajax.reload(null, false); // 刷新表格数据，分页信息不会重置
			},
		});
	});
	
	$("#no").click(function() {    //获取被选中的复选框--撤销已订票
		var data = new Array();
		$(".yn").each(function() {
			if($(this).is(':checked')) {
				var content = tb.row( $(this).parents('tr') ).data();
				data.push(content[0]);
			}
		});
		if(data.length == 0) {
			alert("没有数据!");
			return;
		}
		$.ajax({
			url: "php/confirm.php",
			type: "POST",
			async: false,
			data: "action=0&data="+data,
			success: function(rs) {
				alert(rs);
				tb.ajax.reload(null, false); // 刷新表格数据，分页信息不会重置
			},
		});
	});
	
	var tb1 = $("#table_info").DataTable({  //显示历史表
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "php/table_show.php",
			"type": "POST"
		}
	});


	$("#add_btn").click(function(){   //添加记录
		//var academy_1 = $("#add_select").val(); //获取select选中的 value
		var address = $("#add_address_select").find("option:selected").text();
		var academy = $("#add_select").find("option:selected").text(); //获取select 选中的 text
		//alert(academy+"-----" +academy_1);
		var name = $("#add_name").val();
		var lphone = $("#add_lphone").val();
		var sphone = $("#add_sphone").val();
		var z1=/^[\u4e00-\u9fa5]{0,}$/;   //只能输入汉字
		if((!z1.test(name)) || name.length>4 || name.length<1) {
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
			url: "php/add_person.php",
			type: "POST",
			async: false,
			data: "address="+address+"&academy="+academy+"&name="+name+"&lphone="+lphone+"&sphone="+sphone,
			success: function(result) {
				alert(result);
				tb.ajax.reload(null,false);
				//tb.reset();
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#update_address").click(function() {    //修改地点
		var id = $("#update_id").val();
		var academy = $("#address_select").find("option:selected").text();
		var z = /^\d*$/;
		if(!z.test(id) || id === "") {
			alert("请正确输入id!");
			return ;
		}
		$.ajax({
			url: "php/Caddress.php",
			type: "POST",
			async: false,
			data: "id="+id+"&address="+academy,
			success: function (result) {
				alert(result);
				tb.ajax.reload(null,false);
			},
			error: function () {
				alert("error");			
			}
		});
	});
	
	$("#update_academy").click(function() {    //修改学院
		var id = $("#update_id").val();
		var academy = $("#update_select").find("option:selected").text();
		var z = /^\d*$/;
		if(!z.test(id) || id === "") {
			alert("请正确输入id!");
			return ;
		}
		$.ajax({
			url: "php/Cacademy.php",
			type: "POST",
			async: false,
			data: "id="+id+"&academy="+academy,
			success: function (result) {
				alert(result);
				tb.ajax.reload(null,false);
			},
			error: function () {
				alert("error");			
			}
		});
	});
	
	$("#update_name").click(function () {   //修改姓名
		var id = $("#update_id").val();
		var name = $("#input_name").val();
		var z = /^\d*$/;
		if(!z.test(id) || id === "") {
			alert("请正确输入id!");
			return ;
		}
		var z1=/^[\u4e00-\u9fa5]{0,}$/;   //只能输入汉字
		if((!z1.test(name)) || name.length>6 || name.length<1) {
			alert("姓名只能输入2-6个汉字!!");
			return ;
		}
		$.ajax({
			url: "php/Cname.php",
			type: "POST",
			async: false,
			data: "id="+id+"&name="+name,
			success: function (result) {
				alert(result);
				$("#input_name").val("");
				tb.ajax.reload(null,false);
			},
			error: function () {
				alert("error");			
			}
		});
	});
	
	$("#update_lphone").click(function() {   //修改手机长号
		var id = $("#update_id").val();
		var lphone = $("#input_lphone").val();
		var z = /^\d*$/;
		if(!z.test(id) || id === "") {
			alert("请正确输入id!");
			return ;
		}
		var z1 = /^\d{11}$/;
		if(!z1.test(lphone) || lphone === "") {
			alert("请输入11位手机长号!!");
			return ;
		}
		$.ajax({
			url: "php/Clphone.php",
			type: "POST",
			async: false,
			data: "id="+id+"&lphone="+lphone,
			success: function (result) {
				alert(result);
				$("#input_lphone").val("");
				tb.ajax.reload(null,false);
			},
			error: function () {
				alert("error");			
			}		
		});
	});
	
	$("#update_sphone").click(function() {   //修改手机短号
		var id = $("#update_id").val();
		var sphone = $("#input_sphone").val();
		var z = /^\d*$/;
		if(!z.test(id) || id === "") {
			alert("请正确输入id!");
			return ;
		}
		var z1 = /^\d{6}$/;
		if(!z1.test(sphone) || sphone === "") {
			alert("请输入6位手机短号!!");
			return ;
		}
		$.ajax({
			url: "php/Csphone.php",
			type: "POST",
			async: false,
			data: "id="+id+"&sphone="+sphone,
			success: function (result) {
				alert(result);
				$("#input_sphone").val("");
				tb.ajax.reload(null,false);
			},
			error: function () {
				alert("error");			
			}		
		});
	});	
	
	$("#delete_btn").click(function() {   //删除记录
		var Id = $("#delete_id").val();
		var z = /^\d*$/;
		if(!z.test(Id) || Id === "") {
			alert("请正确输入id!");
			return ;
		}
		//alert(Id);
		$.ajax({
			url: "php/delete_person.php",
			type: "POST",
			async: false,
			data: "id="+Id,
			success: function(result) {
				alert(result);
				$("#delete_id").val("");
				tb.ajax.reload(null,false);
			},
			error: function() {
				alert("error");
			}
		});
	});

	$("#add_table_btn").click(function(){   //添加表
		var user = $("#login_user").text();
		var tname = $("#add_table_input1").val();
		var cmd = $("#add_table_input2").val();
		var Time = $("#add_table_input3").val();
		var addr = $("#add_table_input4").val();

		if(Time === "" || Time.length > 20) {
			alert("请正确输入时间!");
			return ;
		}
		if(addr === "" || addr.length > 20) {
			alert("请正确输入地址!");
			return ;
		}

		if(!z.test(parseInt(tname))) {
			alert("表名由8位数字组成!");
			return ;
		}
		var cmd = $("#add_table_input2").val();
		if(cmd == "" || cmd.length > 8){
			alert("请正确输入口令!");
			return ;
		}
		$.ajax({
			url: "php/add_table.php",
			data: "Tname="+tname+"&user="+user+"&cmd="+cmd+"&Time="+Time+"&addr="+addr,
			type: "POST",
			success: function(result){
				alert(result);
				$("#add_table_input1").val("");
				$("#add_table_input2").val("");
				$("#add_table_input3").val("");
				$("#add_table_input4").val("");
				tb1.ajax.reload(null,false);
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#delete_table_btn").click(function(){   //删除表
		var user = $("#login_user").text();
		var tname = $("#delete_table_input").val();
		if(!z.test(tname)){
			alert("表名由8位数字组成!");
			return ;
		}
		$.ajax({
			url: "php/delete_table.php",
			data: "Tname="+tname+"&user="+user,
			type: "POST",
			async: false,
			success: function(result){
				alert(result);
				$("#delete_table_input").val("");
				tb1.ajax.reload(null,false);
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#set_table_btn").click(function(){   //设定活动表
		var tname = $("#set_table_input").val();
		var user = $("#login_user").text();
		if(!z.test(tname)){
			alert("表名由六位数字组成!");
			return ;
		}
		$.ajax({
			url: "php/set_table.php",
			data: "Tname="+tname+"&user="+user,
			type: "POST",
			async: false,
			success: function(result){
				alert(result);
				$("#set_table_input").val("");
				tb.ajax.reload(null,false);
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#remove_table_btn").click(function(){   //取消活动表
		var user = $("#login_user").text();
		var tname = $("#remove_table_input").val();
		if(!z.test(tname)){
			alert("表名由六位数字组成!");
			return ;
		}
		$.ajax({
			url: "php/remove_table.php",
			data: "Tname="+tname+"&user="+user,
			type: "POST",
			async: false,
			success: function(result){
				alert(result);
				$("#remove_table_input").val('');
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#show_at").click(function(){   //显示活动表
		$.ajax({
			url: "php/show_at.php",
			data: "",
			type: "POST",
			async: false,
			success: function(result){
				alert(result);
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#add_user_btn").click(function() {   //添加用户（管理员）
		var name = $("#uname").val();
		//alert(name);
		var pwd1 = $("#pwd_1").val();
		//alert(pwd1.length);
		var pwd2 = $("#pwd_2").val();
		var z=/^\w{0,9}$/;
		if(!z.test(name)) {
			alert("请正确输入用户名!!");
			$("#uname").val("");
			$("#pwd_1").val("");
			$("#pwd_2").val("");
			return ;
		}
		if(pwd1 === "" || pwd2 === ""){
			alert("密码不能为空!");
			return ;
		}
		if(!(pwd1 === pwd2)){
			alert("两次输入的密码不一致!");
			$("#pwd_1").val("");
			$("#pwd_2").val("");
			return ;
		}
		$.ajax({
			url: "php/add_user.php",
			type: "POST",
			async: false,
			data: "name="+name+"&pwd="+pwd1,
			success: function(data) {
				alert(data);
				$("#uname").val("");
				$("#pwd_1").val("");
				$("#pwd_2").val("");
				tb2.ajax.reload(null,false);
			},
			error: function() {
				alert("error");
			}
		});
	});

	$("#delete_user_btn").click(function() {   //删除用户（管理员）
		var id = $("#delete_user_input").val();
		var z=/^\d*$/;
		if(!z.test(parseInt(id))) {
			alert("请输入数字!");
			return ;
		}
		$.ajax({
			url: "php/delete_user.php",
			async: false,
			type: "POST",
			data: "id="+id,
			success: function(result) {
				alert(result);
				$("#delete_user_input").val("");
				tb2.ajax.reload(null,false);
			},
			error: function(){
				alert("error");
			}
		});
	});

	$("#update_pwd_btn").click(function() {   //修改当前用户的密码
		var ps1 = $("#pwd_input_1").val();
		var ps2 = $("#pwd_input_2").val();
		if(ps1 === "" || ps2 === ""){
			alert("密码不能为空!");
			return ;
		}
		if(!(ps1 === ps2)){
			alert("两次输入的密码不一致!");
			return ;
		}
		$.ajax({
			url: "php/update_pwd.php",
			type: "POST",
			async: false,
			data: "pwd="+ps1,
			success: function(result){
				alert(result);
				tb2.ajax.reload(null,false);
			},
			error: function(){
				alert("error");
			}
		});
	});

	var tb2 = $("#show_user").DataTable({    //显示所有的管理员信息
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "php/user_show.php",
			"type": "POST"
		}
	});

	$("#logout").click(function(){   //注销
		$.ajax({
			url: "php/logout.php",
			data: "a=a",
			type: "POST",
			async: false,
			success: function(data){
				if(data === "1"){
					window.location.href = "login.html";
				}else{alert("Logout Failed !");}
			},
			error: function(){
				alert("error");
			}
		});
	});

});
