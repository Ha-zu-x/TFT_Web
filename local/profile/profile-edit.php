<?php include_once "../layout/form-style.php" ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
        top: -50%;
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
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 1px solid #ccc;
        object-fit: contain;
    }
    #profile-img {
        display: none;
    }
    #inform {
        margin-left: 16.66666667%;
    }
    @media (max-width: 768px) {
        .col-12 {
            width: 100%;
        }
        .profile-img-edit {
            left: 20%;
        }
        #inform {
            margin-left: 0;
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
                            <div style="display: flex; justify-content: center; position: relative;" >
                                <label class="profile-img-edit" for="profile-img"><span class="glyphicon glyphicon-pencil" ></span></label>
                                <input onchange="display_image(this.files[0])" type="file" id="profile-img">
                                <h4 class='username'><?=$res[0]['name']?></h4>
                                <img  src="/local/user-upload/imgs/<?=$res[0]['status']?>_icon.png" alt="" style="width: 20px; margin: 20px 0px 0px 10px; object-fit: contain;">
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
                    <li><a class= "active" href="/local/layout/index.php/?q=chinh-sua-thong-tin">Cap nhat thong tin</a></li>
                    <li><a  href="/local/layout/index.php/?q=doi-mat-khau">Doi mat khau</a></li>
                </ul>
            </div>
        </div>
        <!-- Main body -->
        <div class="col-md-9">
            <form action="#" id="custom-form">
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Họ và tên</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-user user-icon"></i>
                        <input class="form-control" name="name"  type="name" value="<?=$res[0]['name']?>">
                    </div>
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Số điện thoại</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-phone"></i>
                        <input class="form-control" name="sdt" value="<?=$res[0]['phone']?>" type="text">
                    </div>
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Email</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-envelope"></i>
                        <input class="form-control" name="sdt" value="<?=$res[0]['email']?>" type="text">
                    </div>
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Địa chỉ</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-solid fa-location-dot"></i>
                        <input class="form-control" name="address" value="<?=$res[0]['address']?>" type="text" >
                    </div>
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Giới tính</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="field-list">
                            <div class="custom-select">
                                <button
                                    class="select-button form-control"
                                    role="combobox"
                                    aria-labelledby="select button"
                                    aria-haspopup="listbox"
                                    aria-expanded="false"
                                    aria-controls="select-dropdown">
                                    <span class="selected-value"><?=$res[0]['gender']?></span>
                                    <span class="arrow"></span>
                                </button>
                                <ul class="select-dropdown" role="listbox" id="select-dropdown">
                                    <li role="option">
                                        <input type="radio" />
                                        <label>Chọn...</label>
                                    </li>
                                    <li role="option">
                                        <input type="radio" />
                                        <label>Nam</label>
                                    </li>
                                    <li role="option">
                                        <input type="radio" />
                                        <label>Nữ</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="mg-contact-form-input">
                    <div class="col-sm-2">
                        <span class="item-name">Ngày sinh</span>
                    </div>
                    <div class="col-sm-6 col-12">
                        <i class="fa-regular fa-calendar-days"></i>
                        <input class="form-control" name="birthday" id="datepicker" value="<?=$res[0]['birthday']?>" type="text" >
                    </div>
                </div>
            </form>
            <div id="inform" class="col-sm-6 col-12 text-center text-danger"></div>
            <button action="profile-edit" class="btn btn-primary float-left save-btn">Lưu</button>
        </div>
    </div>
</div>
<script>
    //  -------- Custom select options ------------------ //
    const customSelect = document.querySelector(".custom-select");
    const selectBtn = document.querySelector(".select-button");
    const selectedValue = document.querySelector(".selected-value");
    const optionsList = document.querySelectorAll(".select-dropdown li");
    selectBtn.addEventListener("click", (e) => {
        e.preventDefault();
        customSelect.classList.toggle("active");
        selectBtn.setAttribute(
            "aria-expanded",
            selectBtn.getAttribute("aria-expanded") === "true" ? "false" : "true"
        );
    });
    optionsList.forEach(function(option, id) {
        function handler(e) {
            // Click Events
            if (e.type === "click" && e.clientX !== 0 && e.clientY !== 0) {
                if(id>0) selectedValue.textContent = this.children[1].textContent;
                else selectedValue.textContent = "";
                customSelect.classList.remove("active");
            }

        }
        option.addEventListener("click", handler);
       
    });
    $("#datepicker").datepicker(
        {
            dateFormat: "dd-mm-yy"
        }
    );
    // --- Form handlers --- //
    let TimOutFunc;
    let img_added = false;
    function display_image(file) {
        let img = $(".profile-img");
        img.attr("src", URL.createObjectURL(file)) ;
        img_added = true;
    }
    // Collect and send data
    function SendData() {
        let formData = new FormData();
        let img_uploaded = document.querySelector("#profile-img");
        let formInp = $(".mg-contact-form-input").find('.form-control');
        formInp.each(function(id, e) {
            formData.append(e.name, e.value);
        })
        if (img_added) formData.append('image', img_uploaded.files[0]);
        formData.append('gender', selectedValue.textContent);
        formData.append('profile-edit', true);
        $.ajax({
            url: "/local/profile/profileController.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);
                if(response.code == 1) {
                    $("#inform").removeClass('inform--failed');
                    $('.btn_user_info').text(response.info);
                    $('.username').text(response.info);
                    $("#inform").addClass('inform--success');
                    $("#inform").html('Your profile has been updated successfully');
                    setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--success');}, 5000);
                } else {
                    $("#inform").removeClass('inform--success');
                    $("#inform").addClass('inform--failed');
                    setTimeout(function() {$("#inform").text(""); $("#inform").removeClass('inform--failed');}, 5000);
                    $("#inform").html(response.update_err);	// Get Profile Edit Error message
                }
            },
        })
    }
    // Add Input validation handlers
    let WarnArr = ['Chưa nhập họ tên','Chưa nhập SĐT', 'Chưa nhập Email'];
	$("button[action=profile-edit]").click(function(){
		let UserInp = $(".mg-contact-form-input");
		let FormFilled = 1;
		UserInp.each(function(id, val) {
            if(id < 3) { // Validate only on 3 first fields
                let Warn = $(this).find('.text-danger');
                let Inp = $(this).find('input');
                if(!Inp.val() ) { // If not fill the field 
                    let NoteContent = `<span class='text-danger'>${WarnArr[id]}</span>`;
                    if(Warn.length>0) Warn.replaceWith(NoteContent);
                    else $(this).append(NoteContent);
                    FormFilled = 0;
                } else Warn.remove();
            } else return;
		})
        
		if (FormFilled == 0) {
			$("#inform").text("");
			$("#inform").removeClass('inform--failed');
		} else {
            SendData();
		}
    })
</script>

