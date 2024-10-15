<?php require_once "form-style.php" ?>

<div class="modal-header">
	<div class="modal-header-title">
		<span>Đăng nhập</span>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-header-action">
		<span>Bạn chưa có tài khoản?</span>
		<a href="">Tạo tài khoản</a>
	</div>
</div>
<div class="modal-body" id="modal-body">	
	<div class="row">
		<div class="col-md-12">
			<form id="custom-form"  class="alert alert-info" autocomplete="on">
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-user user-icon"></i>
					<input class="form-control" name="email" placeholder="Email/SDT" type="email" autocomplete="username email" required >
				</div>
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-lock user-icon"></i>
					<input id="password-field" class="form-control" name="password"  placeholder="Mật khẩu" autocomplete="current-password" type="password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye toggle-password disabled"></span>
				</div>
			</form>
			<div id="inform" class="text-center text-danger"></div>
		</div>
	</div>	
</div>
<div class="modal-footer">
	<div class="modal-footer-action">
		<div><input type="checkbox" name="account-save" style="margin-right: 6px;"><span>Lưu tài khoản</span></div>
		<a href="" id='forgot-password'>Quên mật khẩu</a>
	</div>
	<button class="btn btn-info btn-block" action="login">Đăng nhập</button>
</div>

<script>
	let TimOutFunc;
	// Eye toggle password display
	$('.toggle-password').click(function() {
		$(this).toggleClass('disabled');
		let input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		}
		else input.attr("type", "password");
	})

	$('.modal-footer-action span').click(function(e) {
		$("input[name=account-save]").click();
	});
	$('.modal-header-action a').click(function(e){
		e.preventDefault();
		$(".btn_registration").click();
	})
	// Forgot password 
	$("#forgot-password").click(function(e) {
		e.preventDefault();
		$.ajax({
			url:"/local/layout/forgot-password.php",				
			beforeSend:function(){
				$("#modal").modal();					
			},
			success:function(response){
				$("#load_modal").html(response);
			},
		});

	});

	// Login submit
	let WarnArr = ['Chưa nhập họ tên', 'Chưa nhập mật khẩu'];
	$("button[action=login]").click(function(e) {		
		let UserInp = $(".mg-contact-form-input");
		let FormFilled = 1;
		UserInp.each(function(id, val) {
			let Warn = $(this).find('.text-danger');
			let Inp = $(this).find('input');
			if(!Inp.val()) { // If not fill the field or cpassword not match
				let NoteContent = `<span class='text-danger'>${WarnArr[id]}</span>`;
				if(Warn.length>0) Warn.replaceWith(NoteContent);
				else $(this).append(NoteContent);
				FormFilled = 0;
			} else Warn.remove();
		})
		if (FormFilled == 0) {
			$("#inform").text("");
			$("#inform").removeClass('inform--failed');
		} else {
			var form = $("#custom-form");	
			$.ajax({
				url:"/local/layout/controllerUserData.php",
				type:"POST",
				data: form.serialize() + '&login=1', // serializes the form's elements.
				success:function(response){	
					response = JSON.parse(response); // Convert response to Json format
					if (response.code==1) { // Login successfully
						// Saving creds to browser 
						if ($("input[name=account-save]:checked").length>0) {
							const creds = new PasswordCredential({
								id: $("input[type=email").val(),
								password: $("input[name=password]").val(),
							});
							if (window.PasswordCredential) {
								navigator.credentials.store(creds);
							}
						}
						// ------- Change user display on Navbar -----//
						$(".btn_dang_nhap").attr('class','btn_user_info');
						$(".btn_user_info").html(`<span class='glyphicon glyphicon-user'></span> <span>${response.name}</span>`);
						// Replace Register by Logout button
						$('.btn_registration').attr('class', 'btn_user_logout') ;
						$('.btn_user_logout').text('Đăng xuất');
						// Add logout button scrript
						$('.btn_user_logout').click(function() {
							$.ajax({
							url: "/local/layout/logout-user.php",
							success: function () {								
								$(this).attr('class', 'btn_registration');
								$('.btn_registration').text('Đăng ký');
								$(".btn_user_info").attr('class','btn_dang_nhap');
								$(".btn_dang_nhap").html('');
								location.reload(true); // Refresh page
							}
							})
						});

						 // Add user info button script 
						$('.btn_user_info').click(function(e) {
							location.reload(true); // Refresh page
							// Header to user info page 
						})
						$('#modal').modal('hide');
					} else if (response.code == 2){ // OTP vertification
						$.ajax({
							url:"/local/layout/user-otp.php",				
							beforeSend:function(){
								$("#modal").modal();					
							},
							success:function(otp_page){
								$("#load_modal").html(otp_page);
							},
						});
						
					}else { // Login failed with errors
						$("#inform").addClass('inform--failed');
						clearTimeout(TimOutFunc);
						TimOutFunc= setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
						$("#inform").html(response.login_err);	// Get Mail Error message
					}
						
				},
			});
		}
	});
</script>