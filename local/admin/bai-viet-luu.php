<?php 
include "kiem-tra-dang-nhap.php";

//print_r($_POST);

$id = $_POST['id'];
$parent_id = $_POST['parent_id'] ;
//cap nhat vao bai viet

$arr_bai_viet['id'] = $_POST['id'] ;

$arr_bai_viet['description'] = $_POST['description'] ;
$arr_bai_viet['noi_dung'] = $_POST['noi_dung'] ;
$arr_bai_viet['sap_xep'] = $_POST['sap_xep'] ;
$i=0;
$a = array();
while($parent_id != 0){	
	$a = $data->getRow($bai_viet,"id='" . $parent_id . "'");
	//echo '<pre>';print_r($a);echo '</pre>';
	$aTemp[$i]['url'] 		= $a[0]['url'];
	$aTemp[$i]['title'] 	= $a[0]['text'];
	$aTemp[$i]['id'] 		= $a[0]['id'];
	$aTemp[$i]['kinhdoanh'] = $a[0]['kinhdoanh'];
	$parent_id 				= $a[0]['parent_id'];
	$i++;
}

if(isset($aTemp)){
	
	$aTemp = array_reverse($aTemp);
	//echo '<pre>';print_r($aTemp);echo '</pre>';	
	//Luu HTML;
	$s='';
	foreach($aTemp as $k=>$v){
		if($k==0){
			$urlCanonical = "/";
			$aTemp[$k]['title'] = 'Home';
		}else{
			$urlCanonical = '/' . $aTemp[$k]['url'];
		}
		$s .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><meta itemprop="position" content="'. $k . '" /><a itemprop="item" href="'.$urlCanonical. '"><span itemprop="name">' . $aTemp[$k]['title']. '</span></a></li>';
		//$kinhdoanh = $aTemp[$k]['kinhdoanh'];
	}
	
	if($s !=""){
		$s = '<ol id="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">' . $s . '</ol>';
	}
	$arr_bai_viet['nav'] = $s;
}

if($arr_bai_viet['noi_dung'] == ''){
	$arr_bai_viet['baiviet'] = 0;
}else{
	$arr_bai_viet['baiviet'] = 1;
}
$date = date_create($_POST["ngay_viet"]);
$arr_bai_viet['ngay_viet'] = date_format($date, "d/m/Y");
$s = $data->update_arr($bai_viet,$arr_bai_viet);
echo '<pre>';print_r($arr_bai_viet);echo '</pre>';
echo $s;
/**/
//Update relate products

if(isset($_GET['kinhdoanh']) ){	
	foreach($field_sp as $k=>$v){
		$arr_san_pham[$k] = $_POST[$k];
	}
	$arr_san_pham['id'] = $_POST['id'] ;
	$s = $data->update_arr($_GET['kinhdoanh'],$arr_san_pham);
	// Update relating product data
	$lq_model = $_POST['lien_quan'];
	$sql_sp = "
		SELECT *
		FROM sanpham
		WHERE ma_san_pham ='$lq_model'
		LIMIT 0,12
		";
	$temp_arr = $data->query($sql_sp)->fetchAll();
	foreach($field_sp as $k=>$v){
		$arr_sp_lien_quan[$k] = $temp_arr[0][$k];
	}
	$arr_sp_lien_quan['gia_0'] = $arr_san_pham['gia_0'];
	$arr_sp_lien_quan['id'] = $temp_arr[0]['id'];
	$data->update_arr($_GET['kinhdoanh'],$arr_sp_lien_quan);
	//echo $s;
}

?>

