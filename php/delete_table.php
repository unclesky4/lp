<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$tname = test_input($_POST['Tname']);
	$username = $_POST['user'];
	if($username === $_SESSION['USER']){
		$sql1 = "delete from `tb` where `tname`='$tname'";
		$sql2 = "drop table if exists `$tname`";
		$conn->autocommit(false);
		$rs1 = $conn->query($sql1);
		$rs2 = $conn->query($sql2);
		if($rs1 && $rs2){
			$conn->commit();
			echo "删除成功!";
		}else{
			$conn->rollback();
			echo "删除失败!";
		}
		$conn->autocommit(true);
	}else{
		echo "请登陆！";
	}
?>