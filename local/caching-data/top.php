
<?php 
  include_once "C:/xampp/htdocs/local/admin/classDatabase/classData-02.php"; // Need to edit here		
  $username = '';
  $is_login=0;
  if (isset($_SESSION['email'])) {
    $mail = $_SESSION['email'];
    $phone = $mail; // Cause the same input on login form
    $sql = "SELECT * FROM thanhvien WHERE email = '$mail' OR phone = '$phone'";
    $res = $data->query($sql)->fetchAll();
    if(count($res) > 0) {
        $username = $res[0]['name'];
        $is_login = 1;
    }
    if($res[0]['status'] == 'verified') $isVerified = 1;
    else $isVerified = 0;
  }
  function get_image($img_name = ''):string {
    $sys_path = "/local/user-upload/imgs/"; // Default image system path (remove 'local' if public)
    $target_path = "../user-upload/imgs/" . $img_name;
    if(file_exists($target_path)) return  $sys_path.$img_name;
    return $sys_path.'/avt-default.jpg';// 
} 
?>

<div class="col-md-9 col-xs-12 header-top">
    <div class="notify-area">
        <span class="glyphicon glyphicon-bell"></span>
        <div class="working-time">
            <div>
                <pre>HTCCA Bo mạch dành cho máy pha Casadio, Cime, Faema.....       HTCLG Bo mạch dành cho máy pha Expobar, La Nuova Era, Bezzera,...       HTCNS Bo mạch dành cho máy pha Nuova Simonelli</pre>
            </div>
        </div>
    </div>
    <ul class="top-nav row">
        <li class="hotline-info"><span>Hotline: 0899.600.009</span></li>
        <li><a href="/gioi-thieu">Giới thiệu</a></li>
        <li><a href="/lien-he">Liên hệ</a></li>
        <li class="user">
            <?php if(!$username) echo "
            <a class='btn_dang_nhap'><span style='margin-right: 5px' class='glyphicon glyphicon-user'></span>Đăng nhập</a>
            <a class='btn_registration'>Đăng ký</a>
            ";
            else echo // Replace Href by '/tai-khoan/thong-tin-ca-nhan'
            "<a href='/local/layout/index.php/?q=thong-tin-ca-nhan' class='btn_user_info'><span style='margin-right: 5px' class='glyphicon glyphicon-user'></span>$username</a> 
            <a href='/local/layout/logout-user.php' class='btn_user_logout'>Đăng xuất</a>
            "; // Add user image show
            ;?>        
        </li>
    </ul>
    <!--  -->
    <div class="row">
        <div class="col-md-9 col-xs-9">
            <form id="form_tim_kiem">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" data-placement="bottom" data-toggle="popover-" data-trigger="focus" name="text" placeholder="Nhập từ khóa" required="" rows="1">
                        <span class="input-group-btn">
							<button class="btn btn-default" id="btn_tim_kiem" type="submit"><san class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3 col-xs-3 mobile-head-view">
            <a class="icon-cart col-md-3" data-target="#cart" data-toggle="modal"><span class="bg_default img-circle"><span class="glyphicon glyphicon-shopping-cart"></span></span> 
				<span style="display: none;" class="badge  total-count">0</span>
			</a>
            <div class="mobile-user-log">
                <div class="mobile-user-icon">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="user-log-box">
                    <div class="user-log-item">
                        <?php if(!$username) echo "<a class='btn_dang_nhap'>Đăng nhập</a>";
                        else echo 
                        "<a href='/local/layout/index.php/?q=thong-tin-ca-nhan' class='btn_user_info'>$username</a>"; // Replace Href by '/tai-khoan/thong-tin-ca-nhan'
                        ;?>
                        
                    </div>
                    <div class="user-log-item">
                        <?php if(!$username) echo "<a class='btn_registration'>Đăng ký</a>";
                            else echo "<a class='btn_user_logout'>Đăng xuất</a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu">
        <div class="container-">
            <nav id="nav-menu-container">
                <ul class="nav-menu " style="padding: 10px 0 40px 0;">
                    <li><a href="/">TRANG CHỦ</a></li>
                    <li><a href="/linh-kien-may-pha">BO MẠCH</a></li>
                    <li><a href="/may-pha-ca-phe">MÁY PHA CHẾ</a></li>
                    <li><a href="/sua-chua">SỬA CHỮA</a></li>
                    <li><a href="/bai-viet">BÀI VIẾT</a></li>
                    <li class="menu-has-children">
                        <a href="/dai-ly" class="sf-with-ul">ĐẠI LÝ</a>
                        <ul>
                            <li><a href="/dai-ly">Danh sách</a></li>
                            <li><a href="/thu-moi-hop-tac">Thư mời hợp tác</a></li>
                        </ul>
                    </li>
                    <li class="add-mb-head"><a href="/gioi-thieu">GIỚI THIỆU</a></li>
                    <li class="add-mb-head"><a href="/lien-he">LIÊN HỆ</a></li>
                    <li class="add-mb-head" style=" padding-right: 0; "><a href="/khuyen-mai"><span style="color:#FF0000;">KHUYẾN MÃI</span><img alt="khuyến mãi" height="40" src="/images/khuyen-mai.png" style="position: absolute; bottom:0;"></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>	
<script>
    <?php if (!$username) {
        ?>
        $(".btn_registration").click(function(){ // Need to edit here
            $.ajax({
            url:"/local/layout/dangkyForm.php",				
            beforeSend:function(){
                $("#modal").modal();					
            },
            success:function(response){
                $("#load_modal").html(response);
            },
            });
        });
        $(".btn_dang_nhap").click(function(){ // Need to edit here
            $.ajax({
                url:"/local/layout/dangnhapForm.php",				
                beforeSend:function(){
                    $("#modal").modal();					
                },
                success:function(response){
                    $("#load_modal").html(response);
                },
            });
        });
        <?php }
        ?>
</script>