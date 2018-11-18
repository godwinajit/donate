// Load is used to ensure all images have been loaded, impossible with document

jQuery(window).load(function () {



	// Takes the gutter width from the bottom margin of .post

	var gutter = parseInt(jQuery('.g_item').css('marginBottom'));
	var container = jQuery('#gallerys');



	// Creates an instance of Masonry on #posts

	container.masonry({
		gutter: gutter,
		itemSelector: '.g_item',
		columnWidth: '.g_item'
	});
	
	
	
	// This code fires every time a user resizes the screen and only affects .post elements
	// whose parent class isn't .container. Triggers resize first so nothing looks weird.
	
	jQuery(window).bind('resize', function () {
		
		if (!jQuery('#gallerys').parent().hasClass('container')) {			
			
			// Resets all widths to 'auto' to sterilize calculations
			
			post_width = jQuery('.g_item').width() + gutter;
			jQuery('#gallerys, body > #grid').css('width', 'auto');	
			
			// Calculates how many .post elements will actually fit per row. Could this code be cleaner?
			
			posts_per_row = jQuery('#gallerys').innerWidth() / post_width;
			floor_posts_width = (Math.floor(posts_per_row) * post_width) - gutter;
			ceil_posts_width = (Math.ceil(posts_per_row) * post_width) - gutter;
			posts_width = (ceil_posts_width > jQuery('#gallerys').innerWidth()) ? floor_posts_width : ceil_posts_width;
			if (posts_width == jQuery('.g_item').width()) {
				posts_width = '100%';
			}
			
			
			
			// Ensures that all top-level elements have equal width and stay centered
			
			jQuery('#gallerys').css('width', posts_width);
			jQuery('#grid').css('width', '95%');
			jQuery('#grid').css({'margin': '0 auto'});
        		
		
		
		}
	}).trigger('resize');
	


});