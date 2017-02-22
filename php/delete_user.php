<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$id = $_POST['id'];

	if($id == '') {
		echo "请输入id";
		return ;
	}
	if(!preg_match("/^\d*$/",intval($id))) {
		echo "请正确输入id!";
		return ;
	}

	$rs_id = $conn->query("select `uname` from `user` where id='$id'");
	if($rs_id->num_rows <=0) {
		echo "用户id不存在!";
		return ;
	}
	$rs = $conn->query("delete from `user` where `id`='$id'");
	if($rs){
		echo "删除成功!";
	}else{
		echo "删除失败!";
	}
?>