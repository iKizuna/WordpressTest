<?php

//Includes
require get_theme_file_path('/inc/search-route.php'); //Custom REST API for search

//Function to create a new REST API record
function website_custom_rest(){
	register_rest_field('post', 'authorName', array(
		'get_callback' => function(){return get_the_author();}
	));
}

add_action('rest_api_init', 'website_custom_rest');

//The template of page banner
function pageBanner($args = NULL) { //NULL is used to make argue $args optional
	if(!$args['title']){
		$args['title'] = get_the_title();
	}
	if(!$args['subtitle']){
		$args['subtitle'] = get_field('page_banner_subtitle');
	}
	if(!$args['photo']){
		if(get_field('page_banner_background_image')){
			$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
		}else {
			$args['photo'] = get_theme_file_uri('/images/ocean.jpg');
		}
	}
	?>
	<div class="page-banner">
	    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
	    <div class="page-banner__content container container--narrow">
	      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
	      <div class="page-banner__intro">
	        <p><?php echo $args['subtitle'] ?></p>
	      </div>
	    </div>  
	</div>
	<?php
}
//There we adding outside scripts
function university_files() {
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyARo67NQNutt2nGqLN0Cc9XacJea5WRFT0', NULL, '1.0', true); //Google Map
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
  wp_localize_script('main-university-js', 'websiteRootURL', array(
  	'root_url' => get_site_url(),
  ));
}

//A function for printing a variables specifications
function vd($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

//This function automatically changing website title tag
function university_features(){
	register_nav_menu('headerMenuLocation', 'Header Menu Location');
	register_nav_menu('footerLocationOne', 'Footer Location One');
	register_nav_menu('footerLocationTwo', 'Footer Location Two');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails'); //its enabled a featured images for blog posts
	add_image_size('professorLandscape', 400, 260, true); //function to add a new images size
	add_image_size('professorPortrait', 480, 650, true);
	add_image_size('pageBanner', 1500, 350, true);
}

add_action('wp_enqueue_scripts', 'university_files');
add_action('after_setup_theme','university_features');

//Function to customise our queries
function university_adjust_queries($query){
	//Campuses
	if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query())
	{
		$query->set('posts_per_page', -1);
	}
	//Programs
	if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query())
	{
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	}
	// Function to separate past and future Events
	if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query())
	{
		$today = date('Ymd');
		
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array( //This query delete a past events
            	array(
            		'key' => 'event_date',
            		'compare' => '>=',
            		'value' => $today,
            		'type' => 'numeric'
            	)
            ));
	}
}
add_action('pre_get_posts','university_adjust_queries');

//A function with API key for Google Map projects
function googleMapKey($api){
	$api['key'] = 'AIzaSyARo67NQNutt2nGqLN0Cc9XacJea5WRFT0';
	return $api;
}

add_filter('acf/fields/google_map/api', 'googleMapKey');
?>