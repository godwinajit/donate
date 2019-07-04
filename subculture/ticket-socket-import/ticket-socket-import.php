<?php

/*

Plugin Name:  TicketSocket Import
Description:  Allows you to synchronize TicketSocket events with Wordpress posts.
Version:      1.0.0

*/



class classTicketSocketImportPlugin {
	const PROFILE_URL = 'https://secure.subculturenewyork.com';
	const FEED_PATH = '/api/eventFeed';
	const IMAGE_PATH = '/tickets/pics/galleries/%1$s/%2$s';
	const POST_TYPE = 'ts_event';
	const POST_STATUS = 'publish';

	function __construct() {
		if ($this->is_active()) {
			if (is_admin()) {
				$this->init_admin();
			} else {
				$this->init_site();
			}

			$this->init();
		}
	}

	public function is_active() {
		return
			in_array( plugin_basename(__FILE__), apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ||
			in_array( plugin_basename(__FILE__), array_keys(get_site_option('active_sitewide_plugins')) );
	}

	public function plugin_url() {
		return WP_PLUGIN_URL.'/'.str_replace('/'.basename( __FILE__),"",plugin_basename(__FILE__));
	}

	protected function init() {

		add_action('init', array($this, 'register_post_type'));
		add_action('wp', array($this, 'manual_triggers'));
		add_action('ts_import_fetch_events', array($this, 'fetch_events'));

		if (!wp_next_scheduled( 'ts_import_fetch_events' )) {
			wp_schedule_event(time(), 'hourly', 'ts_import_fetch_events');
		}
	}

	public function manual_triggers() {
		if (isset($_GET['fetch_events'])) {
			$this->fetch_events();
		}

		if (isset($_GET['ticketsocket_debug'])) {
			if ($feed = $this->fetch_url(self::PROFILE_URL . self::FEED_PATH)) {
				echo '<pre>';
				print_r(json_decode($feed));
				echo '</pre>';
				die();
			}
		}
	}
	
	protected function init_site() {
	}

	protected function init_admin() {

	}

	protected function  fetch_url($url) {
		try {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			//curl_setopt($ch, CURLOPT_MAXREDIRS, 9000);
			
			$result = curl_exec($ch);
			return $result;
		}

		catch (Exception $e) {
			return false;
		}
	}
	
	protected function remove_old_events($event_ids=array()) {
		
		query_posts(array('post__not_in' => $event_ids,'post_type' => self::POST_TYPE, 'showposts' => -1));
		if(have_posts()): while(have_posts()): the_post();
			
			$attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment'));
			
            if($attachments)
            {
				foreach($attachments as $att_id => $attachment)
				{
					wp_delete_attachment($attachment->ID);
				}
			}
			wp_delete_post(get_the_ID()); 
		endwhile; endif; wp_reset_query(); 
		
	}
	protected function process_feed($feed) {
		set_time_limit(0);
		$feed = json_decode($feed);

		if (!is_array($feed)) return false;
		
		$exclude_posts = array(); 
		
		foreach ($feed as $item) {
			set_time_limit(0);
			if ($data = $this->process_feed_item($item)) {
				
				$this->create_post($data);
				
				$args = array(
				'post_type' => 'ts_event',
				'meta_query' => array(array('key' => '_event_id', 'value' => $item->id)));
				$postslist = get_posts( $args );
				foreach($postslist as $postsdata)
				{
					$exclude_posts[] = $postsdata->ID ;
				}
			}
		}
		 if(count($exclude_posts) > 0)
		 {
			 $this->remove_old_events($exclude_posts);
		 }
	}

	protected function process_feed_item($item) {
		$data = array();
		$data['meta'] = array();
		$data['images'] = array();

		if (!isset($item->id)) {
			return false;
		}
		
		if(($item->start) < time())
		{
			return false;
		}
		
		$data['meta']['_event_id'] = $item->id;

		if (isset($item->sefUrl)) {
			$data['meta']['_sefUrl'] = $item->sefUrl;
		}

		if (isset($item->start)) {
			$data['meta']['_start'] = $item->start;
		}

		if (isset($item->end)) {
			$data['meta']['_end'] = $item->end;
		}

		if (isset($item->cutOff)) {
			$data['meta']['_cutOff'] = $item->cutOff;
		}
		
		if (isset($item->addToCartForm)) {
			$data['meta']['_tickettypes'] = $item->addToCartForm;
		}
		
		if (isset($item->sefUrl)) {
			$data['post_name'] = $item->sefUrl;
		}
		
		if (isset($item->title)) {
			$data['post_title'] = base64_decode($item->title);
		}

		if (isset($item->description)) {
			$data['post_content'] = base64_decode($item->description);
		}

		if (isset($item->shortDescription)) {
			$data['post_excerpt'] = base64_decode($item->shortDescription);
		}

		if (isset($item->smallPic)) {
			$data['images'][] = $item->smallPic;
		}

		if (isset($item->images) && !empty($item->images)) {
			foreach ($item->images as $image) {
				$data['images'][] = self::PROFILE_URL . sprintf(self::IMAGE_PATH, $item->id, $image->filename);
			}
		}
		
		if(isset($item->categories))
		{
			foreach ($item->categories as $category) {
				$data['categories'][] = $category;
			}
		}
		
		if(isset($item->contentPages))
		{
			foreach ($item->contentPages as $links) {
				$data['contentTitles'][] = $links->title;
				$data['contentDetail'][] = $links->content;
			}
		}

		return $data;
	}

	protected function create_post($data) {
		if (!is_array($data)) return;

		//check if event already exists
		if (isset($data['meta']['_event_id'])) {
			$posts = get_posts(array(
				'post_type' => self::POST_TYPE,
				'post_status' => 'any',
			    'meta_key' => '_event_id',
				'meta_value' => intval($data['meta']['_event_id']),
			));

			if (is_array($posts) && count($posts)) {
				$post = array_shift($posts);
				$data['ID'] = $post->ID;
			}
		}

		$data['post_type'] = self::POST_TYPE;
		$data['post_status'] = self::POST_STATUS;

		if (isset($data['meta'])) {
			$meta = $data['meta'];
			unset($data['meta']);
		} else {
			$meta = array();
		}

		if (isset($data['images'])) {
			$images = $data['images'];
			unset($data['images']);
		} else {
			$images = array();
		}

		if (isset($data['categories'])) {
			$categories = $data['categories'];
			unset($data['categories']);
		} else {
			$categories = array();
		}
		
		if (isset($data['contentTitles'])) {
			$contentTitles = $data['contentTitles'];
			unset($data['contentTitles']);
		} else {
			$contentTitles = array();
		}
		
		if (isset($data['contentDetail'])) {
			$contentDetail = $data['contentDetail'];
			unset($data['contentDetail']);
		} else {
			$contentDetail = array();
		}
		
		if (count($data)) {
			
			if ($id = wp_insert_post($data)) {
								
				foreach ($meta as $key => $value) {
					foreach ($meta as $key => $value) {
						update_post_meta($id, $key, $value);
					}
				}
				
				
				if($contentTitles)
				{
					$counter=1;
					foreach($contentTitles as $key => $contentTitle)
					{
						if(trim($contentTitle) == 'Price Description')
						{
							update_post_meta($id, 'price_description', base64_decode($contentDetail[$key])) ;
						}
						elseif(trim($contentTitle) == 'Listen')
						{
							update_post_meta($id, 'listen', base64_decode($contentDetail[$key])) ;
						}
						elseif(trim($contentTitle) == 'Sponsors Photo')
						{
							update_post_meta($id, 'sponsor_photo', base64_decode($contentDetail[$key])) ;
						}
						else
						{
							update_post_meta($id, 'link_title_'.$counter, $contentTitle);	
							update_post_meta($id, 'link_content_'.$counter, base64_decode($contentDetail[$key]));
							$counter++ ;
						}
					}
				}
								
				if($categories)
				{
					 foreach($categories as $category)
					 {
						if(has_term(trim($category->categoryGroup).'-group', 'event_categories'))
						{
							$taxonomy_data = get_term_by('slug', trim(strtolower($category->categoryGroup)).'-group' , 'event_categories') ;
							$taxonomy_parent_id = $taxonomy_data->term_id ;
						}
						else
						{
							wp_insert_term($category->categoryGroup, 'event_categories', array('slug' => trim(strtolower($category->categoryGroup)).'-group'));
 						    $taxonomy_data = get_term_by('slug', trim(strtolower($category->categoryGroup)).'-group' , 'event_categories') ;
						    $taxonomy_parent_id = $taxonomy_data->term_id ;
						}
						
						$term_status = term_exists(trim($category->sefUrl), 'event_categories', $taxonomy_parent_id) ;
												
						if(isset($term_status['term_id']))
						{
							$taxonomy_data = get_term_by('id', $term_status['term_id'] , 'event_categories') ;
							
							wp_update_term(
								$term_status['term_id'],
								'event_categories',
								array(
								  'description'=> base64_decode($category->description),
								  'slug' => $category->sefUrl,
								  'parent' => $taxonomy_parent_id
								)
							  );
      						  wp_set_post_terms( $id, $taxonomy_data->term_id, 'event_categories',true) ;
							  update_field('cat_order', $category->ordering, 'event_categories_'.$taxonomy_data->term_id);
						}
						else
						{
							wp_insert_term(
							$category->title,
							'event_categories',
							array(
							  'description'=> base64_decode($category->description),
							  'slug' => $category->slug,
							  'parent' => $taxonomy_parent_id
							)
						  );
						  $taxonomy_data = get_term_by('name', trim($category->title) , 'event_categories') ;
						  wp_set_post_terms( $id, $taxonomy_data->term_id, 'event_categories',true) ;
						  update_field('cat_order', $category->ordering, 'event_categories_'.$taxonomy_data->term_id);
						}
					 }
				 }
				
				//check for removed images
				$curren_images = get_posts(array(
					'post_parent' => $id,
					'post_type' => 'attachment',
					'post_status' => 'any',						
				));
				
				foreach ($curren_images as $image) {
					$orig_url = get_post_meta($image->ID, '_orig_url', true);
					if (!$orig_url || !in_array($orig_url, $images)) {
						wp_delete_attachment($image->ID);
					}
				}
				
				foreach ($images as $i => $image) {
					$images = get_posts(array(
						'post_parent' => $id,
						'post_type' => 'attachment',
						'post_status' => 'any',						
						'meta_key' => '_orig_url',
						'meta_value' => $image
					));
					
					//check if attachment already exists
					if (is_array($images) && count($images)) {
						continue;
					}
					echo $this->encode_url($image);
					exit;
					$bits = $this->fetch_url($this->encode_url($image));
					
					$filename = basename($image);
					$name = substr($filename, 0, strrpos($filename, '.'));
					$ext = substr($filename, strrpos($filename, '.'));
					$name = sanitize_title(trim($name));
					$filename = $name . $ext;

					$upload = wp_upload_bits($filename, null, $bits);

					if (!$upload['error']) {
						$filetype = wp_check_filetype(basename($upload['file']), null);
						$wp_upload_dir = wp_upload_dir();
						$attachment = array(
							'guid'           => $wp_upload_dir['url'] . '/' . basename($upload['file']),
							'post_mime_type' => $filetype['type'],
							'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($upload['file'])),
							'post_content'   => '',
							'post_status'    => 'inherit',
						);

						$attach_id = wp_insert_attachment($attachment, $upload['file'], $id);

						require_once( ABSPATH . 'wp-admin/includes/image.php' );

						$attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
						wp_update_attachment_metadata($attach_id, $attach_data);
						update_post_meta($attach_id, '_orig_url', $image);
					}

					//make first image as featured
					if (!$i) {
						update_post_meta($id, '_thumbnail_id', $attach_id);
					}
				}
			}
		}
	}

	public function register_post_type() {
		register_post_type(self::POST_TYPE, array(
			'label' => 'Events',
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'event', 'with_front' => 1),
			'query_var' => true,
			'supports' => array('title','editor','excerpt','custom-fields','thumbnail'),
		));
	}

	public function fetch_events() {
		if ($feed = $this->fetch_url(self::PROFILE_URL . self::FEED_PATH)) {
			$this->process_feed($feed);
		}

		update_option('ts_last_import', date('Y-m-d H:i:s'));
	}

	protected function encode_url($url) {
		$url = rawurlencode($url);
		$url = str_replace('%2F', '/', $url);
		$url = str_replace('%3A', ':', $url);

		return $url;
	}
}

global $TicketSocketImport;
$TicketSocketImport = new classTicketSocketImportPlugin();