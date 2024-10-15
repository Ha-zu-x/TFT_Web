	var headerHeight = $('header').outerHeight(true)- 30; // true value, adds margins to the total height
	var footerHeight = $('footer').innerHeight()+15;
	$('#account-overview-container').affix({
		offset: {
			top: headerHeight ,
			bottom: footerHeight
		}
	}).on('affix.bs.affix', function () { // before affix
		$(this).css({
			/*'top': headerHeight,*/    // for fixed height
				'width': $(this).outerWidth()  // variable widths
		});
	}).on('affix-bottom.bs.affix', function () { // before affix-bottom
		$(this).css('bottom', 'auto'); // THIS is what makes the jumping
	});