<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch() {
	register_rest_route('university/v1', 'search', array(
		'methods' => WP_REST_SERVER::READABLE,
		'callback' => 'universitySearchResults'
	));
}

function universitySearchResults($data) {
	$searchQuery = new WP_Query(array(
		'post_type' => array('post', 'page', 'professor', 'program', 'event', 'campus'),
		's' => sanitize_text_field($data['term'])
	));

	$results = array(
		'generalInfo' => array(),
		'professors' => array(),
		'programs' => array(),
		'events' => array(),
		'campuses' => array()
	);

	return $results;
}