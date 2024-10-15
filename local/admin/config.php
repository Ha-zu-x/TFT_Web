<?php
/*
$dbhost ='localhost';
$dbname	='tifatech.vn';
$dbuser	='root';
$dbpass	='';


*/

$dbhost ='localhost:4306'; // Editted here for local version
$dbname	='tifatech_tifatech';
$dbuser	='tifatech_tifatec';
$dbpass	='tifatech_tifatech';


$layout 	='layout';
$bai_viet 	= 'baiviet';
$san_pham_1 = 'sanpham';

$field_sp 	= array(
	'ma_san_pham' => 'Model',
	'xuat_xu' => 'Hãng sản xuất',
	'bao_hanh' => 'Bảo hành',
	'giam_gia_0' => "Giá gốc", 
	'gia_0' => 'Giá bán', //giá đã được giảm,
	'gia_nk' => 'Giá nhập khẩu (Chỉ điền cho bo nhập khẩu)', // giá cho những bo mạch nhập khẩu
	'manual_code' => 'Mã HDSD', 
	'manual_link' => 'Link HDSD', 
	"lien_quan" => "Sản phẩm liên quan",
	'ghi_chu' => 'Ghi chú', // giá cho những bo mạch nhập khẩu
//	'giam_gia_0' => '% giảm giá',
//	't_opt_loai' => 'SP: Giá',
//	'hot_0' => 'Sản phẩm bán chạy(1)',
//	'khuyen_mai_0' => 'Sản phẩm khuyến mãi(set 1)',
	
);
$field_repair = array(
	"Id" => "Id",
	"Ngày nhận" => "Ngay_nhan",
	"Ngày hoàn thành" => "Ngay_hoan_thanh",
	"Mã KH"	=>"Ma_KH",
	"Model"	=>"Model",
	"Mã quản lý"=>"Ma_quan_ly",
	"Nội dung lỗi"=>"Noi_dung_loi",
	"Link video" => "Link_video",
	"Ghi chú" => "Ghi_chu"
);

$ngon_ngu 	= array(
	'gia' 		=> 'Giá',
	'lien_he'	=> 'Liên hệ' ,
	'lien_quan'	=> 'Liên quan' ,
	'san_pham'	=> 'Thiết bị âm thanh',
	'dich_vu'	=> 'Công trình thi công' ,
	'mo_ta'		=> 'Mô tả' ,
	'dao_tao'	=> 'Đào Tạo' ,
	'dat'		=> 'Thêm vào giỏ hàng' ,
	'dat_ngay'		=> 'Booking' ,
	'tin_xem_nhanh'	=> 'Bài viết liên quan' ,
	'tin_tuc'	=> 'Bảng tin' ,
	'tuyen_dung'	=> 'Thông tin việc làm' ,
	'dong'		=> 'Đóng' ,
	'tieu_diem'		=> 'Sản phẩm bán chạy' ,
	'khong_tim_thay'		=> 'Không tìm thấy' ,
	'ket_qua_tim_kiem'		=> 'Kết quả tìm kiếm' ,
	'doi_tac'		=> 'Đối Tác' 
	
);

//$arrKinhDoanh = array();
$arrKinhDoanh = array($san_pham_1=>'Chi tiết chậu');
?>