<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes() {
	register_rest_route('university/v1', 'manageLike', array(
		'methods' => 'POST',
		'callback' => 'createLike'
	));

	register_rest_route('university/v1', 'manageLike', array(
		'methods' => 'DELETE',
		'callback' => 'deleteLike'
	));
}

function createLike($data) {
	wp_insert_post(array(
		'post_type' => 'like',
		'post_status' => 'publish',
		'meta_input' => array(
			'liked_professor_id' => sanitize_text_field($data['professorId'])
		)
	));
}

function deleteLike() {

}