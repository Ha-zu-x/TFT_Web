<?php	
	include_once '../admin/kiem-tra-dang-nhap.php';	
    $table_name = $_GET['table'];	
	$col_name = $_GET['col_name'];	
    $col_val = $_GET['col_val'];
    $col_id = $_GET['col_id'];
    $row_id = $_GET['row_id'];
    $name_arr = explode("|",$col_name);
    $val_arr = explode("|",$col_val);
	foreach ($name_arr as $k => $v) {
        $data->update($table_name, $v, $val_arr[$k], $col_id, $row_id);
    }	
?>