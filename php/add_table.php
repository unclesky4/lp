<?php header('Content-type:text/html;charset=UTF-8');  //后台调加表格
	session_start();
	require "sql.php";
	$tname = test_input($_POST['Tname']);
	$cmd = test_input($_POST['cmd']);
	$username = $_POST['user'];
	$Time = test_input($_POST['Time']);
	$addr = test_input($_POST['addr']);

	if(!preg_match("/^\d{8}$/",intval($tname))) {
		echo "表名由8位数字组成!";
		return ;
	}
	if ($cmd == "" || strlen($cmd) > 32) {
		echo "请正确输入口令!";
		return ;
	}
	$conn->query("set names utf8");
	$rs = $conn->query("select `cmd` from `tb` where `tname`='$tname'");
	if($rs->num_rows > 0){
		echo "表名已存在!";
		return ;
	}
	if($username === $_SESSION['USER']){
		$sql1 = "insert into `tb`(`tname`,`cmd`,`time`,`addr`) values ('$tname','$cmd','$Time','$addr')";
		$sql2 = "create table `$tname`(id int primary key auto_increment,address varchar(4) null,academy varchar(10) not null,";
		$sql2 = $sql2."name varchar(8) not null,lphone varchar(11) not null,sphone varchar(11) not null,time varchar(12) not null,status int(1) not null)";
		$conn->autocommit(false);
		$rs1 = $conn->query($sql1);
		$rs2 = $conn->query($sql2);
		if($rs1 && $rs2){
			$conn->commit();
			echo "添加成功!";
		}else{
			$conn->rollback();
			echo "添加失败!";
		}
		$conn->autocommit(true);
	}else{
		echo "请登陆！";
	}

?>