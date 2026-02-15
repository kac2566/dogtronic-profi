<?php
/**
 * Block Styles and Variations.
 *
 * @package Dogtronic
 */
namespace Dogtronic\Setup;

class Blocks
{
	/**
	 * Construct.
	 */
	public function __construct()
	{
		add_action('init', [$this, 'register_block_styles']);
	}

	/**
	 * Register Custom Block Styles.
	 */
	public function register_block_styles()
	{
		$block_styles = [
			'core/button' => [
				[
					'name' => 'primary',
					'label' => __('Primary', 'dogtronic'),
				],
			],
			'core/paragraph' => [
				[
					'name' => 'highlight',
					'label' => __('Highlight', 'dogtronic'),
				],
				[
					'name' => 'max-864',
					'label' => __('Width Max 864px', 'dogtronic'),
				],
				[
					'name' => 'icon-and-text',
					'label' => __('Text with icon', 'dogtronic'),
				],
			],
			'core/heading' => [
				[
					'name' => 'max-640',
					'label' => __('Width Max 640px', 'dogtronic'),
				],
				[
					'name' => 'max-1000',
					'label' => __('Width Max 1000px', 'dogtronic'),
				],
				[
					'name' => 'video-title',
					'label' => __('Video Title', 'dogtronic'),
				],
			],
			'core/group' => [
				[
					'name' => 'icon-box',
					'label' => __('Icon Box', 'dogtronic'),
				],
				[
					'name' => 'max-250',
					'label' => __('Width Max 250px', 'dogtronic'),
				],
			],
			'dogtronic-blocks/static-image' => [
				[
					'name' => 'max-1440',
					'label' => __('Max Width - 1440px', 'dogtronic'),
				],
			],
		];

		foreach ($block_styles as $block_name => $styles) {
			foreach ($styles as $style) {
				register_block_style($block_name, $style);
			}
		}
	}
}