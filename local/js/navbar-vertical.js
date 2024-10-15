	// Make the product category widget Bootstrappable
	$('.product-categories').addClass('nav navbar');
	$('.product-categories .cat-parent').addClass('dropdown-submenu');
	$('.product-categories .cat-parent > a').addClass('dropdown-toggle');
	$('.product-categories .cat-parent > a').attr('data-toggle', 'dropdown');
	$('.product-categories .children').addClass('dropdown-menu');
