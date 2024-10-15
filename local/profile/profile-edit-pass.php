<?php include_once "../layout/form-style.php" ?>
<style type="text/css">
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }
    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
    .card h6 {
        margin-top: 1.5rem;
    }
    .item-name {
        font-weight: 600;
    }
    .text-secondary {
        color: #6c757d!important;
    }
    .mg-contact-form-input i {
		top: 12px;
        right: 20px;
        left: auto;
    }
    .mg-contact-form-input input {
        padding-inline-start: 1rem; /* overwrite new value in common style file */
    }
    .field-list {
        width: 100%;
    }
    .save-btn {
        display: block;
        margin-top: 40px;
        margin-left: 8px;
        border-radius: 5px;
        outline: none;
    }
    .mg-contact-form-input label {
        margin-bottom: 0px;
    }
    .nav .active {
        border-right: 4px solid #337ab7;
        background-color: #c8e4f7;
    }
    .nav .active:hover {
        background-color: #b9d3e5;
    }
    .view-account .arrow{
        border-top: 6px solid #979696;
    }
   
    .profile-img-edit {
        position: absolute;
        left: 10%;
        top: -100%;
        font-size: 14px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #fff;
    }
    .profile-img-edit:hover {
        cursor: pointer;
    }
    .profile-img {
        border-radius: 50%;
        object-fit: contain;
    }
    #profile-img {
        display: none;
    }
    #inform {
        margin-left: 16.66666667%;
    }
    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 1px solid #ccc;
        object-fit: contain;
    }
    @media (max-width: 768px) {
        .col-12 {
            width: 100%;
        }
        .profile-img-edit {
            left: 20%;
        }
    }
    
</style>
<div class="view-account">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breacrumb-item"><a href="">User</a></li>
            <li class="breacrumb-item active" aria-current="page">Profile</li>

        </ol>
    </nav>
    <div class="row-gutters-sm">
    <!-- Side content -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?=get_image($res[0]['image'])?>" alt="<?=$res[0]['name'] ?>_avatar" class="rounded-circle profile-img" >
                        <div class="mt-3">
                            <div style="display: flex; justify-content: center;" >
                                <h4><?=$res[0]['name']?></h4>
                                <img src="/local/user-upload/imgs/<?=$res[0]['status']?>_icon.png" alt="" style="width: 20px; margin: 20px 0px 0px 10px; object-fit: contain;">
                            </div>
                            <p class="text-secondary mb-1"><?=$res[0]['tac']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <ul class="nav">
                    <li><a  href="/local/layout/index.php/?q=thong-tin-ca-nhan">Thong tin ca nhan</a></li>
                    <li><a href="/local/layout/index.php/?q=lich-su-mua-hang">Lich su mua hang</a></li>
                    <li ><a  href="/local/layout/index.php/?q=lich-su-sua-chua">Lich su sua chua</a></li>
                    <li><a href="/local/layout/index.php/?q=chinh-sua-thong-tin">Cap nhat thong tin</a></li>
                    <li><a class= "active" href="/local/layout/index.php/?q=doi-mat-khau">Doi mat khau</a></li>
                </ul>
            </div>
        </div>
        <!-- Main body -->
        <div class="col-md-9">
            <form action="#" method="post" id="custom-form">
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Mật khẩu hiện tại</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-lock user-icon"></i>
                        <input  class="form-control" name="password"  type="password" >
                    </div>
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Mật khẩu mới</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-lock user-icon"></i>
                        <input  class="form-control" name="npassword"  type="password" >
                    </div>
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Nhập lại mật khẩu</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-lock user-icon"></i>
                        <input class="form-control" name="cpassword"  type="password" >
                    </div>
                </div>
            </form>
            <div id="inform" class="col-sm-6 col-12 text-center text-danger"></div>
            <button action="change-password" class="btn btn-primary float-left save-btn">Lưu</button>
        </div>
    </div>
</div>
<script>
    let WarnArr = ['Chưa nhập mật khẩu','Chưa nhập mật khẩu','Mật khẩu không khớp'];
    $("button[action=change-password]").click(function(){
        let UserInp = $(".mg-contact-form-input");
		let FormFilled = 1;
        UserInp.each(function(id, val) {
			let Warn = $(this).find('.text-danger');
			let Inp = $(this).find('input');
			if(id==1) pass = Inp.val(); // Get password value
			else if(id==2) cpass = Inp.val(); // Get cpassword value
			if(!Inp.val() || (id==2 && pass != cpass)) { // If not fill the field or cpassword not match
				let NoteContent = `<span class='text-danger'>${WarnArr[id]}</span>`;
				if(Warn.length>0) Warn.replaceWith(NoteContent);
				else $(this).append(NoteContent);
				FormFilled = 0;
			}
			if (Inp.val() || (id==2 && pass == cpass)) Warn.remove();
		})
        // Password validate
        const validatePassword = (password) => {
		    return (password.length>3);
	    }
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
           let form = $("#custom-form");
           $.ajax({
            url: "/local/profile/profileController.php",
            type: "POST",
            data: form.serialize() + "&profile-edit-pass=1",
            success: function(response) {
                response = JSON.parse(response);
                if(response.code == 1) {
                    $("#inform").removeClass('inform--failed');
                    $("#inform").addClass('inform--success');
                    $("#inform").html('Your password has been changed');
                    setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--success');}, 5000);
                    form[0].reset();

                } else {
                    $("#inform").addClass('inform--failed');
                    $("#inform").removeClass('inform--success');
                    setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
                    $("#inform").html(response.pwd_edit_err);	// Get Profile Edit Error message
                }
            }
           })
        }
    })
</script>