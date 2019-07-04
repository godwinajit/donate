<?php 

$start 		= $_GET['from'] / 1000;
$end   		= $_GET['to'] / 1000;
$start 		= strtotime('-6 day', $start); // Fetch the events -6 days to the current month, so the previous month events will be available in the calander
$end   		= strtotime('+6 day', $end); // Fetch the events +6 days to the current month, so the next month events will be available in the calander

$timezone   = (isset($_GET['browser_timezone']) && $_GET['browser_timezone']) ? $_GET['browser_timezone'] : 'PDT';
$cat 		= isset($_GET['cat']) ? $_GET['cat'] : null;

$query_args = array(
	'post_type' => 'ts_event',
	'showposts' => -1, 
	'meta_query' => array(
		array(
			'key'     => '_start',
			'value'   => array($start, $end),
			'type'    => 'numeric',
			'compare' => 'BETWEEN',
		),
	),
);

if ($cat) {
	$query_args['tax_query'] = array(array(
		'taxonomy' => 'event_categories',
		'field' => 'id',
		'terms' =>$_GET['cat'],
	));
}

query_posts($query_args);

$out = array();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		list($image) = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'events-thumb-100');
		$out[] = array(
			'id' => get_the_ID(),
			"eventTitle" => get_the_title(),
			"title" => get_excerpt(140, 'content'),
			"url" => get_permalink(get_the_ID()),
			"eventImage" => $image,
			"eventImageAlt" => get_the_title(),
			"class" => "event-warning",
			'start' => theme_ts_event_calendar_timestamp_convert(get_post_meta(get_the_ID(), '_start', true), $timezone) . '000',
			'door' => theme_ts_event_calendar_timestamp_convert(get_post_meta(get_the_ID(), '_cutOff', true), $timezone) . '000',
			'end' => theme_ts_event_calendar_timestamp_convert(get_post_meta(get_the_ID(), '_end', true), $timezone) .'000',
			'priceDescription' => strip_tags(get_post_meta(get_the_ID(), 'price_description', true))
		);		
	}
}

wp_reset_query();

echo json_encode(array(
	'start' => date('d.m.Y H:i:s', $start),
	'end' => date('d.m.Y H:i:s', $end),
	'timezone' => $timezone,
	'success' => 1, 
	'result' => $out
));

exit();