<?php
function university_post_types(){
	register_post_type('event', array(
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'events'),
		'has_archive' => true, //it makes that when we will go to http://localhost:3000/event then we will see an archive of events
		'public' => true, //it makes function visible in admin board 
		'labels' => array(
			'name' => 'Events',
			'add_new_item' => 'Add New Event',
			'edit_item' => "Edit Event",
			'all_items' => "All Events",
			'singular_name' => 'Event'
		 ),
		'menu_icon' => 'dashicons-calendar'
	));
}

add_action('init', 'university_post_types'); // Initialize function university_post_types()
?>