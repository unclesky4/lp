<?php header('Content-type:text/html;charset=UTF-8');  //后台订票人数模块复选框--确认订票或者取消已订票
	session_start();
	require "sql.php";
	$action = $_POST['action'];
	//echo $action." ".gettype($action);  //string
	$data = $_POST['data'];
	$tb = "";

	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}
	$Data = explode(',',$data);  //按逗号分离字符串

	$rs = $conn->query("select `name` from `at`");
	if($rs->num_rows !== 1){
		echo "当前未设定活动表!";
		return ;
	}
	while($row = $rs->fetch_assoc()) {
		$tb = $row['name'];
	}
	//echo $tb;
	
	if($action === "1") {
		for($index = 0; $index<count($Data);$index++) {
			$sql = "update `$tb` set `status`=1 where `id`=$Data[$index]";
			$result = $conn->query($sql);
			if(!$result) {
				echo "操作发生错误!";
				return ;
			}
		}
		echo "操作成功!";
	}else if($action === "0") {
		for($index = 0; $index<count($Data);$index++) {
			$sql = "update `$tb` set `status`=0 where id=$Data[$index]";
			$result = $conn->query($sql);
			if(!$result) {
				echo "操作发生错误!";
				return ;
			}
		}
		echo "操作成功!";
	}else if($action !== "1" && $action !== "0"){
		echo "action的值错误!";
		return ;
	}
	
	// $conn->autocommit(false);
	// $rs1 = $conn->query($sql1);
	// $rs2 = $conn->query($sql2);
	// if($rs1 && $rs2){
	// 	$conn->commit();
	// 	echo "操作成功!";
	// }else{
	// 	$conn->rollback();
	// 	echo "操作失败!";
	// }
	// $conn->autocommit(true);

?>