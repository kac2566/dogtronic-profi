# Dogtronic-Blocks Plugin

A modular system for Gutenberg blocks based on ACF & React.

## 📦 Features
- **Modular Architecture**: Each block is isolated in `blocks/{name}`.
- **Automated Build**: Webpack builds each block individually.
- **ACF Integration**: Automatic loading of fields and render templates.
- **Global Assets**: Shared JS/SCSS support.

## 🚀 Installation

1. Clone repo to `wp-content/plugins/dogtronic-blocks`.
2. Run `composer install` to install PHP dependencies.
3. Run `npm install` to install JS dependencies.
4. Run `npm run build` to compile assets.
5. Activate plugin in WordPress.

## 🛠 Development

### Creating a new block
1. Create a folder `blocks/my-block/`.
2. Add `block.json` (copy from `blocks/counter/block.json` and modify).
3. Add `assets/index.js` and `assets/style.scss`.
4. Add `configuration/fields.php` for ACF config.
5. Add `my-block.php` for PHP rendering.

### Commands
- `npm run watch`: Start development server (watch mode).
- `npm run build`: Build production assets.

## 📂 Structure
```
/blocks/{block-name}/
├── assets/
│   ├── style.scss
│   └── index.js
├── configuration/
│   ├── fields.php
│   └── ajax.php
├── block.json
├── {block-name}.php
```
