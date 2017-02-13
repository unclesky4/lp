<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$tb = "";
	$bool = false;
	$Time = date("d-H:i:s");
	//echo $Time;
	
	$cmd = test_input($_POST['cmd']);
	$name = $_POST['name'];
	$lphone = $_POST['lphone'];
	if(!preg_match("/^[\x80-\xff]{5,19}$/",$name)){
		echo  "姓名只能输入2-6个汉字!";
		return ;
	}
	if(strlen($lphone) !== 11) {
		echo "请输入11位手机长号!";
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
	$result = $conn->query("select * from `$tb` where `name`='$name' and `lphone`='$lphone'");
	if($result->num_rows <1) {
		echo "未查到相关记录！";
	}
	if($result->num_rows == 1){
		while($row = $result->fetch_assoc()) {
			if($row['status'] === "1"){
				echo "您已订票成功!";
			}else{
				echo "姓名：".$row['name']."\n学院：".$row['academy']."\n手机长号：".$row['lphone']."\n手机短号：".$row['sphone']."\n订票时间：".$row['time'];		
			}
		}
	}else{
		echo "查到多条记录!";
	}
?>