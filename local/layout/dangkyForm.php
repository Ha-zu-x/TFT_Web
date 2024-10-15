<?php require_once "form-style.php" ?>
<div class="modal-header">
	<div class="modal-header-title">
		<span>Đăng ký</span>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-header-action">
		<span>Bạn đã có tài khoản?</span>
		<a href="">Đăng nhập</a>
	</div>
</div>
<div class="modal-body" id="modal-body">	
	<div class="row">
		<div class="col-md-12">
			<form id="custom-form"  class="alert alert-info" autocomplete="on">
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-user user-icon"></i>
					<input class="form-control" name="name" placeholder="Họ tên" type="name" autocomplete="username name" required >
				</div>
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-envelope"></i>
					<input class="form-control" name="email" placeholder="Email" type="email" autocomplete="username email" required >
				</div>
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-phone"></i>
					<input class="form-control" name="sdt" placeholder="SĐT" type="text" required >
				</div>
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-lock user-icon"></i>
					<input id="password-field" class="form-control" name="password"  placeholder="Mật khẩu" autocomplete="current-password" type="password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye toggle-password disabled"></span>
				</div>
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-lock user-icon"></i>
					<input class="form-control" name="cpassword"  placeholder="Xác nhận mật khẩu" autocomplete="current-password" type="password" required>
				</div>
			</form>
			<div id="inform" class="text-center text-danger"></div>
		</div>
	</div>	
</div>
<div class="modal-footer">
	<button class="btn btn-info btn-block" action="signup">Đăng ký</button>
</div>
<script>
	let TimOutFunc;
	$('.toggle-password').click(function() {
		$(this).toggleClass('disabled');
		let input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		}
		else input.attr("type", "password");
	});
	$('.modal-header-action a').click(function(e){
		e.preventDefault();
		$(".btn_dang_nhap").click();
	});
	const validateEmail = (email) => {
		return email.match(
			/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		);
	};
	const validatePassword = (password) => {
		return (password.length>3);
	}
	let WarnArr = ['Chưa nhập họ tên', 'Chưa nhập Email','Chưa nhập SĐT','Chưa nhập mật khẩu','Mật khẩu không khớp'];
	$("button[action=signup]").click(function(){
		let UserInp = $(".mg-contact-form-input");
		let FormFilled = 1;
		UserInp.each(function(id, val) {
			let Warn = $(this).find('.text-danger');
			let Inp = $(this).find('input');
			if(id==3) pass = Inp.val(); // Get password value
			else if(id==4) cpass = Inp.val(); // Get cpassword value
			let NoteContent = "";
			if(!Inp.val() || (id==4 && pass != cpass)) { // If not fill the field or cpassword not match
				NoteContent = `<span class='text-danger'>${WarnArr[id]}</span>`;
				FormFilled = 0;
				if(Warn.length>0) Warn.replaceWith(NoteContent);
				else $(this).append(NoteContent);
			} 
			if (Inp.val() || (id==4 && pass == cpass)) Warn.remove();
		})
		// Email validate
		let email = $(".mg-contact-form-input input[name='email']");
		if(email.val() && !validateEmail(email.val())) {
			email.find('.text-danger').remove();
			email.closest('div').append(`<span class='text-danger'>Email không hợp lệ</span>`);
			FormFilled = 0;
		}
		// Password validate
		let password = $(".mg-contact-form-input input[name='password']");
		if(password.val() && !validatePassword(password.val())) {
			password.find('.text-danger').remove();
			password.closest('div').append(`<span class='text-danger'>Mật khẩu phải chứa ít nhất 4 ký tự</span>`);
			FormFilled = 0;
		}
		if (FormFilled == 0) {
			$("#inform").text("");
			$("#inform").removeClass('inform--failed');
		} else {
			// Check if valid
			// Submit form
			var form = $("#custom-form");
			$.ajax({
				url: "/local/layout/controllerUserData.php",
				type: "POST",
				data: form.serialize() + '&signup=1',
				success: function(response) {
					response = JSON.parse(response); 
					if(response.code==1) { // Valid infor -> OTP check
						$.ajax({
							url:"/local/layout/user-otp.php",		
							type: "POST",
							data: '&signup_chk=1',
							beforeSend:function(){
								$("#modal").modal();					
							},
							success:function(otp_page){
								$("#load_modal").html(otp_page);
							},
						});
					} else { // Signup failed with errors 
						$("#inform").addClass('inform--failed');
						clearTimeout(TimOutFunc);
						TimOutFunc = setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
						$("#inform").html(response.signup_err);	// Get Mail Error message
					}
				}
			});

		}
	})

	
</script>