<?php
include_once '../admin/kiem-tra-dang-nhap.php';
	
$arr = array();

foreach($_GET as $k=>$v){	
	if($k != 'table'){
		$arr[$k]= str_replace("'","´",$v);
	}	
}

if(!isset($_GET['id'])){
	$arr['id'] = time();
}

$arr['sql'] = $data->insert($_GET['table'],$arr);

echo json_encode($_GET);
?>