var textbox = $(".textbox");
var textarea = $("<textarea id='textarea' class='form-control' name='Content' placeholder='Nội dung' rows='3' required></textarea>");
textarea.val(textbox.val());
textbox = textbox.replaceWith(textarea);

$("#button_submit").click(function(){
	
	$("#form-submit").validate({
		debug:false,
		errorClass:"text-danger",
		errorElement:"span",
		submitHandler:function(){
			$.ajax({
				url:"/PHPMailer/send-to-mail.php",
				type:"POST",
				data:$('#form-submit').serialize(),
				beforeSend:function(){$('#form-submit').html('<img class="center-block" src="/images/loading.gif" alt="loading">');},
				success:function(response){$('#form-submit').html(response);},				
			});
		}
	});
});
