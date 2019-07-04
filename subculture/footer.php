        </div>
        <footer id="footer">
            <div class="container">
            	<div class="logo-f">
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-f.png" width="107" height="107" alt="image description"></a>
				</div>
				<form action="http://subculturenewyork.us7.list-manage.com/subscribe/post" method="post" class="newsletter-form">
					<input type="hidden" name="u" value="de4738596973c62570556b564">
					<input type="hidden" name="id" value="<?php echo get_option('mc_list_id');?>">
                    <fieldset>
                        <h3>Subscribe to our newsletter</h3>
                        <p>Get our latest news &amp; updates</p>
                        <div class="form-group">
                            <input name="MERGE0" id="MERGE0" type="email" class="form-control" placeholder="Your email address">
                            <button type="submit" class="btn btn-subscribe">Subscribe</button>
                        </div>
                    </fieldset>
                </form>
                
                <?php
                if(has_nav_menu('bottom'))
                    wp_nav_menu( array(
                        'theme_location' => 'bottom',
                        'container' => false,
                        'fallback_cb' => false,
                        'items_wrap' => '<ul class="navigation">%3$s</ul>',
                    ));
                ?>
                <?php get_template_part('blocks/footer/contact-information') ?>
            </div>
        </footer>
    </div>
	<?php
	//if ( (strpos(get_page_template(), 'template-about-new.php') !== false) || (strpos(get_page_template(), 'template-event_d.php') !== false)) {
		wp_enqueue_script( 'slick_js', get_template_directory_uri() . '/js/slick.min.js' );
	//}
	?>
    <script type="text/javascript">
        if (navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/MSIE 10.*Touch/)) {
            var msViewportStyle = document.createElement('style')
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto !important}'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle)
        }
    </script>

    <script type="text/javascript">
        (function() {
	        var css = document.createElement('link');
	        css.href = '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css';
	        css.rel = 'stylesheet';
	        css.type = 'text/css';
	        document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
<?php wp_enqueue_script('subculture-main', get_template_directory_uri().'/js/jquery.main.js', array('subculture-bootstrap', 'subculture-masonry', 'subculture-imagesloaded')); ?>
    <?php wp_footer(); ?>
</body>
</html>