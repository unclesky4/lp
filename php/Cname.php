<?php header('Content-type:text/html; charset=UTF-8');  //修改短号
	session_start();
	require "sql.php";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$tb = "";

	$id = $_POST['id'];
	$name = $_POST['name'];
	//echo $name;

	if(!preg_match("/^\d*$/",$id) || $id === "") {
		echo "请正确输入id!";
		return ;
	}

	if(!preg_match("/^[\x80-\xff]{5,19}$/",$name)) {
		echo "请正确输入姓名!";
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

	//echo "update `$tb` set `academy`='$academy' where `id`='$id'";
	$result = $conn->query("update `$tb` set `name`='$name' where `id`='$id'");
	if($result){
		echo "修改成功!";
	}else {
		echo "修改失败!";
	}
?>