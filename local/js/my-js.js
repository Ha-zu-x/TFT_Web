$('p img').addClass('img-responsive');
$('.navbar .dropdown > a').click(function(){location.href = this.href;}); 
$('.thumbnail img').addClass('center-block');
var activeurl = window.location.pathname;
$('a[href="'+activeurl+'"]').parent('li').addClass('active');

$("#button_submit_lien_he").click(function(){
	$("#form-submit").validate({
		debug:false,
		errorClass:"text-danger",
		rules:{
			"Tên":{required:true,minlength:3},
			"Điện Thoại":{required:true,number: true,minlength:10},
			"Nội dung":{required:true},
		},
		messages:{
			"Tên":{required:"Chưa nhập tên",minlength:"Tên quá ngắn"},
			"Điện Thoại":{required:"Chưa nhập điện thoại",minlength:"Số điện thoại"},
			"Nội dung":{required:"Nhập nội dung"},			
		},
		submitHandler:function(){
			$.ajax({
				url:"/layout/send-to-mail.php",
				type:"POST",
				data:$('#form-submit').serialize(),
				beforeSend:function(){$('#form-submit').html('<img src="/image/loading.gif" alt="loading"/>');},
				success:function(response){$('#form-submit').html(response);},
				error:function(){$('#form-submit').html('<div class="alert alert-danger" role="alert">Lỗi</div>');},
			});
		}
	});
});

function booking(id,gia,add=''){
		$.ajax({
			url:"/forms/booking.php?id=" + id + '&gia=' + gia + '&add=' + add,
			success:function(msg){
				$("#load_modal").html(msg);
				$("#modal").modal()
			},
		});
};

$("#page-opt").change(function(){
	//alert($("#page-opt").val());
	window.open($("#page-opt").val(),'_self');
});
/**/

var heightBaner = $('.baner').height() + 32;
$("nav").attr("data-offset-top",heightBaner);

//di chuyen den vi tri dau
var product = $('#product').html();
$( "#product" ).remove();
$(product).insertAfter('.page-header');

if($(window).width() < 798){			
	$("#myAffix").attr("style", "position: relative;");
}else{
	$("#myAffix").on('affix.bs.affix', function(){//var $affixElement = $('div[data-spy="affix"]');$affixElement.width($affixElement.parent().width());
		$(this).css({
			'width': $(this).outerWidth()  // variable widths
		});	
	});
/**/
	if( $('#content').height() >200){
		var heightcarousel = $('.carousel').height() ;
		$('#myAffix').affix({
			offset: {top:heightBaner + heightcarousel,}			
			
		})
		
		$("#myAffix").attr("style", "top:65px;");
	}
}
