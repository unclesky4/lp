<?php header('Content-type:text/html;charset=UTF-8');
	session_start();
	require "sql.php";
	if(isset($_SESSION['USER'])){
		$conn->query("set names utf8");
		$draw = $_POST['draw'];
		//排序
		$order_column = $_POST['order']['0']['column'];//那一列排序，从0开始
		$order_dir = $_POST['order']['0']['dir'];//ase desc 升序或者降序
		//拼接排序sql
		$orderSql = "";
		if(isset($order_column)){
		    $i = intval($order_column);
		    switch($i){
		        case 0: $orderSql = " order by tname ".$order_dir; break;
		        case 1: $orderSql = " order by `cmd` ".$order_dir; break;
		        case 2: $orderSql = " order by `time` ".$order_dir; break;
		        case 3: $orderSql = " order by `addr` ".$order_dir; break;
		        default: $orderSql = '';
		    }
		}
		//搜索
		$search = $_POST['search']['value'];//获取前台传过来的过滤条件
		//分页
		$start = $_POST['start'];//从多少开始
		$length = $_POST['length'];//数据长度
		$limitSql = '';
		$limitFlag = isset($_POST['start']) && $length != -1 ;
		if ($limitFlag ) {
	   	$limitSql = " limit ".intval($start).",".intval($length);
		}
		//定义查询数据总记录数sql
		$sumSql = "select count(*) as sum from tb";
		//条件过滤后记录数 必要
		$recordsFiltered = 0;
		//表的总记录数 必要
		$result = $conn->query($sumSql);
		while($row = $result->fetch_assoc()) {
			$recordsTotal = $row['sum'];
		}
		
		$sumSqlWhere = " where tname like '%".$search."%' and `cmd` like '%".$search."%' and `time` like '%".$search."%'";
		$sumSqlWhere = $sumSqlWhere." and `addr` like '%".$search."%' ";
		if(strlen($search)>0){
			$rs = $conn->query($sumSql.$sumSqlWhere);
	    	while ($row = $rs->fetch_assoc()) {
	        	$recordsFiltered = $row['sum'];
	    	}
	   }else{
	    	$recordsFiltered = $recordsTotal;
	   }
		
		
		$totalResultSql = "select * from tb ";
		$data = array();
		if(strlen($search)>0) {
		    //如果有搜索条件，按条件过滤找出记录
		    $sql = $totalResultSql.$sumSqlWhere.$orderSql.$limitSql;
		    $dataResult = $conn->query($sql);
		    while ($row = $dataResult->fetch_assoc()) {
		        $obj = array($row['tname'], $row['cmd'],$row['time'],$row['addr']);
		        array_push($data, $obj);
		    }
		}else{
		    //直接查询所有记录
		    $dataResult = $conn->query($totalResultSql.$orderSql.$limitSql);
		    while ($row = $dataResult->fetch_assoc()) {
		        $obj = array($row['tname'], $row['cmd'],$row['time'],$row['addr']);
		        array_push($data,$obj);
		    }
		}
		echo json_encode(array(
		   "draw" => intval($draw),
		   "recordsTotal" => intval($recordsTotal),
		   "recordsFiltered" => intval($recordsFiltered),
		   "data" => $data
		),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array(
			"draw" => 0,
	    	"recordsTotal" => 0,
	    	"recordsFiltered" => 0,
	    	"data" => array()		
		));
	}
?>