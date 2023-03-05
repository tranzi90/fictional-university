<?php
/*
  Plugin Name:   My plugin
  Description:   test Description
  Version:       1.0
  Author:        Den
  Author URI:    https://github.com/tranzi90
  Text Domain: wcpdomain
  Domain Path: /languages
*/

class WordCountAndTimePlugin {
	function __construct() {
		add_action('admin_menu', array($this, 'adminPage'));
		add_action('admin_init', array($this, 'settings'));
		add_filter('the_content', array($this, 'ifWrap'));
	}

    function ifWrap($content) {
        if (is_main_query() and is_single() and
            (
                    get_option('wcp_wordcount', '1') or
                    get_option('wcp_charcount', '1') or
                    get_option('wcp_readtime', '1')
            )) {
            return $this->createHTML($content);
        }
        return $content;
    }

	function settings() {
		add_settings_section('wcp_first_section', null, null, 'word-count-settings');

		add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

		add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistic'));

		add_settings_field('wcp_wordcount', 'Word Count', array($this, 'wordcountHTML'), 'word-count-settings', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('wcp_charcount', 'Character Count', array($this, 'charcountHTML'), 'word-count-settings', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_charcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('wcp_readtime', 'Read Time', array($this, 'readtimeHTML'), 'word-count-settings', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
	}

    function sanitizeLocation($input) {
        if ($input !== '0' and $input !== '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Wrong location');
            return get_option('wcp_location');
        }
        return $input;
    }

	function readtimeHTML() { ?>
        <input type="checkbox" name="wcp_readtime" value="1" <?php checked(get_option('wcp_readtime'), '1') ?>>
	<?php }

	function charcountHTML() { ?>
        <input type="checkbox" name="wcp_charcount" value="1" <?php checked(get_option('wcp_charcount'), '1') ?>>
	<?php }

	function wordcountHTML() { ?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
	<?php }

	function headlineHTML() { ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')) ?>">
	<?php }

	function locationHTML() { ?>
		<select name="wcp_location">
			<option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
			<option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of post</option>
		</select>
<?php }

	function adminPage() {
		add_options_page('Word Count Settings',
			 __('Word Count', 'wcpdomain'),
			'manage_options',
			'word-count-settings',
			array($this, 'pageHTML'));
	}

	function pageHTML() { ?>
		<div class="wrap">
			<h1>Word Count Settings</h1>
			<form action="options.php" method="post">
				<?php
                    settings_fields('wordcountplugin');
					do_settings_sections('word-count-settings');
					submit_button();
				?>
			</form>
		</div>
<?php }

        function createHTML( $content ) {
            $headline = esc_html(get_option('wcp_headline', 'Post Stats'));
            $html = "<h3>$headline</h3>";
            $info = __('This post has', 'wcpdomain');

            if (get_option('wcp_wordcount', '1') or get_option('wcp_readtime', '1'))
                $wordCount = str_word_count(strip_tags($content));

	        if (get_option('wcp_wordcount', '1')) {
		        $words = __('words', 'wcpdomain');
		        $html .= "<p>$info $wordCount $words.</p>";
	        }

	        if (get_option('wcp_charcount', '1')) {
                $chars = strlen(strip_tags($content));
		        $html .= "<p>This post has $chars characters.</p>";
	        }

	        if (get_option('wcp_readtime', '1')) {
                $readtime = round($wordCount/225) ;
		        $html .= "<p>This post will take about $readtime minutes to read.</p>";
	        }

            if (get_option('wcp_location', '0') === '0') {
                return $html . $content;
            }
            return $content . $html;
        }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();



