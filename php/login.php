<?php header('Content-type:text/html;charset=utf-8');
	session_start();
	require "sql.php";
	$name = test_input($_POST['name']);
	$password = $_POST['password'];
	if(!preg_match("/^\w{0,9}$/",$name)){
		echo "请正确输入用户名!";
		return ;
	}
	if(strlen($password) == 0){
		echo "密码不能为空!";
		return ;
	}
	$sql = "SELECT `password` FROM `user` WHERE `uname`='$name'";
	$result = $conn->query($sql);
	if($result->num_rows == 1){
		while($row = $result->fetch_assoc()) {
			if($row['password'] === md5($password)){
				echo "1";
				$_SESSION['USER'] = $name;
				break;
			}else{
				echo "密码不正确!";
			}
		}
	}else{
		echo "用户名不存在!";
	}
?>