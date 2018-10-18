<?php 
function custom_post_news() {
  $labels = array(
    'name'               => _x( 'News', 'post type general name' ),
    'singular_name'      => _x( 'News', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'News' ),
    'add_new_item'       => __( 'Add New News' ),
    'edit_item'          => __( 'Edit News' ),
    'new_item'           => __( 'New News' ),
    'all_items'          => __( 'All News' ),
    'view_item'          => __( 'View News' ),
    'search_items'       => __( 'Search News' ),
    'not_found'          => __( 'No News found' ),
    'not_found_in_trash' => __( 'No News found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'News'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Capabilities and Capabilities specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor','thumbnail','page-attributes','excerpt'),
     'taxonomies'   => array( 'category'),
    'has_archive'   => true,
  );
  register_post_type( 'news', $args ); 
}

add_action( 'init', 'custom_post_news' );
?>