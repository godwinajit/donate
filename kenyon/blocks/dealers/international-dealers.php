<?php

global $wpdb;
$internationalDealers = $wpdb->get_results("Select * from ".$wpdb->prefix."store_locator Where sl_tags='international'");
if ($internationalDealers) : ?>

    <div class="tab-pane" id="international-dealers">
        <section class="result-holder">
            <?php foreach($internationalDealers as $dealer):  ?>
                <div class="result-block international-dealers clearfix">
                    <div class="flag-holder">
						<!--  <a href="<?php echo add_query_arg('id', $dealer->sl_id); ?>">  -->
							<?php if (!empty($dealer->sl_image)) : ?>
								<img src="<?php echo $dealer->sl_image ?>" width="191" height="95" alt="image description">
							<?php /*else : ?>
								<img src="http://placehold.it/141x64.png&text=NO%20LOGO" width="191" height="95" alt="no-logo">
							<?php */endif; ?>
						<!-- </a>  -->
                    </div>
                    <div class="description">
                        <h2>
							<span><?php echo $dealer->sl_country ?></span>
							
							<?php if ($dealer->sl_url) : ?>
							<a href="<?php echo check_http_in_url($dealer->sl_url) ?>">
							<?php endif; ?>
							
								<?php echo $dealer->sl_store ?>
							
							<?php if ($dealer->sl_url) : ?>
							</a>
							<?php endif; ?>
						</h2>
                        <div class="clearfix">
							<?php if ($dealer->sl_url) : ?>
                            <div class="col-website">
                            <a href="<?php echo check_http_in_url($dealer->sl_url) ?>">
                                <dl>
                                    <dt><?php _e('Website','kenyon')?></dt>
                                    <dd><?php echo $dealer->sl_url ?></dd>
                                </dl>
                            </a>
                            </div>
							<?php endif; ?>
							
							<?php if ($dealer->sl_address || $dealer->sl_address2) : ?>
                            <div class="col-address">
                                <dl>
                                    <dt><?php _e('Address','kenyon')?></dt>
                                    <dd>
                                        <address>
                                            <?php echo $dealer->sl_address ?> <br>
                                            <?php echo $dealer->sl_address2 ?>
                                        </address>
                                    </dd>
                                </dl>
                            </div>
							<?php endif; ?>
                            <div class="clearfix hidden-md hidden-lg"></div>
							
							<?php if ($dealer->sl_phone) : ?>
                            <div class="col-phone">
                                <dl>
                                    <dt><?php _e('Phone','kenyon')?></dt>
                                    <dd><a href="tel:<?php echo $dealer->sl_phone ?>" class="phone-link"><?php echo $dealer->sl_phone ?></a></dd>
                                </dl>
                            </div>
							<?php endif; ?>
							
							<?php if ($dealer->sl_email) : ?>
                            <div class="col-email">
                                <dl>
                                    <dt><?php _e('Email','kenyon')?></dt>
                                    <dd><a href="mailto:<?php echo $dealer->sl_email ?>"><?php echo $dealer->sl_email ?></a></dd>
                                </dl>
                            </div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

<?php endif; ?>