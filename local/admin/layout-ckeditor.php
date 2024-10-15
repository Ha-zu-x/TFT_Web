<?php 
include 'kiem-tra-dang-nhap.php';

//echo '<pre>';print_r($_GET);echo '</pre>';
$vitri = $_GET['vitri'];

$sql = "
SELECT *
FROM $layout
WHERE vitri = '$vitri'
";

$arr = $data->query($sql)->fetchAll();

?>
<div id="myAlert" class="alert alert-success fade in" style="position: fixed;width: 100%;top: 0;bottom:0;overflow-y:scroll;overflow-x:hidden;z-index: 1;" role="alert">

<form id="form_submit" class="form-horizontal">

	<textarea name="content" id="editor"><?php echo $arr[0]['content'] ?></textarea>    

    <input type="text" name="id" value="<?php echo $arr[0]['id'] ?>" style="display:none" />

	<input type="text" name="vitri" value="<?php echo $arr[0]['vitri'] ?>" style="display:none" />

	<input type="text" name="table" value="<?php echo $layout ?>" style="display:none" />

    <hr />

<input id="btn_submit" class="btn btn-info" type="submit" value="Lưu" />
<button type="button" class="btn btn-default" data-dismiss="alert">Hủy</button>	

<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/js/sample.js"></script>
<script>
initSample();

    $("#myAlert").on('closed.bs.alert', function(){
        
    });
	
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
				url:"layout-luu.php",
				type:"POST",
				data:$('#form_submit').serialize(),
				beforeSend:function(){
					$('#form_submit').html('<center>Xin chờ ...</center>');
				},
				success:function(response){
					//$('#bien_tap').html(response);
					$(".alert").alert('close')
				},
				
			});
		}
	});
});
</script>

</form>

</div>