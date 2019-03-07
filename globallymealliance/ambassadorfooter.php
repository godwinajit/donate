<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!-- footer starts here -->

<footer class="footer">
                <div class="wrapper container-fluid">
                    <div class="row center-xs">
                        <div class="col-xs-11 col-md-10">
                            <div class="footer-columns">
                                <div class="footer-column footer-column-logo">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Global Lyme Alliance" class="logo">Global Lyme Alliance</a>
                                    <div class="copyright-block md-visible">
                                    <?php
                                        if(is_active_sidebar('footer-sidebar-3')){
                                        dynamic_sidebar('footer-sidebar-3');
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="footer-column footer-column-nav">
                                    <?php wp_nav_menu(array( 'theme_location' => 'footer-menu-1', 'menu_class' => 'sub-nav sub-nav-bold border-md' ) ); ?>
                                </div>
                                <div class="footer-column footer-column-nav02">
                                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2', 'menu_class' => 'sub-nav' ) ); ?>
                                </div>
                                <div class="footer-column footer-column-contact">
                                     <?php
                                    if(is_active_sidebar('footer-sidebar-2')){
                                    dynamic_sidebar('footer-sidebar-2');
                                    }
                                    ?>
                                </div>
                                <div class="footer-column footer-column-social">
                                <?php
                                    if(is_active_sidebar('footer-sidebar-1')){
                                    dynamic_sidebar('footer-sidebar-1');
                                    }
                                ?>
                                    
                                </div>
                                <div class="footer-column footer-column-copyright md-hidden">
                                  <?php
                                        if(is_active_sidebar('footer-sidebar-3')){
                                        dynamic_sidebar('footer-sidebar-3');
                                        }
                                  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row center-xs fine-print">
                        <div class="col-xs-11 col-md-10">
                            <p style="font-size: 12px; line-height: 14px;">Disclaimer: The above material is provided for information purposes only. The material (a) is not nor should be considered, or used as a substitute for, medical advice, diagnosis, or treatment, nor (b) does it necessarily represent endorsement by or an official position of Global Lyme Alliance, Inc. or any of its directors, officers, advisors or volunteers. Advice on the testing, treatment or care of an individual patient should be obtained through consultation with a physician who has examined that patient or is familiar with that patient’s medical history. Global Lyme Alliance, Inc. makes no warranties of any kind regarding this Website, including as to the accuracy, completeness, currency or reliability of any information contained herein, and all such warranties are expressly disclaimed.</p>
                        </div>
                    </div>
                </div>
      </footer>

       <div class="popup popup-nav">
                <div class="panel-close">
                    <a href="#" class="popup-close">Close</a>
                </div>
                <div class="accordion-nav">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-11 col-md-10">
                                <ul class="accordion">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="popup popup-search">
                <div class="panel-close">
                    <a href="" class="popup-close">Close</a>
                </div>
                <div class="wrapper container-fluid">
                    <div class="row center-xs">
                        <div class="col-xs-11 col-md-10">
                            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) );?>">
                                <label>What are you looking for?</label>
                                <div class="search-input">
                                    <span class="icon icon-search"></span>
                                    <input type="search" class="search-field" placeholder="SEARCH" value="" name="s" title="Search for:">
                                    <input type="submit" style="display:none;" class="search-submit" value="search">
                                    <input type="hidden" name="post_type" value="any" />
                                </div>
                                <ul class="dhemy-ajax-search results-list">
                                    <!--li>
                                        <span class="number">55</span>
                                        <a href="#"><span class="highlighted">Lyme</span> Prevention</a>
                                    </li-->
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

<!-- #colophon -->
<div class="preload"> <img src="<?php echo get_template_directory_uri(); ?>/images/minus.png" alt="Preload" /> </div>
<!-- #page -->
<!--Ajax Search Code -->
<script type="text/javascript">var BASE = "<?php echo home_url() ?>";</script>
<?php wp_footer(); ?>

<script type="text/javascript">
$(window).load(function(e) {
    if($(".wp-social-login-provider-facebook").length){
		$(".wp-social-login-provider-facebook img").attr('src',"<?php echo get_template_directory_uri(); ?>/images/comment-fb.png");
	}
	if($(".wp-social-login-provider-twitter").length){
		$(".wp-social-login-provider-twitter img").attr('src',"<?php echo get_template_directory_uri(); ?>/images/comment-tw.png");
	}
	if($(".wp-social-login-provider-google").length){
		$(".wp-social-login-provider-google img").attr('src',"<?php echo get_template_directory_uri(); ?>/images/comment-gplus.png");
	}
});
</script>
<!-- Constant Contact Start -->
<script>
$(function() {

	$('#ctct-submitted').prop('disabled', true);
var ccFirstName;
var ccLastName;
var ccEmail;


	// First Name can't be blank
	$("[id^=first_name___]").on('input', function() {
		var input=$(this);
		ccFirstName = input.val();
		if(ccFirstName && ccLastName && ccEmail){
			$('#ctct-submitted').prop('disabled', false);
		}else{
			$('#ctct-submitted').prop('disabled', true);
		}
	});

	// First Name can't be blank
	$("[id^=last_name___]").on('input', function() {
		var input=$(this);
		ccLastName = input.val();
		if(ccFirstName && ccLastName && ccEmail){
			$('#ctct-submitted').prop('disabled', false);
		}else{
			$('#ctct-submitted').prop('disabled', true);
		}
	});

	// Email can't be blank
	$("[id^=email___]").on('input', function() {
		var input=$(this);
		ccEmail = input.val();
		if(ccFirstName && ccLastName && ccEmail){
			$('#ctct-submitted').prop('disabled', false);
		}else{
			$('#ctct-submitted').prop('disabled', true);
		}
	});


});
</script>
<!-- Facebook Book -->
<div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body></html>