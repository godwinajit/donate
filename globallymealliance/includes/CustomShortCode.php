<?php

/**************** Custom Breadcumbs *****************************/
function qt_custom_breadcrumbs() {
 
  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '/'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end qt_custom_breadcrumbs()

add_shortcode( 'breadcrumbs', 'qt_custom_breadcrumbs' );

/******* Get Sidebar List Of Links ***********/
function sidebar_links_listing($option)
{
	ob_start();
	$html = '';
	
	$get_involved_links = get_field('get_involved_links','options');
	echo '<ul>';
	foreach($get_involved_links as $row){
		echo '<li><a href="'.$row['link'].'" title="'.$row['title'].'"><div class="get-involved-img"><img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'" /></div><div class="get-invol-txt">'.$row['title'].'</div></a></li>';
	}
	echo '</ul>';
	return ob_get_clean();
}
add_shortcode('SidebarLinks','sidebar_links_listing');

/******* Constant Contact Shortcode ************/
/*
function constant_contact(){
	ob_start();
	$html = '';
	echo '<div id="success_message" style="display:none;">
     <div style="text-align:center;">Thanks for signing up!</div>
    </div>
    <div class="ctct-embed-signup">
     <form data-id="embedded_signup:form" class="ctct-custom-form Form cf" name="embedded_signup" method="POST" action="https://visitor2.constantcontact.com/api/signup">
      <input data-id="ca:input" type="hidden" name="ca" value="202d9ed6-0ad3-4334-a43a-a61bc72e4c8d">
      <input data-id="list:input" type="hidden" name="list" value="4">
      <input data-id="source:input" type="hidden" name="source" value="EFD">
      <input data-id="required:input" type="hidden" name="required" value="list,email,first_name,last_name">
      <input data-id="url:input" type="hidden" name="url" value="">
      <div class="sform_body">
       <ul>
        <li class="first-name-input" >
         <div class="sinput_container" data-id="First Name:p">
          <label data-id="First Name:label" data-name="first_name" class="ctct-form-required">First Name</label>
          <input data-id="First Name:input" type="text" name="first_name" tabindex="1" placeholder="FIRST NAME" />
         </div>
        </li>
        <li class="last-name-input" >
         <div class="sinput_container" data-id="Last Name:p">
          <label data-id="Last Name:label" data-name="last_name" class="ctct-form-required">Last Name</label>
          <input data-id="Last Name:input" type="text" name="last_name" tabindex="2" placeholder="LAST NAME" />
         </div>
        </li>
        <li class="email-name-input">
         <div class="sinput_container" data-id="Email Address:p">
          <label data-id="Email Address:label" data-name="email" class="ctct-form-required">Email Address</label>
          <input data-id="Email Address:input" type="text" name="email" tabindex="3" placeholder="EMAIL" />
         </div>
        </li>
       </ul>
      </div>
      <div class="sform_footer top_label">
       <input type="submit" tabindex="4" value="" />
      </div>
     </form>
    </div>';
		return ob_get_clean();
}
add_shortcode('ConstantContact','constant_contact');
*/
/************************ Mobile Icon Slider ******************************/

function mobile_icon_slider(){
	ob_start();
	$html = '';
	echo '<div class="icon-slider inner-pages-icon-slider">
 <div class="main">
  <div class="owl-ico-slider">';
   
			$icon_slider = get_field('icon_slider', 2);
			if($icon_slider){
				foreach($icon_slider as $islider){
					if($islider['image']){
						echo '<div class="item"> 
										<a class="cf" href="'.$islider['link'].'" title="Donate">
											<div class="img-ico">
											 <img class="img-normal" src="'.$islider['image']['url'].'" alt="'.$islider['image']['alt'].'" title="'.$islider['image']['title'].'" />
											 <img class="img-hover" src="'.$islider['hover_image']['url'].'" alt="'.$islider['hover_image']['alt'].'" title="'.$islider['hover_image']['title'].'" /> 
											</div>
										<div class="icon-slider-title">'.$islider['text'].'</div>
										</a> 
									</div>';	
					}	
				}	
			}
	
  echo '</div>
 </div>
</div>';
	return ob_get_clean();	
}
add_shortcode('IconSlider','mobile_icon_slider');

function upcoming_events(){
	ob_start();
	$html = '';
		$d = date("Y-m-d");
		$args=array(
		 'post_type' => 'events',
		 'post_status' => 'publish',
		 'posts_per_page' => 1,
		 'meta_key' => 'event_date',
		 'orderby' => 'meta_value_num',
		 'order' => 'ASC',
		 'meta_query' => array(
					array(
							'key' => 'event_date',
							'value' => $d,
							'type' => 'date',
							'compare' => '>'
					)
			)
		 );
		 		echo '<div class="bucket-widget-text upcoming-events"><div class="upcoming-event-title common-aside-title">Upcoming Events</div>';

				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
            <div class="bucket-widget-title-height">
  				<div class="dis-table">
  					<?php $event_date = get_field('event_date', $post->ID); ?>
  					<?php $sidebar_event_address = get_field('sidebar_event_address', $post->ID); ?>
   					<div class="bucket-widget-text-title">
   					<?php
						echo date('l',strtotime($event_date)).',<br>';
						echo date(' F j, Y',strtotime($event_date)); ?><span> &gt; </span></div>
  				</div>
 			</div>
            <div class="textwidget uc-content">
           		<?php echo'<h3>'.$post->post_title.'</h3>';
					$content = $post->post_content;
					//$trimmed_content = wp_trim_words( $content, 3 );
					echo '<p>'. date('l',strtotime($event_date)).', ';
					echo date(' F j, Y',strtotime($event_date)).'</p>';
					echo $sidebar_event_address;
					echo '<a class="read-more" href="'. get_permalink($post->ID) . '">MORE</a>';
					?>
           	</div>
				<?php endforeach;
				wp_reset_postdata();
				return ob_get_clean();
}

add_shortcode('UpcomingEvents','upcoming_events');

/************ Get List of years for sidebar **************/

function sidebar_events_year(){
	ob_start();
	$curetnyear = date("Y");
	$html = '';
		$d = date("Y-m-d");
		$args=array(
		 'post_type' => 'events',
		 'post_status' => 'publish',
		 'posts_per_page' => -1		
		 );

				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				  <?php $event_date = get_field('event_date', $post->ID);  				
								$year = date('Y',strtotime($event_date)); 
                $year_archive[] = $year;           
								
			 endforeach;
			 $year_archive = array_unique($year_archive);
			// print_r($year_archive);
			
			 echo '<ul>';
			 foreach($year_archive as $ya)
			 {
				 if($curetnyear>=$ya)
				 {
				    echo '<li><a href="'.site_url().'/events/'.$ya.'">'.$ya.'</a></li>'; 
				 }
			 }
			 echo '<li><a href="/past-events/">MORE</a></li>';
			 echo '</ul>';
				wp_reset_postdata();
				return ob_get_clean();
}

add_shortcode('SidebarEventsYear','sidebar_events_year');


function sidebar_press_releases_year(){
	ob_start();

	$curetnyear = date("Y");
	$args=array(
		'post_type' => 'press_releases',
		'post_status' => 'publish',
		'posts_per_page' => -1		
	);
	
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){	
		$year_archive[] = date('Y', strtotime($post->post_date));           
	}
	$year_archive = array_unique($year_archive);
	
	echo '<ul>';
	foreach($year_archive as $ya){
		if($curetnyear>=$ya){
			echo '<li><a href="'.site_url().'/press-releases/'.$ya.'/">'.$ya.'</a></li>'; 
		}
	}
	echo '<!-- <li><a href="/press-releases/">MORE</a></li> -->';
	echo '</ul>';
	
	return ob_get_clean();
}

