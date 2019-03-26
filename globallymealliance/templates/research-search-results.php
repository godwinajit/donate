<?php
/* Template Name: Research Search Results */

get_header();

if ( ! empty( $_POST ) ) {
	$args = array();

	$args['post_type'] = $_POST['post_types'];
	if( trim($_POST['search-research']) != "") $args['s'] = trim($_POST['search-research']);
	$args['posts_per_page'] = -1;
	$args['orderby'] = $_POST['research-search-sort'];
	if( $_POST['research-search-sort'] == 'post_date' ) $args['order'] = 'desc';
	
	$tax_query = array();

    if (!empty($_POST['research_topics'])) {
        $tax_query[] = array(
            'taxonomy' => 'research_topics',
            'field' => 'slug',
            'terms' => $_POST['research_topics']
        );
    }

    if (!empty($_POST['research_year'])) {
        $tax_query[] = array(
            'taxonomy' => 'research_year',
            'field' => 'slug',
            'terms' => $_POST['research_year']
        );
    }

    if (!empty($_POST['research_author'])) {
        $tax_query[] = array(
            'taxonomy' => 'research_author',
            'field' => 'slug',
            'terms' => $_POST['research_author']
        );
    }

    if (!empty($tax_query)) {
        $tax_query['relation'] = 'AND'; // you can also use 'OR' here
        $args['tax_query'] = $tax_query;
    }

	if( isset($args['s']) ){
		$query = new WP_Query();
		$query->parse_query( $args );
		relevanssi_do_query( $query );
	}else{
		$args['suppress_filters'] = true;
		$query = new WP_Query( $args );
	}

} else{
	$redirectUrl = site_url( '/research-topics/' );
	wp_redirect( $redirectUrl, 301 );
	exit;
}
?>
<main class="mains">
	<div class="inner-pages common-content-page">
	<?php
		if (has_post_thumbnail()) {
			$banneurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
		} else {
			$banneurl = get_template_directory_uri() . '../../../uploads/2015/12/web-header_researcher9.png';
		}
	?>
		<!-- <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)"></div> -->
		<div class="container-section">
			<div class="wrapper container-fluid">
				<div class="row center-xs">
					<div class="col-xs-12 col-sm-11 col-md-10">
						<div class="boards">
							<?php get_template_part( 'research', 'searchform' ); ?>
							<div class="search-result">
							<?php if ( !empty($query->posts) ) : ?>
								<?php foreach ($query->posts as $post): setup_postdata($post); ?>
									<?php get_template_part( 'loops/research', 'content' ); ?>
								<?php wp_reset_postdata(); ?>
								<?php endforeach; ?>
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
	<?php get_template_part( 'newsletter', 'form' ); ?>
</main>

<?php get_footer(); ?>
