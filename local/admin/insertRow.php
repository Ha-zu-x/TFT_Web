<?php	
	include_once '../admin/kiem-tra-dang-nhap.php';	
    $table_name = $_GET['table'];	
	$col_name = $_GET['col_name'];	
    $col_val = $_GET['col_val'];
    $name_arr = explode(",",$col_name);
    $val_arr = explode(",",$col_val);
    $row_arr = array();

	foreach ($name_arr as $k => $v) {
        $row_arr[$v] = $val_arr[$k];
    }	
    $data->insert($table_name, $row_arr);


?>