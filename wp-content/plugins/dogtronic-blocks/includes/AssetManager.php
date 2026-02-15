<?php

namespace DogtronicBlocks;

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class AssetManager
 * Handles global assets.
 */
class AssetManager
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		add_action('enqueue_block_assets', [$this, 'enqueue_global_assets']);
	}

	/**
	 * Enqueue global assets
	 */
	public function enqueue_global_assets()
	{
		// Global JS
		if (file_exists(DOGTRONIC_BLOCKS_PATH . 'dist/assets/global.js')) {
			wp_enqueue_script(
				'dogtronic-blocks-global',
				DOGTRONIC_BLOCKS_URL . 'dist/assets/global.js',
				['wp-element', 'wp-i18n'],
				DOGTRONIC_BLOCKS_VERSION,
				true
			);
		}

		// Global CSS (if compiled via Webpack it might be in assets/global.css depending on config, 
		// but standard wp-scripts output CSS imported in JS to a separate file)
		if (file_exists(DOGTRONIC_BLOCKS_PATH . 'dist/assets/global.css')) {
			wp_enqueue_style(
				'dogtronic-blocks-global',
				DOGTRONIC_BLOCKS_URL . 'dist/assets/global.css',
				[],
				DOGTRONIC_BLOCKS_VERSION
			);
		}
	}
}
