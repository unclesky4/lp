<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	if(session_destroy()){
		echo "1";
	}else{
		echo "0";
	}
?>