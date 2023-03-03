<?php
/*
  Plugin Name:   My plugin
  Description:   test Description
  Version:       1.0
  Author:        Den
  Author URI:    https://github.com/tranzi90
*/

class WordCountAndTimePlugin {
	function __construct() {
		add_action('admin_menu', array($this, 'adminPage'));
	}

	function adminPage() {
		add_options_page('Word Count Settings',
			'Word Count',
			'manage_options',
			'word-count-settings',
			array($this, 'pageHTML'));
	}

	function pageHTML() {

	}
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();



