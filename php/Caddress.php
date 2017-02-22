<?php header('Content-type:text/html;charset=UTF-8');  //后台修改地址
	session_start();
	require "sql.php";
	
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$tb = "";
	$id = $_POST['id'];
	$address = $_POST['address'];
	if(!preg_match("/^\d*$/",$id) || $id === "") {
		echo "请正确输入id!";
		return ;
	}

	if($address == ''){
		echo "请选择地点!";
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
	}

	$result = $conn->query("update `$tb` set `address`='$address' where `id`='$id'");
	if($result){
		echo "修改成功!";	
	}else {
		echo "修改失败!";	
	}
?>