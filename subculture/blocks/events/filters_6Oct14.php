<?php $performance_page_id = get_field('performance_page_id','option'); ?>
<div class="container heading-panel">
	<div class="row">
		<div class="col-sm-4">
			<a href="https://secure.subculturenewyork.com/my-account" class="login-link">LOG-IN TO YOUR ACCOUNT <span class="fa fa-chevron-circle-right"></span></a>
		</div>
		<div class="col-sm-4">
			<div class="switch" style="display:none;">
				<span class="title">switch to:</span>
				<a href="#">calendar <span class="fa fa-calendar-o"></span></a>
				<a href="#">LIST <span class="fa fa-list"></span></a>
			</div>
		</div>
        <?php if(!is_single()): ?>
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