<?php	
	include_once '../admin/kiem-tra-dang-nhap.php';	
	$url = convert_vi_to_en(str_replace(' ','-',$_GET['text']));	
	$parent_id = $_GET['parent_id'];	
	$a = $data->getRow($bai_viet,"id=$parent_id");	
	$_GET['id'] = time();
	
	if($a[0]['id']==1){
		$_GET['kinhdoanh'] = $url;
	}else{
		$_GET['kinhdoanh'] = $a[0]['kinhdoanh'];	
	}

	$sql = "
		SELECT *
		FROM $bai_viet
		WHERE url='$url'
	";
	$arr_id = $data->query($sql)->fetchAll();
	if(!empty($arr_id)) $url .= '-'.$_GET['id'];
	$_GET['url'] = $url;
	include '../control/insert.php';
/*	
	$count = $data->Counter_parent_id($_GET['parent_id']);
	$data->update($bai_viet,'count_children',$count," WHERE id='".$_GET['parent_id']."'");
*/
	//echo $_GET['id'];
	
	
	
?>