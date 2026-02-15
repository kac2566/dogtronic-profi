<?php
namespace Dogtronic\Setup;

class Assets
{
	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
		add_action('enqueue_block_editor_assets', [$this, 'enqueue_assets']);
		add_filter('script_loader_tag', [$this, 'add_module_type'], 10, 3);
	}

	/**
	 * Główne ładowanie assetów (front + editor)
	 */
	public function enqueue_assets()
	{
		if ($this->is_vite_dev()) {
			$this->enqueue_dev_assets();
		} else {
			$this->enqueue_production_assets();
		}
		$this->enqueue_fontello();
	}

	/**
	 * DEV MODE (Vite)
	 */
	private function enqueue_dev_assets()
	{
		// Klient HMR - MUSI być jako pierwszy
		wp_enqueue_script(
			'dogtronic-vite-client',
			'http://localhost:5050/@vite/client',
			[],
			null,
			false // w head!
		);

		// Główny entry - importuje wszystkie CSS i JS
		wp_enqueue_script(
			'dogtronic-main',
			'http://localhost:5050/assets/js/.dev-entry.js',
			['dogtronic-vite-client'],
			null,
			false // w head dla lepszego HMR
		);
	}

	/**
	 * PRODUCTION MODE
	 */
	private function enqueue_production_assets()
	{
		$manifest = $this->get_manifest();
		if (empty($manifest)) {
			return;
		}

		foreach ($manifest as $src => $asset) {
			$handle = 'dogtronic-' . md5($src);

			// JS
			if (!empty($asset['file']) && str_ends_with($asset['file'], '.js')) {
				wp_enqueue_script(
					$handle,
					get_template_directory_uri() . '/dist/' . $asset['file'],
					[],
					null,
					true
				);
			}

			// CSS (główny plik)
			if (!empty($asset['file']) && str_ends_with($asset['file'], '.css')) {
				wp_enqueue_style(
					$handle,
					get_template_directory_uri() . '/dist/' . $asset['file'],
					[],
					null
				);
			}

			// CSS z manifestu (importowane pliki)
			if (!empty($asset['css']) && is_array($asset['css'])) {
				foreach ($asset['css'] as $index => $css_file) {
					wp_enqueue_style(
						$handle . '-' . $index,
						get_template_directory_uri() . '/dist/' . $css_file,
						[],
						null
					);
				}
			}
		}
	}

	/**
	 * Automatyczne type="module" dla Vite
	 */
	public function add_module_type($tag, $handle, $src)
	{
		if (str_contains($handle, 'dogtronic') && str_contains($tag, '<script')) {
			// Dodaj crossorigin dla lepszej kompatybilności z Vite
			$tag = str_replace('<script', '<script type="module" crossorigin', $tag);
			$tag = str_replace(' src=', ' src=', $tag);
			// Usuń domyślny src i dodaj własny
			preg_match('/src=["\']([^"\']+)["\']/', $tag, $matches);
			if (!empty($matches[1])) {
				return '<script type="module" crossorigin src="' . esc_url($matches[1]) . '"></script>';
			}
		}
		return $tag;
	}

	private function enqueue_fontello()
	{
		wp_enqueue_style(
			'dogtronic-fontello',
			get_template_directory_uri() . '/assets/fontello/css/fontello.css',
			[],
			'1.0.0'
		);
	}

	private function is_vite_dev()
	{
		return defined('WP_DEBUG') && WP_DEBUG;
	}

	private function get_manifest()
	{
		$manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
		if (!file_exists($manifest_path)) {
			return [];
		}
		return json_decode(file_get_contents($manifest_path), true) ?: [];
	}
}