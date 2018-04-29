<?php
get_header ();
$bannerImageurl = '/wp-content/uploads/2015/12/Reading-Resources-hero.jpg';

$bannerurlId = get_field( 'resources_header', 'option');
$bannerImage = wp_get_attachment_image_src($bannerurlId, 'banner-top')[0];

if (!$bannerImage)
    $bannerImage = $bannerImageurl;
?>
<main class="mains">
    <div class="inner-pages common-content-page">
        <div class="inner-banner" style="background-image:url(<?php echo $bannerImage; ?>)"></div>
        <div class="container-section resources-cat-container">
            <div class="wrapper container-fluid">
                <div class="row center-xs">
                    <div class="col-xs-12 col-sm-11 col-md-10">
                        <div class="boards resources-cat-page">
                            <h1 class="page-title">Resources</h1>
                            <div class="resources-cat-filter">
                                <ul>
                                    <li id="categories-li">
                                        <?php
                                        $url = site_url( '/resources/', 'https' );
                                        $args = array (
                                            'show_option_all' => '',
                                            'show_option_none' => 'Category',
                                            'option_none_value' => '',
                                            'orderby' => 'ID',
                                            'order' => 'ASC',
                                            'show_count' => 0,
                                            'hide_empty' => 1,
                                            'child_of' => 0,
                                            'exclude' => '',
                                            'include' => '',
                                            'echo' => 1,
                                            'selected' => 0,
                                            'hierarchical' => 0,
                                            'name' => 'support_group_states-cat',
                                            'id' => 'support_group_states-cat',
                                            'class' => 'support_group_states-cat',
                                            'depth' => 0,
                                            'tab_index' => 0,
                                            'taxonomy' => 'support_group_states',
                                            'hide_if_empty' => true,
                                            'value_field' => 'slug'
                                        );
                                        ?>
                                        <?php wp_dropdown_categories( $args ); ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="resources-cat-con-contain page">
                                <div class="resources-cat-list-container resources-cat-masonary">
                                    <?php if ( have_posts() ) : ?>
                                        <?php while (have_posts() ) : the_post(); ?>
                                            <article class="resources-cat-article">
                                                <div style="display: block;padding: 20px;">
                                                    <h4><?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?></h4>
                                                    <?php if (get_field('address')){ ?>
                                                        <?php the_field('address');?>
                                                    <?php }?>
                                                    <?php if (get_field('city')){ ?>
                                                        <strong>City: </strong>
                                                        <?php the_field('city');?>
                                                    <?php }?>
                                                    <?php if (get_field('dates')){ ?>
                                                        <br>
                                                        <strong>Dates: </strong>
                                                        <?php the_field('dates');?>
                                                    <?php }?>
                                                    <?php if (get_field('time')){ ?>
                                                        <br>
                                                        <strong>Time: </strong>
                                                        <?php the_field('time');?>
                                                    <?php }?>
                                                    <?php if (get_field('contacts')){ ?>
                                                        <br>
                                                        <strong>Contacts: </strong>
                                                        <?php the_field('contacts');?>
                                                    <?php }?>
                                                    <?php if (get_field('website')){ ?>
                                                        <br>
                                                        <strong>Website: </strong>
                                                        <a href="<?php the_field('website');?>"><?php the_field('website');?></a>
                                                    <?php }?>
                                                 </div>
                                            </article>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <?php wp_pagenavi(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subscribe CTA -->
        <section class="section-subscribe">
            <div class="wrapper container-fluid">
                <div class="row center-xs">
                    <div class="col-xs-12 col-sm-11 col-md-10">
                        <div class="subscribe-form">
                            <span class="icon icon-mail sm-visible"></span>
                            <h2><?php echo get_field('newsletter_text', 2); ?></h2>
                            <div class="form-row">
                                <?php echo do_shortcode('[ctct form="7979"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
<script>
    $(function(){
        var siteUrl = "<?php echo $url?>";
        // bind change event to select
        $('#resources-cat').on('change', function () {
            var slug = $(this).val(); // get selected value
            if (slug) { // require a slug
                window.location = siteUrl+slug; // redirect
            }
            return false;
        });
    });
</script>
