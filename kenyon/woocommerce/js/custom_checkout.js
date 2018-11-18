jQuery( function( $ ) {

	console.log("Custom Checkout Loaded...");
	
	$.blockUI.defaults.overlayCSS.cursor = 'default';

	// wc_checkout_params is required to continue, ensure the object exists
	if ( typeof wc_checkout_params === 'undefined' )
		return false;
		
		
	// Add Notice Division for display
	if( document.getElementById("#notice") == null) 
	{
		$( "#order_comments_field" ).before( '<div id="notice" style="text-align: justify; color: #FF0000; margin-bottom: 10px;"></div>' );
	}
	
	function getCountry(){
		
		if ( $( '#ship-to-different-address input' ).is( ':checked' ) ) {
			country = $( '#shipping_country_field span.select-country_select span.jcf-unselectable' ).html();
		} else {
			country = $( '#billing_country_field span.select-country_select span.jcf-unselectable' ).html();
		}
		return country;
	}
	
	$( 'form.checkout' )

	.on( 'input change', 'select.shipping_method, input[name^=shipping_method], #ship-to-different-address input, .update_totals_on_change select, .update_totals_on_change input[type=radio]', function() {
		
			
		country = getCountry();
		
		if (country == 'United States (US)')
		{
			$('#notice').html('');
			$('ul#shipping_method li').each(function(index,element)
			{
				//Check Selected Shipping 
				if( $(element).find('label').html() == 'Free Shipping' )
				{
					$(element).css('display','block');
				}
			});
		}
		else
		{	
			// Display Notice
			$('#notice').html('<strong>International Shippers:</strong> Please be advised that our shipping prices given through our website are just an estimate and may be subject to change. The buyer is responsible for all clearance fees, duties and taxes determined by customs.');
			// Display Shipping & handling , Disable Free Shipping
			$('ul#shipping_method li').each(function(index,element)
			{
				//Check Selected Shipping 
				if( $(element).find('label').html() == 'Free Shipping' )
				{
					$(element).css('display','none');
				}
			});
			
		}
		
	})
	
	
	.on( 'ul#shipping_method li click' , function(){
		
		// If Free Shipping then shipping_handling_charge = $0
		$('ul#shipping_method li').each(function(index,element)
		{
			//Check Selected Shipping 
			if( $(element).find('div').hasClass('rad-checked')  )
			{
				shipping_methods = $(element).find('input').val();
				ship_charge = $(element).find('label .amount').html();
				if( typeof(ship_charge) == "undefined" )
				{
					ship_charge = "$0";
				}
			}
		});
		
		if( typeof ship_charge != 'undefined') 
		{
			$('#shipping_handling_charge').html(ship_charge);
		}
		
		if( typeof shipping_methods === 'undefined') 
		{
			return false;
		}
		
		var data = {
			action: 'woocommerce_update_shipping_method',
			security: wc_cart_params.update_shipping_method_nonce,
			shipping_method: shipping_methods
		};

		$.post( wc_cart_params.ajax_url, data, function( response ) {
			console.log(response);
			order_total = $(response).find('.order-total .amount').html();
			$('div.cart_totals .order-total .amount').html(order_total);
			$( 'body' ).trigger( 'updated_shipping_method' );

		});
		
	})
	
	
});
