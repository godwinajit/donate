<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	?> <p><?php _e('This post is password protected. Enter the password to view comments.', 'kenyon'); ?></p> <?php
	return;
}
	
function theme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
	<div class="commentlist-item">
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <article class="post">
                <header class="title-block">
                    <div class="meta clearfix">
                        <time datetime="<?php comment_date('Y-m-d'); ?>"><?php comment_date('F j Y'); ?></time>
                        <?php
                            $url    = get_comment_author_url(get_comment_ID());
                            $author = get_comment_author(get_comment_ID());
                        ?>
                        <?php if ($url) : ?>
                        <a href="<?php echo $url ?>" class="by"><?php echo $author ?></a>
                        <?php else : ?>
                        <span class="by"><?php echo $author ?></span>
                        <?php endif; ?>
                        <?php edit_comment_link( __( '(Edit)', 'kenyon'), '<p class="edit-link">', '</p>' ); ?>
                    </div>

                    <?php if ($comment->comment_approved == '0') : ?>
                        <p><?php _e('Your comment is awaiting moderation.', 'kenyon'); ?></p>
                    <?php endif; ?>

                    <?php comment_text(); ?>

                    <?php
                        comment_reply_link(array_merge( $args, array(
                            'reply_text' => __('Reply', 'kenyon'),
                            'before' => '<p>',
                            'after' => '</p>',
                            'depth' => $depth,
                            'max_depth' => $args['max_depth']
                    ))); ?>
                </header>
            </article>
		</div>
	<?php }
	
	function theme_comment_end() { ?>
		</div>
	<?php }
?>

<?php if ( have_comments() ) : ?>

<section class="comments-holder container" id="comments">

	<h2><?php comments_number(__('Comments 0', 'kenyon'), __('Comments 1', 'kenyon'), __('Comments %', 'kenyon') );?></h2>

	<div class="commentlist">
		<?php wp_list_comments(array(
			'callback' => 'theme_comment',
			'end-callback' => 'theme_comment_end',
			'style' => 'div'
		)); ?>
	</div>

    <?php if (get_previous_comments_link() || get_next_comments_link()) : ?>
        <div class="text-center">
            <ul class="pagination">
                <?php if (get_previous_comments_link()) : ?>
                    <li><?php previous_comments_link(__('&laquo; Older Comments', 'kenyon')) ?></li>
                <?php endif; ?>
                <?php if (get_next_comments_link()) : ?>
                    <li><?php next_comments_link(__('Newer Comments &raquo;', 'kenyon')) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
</section>

<?php endif; ?>
 

<?php if ( comments_open() ) : ?>

    <section class="comments-holder container">
	<?php theme_comment_form(); ?>
    </section>

<?php else : ?>

	<?php if (is_singular(array('post'))) : ?>
    <section class="comments-holder container">
	    <p><?php _e('Comments are closed.', 'kenyon'); ?></p>
    </section>
	<?php endif; ?>
	
<?php endif; ?>