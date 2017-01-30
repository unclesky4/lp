<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$tb = "";
	$Time = date("d-H:i:s");
	//echo $Time;

	$academy = $_POST['academy'];
	$name = $_POST['name'];
	$lphone = $_POST['lphone'];
	$sphone = $_POST['sphone'];
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	if(!preg_match("/^[\x80-\xff]*$/",$academy)) {
		echo $academy;
		echo "学院类型不正确!";
		return ;
	}
	if(!preg_match("/^[\x80-\xff]{5,19}$/",$name)){
		echo  "姓名只能输入2-6个汉字!";
		return ;
	}
	if(strlen($lphone) !== 11) {
		echo "请输入11位手机长号!";
		return ;
	}
	if(strlen($sphone) !== 6){
		echo "请输入6位手机短号!";
		return ;
	}
	$conn->query("set names utf8");
	$rs = $conn->query("select `name` from `at`");
	if($rs->num_rows !== 1){
		echo "当前未设定活动表!";
		return ;
	}
	while($row = $rs->fetch_assoc()) {
		$tb = $row['name'];
		//echo $tb;
	}
	$result = $conn->query("insert into `$tb`(academy,name,lphone,sphone,time) values ('$academy','$name','$lphone','$sphone','$Time')");
	if($result){
		echo "添加成功!";
	}else{
		echo "添加失败!";
	}
?>