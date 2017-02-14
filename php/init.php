<?php header('Content-type:text/html;charset=UTF-8');   //用于显示后台登陆的用户名
	session_start();
	echo $_SESSION['USER'];
?>