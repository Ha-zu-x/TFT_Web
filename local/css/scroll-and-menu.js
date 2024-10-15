if($(window).width()>800){
  $('.navbar .dropdown > a').click(function(){
     //location.href = this.href;
  });

//scroll
  var height_left = $('aside').outerHeight(true)+ 200;
  var height_right = $('#data-content').outerHeight(true);
  if(height_right>height_left){	
	var headerHeight = $('header').outerHeight(true)+440; // true value, adds margins to the total height
	var footerHeight = $('footer').outerHeight(true)+80;
	$('#left').affix({
		offset: {
		top: headerHeight ,
		bottom: footerHeight
		}
		}).on('affix.bs.affix', function () {
			$(this).css({
				'width': $(this).outerWidth()
			});
		}).on('affix-bottom.bs.affix', function () {
			$(this).css('bottom', 'auto');
	});
  }
}

var load_facebook=false;
$(window).scroll(function(){
	if(load_facebook==false){
		t=$('#load_plugin').offset().top-$(window).scrollTop()-$(window).height();
		if(t<0){
			$.ajax({
				url:"/caching-data/right.html", //url:"/layout/ajax-facebook-googlePlus-chat.html",
				success:function(msg){
					$("#load_plugin").html(msg);
					load_facebook=true;
				},
			});
		}
	};
});