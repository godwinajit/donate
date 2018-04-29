<?php
/* Template Name: ragistration */
get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
  
  <div class="main main1196">
    <?php /* The loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
   <div class="registration-form-wrapper">
   <h2>Registration Form</h2>
<?php
/* the captcha result is stored in session */
session_start();
 
if( isset( $_POST['svalue'] ) ) {
    if($_POST['svalue'] != $_SESSION['answer']) {
        $matherror = "Wrong math!";
    }
    else {
        $matherror = " ";
    }
}

if(defined('REGISTRATION_ERROR')){
    foreach(unserialize(REGISTRATION_ERROR) as $error){
    echo '<p class="error">'.$error.'</p';
    }
} elseif(defined('REGISTERED_A_USER')){
    echo '<p class="success">Successful registration, an email has been sent to '.REGISTERED_A_USER .'</p>';
}
echo '<p class="error">'. $matherror .'</p>';
?>

 
  <form id="my-registration-form" method="post" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>">
    <ul>
    <li>
        <label for="username">Username</label>
        <input type="text" id="username" name="user" value=""/>
    </li>
    <li>
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" value="" />
    </li>
    
    <li>
        <input type="submit" value="Register" />
    </li>
    </ul>
  </form>
</div>
</div>
    
    <?php comments_template(); ?>
    <?php endwhile; ?>
  </div>
  <!-- #content --> 
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

