<?php	
	include_once '../admin/kiem-tra-dang-nhap.php';	
    $table_name = $_GET['table'];	
    $col_id = $_GET['col_id'];
    $row_id = $_GET['row_id'];
    $name_arr = explode(",",$col_name);
    $val_arr = explode(",",$col_val);
    $data->dele($table_name, $col_id, $row_id);
		
?>