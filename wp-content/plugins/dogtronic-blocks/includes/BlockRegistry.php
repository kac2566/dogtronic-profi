<?php

namespace DogtronicBlocks;

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class BlockRegistry
 * Handles automatic registration of blocks.
 */
class BlockRegistry
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		add_action('init', [$this, 'register_blocks']);
		add_filter('block_categories_all', [$this, 'register_categories'], 10, 2);
	}

	/**
	 * Register Block Categories
	 */
	public function register_categories($categories, $post)
	{
		return array_merge(
			$categories,
			[
				[
					'slug' => 'dogtronic-blocks-sections',
					'title' => __('SF Sections', 'dogtronic-blocks'),
				],
				[
					'slug' => 'dogtronic-blocks-ui',
					'title' => __('SF UI Elements', 'dogtronic-blocks'),
				],
			]
		);
	}

	/**
	 * Register all blocks found in blocks/ directory
	 */
	public function register_blocks()
	{
		$blocks_dir = DOGTRONIC_BLOCKS_PATH . 'blocks/';

		if (!is_dir($blocks_dir)) {
			return;
		}

		$blocks = array_diff(scandir($blocks_dir), ['..', '.']);

		foreach ($blocks as $block_slug) {
			$block_path = $blocks_dir . $block_slug;

			if (is_dir($block_path)) {
				$this->load_block($block_slug, $block_path);
			}
		}
	}

	/**
	 * Load a single block
	 *
	 * @param string $slug
	 * @param string $path
	 */
	private function load_block($slug, $path)
	{
		// 1. Load ACF Fields
		if (file_exists($path . '/configuration/fields.php')) {
			require_once $path . '/configuration/fields.php';
		}

		// 2. Load AJAX Handler (if exists)
		if (file_exists($path . '/configuration/ajax.php')) {
			require_once $path . '/configuration/ajax.php';
		}

		// 3. Register Block via register_block_type (reads block.json)
		if (file_exists($path . '/block.json')) {
			register_block_type($path);
		}
	}
}
