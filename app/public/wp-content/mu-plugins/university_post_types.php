<?php

function university_post_types() {

	register_post_type('campus', array(
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'campuses'),
		'has_archive' => true,
		'public' => true,
		'labels' => array(
			'name' => 'Campuses',
			'singular_name' => 'Campus',
			'add_new_item' => 'Add New Campus',
			'edit_item' => 'Edit Campus',
			'all_items' => 'All campuses'
		),
		'menu_icon' => 'dashicons-building'
	));

    register_post_type('event', array(
		'capability_type' => 'event',
		'map_meta_cap' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'singular_name' => 'Event',
            'add_new_item' => 'Future event',
            'edit_item' => 'Change event',
            'all_items' => 'All events'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    register_post_type('program', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'singular_name' => 'Program',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));

    register_post_type('professor', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'singular_name' => 'Professor',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors'
        ),
        'menu_icon' => 'dashicons-businessperson'
    ));
}

add_action('init', 'university_post_types');