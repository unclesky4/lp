<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$id = $_POST['id'];
	if(!preg_match("/^\d*$/",intval($name))) {
		echo "请正确输入用户名!";
		return ;
	}
	$rs = $conn->query("delete from `user` where `id`='$id'");
	if($rs){
		echo "删除成功!";
	}else{
		echo "删除失败!";
	}
?>