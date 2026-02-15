<?php
/**
 * Theme Setup.
 *
 * @package Dogtronic
 */
namespace Dogtronic\Setup;
class ThemeSetup
{
	/**
	 * Construct.
	 */
	public function __construct()
	{
		add_action('after_setup_theme', [$this, 'setup']);
		add_filter('upload_mimes', [$this, 'add_svg_support']);
		add_filter('wp_check_filetype_and_ext', [$this, 'fix_svg_mime_type'], 10, 4);
	}
	/**
	 * Setup theme.
	 */
	public function setup()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');
		// Let WordPress manage the document title.
		add_theme_support('title-tag');
		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');
		// Add support for Block Styles.
		add_theme_support('wp-block-styles');
		// Add support for full and wide align images.
		add_theme_support('align-wide');
		// Add support for editor styles.
		add_theme_support('editor-styles');
		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');
		// Add support for menus
		add_theme_support('menus');
	}

	/**
	 * Add SVG to allowed upload mime types.
	 *
	 * @param array $mimes Allowed mime types.
	 * @return array
	 */
	public function add_svg_support($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Fix mime type for SVG files.
	 *
	 * @param array  $data File data.
	 * @param string $file File path.
	 * @param string $filename File name.
	 * @param array  $mimes Allowed mime types.
	 * @return array
	 */
	public function fix_svg_mime_type($data, $file, $filename, $mimes)
	{
		$ext = isset($data['ext']) ? $data['ext'] : '';
		if (strlen($ext) < 1) {
			$exploded = explode('.', $filename);
			$ext = strtolower(end($exploded));
		}
		if ($ext === 'svg') {
			$data['type'] = 'image/svg+xml';
			$data['ext'] = 'svg';
		} elseif ($ext === 'svgz') {
			$data['type'] = 'image/svg+xml';
			$data['ext'] = 'svgz';
		}
		return $data;
	}
}