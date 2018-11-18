<ul class="step-list">
	<?php 
		if(is_checkout()):
			$checkoutclass = 'class="active billing_step"';
			$cartclass = '';
		elseif(is_cart()):
			$checkoutclass = '';
			$cartclass = 'class="active"';	
		endif;
	?>
    <li <?php echo $cartclass;?>><span class="holder"><?php _e('Shopping cart', 'kenyon') ?></span></li>
    <li <?php echo $checkoutclass;?>><span class="holder"><?php _e('Checkout', 'kenyon') ?></span></li>
    <li class='payment_step'><span class="holder"><?php _e('Payment', 'kenyon') ?></span></li>
</ul>