<?php
$email = $_POST['email'];

include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php"; // Need to edit here		

$sql = "
			SELECT *
			FROM thanhvien
			WHERE email='$email'
";

$arr = $data->query($sql)->fetchAll();
		
//echo '<pre>'; print_r($_POST); echo '</pre>';
		
if(!empty($arr)){
	echo  'Email đã đăng ký';
	
	$_POST['id'] = $arr['0']['id'];
	unset($_POST['pass_nhaclai']);
	
	$data->update_arr('thanhvien',$_POST);
	
	goto update;
}

if($_POST['pass'] != $_POST['pass_nhaclai']){
	echo  'Pass không khớp';
	goto ketthuc;
}

$_POST['id'] = time();
unset($_POST['pass_nhaclai']);

$data->insert('thanhvien',$_POST);

update:
$js_array = json_encode($_POST);
//echo "var javascript_array = ". $js_array . ";\n";

?>	
<script>	

	$('#modal').modal('hide');
	var user = <?php echo $js_array . ";\n"; ?>
	
	sessionStorage.setItem('user', JSON.stringify(user));
	
	$(".btn_user_info").attr('style','display:block')
	$(".btn_user_info").html("<span class='glyphicon glyphicon-user'></span> "+ user.name)	
	
	$(".btn_dang_nhap").attr('style','display:none')
	$(".btn_registration").attr('style','display:none')
	
	console.log(user)

</script>	

<?php
ketthuc:
?>

