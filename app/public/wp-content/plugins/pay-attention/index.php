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
		add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));

	}

    function adminAssets() {
        wp_enqueue_script('newblocktype', plugin_dir_url(__FILE__) . 'test.js', array('wp-blocks', 'wp-element'));
    }

}

$payingAttention = new PayingAttention();