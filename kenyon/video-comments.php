<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 */

if ('video-comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ('Please do not load this page directly. Thanks!');}
if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password)
	{  // and it doesn't match the cookie
		?>

<h2><?php _e('Password Protected'); ?></h2>
<p><?php _e('Enter the password to view comments.'); ?></p>

<?php return;
	}
}
$oddcomment = 'alt';

?>
<section class="section">
<?php if ($comments) : ?>

	<header class="sub-headline">
		<h2>Comments</h2>
	</header>

<ol class="comments-list" id="comment-list">
<?php
			wp_list_comments('type=comment&callback=mytheme_comment');
		?>

</ol>

<?php else : ?>

<?php if ('open' == $post->comment_status) : ?>
	<!-- If comments are open, but there are no comments. -->
	<?php else : // comments are closed ?>

	
<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>

<?php endif; ?>
</section>

<?php if ('open' == $post->comment_status) : ?>
<section class="section section-contact" id="respond">
	<h2>Add Your Comment</h2>
	<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
		nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.
		Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.</p> -->

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>
/wp-login.php?redirect_to=<?php the_permalink(); ?>">
logged in</a> to post a comment.</p>

<?php else : ?>
<div class="form-box contact-form">
<form action="<?php echo get_option('siteurl'); ?>
/wp-comments-post.php" method="post" id="commentform">
<div class="fieldset">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
<?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>
/wp-login.php?action=logout" 
title="Log out of this account">Logout &raquo;</a></p>

<?php else : ?>

	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6">
			<div class="control-wrap">
				<input type="text" name="author" id="author" class="form-control" value="<?php echo $comment_author; ?>" placeholder="Name"> <span class="red req-icon"> * </span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6">
			<div class="control-wrap">
				<input type="text" name="email" id="email" class="form-control" value="<?php echo $comment_author_email; ?>" placeholder="Email Address"> <span class="red req-icon"> * </span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6">
			<div class="control-wrap">
				<input type="text" name="url" id="url" class="form-control"	placeholder="Website Url" value="<?php echo $comment_author_url; ?>" > 
			</div>
		</div>
	</div>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?> 
<?php echo allowed_tags(); ?></small></p>-->

	<div class="row">
		<div class="col-xs-12">
			<div class="control-wrap">
				<textarea name="comment" id="comment" class="form-control"></textarea> <span class="red req-icon"> * </span>
			</div>
		</div>
	</div>
	<div class="action">
		<input type="submit"  name="submit" id="submit" value="Submit" class="btn btn-default btn-round red sm comment_submit">
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		<?php comment_id_fields(); ?>
	</div>
</div>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>
<?php endif; ?>

</section>
<?php endif; ?>