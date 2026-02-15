const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const glob = require('glob');

// Function to find all block entry points
const getBlockEntries = () => {
	const entries = {};

	// Find all index.js files in blocks folders
	// Pattern: blocks/{block-name}/assets/index.js
	const blockFiles = glob.sync('./blocks/*/assets/index.js');

	blockFiles.forEach((filepath) => {
		// Normalize path separators to forward slashes for consistency
		const normalizedPath = filepath.replace(/\\/g, '/');

		// Extract block name. We expect: .../blocks/{blockName}/assets/index.js
		// We can split by 'blocks/' and take the part immediately after
		const pathParts = normalizedPath.split('blocks/');
		if (pathParts.length < 2) return;

		const blockPart = pathParts[1]; // counter/assets/index.js
		const blockName = blockPart.split('/')[0]; // counter

		// Ensure path starts with ./ so Webpack treats it as relative file, not module
		// Use the original filepath but ensure relative prefix
		const relativePath = filepath.startsWith('./') || filepath.startsWith('.\\') ? filepath : `./${filepath}`;

		entries[`blocks/${blockName}/index`] = relativePath;
	});

	// Global assets
	// Check if global JS exists
	const globalJs = glob.sync('./assets/js/global.js');
	if (globalJs.length > 0) {
		entries['assets/global'] = './assets/js/global.js';
	}

	// Check if global SCSS exists (we usually import it in JS, but if standalone is needed)
	// For WordPress scripts, it's often better to import SCSS in the JS file.
	// We will assume style.scss in blocks is imported by index.js

	return entries;
};

module.exports = {
	...defaultConfig,
	entry: getBlockEntries(),
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'dist'),
		filename: '[name].js', // This will result in blocks/counter/index.js
	},
	// Ensure we process SCSS
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
		],
	},
};
