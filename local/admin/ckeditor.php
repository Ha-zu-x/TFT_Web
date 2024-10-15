<?php 
include 'kiem-tra-dang-nhap.php';
//echo '<pre>';print_r($_GET);echo '</pre>';
$id = $_GET['id'];

$sql = "
	SELECT *
	FROM $bai_viet
	WHERE id = $id
";

$arr = $data->query($sql)->fetchAll();

$_SESSION['url'] = $arr[0]['url'];
//echo '<pre>';print_r($_SESSION);echo '</pre>';

?>
<div class="alert alert-success fade in" role="alert"  style="position: fixed;width: 100%;top: 0;bottom: 0;; overflow-y:scroll;overflow-x:hidden;">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>


Biên tập ID: <?php echo $arr[0]['id'] ?> - URL: <?php echo '/' . $arr[0]['url'] ?>

<form id="form_submit" class="form-horizontal">
    <input type="text" style="display:none" name="id" 				value="<?php echo $_GET['id'] ?>"  />
	<input type="text" style="display:none" name="parent_id" 				value="<?php echo $arr[0]['parent_id'] ?>"  />	
	<div class="form-group">
		<label class="col-sm-2 control-label">Mô tả</label>
		<div class="col-sm-10">
		  <input class="form-control" type="text" name="description" value="<?php echo $arr[0]['description'] ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Sắp xếp</label>
		<div class="col-sm-10">
		  <input style="width:350px;"  class="form-control" type="text" name="sap_xep" value="<?php echo $arr[0]['sap_xep'] ?>" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Ngày</label>
		<div class="col-sm-10">
		  <input style="width:350px;"  class="form-control" type="date" name="ngay_viet" value="<?php echo date("d/m/Y", strtotime($arr[0]['ngay_viet'])) ?>" >
		</div>
	</div>	
<?php
/**/
$param_save_kinhdoanh = '';

if($arr[0]['kinhdoanh'] != '' && $arr[0]['chitiet']==1 ){
	$param_save_kinhdoanh = '?kinhdoanh=' . $arr[0]['kinhdoanh'];
	$sp_table = $arr[0]['kinhdoanh'];
	$sql = "
		SELECT *
		FROM $sp_table
		WHERE id = $id
	";
	
	$arr_get_table_sp = $data->query($sql)->fetchAll();
	//echo '<pre>';print_r($arr_get_table_sp);echo '</pre>';
	
	foreach($field_sp as $k=>$v){
		
	?>
	<div class="form-group">
		<label class="col-sm-2 control-label"><?php echo $v ?></label>
		<div class="col-sm-10">
	<?php
		$char_2_before = substr($k,0,2);
		switch($char_2_before){
			case 'n_':?>
			<input style="width:350px;"  class="form-control" type="number" name="<?php echo $k ?>" value="<?php echo $arr_get_table_sp[0][$k] ?>" >
		<?php
			break;
			case 't_': ?>
			<textarea rows="5" style="width:350px;" class="form-control" name="<?php echo $k ?>" ><?php echo $arr_get_table_sp[0][$k] ?></textarea>
		<?php
			break;
			default: ?>
			<input style="width:350px;"  class="form-control" type="text" name="<?php echo $k ?>" value="<?php echo $arr_get_table_sp[0][$k] ?>" >
		<?php } ?>
		</div>
	</div>
    <?php
		
	}
}
?>
	<textarea type="text" name="noi_dung" id="editor"><?php echo $arr[0]['noi_dung']; ?></textarea>


<input id="btn_submit" class="btn btn-info" type="submit" value="Lưu" />
<button type="button" class="btn btn-default" data-dismiss="alert">Hủy</button>	

<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/js/sample.js"></script>
<script>
initSample();
	
$("#btn_submit").click(function(){
	$("#form_submit").validate({
		debug:false,
		errorClass:"text-danger",
		errorElement:"span",
		rules:{
			"text":{required:true},
			"description":{required:true,},
		},
		messages:{
			"text":{required:"Nhập tiêu đề"},
			"description":{required:"Nhập mô tả"},
			
		},
		submitHandler:function(){
		
			$.ajax({
				url:"bai-viet-luu.php<?php echo $param_save_kinhdoanh ?>",
				type:"POST",
				data:$('#form_submit').serialize(),
				beforeSend:function(){
					$('#form_submit').html('<center>Xin chờ ...</center>');
				},
				success:function(response){
					//$('#form_submit').html(response);
					$(".alert").alert('close')
				},
				
			});
		
			
		}
	});
});
</script>

</form>

</div>