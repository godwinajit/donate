<?php

/*
Template Name: Contact Template
*/


get_header(); ?>

<div class="img-section contacts-section">
    <div class="container">
        <div class="row">
           
            <div class="clearfix"></div>
			
        </div>
		<?php if ($form = get_field('contact_form')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<section class="contact-form">
					<?php echo $form; ?>
				</section>
			</div>
		</div>
		<?php endif; ?>
    </div>
</div>


    <script>
	var jquery_noconflict = jQuery.noConflict();
      jquery_noconflict(window).on('load', function(){ // when DOM ready
	  
	  
	  
				
// dyname fields
		    var max_fields      = 6; //maximum input boxes allowed
		    var wrapper         = jquery_noconflict(".input_fields_wrap"); //Fields wrapper
		    var add_button      = jquery_noconflict(".add_field_button"); //Add button ID
  
		    var x = 1; //initlal text box count
		    jquery_noconflict(add_button).click(function(e){ //on add input button click
			
			
	
		        e.preventDefault();
		        if(x < max_fields){ //max input box allowed
		            x++; //text box increment
		            jquery_noconflict(wrapper).append('<div class="row"><div class="col-sm-1"> <div class="form-group"><label class="control-label" for="message">Qty </label>	<input type="text" class="form-control" name="qty[]">  </div>  </div>  <div class="col-xs-12 col-sm-2">	<div class="form-group">	<label class="control-label" for="message">Modal </label>	<input type="text" class="form-control" name="modal[]">  </div>  </div>  <div class="col-xs-10 col-sm-6">	<div class="form-group">	<label class="control-label" for="message">Description </label>	<input type="text" class="form-control" name="description[]">  </div>  </div>  <div class="col-xs-2 col-sm-1">  <img src="/remove.png" title="Remove" class="pull-right remove_field" style="margin-top:25px;margin-right:6px">  </div> </div>'); //add input box 
					
					
					//jquery_noconflict(wrapper).append('<div><label class="control-label" for="message">qty </label>	<input type="text" name="qty[]">	<label class="control-label" for="message">brand </label>	<input type="text" name="brand[]">	<label class="control-label" for="message">modal </label>	<input type="text" name="modal[]">	<label class="control-label" for="message">description </label>	<input type="text" name="description[]"> <a href="#" class="remove_field"><img src="/remove.png" title="Remove" style="padding-top:7px"></a>  </div> </div>'); //add input box 
		        }
		    });
		   
		    jquery_noconflict(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		
		        e.preventDefault(); jquery_noconflict(this).closest('div[class^="row"]').remove(); x--;
		    })


	// End dynamic fields
				
				
				
				
				
				
      });
    </script>
	


<?php get_footer(); ?>