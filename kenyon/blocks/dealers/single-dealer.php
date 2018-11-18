<?php

	global $wpdb;
	
	$dealer = $wpdb->get_row( 
		$wpdb->prepare( 
			"SELECT * FROM {$wpdb->prefix}store_locator WHERE sl_id = %d", intval($_GET['id'])
		)
	);
	
if (!empty($dealer)) : ?>

<section class="result-holder single-dealer">
	<div class="result-block international-dealers clearfix">
		<?php if ($dealer->sl_store) : ?>
		<h1><?php echo $dealer->sl_store; ?></h1>
		<?php endif; ?>
		<dl>
			<?php if ($dealer->sl_url) : ?>
				<dt><?php _e('Website','kenyon')?></dt>
				<dd><a href="<?php echo check_http_in_url($dealer->sl_url) ?>"><?php echo $dealer->sl_url ?></a></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_description) : ?>
				<dt><?php _e('Description','kenyon')?></dt>
				<dd><?php echo $dealer->sl_description ?></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_address) : ?>
				<dt><?php _e('Address','kenyon')?></dt>
				<dd>
					<?php echo $dealer->sl_address ?>
					
					<?php if($dealer->sl_address2): ?>
						<br /><?php echo $dealer->sl_address2 ?>
					<?php endif ?>
				</dd>
			<?php endif; ?>
			
			<?php if ($dealer->sl_city) : ?>
				<dt><?php _e('City','kenyon')?></dt>
				<dd><?php echo $dealer->sl_city ?></dd>
			<?php endif; ?>
			
			<?php if ($dealer->sl_state) : ?>
				<dt><?php _e('State','kenyon')?></dt>
				<dd><?php echo $dealer->sl_state ?></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_zip) : ?>
				<dt><?php _e('Zip','kenyon')?></dt>
				<dd><?php echo $dealer->sl_zip ?></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_country) : ?>
				<dt><?php _e('Country','kenyon')?></dt>
				<dd><?php echo $dealer->sl_country ?></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_email) : ?>
				<dt><?php _e('Email','kenyon')?></dt>
				<dd><a href="mailto:<?php echo shortcode_email(array(), $dealer->sl_email) ?>"><?php echo shortcode_email(array(), $dealer->sl_email) ?></a></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_hours) : ?>
				<dt><?php _e('Hours','kenyon')?></dt>
				<dd><?php echo $dealer->sl_hours ?></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_phone) : ?>
				<dt><?php _e('Phone','kenyon')?></dt>
				<dd><?php echo $dealer->sl_phone ?></dd>
			<?php endif; ?>

			<?php if ($dealer->sl_fax) : ?>
				<dt><?php _e('Fax','kenyon')?></dt>
				<dd><?php echo $dealer->sl_fax ?></dd>
			<?php endif; ?>

		</dl>
	</div>
</section>

<?php endif; ?>