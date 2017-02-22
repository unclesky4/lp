<?php header('Content-type:text/html;charset=UTF-8');   //后台添加订票记录
	session_start();
	require "sql.php";
	date_default_timezone_set("Asia/Shanghai");   //设定时区
	$tb = "";
	$Time = date("m/d-H:i");
	//echo $Time;

	$address = $_POST['address'];
	$academy = $_POST['academy'];
	$name = $_POST['name'];
	$lphone = $_POST['lphone'];
	$sphone = $_POST['sphone'];
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	if($academy == '' || $address == '') {
		echo "学院 or 地点未选择!";
		return ;
	}
	if(!preg_match("/^[\x80-\xff]*$/",$academy)) {
		//echo $academy;
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

	$rs_1 = $conn->query("select `name`,`lphone` from `$tb` where `name`='$name' and `lphone`='$lphone'");
	if($rs_1->num_rows > 0) {
		echo "你已订票!";
		return ;
	}

	$result = $conn->query("insert into `$tb`(academy,name,lphone,sphone,time) values ('$academy','$name','$lphone','$sphone','$Time')");
	if($result){
		echo "添加成功!";
	}else{
		echo "添加失败!";
	}
?>