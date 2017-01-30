<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$id = $_POST['id'];
	$tb = "";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}

	if(!preg_match("/^\d*$/",$id)) {
		echo "请正确输入id!";
		return ;
	}

	$rs = $conn->query("select `name` from `at`");
	if($rs->num_rows !== 1){
		echo "当前未设定活动表!";
		return ;
	}
	while($row = $rs->fetch_assoc()) {
		$tb = $row['name'];
	}
	$result = $conn->query("select `name` from `$tb` where `id`='$id'");
	if($result->num_rows == 0) {
		echo "id不存在!";
		return ;
	}
	$rs1 = $conn->query("delete from `$tb` where `id`='$id'");
	if(rs1) {
		echo "删除成功!";
	}else{
		echo "删除失败!";
	}
?>