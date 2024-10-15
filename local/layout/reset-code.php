<?php require_once "form-style.php" ;
session_start();
$info = "";
if(isset($_POST["reset_code"])) {
    $info = $_SESSION["info"];
}
?>
<div class="modal-header">
	<div class="modal-header-title">
		<span>Xác thực đổi mật khẩu</span>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
</div>
<div class="modal-body" id="modal-body">	
	<div class="row">
		<div class="col-md-12">
			<form id="custom-form" class="alert alert-info" autocomplete="on">
				<div class="mg-contact-form-input">
					<input class="form-control" name="otp" placeholder="Nhập mã xác thực" type="number" required >
				</div>
			</form>
			<div id="inform" class="text-center text-danger <?php if($info) echo 'inform--success';?>"><?php if($info) echo $info;?></div>
		</div>
	</div>	
</div>
<div class="modal-footer">
	<button class="btn btn-info btn-block" action='check-reset-otp'>Xác thực</button>
</div>

<script type="text/javascript>">
$("button[action=check-reset-otp]").click(function(e) {
    var form = $("#custom-form");	
    let OtpWarn = $(".mg-contact-form-input .text-danger");
    if(!$("input[name=otp").val()) {
			let NoteContent = "<span class='text-danger'>Chưa nhập mã xác thực</span>";
			if (OtpWarn.length>0) OtpWarn.replaceWith(NoteContent);
			else $(".mg-contact-form-input").append(NoteContent);
			$("#inform").text("");
			$("#inform").removeClass('inform--failed');
            $("#inform").removeClass('inform--success'); // If success message from Email signup

	} else 
    {
        OtpWarn.remove();
        $.ajax({
				url:"/local/layout/controllerUserData.php",
				type:"POST",
				data: form.serialize() + '&check-reset-otp=1', // serializes the form's elements.
				success:function(response){	
                    response = JSON.parse(response); // Extract returned error
                    if(response.code == 1) { // OTP verified successfully
                        // New password page switch 
                        $.ajax({
							url:"/local/layout/new-password.php",		
							type: "POST",
							beforeSend:function(){
								$("#modal").modal();					
							},
							success:function(response){
								$("#load_modal").html(response);
							},
						});
                    } else {
                        // OTP confirm failed with errors
						$("#inform").addClass('inform--failed');
                        $("#inform").removeClass('inform--success'); // If success message from Email signup
                        setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
                        $("#inform").html(response.reset_otp_err); // Get OTP error message
                    }                  	
                }
        });
    }

})

</script>