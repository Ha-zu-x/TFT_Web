var fixAffixWidth = function() {
	$('#sidebar').width( $('#sidebar').parent().width() );
/*	
	  $('[data-spy="affix"]').each(function() {
		$(this).width( $(this).parent().width() );
	  });
*/
}

if($(document).width() >1000){
	var height_content = $(".col-md-8").outerHeight(true);
	var height_sidebar = $("#sidebar").outerHeight(true);
	if(height_content > height_sidebar){
		$('#sidebar').affix({    
			  offset: {
				top: $("header").outerHeight(true),
				bottom: $("footer").outerHeight(true) + 60,
			  }	
		});
	}
}


fixAffixWidth();
$(window).resize(fixAffixWidth);
