<?php
$get_email = $_POST['email'];
$get_pass = $_POST['pass'];

include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php"; // Need to edit here	
include_once "/local/layout/controllerUserData.php"; // Need to edit here		



if(empty($arr)){
	echo 0;
} else {
	$php_array = $arr[0];
	$js_array = json_encode($php_array);
?>	
<script>	
	var user = <?php echo $js_array . ";\n"; ?>
	sessionStorage.setItem('user', JSON.stringify(user));
	$(".btn_user_info").attr('style','display:block')
	$(".btn_user_info").html("<span class='glyphicon glyphicon-user'></span> <?php echo $arr[0]['name']; ?>")	
	
	// $(".btn_dang_nhap").attr('style','display:none')
	$(".btn_registration").attr('style','display:none')
	$('#modal').modal('hide');

</script>	
<?php
}
?>



