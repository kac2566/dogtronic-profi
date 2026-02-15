<?php
/**
 * Dogtronic Theme functions and definitions
 *
 * @package Dogtronic
 */

namespace Dogtronic;

// Check for Composer Autoload
if (!file_exists(get_template_directory() . '/vendor/autoload.php')) {
	add_action('admin_notices', function () {
		echo '<div class="notice notice-error"><p>' . esc_html__('Dogtronic theme dependencies not found. Please run "composer install".', 'dogtronic') . '</p></div>';
	});

	add_action('wp_head', function () {
		echo '<div style="background: red; color: white; padding: 10px; text-align: center;">' . esc_html__('Dogtronic theme dependencies not found. Please run "composer install".', 'dogtronic') . '</div>';
	});
	return;
}

require_once get_template_directory() . '/vendor/autoload.php';

use Dogtronic\Setup\ThemeSetup;
use Dogtronic\Setup\Assets;
use Dogtronic\Setup\Patterns;
use Dogtronic\Setup\Blocks;
use Dogtronic\Ajax\ExampleAjax;

// Initialize Components
new ThemeSetup();
new Assets();
new Patterns();
new Blocks();
new ExampleAjax();
