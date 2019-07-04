<?php $start_date = get_post_meta(get_the_ID(), '_start', true); 
      $price_description = get_post_meta(get_the_ID(), 'price_description', true); 
	  $find_tickets_link = get_post_meta(get_the_ID(), '_find_tickets_link', true); 
	  $facebookLikeURL = get_post_meta(get_the_ID(), '_facebookLikeURL', true); 
	  $sefUrl = get_post_meta(get_the_ID(), '_sefUrl', true);
	  $cutOff = get_post_meta(get_the_ID(), '_cutOff', true); 
	  $end = get_post_meta(get_the_ID(), '_end', true); 	  
	   $listen = get_post_meta(get_the_ID(), 'listen', true); 
	   $sponsored_photo = get_post_meta(get_the_ID(), 'sponsor_photo', true); 
	   $eventid = get_post_meta(get_the_ID(), '_event_id', true); 
	   $tickettypes = fetch_event_tickettypes($eventid); 
	   if ($listen) {
			$listen = theme_parse_youtube_id($listen);
			if ($listen) {
				$listen = "//www.youtube.com/embed/{$listen}";
			}
	   }
	   
	   
	 // $link_title = get_post_meta(get_the_ID(), 'link_title', false);
	  //$link_content = get_post_meta(get_the_ID(), 'link_content', false); ?>
      
<div class="col-sm-8 pull-right">
	<div class="content">
	  <header class="content-heading">
		  <div class="heading-block">
			  <div class="share-block">
                 <span class="text">share:</span>
                 <ul class="social">
                      <li><span class="st_facebook"><span class="fa fa-facebook"></span></span></li>
                      <li><span class="st_twitter"><span class="fa fa-twitter"></span></span></li>
                      <li>
                      	<div class="popup-holder">
							<a href="emailOpen()" class="opener"><span class="fa fa-envelope"></span></a>
							<div class="popup popup-email" title="SHARE VIA EMAIL">
								<?php get_template_part('blocks/events/email'); ?>
							</div>
							
                      	</div>
                      </li>
                 </ul>
              </div>              
			  <div class="holder">
				  <h1><?php the_title(); ?></h1>
			  </div>
		  </div>
		  <div class="date-block">
			  <?php if ($start_date) : ?><time class="day" datetime="<?php echo theme_ts_event_date('Y-m-d', $start_date) ?>"><?php echo strtoupper(theme_ts_event_date('D', $start_date)) ?> - <?php echo theme_ts_event_date('m/d/y', $start_date) ?></time><?php endif; ?>
			  <?php if($cutOff): ?>Doors: <?php echo theme_ts_event_date( 'h:i a', $cutOff) ?> <?php endif; ?><?php if ($start_date) : ?>/ Show: <?php echo theme_ts_event_date('h:i a', $start_date) ?><?php endif; ?>
		  </div>
		  <div class="tickets-block">
			  <?php if($price_description): ?><div class="price"><?php echo $price_description; ?></div><?php endif; ?>
			  <?php /*<button onclick="window.location.href=' https://secure.subculturenewyork.com/event/<?php echo $sefUrl; ?>'" class="btn btn-default btn-find" type="button">FIND TICKETS</button> */ ?>
		  </div>
		  <div class="heading-box">
			  <ul class="links">
              	  <?php if($listen): ?>
				  <li>
					  <div class="popup-holder">
						  <a href="#" class="opener">LISTEN <span class="fa fa-volume-up"></span></a>
						  <div class="popup" title="LISTEN">
							  <iframe src="<?php echo $listen; ?>" width="330" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
						  </div>
					  </div>
				  </li>
                  <?php endif; ?>
				  <?php $haveLink = false;
						for($i=1; $i<20; $i++):
							$link_title = get_post_meta(get_the_ID(), 'link_title_'.$i, true);
							$link_content = strip_tags(get_post_meta(get_the_ID(), 'link_content_'.$i, true));
							if($link_title && $link_content) : 
								$haveLink =	true;
								break;
							endif; 
						endfor; 
						
						if($haveLink): 
				  ?>	
                  <li>
					  <div class="popup-holder">
						  <a href="#" class="opener">LINKS <span class="fa fa-link"></span></a>
						  <div class="popup popup-social" title="LINKS">
						  <?php get_template_part('blocks/events/links'); ?>
						  </div>
					  </div>
				  </li>
				  <?php endif; ?>
			  </ul>
			  <div class="fb-holder">
              	  <div class="fb-like" data-href="<?php echo get_permalink(get_the_ID()); ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
			  </div>
              
		  </div>
	  </header>
      <?php echo theme_customize_tickettypes($tickettypes); ?>
	  <?php the_content(); ?>
	</div>
</div>

<?php   
$attachments = get_children(array(
	'post_parent' => get_the_ID(),
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order' => 'asc',
	'orderby' => 'menu_order',
	'exclude' => get_post_thumbnail_id(get_the_ID())
));
			  
if($attachments || $sponsored_photo):
?>
<div class="col-sm-4">
	<div class="img-block">
    	<?php if($attachments): ?>
			<?php foreach($attachments as $att_id => $attachment): ?>
                <?php echo wp_get_attachment_image($attachment->ID, 'events-gallery-683');?>
            <?php endforeach; ?>
      	<?php endif; ?>
      
      <?php echo $sponsored_photo; ?>
	</div>
</div>
<?php endif; ?>