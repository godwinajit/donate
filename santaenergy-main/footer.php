<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package santaenergy-main
 */

?>

	</main><!-- #content -->

<!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-bar">
      <div class="container">
        <div class="footer-logo"><a href="<?php echo get_bloginfo( 'url' )?>"><img alt="Santa" src="<?php echo get_template_directory_uri(); ?>/img/santa_home_logo_color.svg" width="109"></a></div>
        <div class="footer-nav-holder">
          <ul class="footer-nav">
            <li>
                <?php dynamic_sidebar('footer-content-1');?>
            </li><li>
                <?php dynamic_sidebar('footer-content-2');?>
            </li><li>
                <?php dynamic_sidebar('footer-content-3');?>
            </li><li>
                <?php dynamic_sidebar('footer-content-4');?>
            </li><li class="last border-btm">
                <?php dynamic_sidebar('footer-content-5');?>
            </li><li class="last">
                <?php dynamic_sidebar('footer-content-6');?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer><!-- #footer -->

<div class="top-header mobile-display">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center foot-bottom-menu top-menu-section">
          <?php dynamic_sidebar('header-top');?>
        </div>
      </div>
      </div>
      </div>



     <div class="foot-bottom">
    <div class="container">
      <div class="row">
        <?php dynamic_sidebar('footer-content-7');?>
      </div>
    </div>
  </div>
  
  <?php wp_footer();?>
  <!-- JavaScript Libraries -->

  
  <script src="https://use.fontawesome.com/6af3da97fb.js"></script> 
  <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js" type="text/javascript"></script>
  <!-- <script src="<?php echo get_template_directory_uri(); ?>/lib/jquery/jquery.min.js">
  </script> 
  <script src="<?php echo get_template_directory_uri(); ?>/lib/jquery/jquery-migrate.min.js">
  </script>  -->
  <script src="<?php echo get_template_directory_uri(); ?>/lib/bootstrap/js/bootstrap.bundle.min.js">
  </script> <!-- Template Main Javascript File -->
   
  <script src="<?php echo get_template_directory_uri(); ?>/js/main.js">  </script>

</body>
</html>
