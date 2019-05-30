<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<div itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div class="commentlist-item">
        <div id="comment-<?php comment_ID(); ?>" class="comment_container">
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

                        <?php

                        if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
                            if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
                                echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

                        ?>

                        <?php edit_comment_link( __( '(Edit)', 'kenyon'), '<p class="edit-link">', '</p>' ); ?>
                    </div>

                    <?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

                        <div class="review-rating clearfix">
                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="rating-box star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
                                <span class="rating" style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong class="rating-value" itemprop="ratingValue"><?php echo $rating; ?></strong></span>
                            </div>
                        </div>

                    <?php endif; ?>

                    <?php if ($comment->comment_approved == '0') : ?>
                        <p><?php _e('Your comment is awaiting moderation.', 'kenyon'); ?></p>
                    <?php endif; ?>

                    <?php comment_text(); ?>
                </header>
            </article>
        </div>
    </div>