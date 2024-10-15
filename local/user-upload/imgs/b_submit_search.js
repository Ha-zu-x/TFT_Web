$("#b_submit_search").click(function(){	
	$("#f_search").validate({	
		debug:false,
		errorClass: "text-danger",
		rules:{
			"diem_den":{required:true},
		},
		messages:{
			"diem_den":{required:"Nhập điểm đến"},			
		},		
		submitHandler:function(){
		$.ajax({
			type:"GET",
			data:$("#f_search").serialize(),
			url:"/forms/search.php",
			success:function(msg){
				$("#ketqua_search").html(msg);				
			},
		});
		}	
	});	
});