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
    hr {
        margin: 1rem auto 1rem auto;
    }
    .nav .active {
        border-right: 4px solid #337ab7;
        background-color: #c8e4f7;
    }
    .nav .active:hover {
        background-color: #b9d3e5;
    }
    .warning-container {
        display: flex;
        padding: 15px;
        background-color: #ffebaf;
        margin-bottom: 20px;
        align-items: center;
    }
    .warning-title {
        font-size: 16px;
        font-weight: 600;
        color: #e97617;
    }
    .warning-container a{
        color: #81a7f1;
    }
    .warning-icon {
        font-size: 30px;
        color: #dea413;
        margin-right: 15px;
    }
    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 1px solid #ccc;
        object-fit: contain;
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
                    <li><a class= "active" href="/local/layout/index.php/?q=thong-tin-ca-nhan">Thong tin ca nhan</a></li>
                    <li><a href="/local/layout/index.php/?q=lich-su-mua-hang">Lich su mua hang</a></li>
                    <li ><a href="/local/layout/index.php/?q=lich-su-sua-chua">Lich su sua chua</a></li>
                    <li><a href="/local/layout/index.php/?q=chinh-sua-thong-tin">Cap nhat thong tin</a></li>
                    <li><a href="/local/layout/index.php/?q=doi-mat-khau">Doi mat khau</a></li>
                </ul>
            </div>
        </div>
        <!-- Main body -->
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-body">
                    <?php if (!$isVerified) {
                    ?>
                    <div class="warning-container" >
                        <div class="warning-icon"><i class="fa fa-exclamation-triangle"></i></div>
                        <div class="warning-content">
                            <p class="warning-title">Tài khoản chưa được xác thực</p>
                            <a href="#">Xác thực qua email</a>
                        </div>
                    </div>
                   <?php } ?>
                    <!--  -->
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Họ và tên</span>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['name'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Số điện thoại</span>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['phone'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Email</span> 
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['email'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Địa chỉ</span>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['address'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Giới tính</span>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['gender'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Ngày sinh</span>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['birthday'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="item-name">Giới thiệu</span>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?=$res[0]['introduction'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
