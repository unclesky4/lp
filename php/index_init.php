<?php header('Content-type:text/html;charset=UTF-8');  //前台显示的时间和地点
	require "sql.php";
	$conn->query("set names utf8");
	$rs = $conn->query("select `time`,`addr` from `at`");
	if($rs->num_rows !== 1) {
		echo json_encode(array(
		"data" => array()
		),JSON_UNESCAPED_UNICODE);
		return ;
	}
	$data = array();
	while($row = $rs->fetch_assoc()) {
		$obj = array("Time"=>$row['time'],"addr"=>$row['addr']);
		array_push($data,$obj);
	}
	echo json_encode(array(
		"data"=>$data
	),JSON_UNESCAPED_UNICODE);
?>