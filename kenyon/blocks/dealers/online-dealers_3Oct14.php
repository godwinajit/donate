<?php
global $wpdb;
$onlineDealers = $wpdb->get_results("Select * from ".$wpdb->prefix."store_locator Where sl_tags='online'");
if ($onlineDealers) : ?>
    <section class="tab-pane" id="online-dealers">
        <ul class="row dealers-list">
            <?php foreach($onlineDealers as $dealer):  ?>
                <li class="col-md-4 col-sm-4">
                    <div class="holder">
                        <div class="image-area">
                            <?php if ($dealer->sl_url) : ?>
                            <a href="<?php echo $dealer->sl_url ?>">
                            <?php endif; ?>

								<?php if (!empty($dealer->sl_image)) : ?>
									<img src="<?php echo $dealer->sl_image ?>" width="141" height="64" alt="image description">
								<?php /*else : ?>
									<img src="http://placehold.it/141x64.png&text=NO%20LOGO" width="141" height="64" alt="no-logo">
								<?php */endif; ?>
                                <p><?php echo $dealer->sl_store ?></p>

                            <?php if ($dealer->sl_url) : ?>
                            </a>
                            <?php endif; ?>
                        </div>
						<?php if (!empty($dealer->sl_url)) : ?>
                        <h2><span><?php _e('Browse Kenyon Products on','kenyon')?></span> <a href="<?php echo $dealer->sl_url ?>"><?php echo $dealer->sl_url ?></a></h2>
						<?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>