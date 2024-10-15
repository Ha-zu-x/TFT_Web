<option selected="selected">--Chọn Phường/Xã--</option>
<?php
//echo '<pre>'; print_r($_POST); echo '</pre>';

$id = $_POST['id'];

include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php"; // Need to edit here		


$sql = "
	SELECT *
	FROM diadiem
	WHERE parent_id=$id
";

$arr = $data->query($sql)->fetchAll();
//echo '<pre>'; print_r($arr); echo '</pre>'
?>
	
<?php
	foreach($arr as $k=>$v){
?>
	<option value="<?php echo $v['text'] ?>" data-id="<?php echo $v['id'] ?>"><?php echo $v['text']; ?></option>
<?php
	}

?>