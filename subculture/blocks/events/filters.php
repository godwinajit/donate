<?php 

	$list_page = get_field('list_page','option');
	$series_page = get_field('series_page','option');
	$calendar_page = get_field('calendar_page','option');

?>
<div class="container heading-panel">
	<div class="row">
		<?php if ($calendar_page || $list_page || $series_page) : 
					$str = "";
					if(isset($_GET["cat"])): 
						$str = "?cat=".$_GET["cat"];
						
						if(is_page('events-calendar')):
							$query_args = array(
								'post_type' => 'ts_event',
								'showposts' => -1, 
								'post_per_page' => -1,
								'meta_query' => array(
									array(
										'key'     => '_start',
										'type'    => 'numeric',
									),
								),
								'tax_query' => array(
									array(
										'taxonomy' => 'event_categories',
										'field' => 'id',
										'terms' =>$_GET['cat'],
									),
								),
								'orderby' => '_start',
								'order' => 'ASC',
							);
							
							query_posts($query_args);
							if (have_posts()) {
								the_post();
								$start_date = get_post_meta(get_the_ID(), '_start', true);
								?>
								<script type="text/javascript">
								var eventsCalendarDay = {
									day: '<?php echo theme_ts_event_date('Y-m-d', $start_date); ?>',
								}
								</script>
								<?php	
								//echo theme_ts_event_date('Y-m-d', $start_date);
							}
							wp_reset_query();
						endif;
						
					endif;
		?>
		<!-- <div class="col-sm-8">
			<div class="switch" >
				<span class="title">VIEW:</span>
				<?php if ($calendar_page) : ?>
				<a class="calendar-view" href="<?php echo get_permalink($calendar_page->ID).$str; ?>">calendar <span class="fa fa-calendar-o"></span></a>
				<?php endif; ?>
				<?php if ($list_page) : ?>
				<a class="list-view" href="<?php echo get_permalink($list_page->ID).$str; ?>">LIST <span class="fa fa-th"></span></a>
				<?php endif; ?>
				<?php if ($series_page) : ?>
				<a class="series-view" href="<?php echo get_permalink($series_page->ID); ?>">SERIES <span class="fa fa-list"></span></a>
				<?php endif; ?>
			</div>
		</div> -->
		<?php endif; ?>

        <?php if(!is_single() && !is_page($series_page->ID)): ?>
        <?php $taxonomy_data = get_term_by('slug', 'series-group' , 'event_categories') ;
			  $series_parent_id = $taxonomy_data->term_id ;?>
              
		<?php $taxonomies = get_terms( 'event_categories', array('exclude_tree' => $series_parent_id ,'orderby' => 'id') ); ?>         
        <?php if($taxonomies): ?>
        
        <?php $ordered_taxonomies = array(); 
			   foreach($taxonomies as $taxonomy)
			   {
				   $taxonomy_order = get_field('cat_order','event_categories_'.$taxonomy->term_id);
				   if($taxonomy_order > 0)
				   {
					   $ordered_taxonomies[$taxonomy_order] = $taxonomy->term_id ;
				   }
				   else
				   {
					   $ordered_taxonomies[] = $taxonomy->term_id ;
				   }
			   }			   
			   ksort($ordered_taxonomies);
		 ?>
        <div class="col-sm-4">
			<form action="#" class="sort-form">
				<fieldset>
					<label for="sort">SORT BY:</label>
					<select id="sort" onchange="window.location.href=this.value">
                    	<option value="<?php echo get_permalink($performance_page_id); ?>">All</option>
                    	<?php foreach($ordered_taxonomies as $ordered_taxonomy):  ?>
                        	<?php $taxonomy = get_term_by('id', $ordered_taxonomy, 'event_categories') ;?>
                        	<?php if($taxonomy->parent > 0): ?>
								<option <?php if(isset($_REQUEST['cat']) && ($_REQUEST['cat'] ==$taxonomy->term_id )): echo 'selected="selected"'; endif; ?> value="<?php echo add_query_arg('cat',$taxonomy->term_id,get_permalink($performance_page_id)); ?>"><?php echo $taxonomy->name; ?></option>
                             <?php endif; ?>   
                        <?php endforeach; ?>
					</select>
				</fieldset>
			</form>
		</div>
        <?php endif; ?>
        <?php endif; ?>
	</div>
</div>