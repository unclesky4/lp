<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$tb = "";
	$bool = false;
	$Time = date("d-H:i:s");
	//echo $Time;
	
	$cmd = test_input($_POST['cmd']);
	$academy = $_POST['academy'];
	$name = $_POST['name'];
	$lphone = $_POST['lphone'];
	$sphone = $_POST['sphone'];
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
	$rs = $conn->query("select `name`,`cmd` from `at`");
	if($rs->num_rows !== 1){
		echo "当前未设定活动表!";
		return ;
	}
	while($row = $rs->fetch_assoc()) {
		if($row['cmd'] == $cmd) {
			$tb = $row['name'];
			$bool = true;
			break;			
		}
	}
	
	if(!$bool) {
		echo "口令不正确！";
		return ;	
	}
	$result = $conn->query("insert into `$tb`(academy,name,lphone,sphone,time) values ('$academy','$name','$lphone','$sphone','$Time')");
	if($result){
		echo "订票成功!";
	}else{
		echo "订票失败!";
	}
?>