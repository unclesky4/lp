<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	$cmd = "";
	$time = "";
	$addr = "";
	$tname = $_POST['Tname'];
	$username = $_POST['user'];
	if(!($username === $_SESSION['USER'])){
		echo "请登陆！";
		echo $_SESSION['USER'];
		return ;
	}
	//echo preg_match("/^\d{8}$/",intval($tname));
	if(preg_match("/^\d{8}$/",intval($tname))) {
		$conn->query("set names utf8");
		$rs = $conn->query("select `cmd`,`time`,`addr` from `tb` where `tname`='$tname'");
		//echo $rs->num_rows;
		//echo gettype($rs->num_rows);
		if($rs->num_rows>0){
			while($row = $rs->fetch_assoc()){
				$cmd = $row['cmd'];
				$time = $row['time'];
				$addr = $row['addr'];
			}
			$conn->autocommit(false);
			$rs1 = $conn->query("delete from `at`");
			$rs2 = $conn->query("insert into `at` value ('$tname','$cmd','$time','$addr')");
			if($rs1 && $rs2){
				$conn->commit();
				echo "已成功设定!";
			}else{
				$conn->rollback();
				echo "已成功取消";
			}
			$conn->autocommit(true);
		}else{
			echo "表名不存在!";
		}
		
	}else{
		echo "表名由8位数字组成!";
	}
?>