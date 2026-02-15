# Dogtronic WordPress Theme

Modern FSE (Full Site Editing) WordPress theme with modular architecture and Vite build system.

## Requirements
- WordPress 6.0+
- Node.js 16+
- PHP 7.4+

## Installation

1. Clone or extract the theme into `wp-content/themes/dogtronic`.
2. Install dependencies:
   ```bash
   npm install
   ```

## Development

To start the development server with Hot Module Replacement (HMR):
```bash
npm run dev
```
This will start Vite on `http://localhost:3000`. Ensure your WordPress checks for `VITE_DEV` or similar if you customize the environment detection (currently `Assets.php` checks simply for `is_vite_dev` logic which you might want to map to `WP_ENVIRONMENT_TYPE` = `local`).

## Production Build

To build assets for production:
```bash
npm run build
```
This will generate optimized CSS/JS in `dist/` directory.

## Structure

- `assets/`: Source SCSS and JS.
- `inc/`: PHP classes (Autoloaded).
- `patterns/`: Block patterns (nested structure supported).
- `parts/`: Template parts (header, footer).
- `templates/`: Page templates.
- `theme.json`: Global configuration.

## Features

- **Vite Integration**: Fast dev server and optimized builds.
- **SCSS**: Modular styles with abstracts.
- **Auto-registration**: Patterns in `patterns/` are automatically registered.
- **Block Styles**: Custom styles registered in `inc/setup/Blocks.php`.
