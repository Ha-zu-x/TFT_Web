function booking(ten_tour,gia,info = ''){
	if(info == '') info = ten_tour;
	
	$.ajax({
		//type:"POST",
		url:"/layout/modal_book_info.php?ten_tour=" + ten_tour + "&gia=" + gia + "&info=" + info,
		beforeSend:function(){
			$("#load_modal").html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
			$("#modal").modal();
		},
		success:function(msg){
			$("#load_modal").html(msg);
		},
	});
};
