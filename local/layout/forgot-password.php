<?php require_once "form-style.php" ;
?>
<div class="modal-header">
	<div class="modal-header-title">
		<span>Quên mật khẩu?</span>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
</div>
<div class="modal-body" id="modal-body">	
	<div class="row">
		<div class="col-md-12">
            <form id="custom-form" class="alert alert-info" autocomplete="on">
                <div class="mg-contact-form-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input class="form-control" name="email" placeholder="Nhập Email khôi phục" type="email" autocomplete="username email" required >
                </div>
            </form>
			<div id="inform" class="text-center text-danger "></div>
		</div>
	</div>	
</div>
<div class="modal-footer">
	<button class="btn btn-info btn-block" action='check-email'>Xác thực Email</button>
</div>
<script>
    $("button[action=check-email]").click(function(e) {
        var form = $("#custom-form");	
        let MailWarn = $(".mg-contact-form-input .text-danger");
        if(!$("input[name=email").val()) {
                let NoteContent = "<span class='text-danger'>Chưa nhập Email</span>";
                if (MailWarn.length>0)MailWarn.replaceWith(NoteContent);
                else $(".mg-contact-form-input").append(NoteContent);
                $("#inform").text("");
                $("#inform").removeClass('inform--failed');
        } else 
        {
            MailWarn.remove();
            $.ajax({
                    url:"/local/layout/controllerUserData.php",
                    type:"POST",
                    data: form.serialize() + '&check-email=1', // serializes the form's elements.
                    beforeSend: function() {
                        $(this).prop("disabled", true); // Disable submit button while waiting for response 
                    },
                    success:function(response){	
                        response = JSON.parse(response); // Extract returned error
                        if(response.code == 1) { // Mail sent successfully
                            $.ajax({
                                url:"/local/layout/reset-code.php",		
                                type: "POST",
                                data: '&reset_code=1',
                                beforeSend:function(){
                                    $("#modal").modal();					
                                },
                                success:function(otp_page){
                                    $("#load_modal").html(otp_page);
                                },
                            });
                        } else {
                            // Email code sending failed with errors
                            $("#inform").addClass('inform--failed');
                            setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
                            $("#inform").html(response.mcheck_err);
                        }                  	
                    }
            });
        }

    })
</script>