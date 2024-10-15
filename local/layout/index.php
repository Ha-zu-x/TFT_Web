<?php session_start(); ?>  <!--  Need to edit here -->
<!DOCTYPE html>
<html lang="vi" style="position: relative;min-height: 100%;">
<head>	
<link href="/local/css/font-awesome.min.css" rel="stylesheet" /> 
<link href="/local/css/bootstrap.min.css" rel="stylesheet">
<link href="/local/css/style.min.css" rel="stylesheet">
<link href="/local/css/prod_detail.css?v=3" rel="stylesheet">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="author" content = "Tifatech">
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'   />
<link rel="canonical" href="https://tifatech.vn/thu-moi-hop-tac" />
<title>Danh sach sua chua | Tifatech</title>
<meta name="description" content="Thư mời hợp tác cùng Tifatech" />	
<base href="/" />
<meta property="og:url"                content="https://tifatech.vn/thu-moi-hop-tac" />
<meta property="og:title"              content="Thư mời hợp tác" />
<meta property="og:description"        content="Thư mời hợp tác cùng Tifatech" />
<meta property="og:image"              content="/local/user-upload/imgs/tft-logo.png" />
<!-- <meta property="fb:app_id" content="502876775232594" /> -->
<meta property="fb:app_id" content="628148988939051"/>
<link href="/local/user-upload/imgs/k-co-nen-tft.png" rel="icon" type="image/x-icon">
<script src="/local/js/jquery.min.js"></script>
<link href="/local/css/owl.carousel.min.css" rel="stylesheet">
<link href="/local/css/owl.theme.css" rel="stylesheet">
<link href="/local/css/linearicons.css" rel="stylesheet">
<link href="/local/css/sidebar-collapse.css" rel="stylesheet"> 
<link href="/local/css/dimbox.min.css" rel="stylesheet">
<?php include_once 'C:\xampp\htdocs\local\caching-data\head.html'; ?>  
</head>
<body class="mg-boxed-" id="main">
<!-- For top banner -->
<a href = "/linh-kien-may-pha" class="banner-notify">
	<span class="glyphicon glyphicon-remove"></span>
</a>
<!--  -->
<header style=" font-weight: bold; padding-top: 10px;">
	<div class="container">
		<div class="row">
			<div class="mobile-head row col-md-3 col-xs-12">
				<p class = "col-xs-9 col-md-12"><a href="/" id="me"><img alt="tifatech Đà Nẵng" class="logo-img img-responsive center-block" src="/local/user-upload/imgs/tft-logo.png" title="tifatech Đà Nẵng" width="861"></a></p>
			</div>
      <?php include_once 'C:\xampp\htdocs\local\caching-data\top.php'; ?>  <!-- Edit to relative path -->
      
    </div>
	</div>
	<div class="shipping-info">
		<img src="/local/user-upload/imgs/FreeShip_img.png" alt="" class="shipping-info-img">
	</div>
</header>
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
	<div class="modal-dialog modal-lg-"  role="document">
		<div class="modal-content" id="load_modal">
		</div>
	</div>
</div>
<section class="mg-page">
	<div class='container'>
		<!-- <h1 class="title"><b>Danh sách sửa chữa</b></h1> -->
		<h1 class="title"><b>Thông tin tài khoản</b></h1>

        <!--  Main content here -->
        <div id="container">
          <?php 
		  // switch ($kinh_doanh) case 'tai-khoan':
			
			include_once "../profile/profile-route.php"; 
		 	// include_once "list-sua-chua.php"; 
			// break;
	
		  ?>
        </div>
        
	</div>
    
