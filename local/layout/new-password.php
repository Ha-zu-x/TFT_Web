<?php require_once "form-style.php" ?>
<div class="modal-header">
	<div class="modal-header-title">
		<span>Cập nhật mật khẩu</span>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
</div>
<div class="modal-body" id="modal-body">	
	<div class="row">
		<div class="col-md-12">
			<form id="custom-form"  class="alert alert-info" autocomplete="on">
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-lock user-icon"></i>
					<input id="password-field" class="form-control" name="password"  placeholder="Nhập mật khẩu mới" autocomplete="current-password" type="password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye toggle-password disabled"></span>
				</div>
				<div class="mg-contact-form-input">
					<i class="fa-solid fa-lock user-icon"></i>
					<input class="form-control" name="cpassword"  placeholder="Nhập lại mật khẩu" autocomplete="current-password" type="password" required>
				</div>
			</form>
			<div id="inform" class="text-center text-danger"></div>
		</div>
	</div>	
</div>
<div class="modal-footer">
	<button class="btn btn-info btn-block" action="change-password">Đổi mật khẩu</button>
</div>
<script>
    $('.toggle-password').click(function() {
		$(this).toggleClass('disabled');
		let input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		}
		else input.attr("type", "password");
	});
    let WarnArr = ['Chưa nhập mật khẩu','Mật khẩu không khớp'];
	$("button[action=change-password]").click(function(){
        let UserInp = $(".mg-contact-form-input");
		let FormFilled = 1;
        UserInp.each(function(id, val) {
			let Warn = $(this).find('.text-danger');
			let Inp = $(this).find('input');
			if(id==0) pass = Inp.val(); // Get password value
			else if(id==1) cpass = Inp.val(); // Get cpassword value
			if(!Inp.val() || (id==1 && pass != cpass)) { // If not fill the field or cpassword not match
				let NoteContent = `<span class='text-danger'>${WarnArr[id]}</span>`;
				if(Warn.length>0) Warn.replaceWith(NoteContent);
				else $(this).append(NoteContent);
				FormFilled = 0;
			}
			if (Inp.val() || (id==1 && pass == cpass)) Warn.remove();
		})
		if (FormFilled == 0) {
			$("#inform").text("");
			$("#inform").removeClass('inform--failed');
		} else {
            // Submit form
            var form = $("#custom-form");
            $.ajax({
                url:"/local/layout/controllerUserData.php",
                type:"POST",
                data: form.serialize() + '&change-password=1', // serializes the form's elements.
                success:function(response){	
                    response = JSON.parse(response); // Extract server response
                    if(response.code == 1) { 
                        $("#inform").addClass('inform--success');
                        $("#inform").removeClass('inform--failed');
                        $("#inform").html(response.info); 
                        setTimeout(function() {$(".btn_dang_nhap").click();}, 1000);
                    } else {
                        // Password change failed with errors
                        $("#inform").addClass('inform--failed');
                        setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
                        $("#inform").html(response.pwdchange_err);
                    }                  	
                }
            });
        }
    })

</script>