add_shortcode('SidebarPressReleasesYear','sidebar_press_releases_year');


function sidebar_news_year(){
	ob_start();

	$curetnyear = date("Y");
	$args=array(
		'post_type' => 'news',
		'post_status' => 'publish',
		'posts_per_page' => -1		
	);
	
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){	
		$year_archive[] = date('Y', strtotime($post->post_date));           
	}
	$year_archive = array_unique($year_archive);
	
	echo '<ul>';
	foreach($year_archive as $ya){
		if($curetnyear>=$ya){
			echo '<li><a href="'.site_url().'/news/'.$ya.'/">'.$ya.'</a></li>'; 
		}
	}
	echo '<!-- <li><a href="/news/">MORE</a></li> -->';
	echo '</ul>';
	
	return ob_get_clean();
}

add_shortcode('SidebarNewsYear','sidebar_news_year');


function sidebar_newsletters_year(){
	ob_start();

	$curetnyear = date("Y");
	$args=array(
		'post_type' => 'newsletters',
		'post_status' => 'publish',
		'posts_per_page' => -1		
	);
	
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){	
		$year_archive[] = date('Y', strtotime($post->post_date));           
	}
	$year_archive = array_unique($year_archive);
	
	echo '<ul>';
	foreach($year_archive as $ya){
		if($curetnyear>=$ya){
			echo '<li><a href="'.site_url().'/newsletters/'.$ya.'/">'.$ya.'</a></li>'; 
		}
	}
	echo '<!-- <li><a href="/newsletters/">MORE</a></li> -->';
	echo '</ul>';
	
	return ob_get_clean();
}

add_shortcode('SidebarNewslettersYear','sidebar_newsletters_year');


function sidebar_videos_year(){
	ob_start();

	$curetnyear = date("Y");
	$args=array(
		'post_type' => 'videos',
		'post_status' => 'publish',
		'posts_per_page' => -1		
	);
	
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){	
		$year_archive[] = date('Y', strtotime($post->post_date));           
	}
	$year_archive = array_unique($year_archive);
	
	echo '<ul>';
	foreach($year_archive as $ya){
		if($curetnyear>=$ya){
			echo '<li><a href="'.site_url().'/videos/'.$ya.'/">'.$ya.'</a></li>'; 
		}
	}
	echo '<!-- <li><a href="/videos/">MORE</a></li> -->';
	echo '</ul>';
	
	return ob_get_clean();
}

add_shortcode('SidebarVideosYear','sidebar_videos_year');

function sidebar_blog_year(){
	ob_start();

	$curetnyear = date("Y");
	$args=array(
		'post_status' => 'publish',
		'posts_per_page' => -1		
	);
	
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){	
		$year_archive[] = date('Y', strtotime($post->post_date));           
	}
	$year_archive = array_unique($year_archive);
	
	echo '<ul>';
	foreach($year_archive as $ya){
		if($curetnyear>=$ya){
			echo '<li><a href="'.site_url().'/'.$ya.'/">'.$ya.'</a></li>'; 
		}
	}
	echo '<!-- <li><a href="/blog/">MORE</a></li> -->';
	echo '</ul>';
	
	return ob_get_clean();
}

add_shortcode('SidebarBlogYear','sidebar_blog_year');