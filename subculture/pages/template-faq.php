<?php

/*
Template Name: FAQ Template
*/

wp_enqueue_script('subculture-jquery-quicksearch', get_template_directory_uri().'/js/quicksearch.js', array('jquery'));

theme_wrapper_class('faq');

get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
    <div class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav class="category-menu">
                        <strong class="title"><?php _e('CATEGORY', 'subculture') ?>:</strong>
                        <?php theme_faq_list_categories() ?>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12">
                	<?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($cats = get_terms(array('faq-category'))) : ?>
    <?php theme_print_each(); ?>

    <div class="container category-section">
        <div class="row">
            <?php foreach ($cats as $cat) : ?>
                <?php theme_print_each(2, '</div><div class="row">'); ?>
                <div class="col-sm-6">
                    <?php $posts = get_posts(array(
                        'post_type' => 'faq',
						'showposts' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'faq-category',
                                'field' => 'id',
                                'terms' => $cat->term_id,
                            )
                        )
                    ));

                    if ($posts) : ?>
                    <div class="box">
                        <h2 id="category-<?php echo $cat->slug ?>"><?php echo $cat->name ?>:</h2>
                        <ul class="category-list">
                            <?php foreach ($posts as $post) : ?>
                            <li>
                                <span class="fa fa-angle-right"></span><a class="dropdown-toggle" id="faq-<?php echo $cat->term_id ?>" data-toggle="dropdown" href="<?php the_permalink($post->ID) ?>"><?php echo $post->post_title; ?></a>
                                <div class="faq-answer" aria-labelledby="faq-<?php echo $cat->term_id ?>">
                                    <?php echo apply_filters('the_content', $post->post_content) ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>