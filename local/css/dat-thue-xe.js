$("#button_thue_xe").click(function(){	
	$("#form_thue_xe").validate({
		debug:false,
		errorClass:"text-danger",
		errorElement:"span",
		submitHandler:function(){
			$.ajax({
				url:"/PHPMailer/send-to-mail.php",
				type:"POST",
				data:$('#form_thue_xe').serialize(),
				beforeSend:function(){$('#form_thue_xe').html('<img class="center-block" src="/images/loading.gif" alt="loading">');},
				success:function(response){$('#form_thue_xe').html(response);},				
			});
		}
	});
});