</section>
<footer class="mg-footer">
	<div class="mg-footer-widget"><div class="bg_bottom" style="background: rgba(0, 137, 209, 1);color: white;">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<h3 class="mg-sec-left-title"><img alt="" height="66" src="/local/user-upload/imgs/tft-wh-nobg.png" width="280"></h3>
				<strong><span style="font-size: calc(10px + 1rem);">CÔNG TY TNHH SẢN XUẤT VÀ THƯƠNG MẠI TIFATECH</span></strong>

				<p><span style="font-size: calc(10px + 1rem);"><strong>TIFATECH CO., LTD</strong></span></p>

				<p><span style="font-size:16px;">14 Đường Trần Tử Bình, Xã Hòa Châu, Huyện Hòa Vang, Thành phố Đà Nẵng, Việt Nam</span></p>

				<p><span style="font-size:16px;">Mã Số Doanh Nghiệp: 0402109247 </span></p>

				<p><span style="font-size:16px;">Ms: Quỳnh 0899.600.009</span></p>

				<p style="font-size:16px;"><span style="font-size:16px;"><span style="font-size:16px;">Phòng kỹ thuật:  0898.190.109</span></span></p>

				<p style="font-size:16px;">Email: tifatech@tifatech.vn</p>

				<div class="social-icons" style="display:flex;padding: 10px 0px 20px 0px;"><a href="https://www.facebook.com/tifatech.com.vn" style="margin-right: 10px;"><img src="/local/user-upload/imgs/fb_icon.png" style="max-width: 44px;"> </a> <a href="https://www.youtube.com/@tifatech" https:="" style="margin-right: 10px"> <img src="https://tifatech.vn/user-upload/imgs/ytb-icon.png" style="max-width: 44px;"> </a> <a href="https://www.lazada.vn/shop/tifatech-co-ltd/" style="margin-right: 10px;"><img src="/user-upload/imgs/lazada_icon.jpg" style="max-width: 44px;"> </a> <a href="https://shopee.vn/tifatech/"> <img src="/user-upload/imgs/shoppe_icon.jpg" style="max-width: 44px;"> </a></div>
				<img alt="" height="60" src="/local/user-upload/imgs/da-thong-bao-bo-cong-thuong.png" width="166"></div>

			<div class="col-md-6 col-xs-12">
				<h3 class="mg-sec-left-title"><img alt="" height="58" src="/local/user-upload/imgs/ht-wh-nobg.png" width="300"></h3>

				<p><span style="font-size:14px;"></span><span style="font-size:16px;">HARDTECH là thương hiệu của Tifatech Co.,Ltd<br>
					Thương hiệu cung cấp giải pháp công nghệ và sản phẩm bo mạch máy pha cà phê.<br>
					Website:<a href="http://hardtech.vn"> </a></span><a href="http://hardtech.vn" target="_blank">ha<span style="font-size:14px;">rdtech.vn</span></a><span style="font-size:16px;"></span></p>

				<p><span style="font-size:20px;"></span><span style="font-size:20px;"></span></p>

				<div class="fb-page" data-adapt-container-width="true" data-height="" data-hide-cover="false" data-href="https://www.facebook.com/tifatech.com.vn" data-show-facepile="true" data-small-header="false" data-tabs="" data-width="">
					<blockquote cite="https://www.facebook.com/tifatech.com.vn" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/tifatech.com.vn">TIFATECH-Sản Xuất & Phân Phối Bo Mạch Máy Pha Cà Phê</a></blockquote>
				</div>

				<div style="margin-top: 15px;"><img alt="" height="31" src="/user-upload/imgs/thanh-toan-qt.jpg" width="300"></div>
			</div>
		</div>

		<hr>
		<p align="center">Copyright © 2012. TIFATECH CO., LTD. All Right Reserved.</p>
	</div>
</div>
</div>
</footer>
<div class="icon-bar">
	<a class="link-contact" href="tel:0899600009" target="_blank"><img alt="tifatech_phone" src="/local/images/widget_icon_click_to_call.svg" title=""></a>
	<div id="whatsapp-btn" class="link-contact" style="z-index: 100;"></div>
	<a class="link-contact" href="https://zalo.me/0899600009" target="_blank"><img alt="tifatech_zalo" src="/local/images/widget_icon_zalo.svg" title=""></a>
</div>
<!-- Shopping cart load if ordered before -->
<script>
	if(sessionStorage.getItem("shoppingCart") != null){
			}
</script>
	<!-- Insert paypal payment -->
	<script src = "https://www.paypal.com/sdk/js?client-id=AVSfuC7uM7wTB2lai9RQ9pWyrv2CYZ2BM7ocOoPYYX7mvYsfum-xjM68vlsKYi0pBAxNi1wu6VPxOYaa&currency=USD"></script>
	
