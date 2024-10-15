$("#loai_nha").change(function()	{
		var quan_huyen=$(this).val();
		var dataString = 'quan_huyen='+ quan_huyen;
		$.ajax
		({
			type: "POST",
			url: "/layout/get-quan-huyen.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#quan_huyen").html(html);
			} 
		});
		
});

$("#quan_huyen").change(function()
	{
		var phuong_xa_0=$(this).val();
		var dataString = 'phuong_xa_0='+ phuong_xa_0;
	
		$.ajax
		({
			type: "POST",
			url: "/layout/get-phuong-xa.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#phuong_xa_0").html(html);
			} 
		});
});

$("#phuong_xa_0").change(function()
	{
		var duong_pho_0=$(this).val();
		var dataString = 'duong_pho_0='+ duong_pho_0;
	
		$.ajax
		({
			type: "POST",
			url: "/layout/get-duong-pho.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#duong_pho_0").html(html);
			} 
		});
});