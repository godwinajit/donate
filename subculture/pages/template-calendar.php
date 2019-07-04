<?php

/*
Template Name: Calendar Template
*/

if (isset($_GET['json'])) {
	get_template_part('blocks/events/events-calendar', 'json');
}

wp_enqueue_style('subculture-calendar', get_template_directory_uri().'/calendar/css/calendar.css', array('subculture-bootstrap'));
wp_enqueue_style('subculture-calendar-custom', get_template_directory_uri().'/calendar/css/calendar-custom.css', array('subculture-calendar'));


wp_enqueue_script('subculture-calendar-underscore', get_template_directory_uri().'/calendar/components/underscore/underscore-min.js', array('jquery'));
wp_enqueue_script('subculture-calendar-jstimezonedetect', get_template_directory_uri().'/calendar/components/jstimezonedetect/jstz.min.js', array('jquery'));
wp_enqueue_script('subculture-calendar-lib', get_template_directory_uri().'/calendar/js/calendar.js', array('jquery', 'subculture-bootstrap', 'subculture-calendar-jstimezonedetect', 'subculture-calendar-underscore', 'subculture-main'));
wp_enqueue_script('subculture-calendar-app', get_template_directory_uri().'/calendar/js/app.js', array('subculture-calendar-lib'));

function theme_calendar_header_scripts(){
?>
<script type="text/javascript">
    var eventsCalendarSettings = {
        base: '<?php echo get_template_directory_uri(); ?>/calendar/',
        json: '<?php echo add_query_arg('json', 1); ?>',
    }
</script>
<?
}
add_action('wp_head', 'theme_calendar_header_scripts', 1);


get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
	<?php get_template_part('blocks/events/filters') ?>

    <div class="container">
		<div class="calendar-heading">
			<button class="btn-prev" data-calendar-nav="prev">Prev</button>
			<button class="btn-next" data-calendar-nav="next">Next</button>
			<h3></h3>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="calendar"></div>
			</div>
		</div>
    </div>
</div>

<?php get_footer(); ?>