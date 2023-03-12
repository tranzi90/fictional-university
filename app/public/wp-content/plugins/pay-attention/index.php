<?php

/*
  Plugin Name:   Paying Attention Quiz
  Description:   Give your readers a multiple choice question.
  Version:       1.0
  Author:        Den
  Author URI:    https://github.com/tranzi90
*/

if (!defined('ABSPATH')) exit;

class PayingAttention {
	function __construct() {
		add_action('init', array($this, 'adminAssets'));

	}

    function adminAssets() {
	    wp_register_style('quizeditcss',
		    plugin_dir_url(__FILE__) . 'build/index.css'
	    );

        wp_register_script('newblocktype',
	        plugin_dir_url(__FILE__) . 'build/index.js',
	        array('wp-blocks', 'wp-element', 'wp-editor')
        );

		register_block_type('plugin/are-you-paying-attention', array(
			'editor_script' => 'newblocktype',
			'editor_style' => 'quizeditcss',
			'render_callback' => array($this, 'theHTML')
		));
    }

	function theHTML($attributes) {

	}
}

$payingAttention = new PayingAttention();