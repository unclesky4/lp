<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$tname = test_input($_POST['Tname']);
	$username = $_POST['user'];
	if($username === $_SESSION['USER']){
		if(!preg_match("/^\d{8}$/",intval($tname))) {
			echo "表名由8位数字组成!";
			return ;
		}
		$rs1 = $conn->query("select * from `at` where `name`='$tname'");
		if($rs1->num_rows > 0){
			$conn->query("delete from `at` where `name`='$tname'");
			echo "成功取消!";
		}else {
			echo "表名不存在!";
		}
	}else{
		echo "请登陆！";
	}
?>