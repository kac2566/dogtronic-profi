<?php
/**
 * Plugin Name: Dogtronic-Blocks
 * Description: A modular system for Gutenberg blocks based on ACF.
 * Version: 0.0.1
 * Author: Kacper Powalka
 * Text Domain: dogtronic-blocks
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
	exit;
}

// Define Constants
define('DOGTRONIC_BLOCKS_PATH', plugin_dir_path(__FILE__));
define('DOGTRONIC_BLOCKS_URL', plugin_dir_url(__FILE__));
define('DOGTRONIC_BLOCKS_VERSION', '1.0.0');

// Autoload (Composer)
if (file_exists(DOGTRONIC_BLOCKS_PATH . 'vendor/autoload.php')) {
	require_once DOGTRONIC_BLOCKS_PATH . 'vendor/autoload.php';
}

/**
 * Main Plugin Class Wrapper
 */
function DOGTRONIC_BLOCKS_init()
{
	if (class_exists('DogtronicBlocks\Plugin')) {
		DogtronicBlocks\Plugin::get_instance();
	}
}
add_action('plugins_loaded', 'DOGTRONIC_BLOCKS_init');

/**
 * Render Global Video Popup Modal in Footer
 */
function dogtronic_blocks_render_video_popup()
{
	?>
	<div id="dogtronic-video-popup-modal" class="dogtronic-video-popup-modal" aria-hidden="true">
		<div class="dogtronic-video-popup-content">
			<button type="button" class="dogtronic-video-popup-close"
				aria-label="<?php esc_attr_e('Close', 'dogtronic-blocks'); ?>">&times;</button>
			<video class="dogtronic-video-popup-video" controls playsinline>
				<source src="" type="video/mp4">
				<?php esc_html_e('Your browser does not support the video tag.', 'dogtronic-blocks'); ?>
			</video>
		</div>
	</div>
	<?php
}
add_action('wp_footer', 'dogtronic_blocks_render_video_popup');