<div class="sidebar" id="mySidebar">
	<a class="closebtn" href="javascript:void(0)" onclick="closeNav()">×</a>	
  <div class="show-cart-pr1">
    <div class="show-cart-pr2">
      <div class="show-cart-pr3">
	      <div class="show-cart"></div>
      </div>
    </div>
  </div>
	<div><b >Tổng cộng: </b><span class="total-cart"></span></div>
	<button style="margin-top: 16px" type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#cart" >Đặt Ngay</button>
</div>

<div class="modal fade" id="cart" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: initial;">
		<form id="form-cart-submit">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p class="modal-title"><b>Giỏ hàng</b></p>
			</div>
			<div class="modal-body">
          <div class="show-cart-pr1">
            <div class="show-cart-pr2">
              <div class="show-cart-pr3">
                <div class="show-cart"></div>
              </div>
            </div>
          </div>
      </div>
      <div id="info" >
        <p><b style="margin-right: 5px;">Tổng cộng:</b><span class="total-cart" style= "color: red;"></span></p>			
        <hr>
        <p>Tỉ giá USD: <span style= "color: red;" class="crc-rate"></span></p>
        <p>Tổng tiền sau chuyển đổi: <span style= "color: red;" class="crc-converted"></span><span style= "color: red;">$</span></p>
      </div>
      <div class="not-order" style= "text-align: center">
        <img alt="" src ="/local/user-upload/imgs/oops_icon.png" style="width: 50px; margin-bottom: 10px">
        <p style="font-size: 26px">Bạn chưa có đơn hàng nào</p>
      </div>
      <!-- Insert paypal button -->
      <div id="paypal-button-container"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
		</form>	  
    </div>
  </div>
</div>


<style>
		#paypal-button-container{
			max-width: 100%;
			text-align: center;
		
		}
		.paypal-buttons{
			max-width: 80% !important;
		}
	
</style>
<script> 

</script>

<script src="/local/js/jquery.parallax-1.1.3.js"></script>
<script src="/local/js/bootstrap.min.js"></script>
<script src="/local/js/owl.carousel.js"></script>
<script src="/local/js/jquery.validate.min.js" ></script>
<script src="/local/js/superfish.min.js"></script>
<script src="/local/js/jquery.magnific-popup.min.js"></script>
<script src="/local/js/menu.js"></script>
<script src="/local/js/script.js" ></script>
<script src="/local/js/custom.js" ></script>
<script src="/local/js/shoping-cart.js" defer></script>
<script src="/local/js/dimbox.js"></script>

<!-- Facebook sdk insert-->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=628148988939051&autoLogAppEvents=1" nonce="MPfUOdRD"></script>
<script>

$("#btn_tim_kiem").click(function(){
	$("#form_tim_kiem").validate({
		debug:false,
		errorClass:"text-danger",
		errorElement:"span",
		rules:{
			"text":{required:true},
			
		},
		messages:{
			"text":{required:"Nhập dữ liệu",},
			
		},

		submitHandler:function(){
			window.location.href = "/linh-kien-may-pha/search?q=" + $(".form-control").val();
		}
	});
});

	var menu = $(".active ul").html();
	$(".mtree").html(menu)

</script>


<div id="fb-root"></div>
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", 109535254512190);
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- WHATSAPP -->
<script>
    var url = "js/whatsapp.js";
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#10b77f",
      "ctaText":"",
      "borderRadius":"25",
      "marginLeft":"0",
      "marginBottom":"0",
      "marginRight":"0",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"TIFATECH",
      "brandSubTitle":"Coffee Machine Control Board Manufacturer",
      "brandImg":"/user-upload/imgs/k-co-nen-tft.png",
      "welcomeText":"Chào bạn!\nTôi có thể giúp gì cho bạn không?",
      "messageText":"Tifatech xin chào bạn!",
      "backgroundColor":"#33bee1",
      "ctaText":"Trò chuyện",
      "borderRadius":"50%",
      "autoShow":false,
      "phoneNumber":"84898166989"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
</body>
</html>
