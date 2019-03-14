<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch(){
	register_rest_route('university/v1', 'search', array(
		'methods' => WP_REST_SERVER::READABLE, //Create, Read, Update or Delete
		'callback' => 'universitySearchResults'
	));
}

function universitySearchResults($data){
	$mainQuery = new WP_Query(array(
		'post_type' => array('campus','event', 'page', 'post', 'professor', 'program'),
		's' => sanitize_text_field($data['term'])
	));

	$results = array( //We dont need to add post and pages
		'generalInfo' => array(),
		'campuses' => array(),
		'events' => array(),
		'professors' => array(),
		'programs' => array(),
	);

	while($mainQuery->have_posts()){
		$mainQuery->the_post();

		if(get_post_type() == 'post' OR get_post_type() == 'page'){
		array_push($results['generalInfo'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'postType' => get_post_type(),
			'authorName' => get_the_author()
		));
		}

		if(get_post_type() == 'campus'){
		array_push($results['campuses'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink()
		));
		}

		if(get_post_type() == 'event'){
			// Get RAW date
		    $eventDate = get_field( 'event_date', false, false );
		    // THEN create object
		    $eventDate = new DateTime( $eventDate );
		    $description = null;
		    //Function to displaying the contents of events
		    if(has_excerpt()){
		      $description = get_the_excerpt();
		    }else {
		      $description = wp_trim_words(get_the_content(), 18);
		    }

			array_push($results['events'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'month' => $eventDate->format( 'M' ),
				'day' => $eventDate->format( 'd' ),
				'description' => $description
			));
		}

		if(get_post_type() == 'professor'){
		array_push($results['professors'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
		));
		}

		if(get_post_type() == 'program'){
			$relatedCampuses = get_field('related_campus');

			if($relatedCampuses){
				foreach($relatedCampuses as $campus){
					array_push($results['campuses'], array(
						'title' => get_the_title($campus),
						'permalink' => get_the_permalink($campus)
					));
				}
			}

		array_push($results['programs'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'id' => get_the_id()
		));
		}
	}

	if($results['programs']){
	//Function to create a multiple filters 
		$programsMetaQuery = array('relation' => 'OR');

		foreach($results['programs'] as $item){
			array_push($programsMetaQuery, array(
					'key' => 'related_programs',
					'compare' => 'LIKE',
					'value' => '"' . $item['id'] . ''
				));
		}

		$programRelationshipQuery = new WP_Query(array(
			'post_type' => array('professor', 'event'),
			'meta_query' => $programsMetaQuery
		));

	//Searching relationships code
		while($programRelationshipQuery->have_posts()){
			$programRelationshipQuery->the_post();

			if(get_post_type() == 'event'){
				// Get RAW date
			    $eventDate = get_field( 'event_date', false, false );
			    // THEN create object
			    $eventDate = new DateTime( $eventDate );
			    $description = null;
			    //Function to displaying the contents of events
			    if(has_excerpt()){
			      $description = get_the_excerpt();
			    }else {
			      $description = wp_trim_words(get_the_content(), 18);
			    }

				array_push($results['events'], array(
					'title' => get_the_title(),
					'permalink' => get_the_permalink(),
					'month' => $eventDate->format( 'M' ),
					'day' => $eventDate->format( 'd' ),
					'description' => $description
				));
			}

			if(get_post_type() == 'professor'){
			array_push($results['professors'], array(
				'title' => get_the_title(),
				'permalink' => get_the_permalink(),
				'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
			));
			}
		}

		$results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
		$results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));

	}

	// return $professors->posts; //It return the whole data

	return $results;
}