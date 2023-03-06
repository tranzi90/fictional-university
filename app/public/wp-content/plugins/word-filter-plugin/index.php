<?php

/*
  Plugin Name:   Word Filter plugin
  Description:   Replaces a list of words.
  Version:       1.0
  Author:        Den
  Author URI:    https://github.com/tranzi90
*/

if (!defined('ABSPATH')) exit;

class WordFilterPlugin {
	function __construct() {
		add_action('admin_menu', array($this, 'mainMenu'));
	}

	function mainMenu() {
		add_menu_page('Words To Filter',
			'Word Filter',
			'manage_options',
			'wordfilter',
			array($this, 'wordFilterPage'),
			'dashicons-smiley',
			100
		);

		add_submenu_page();
	}

	function wordFilterPage() {

	}
}

$wordFilterPlugin = new WordFilterPlugin();