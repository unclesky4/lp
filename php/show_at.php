<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	if(!isset($_SESSION['USER'])){
		echo "请登陆！";
		return ;
	}

	$rs = $conn->query("select `name` from `at`");
	if($rs->num_rows==0){
		echo "当前未设定活动表!";
		return ;
	}
	while($row = $rs->fetch_assoc()){
		echo "当前活动表:".$row['name'];
	}
?>