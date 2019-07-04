<?php
/*
Template Name: Series Template
*/
?>

<?php if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] ==1): ?>

<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  ?>
<?php $args = array('post_type' => 'ts_event', 'orderby' => 'meta_value', 'meta_key' => '_start', 'order' => 'ASC', 'showposts' => 3, 'paged' => $paged ,'tax_query' => array( array('taxonomy' => 'event_categories','field' => 'id','terms' =>$_REQUEST['cat']))); ?>

<?php query_posts($args); ?>
<?php if(have_posts()): ?>
<div class="row">
	<?php theme_print_each(); ?>
	<?php while (have_posts()) : the_post(); ?>
        <?php theme_print_each(3, '</div><div class="row">'); ?>
        <article class="item col-sm-4">
            <div class="holder">
                <?php get_template_part('blocks/events/content') ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php if(get_next_posts_link()): ?>
    <div class="show-more-link">
        <?php $newpaged = $paged + 1 ; ?>
       <a href="<?php echo add_query_arg(array('ajax' => 1, 'paged' => $newpaged, 'cat' => $_REQUEST['cat'])); ?>">SHOW MORE EVENTS</a>
    </div>
<?php endif; ?>
<?php endif; ?>

<?php wp_reset_query() ?>



<?php else: ?>
<?php get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
    <?php get_template_part('blocks/events/filters') ?>
    <section class="container items">
        <div class="row">
			
			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  ?>
            
            <?php $taxonomy_data = get_term_by('slug', 'series-group' , 'event_categories') ;
				  $series_parent_id = $taxonomy_data->term_id ;?>
    		<?php $taxonomies = get_terms( 'event_categories', array('hide_empty' => 0, 'orderby' => 'id', 'child_of' => $series_parent_id) ); ?>                
             <?php if($taxonomies): ?>
             
			 <?php $ordered_taxonomies = array(); 
			 	   
				   // Get Series Order From Ticket Socket
				   $series = fetch_series(); 
				   foreach($series as $seriesname):
				   		$staxonomy = get_term_by('slug', $seriesname, 'event_categories') ;
						if(isset($staxonomy->term_id)):
				   			$taxonomy_order = get_field('cat_order','event_categories_'.$staxonomy->term_id);
				   			$ordered_taxonomies[$taxonomy_order] = $staxonomy->term_id ;
						endif;
				   endforeach;
				   
				   /*foreach($taxonomies as $taxonomy)
			 	   {
					   $taxonomy_order = get_field('cat_order','event_categories_'.$taxonomy->term_id);
					   $ordered_taxonomies[$taxonomy_order] = $taxonomy->term_id ;
				   }
				   ksort($ordered_taxonomies);*/
			 ?>
			 
			 <?php $counter=1; foreach($ordered_taxonomies as $ordered_taxonomy): ?>
             <?php $taxonomy = get_term_by('id', $ordered_taxonomy, 'event_categories') ;?>
             
            <div class="series open-close <?php if(($paged > 1) && (isset($_REQUEST['cat']) && ($taxonomy->term_id == $_REQUEST['cat']))): echo "active" ; endif; ?>">
                <h2 class="title"><?php echo $taxonomy->name; ?></h2>
                <?php echo $taxonomy->description; ?>
				
				<div class="clearfix"></div>
                <a class="btn pull-right opener" href="#">
                    <span class="open-w"><span class="glyphicon glyphicon-plus"></span> View Events</span>
                    <span class="close-w"><span class="glyphicon glyphicon-remove"></span></span>
                </a>
				<div class="clearfix"></div>
                
                <?php if(isset($_REQUEST['cat']) && ($taxonomy->term_id == $_REQUEST['cat'])): ?>
	                <?php $args = array('post_type' => 'ts_event', 'orderby' => 'meta_value', 'meta_key' => '_start', 'order' => 'ASC', 'showposts' => 999, 'paged' => $paged ,'tax_query' => array( array('taxonomy' => 'event_categories','field' => 'id','terms' =>$taxonomy->term_id))); ?>
                <?php else: ?>
                	<?php $args = array('post_type' => 'ts_event' , 'orderby' => 'meta_value', 'meta_key' => '_start', 'order' => 'ASC' , 'showposts' => 999 ,'tax_query' => array( array('taxonomy' => 'event_categories','field' => 'id','terms' =>$taxonomy->term_id))); ?>
                <?php endif; ?>
                
				<?php query_posts($args); ?>
                <?php if(have_posts()): ?>    
                <div class="slide">
                    <div class="slide-holder">
                        <div class="ajax-items">
                            <div class="ajax-container">
                                <div class="row">
                                	<?php theme_print_each(); ?>
                					<?php while (have_posts()) : the_post(); ?>
                					<?php theme_print_each(3, '</div><div class="row">'); ?>
                                    <article class="item col-sm-4">
                                        <div class="holder">
                                            <?php get_template_part('blocks/events/content') ?>
                                        </div>
                                    </article>
                                    <?php endwhile; ?>
                                    
                                    <?php if(isset($_REQUEST['cat']) && ($taxonomy->term_id == $_REQUEST['cat'])): ?>
                						<?php if(get_next_posts_link()): ?>
                                        <div class="show-more-link">
                                            <?php $newpaged = $paged + 1 ; ?>
                                            <a href="<?php echo add_query_arg(array('ajax' => 1, 'paged' =>$newpaged, 'cat' => $taxonomy->term_id)); ?>">SHOW MORE EVENTS</a>
                                        </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    	
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(get_next_posts_link()): ?>
                                <div class="show-more-link">
                                    <?php $newpaged = 2 ; ?>
                                    <a href="<?php echo add_query_arg(array('ajax' => 1, 'paged' => $newpaged, 'cat' => $taxonomy->term_id)); ?>">SHOW MORE EVENTS</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; wp_reset_query(); ?>
            </div>
            
            
            
            <?php $counter++; endforeach; ?>
            <?php endif; ?>
            
        </div>
    </section>
</div>

<?php get_footer(); ?>

<?php endif; ?>