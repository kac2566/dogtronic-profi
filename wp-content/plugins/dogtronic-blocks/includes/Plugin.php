<?php

namespace DogtronicBlocks;

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class Plugin
 * Main plugin bootstrapper.
 */
class Plugin
{

	/**
	 * Instance
	 *
	 * @var Plugin
	 */
	private static $instance = null;

	/**
	 * Get Instance
	 *
	 * @return Plugin
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct()
	{
		$this->init_components();
	}

	/**
	 * Initialize components
	 */
	private function init_components()
	{
		// Initialize Assets
		new AssetManager();

		// Initialize Block Registry
		new BlockRegistry();

		// Initialize Helpers
		new Helpers();
	}
}
