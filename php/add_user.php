<?php header('Content-type:text/html;charset=UTF-8');   //后台调加用户
	session_start();
	require "sql.php";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$name = $_POST['name'];
	$pwd = $_POST['pwd'];
	if(!preg_match("/^\w{0,9}$/",$name)) {
		echo "请正确输入用户名!";
		return ;
	}
	if($pwd === ""){
		echo "密码不能为空!";
		return ;
	}
	$result = $conn->query("select `id` from `user` where `uname`='$name'");
	if($result->num_rows > 0){
		echo "用户名已存在!";
		return ;
	}
	$p = md5($pwd);
	//echo $p;
	$rs = $conn->query("insert into `user`(uname,password) value ('$name','$p')");
	if($rs){
		echo "添加成功!";
	}else{
		echo "添加失败!";
	}
?>