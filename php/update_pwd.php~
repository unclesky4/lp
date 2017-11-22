<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$pwd = $_POST['pwd'];
	$p = md5($pwd);
	$user = $_SESSION['USER'];
	$rs = $conn->query("update table `user` set `password`='$p' where `uname`=$user");
	if($rs){
		echo "修改成功!";
	}else{
		echo "修改失败!";
	}
?>