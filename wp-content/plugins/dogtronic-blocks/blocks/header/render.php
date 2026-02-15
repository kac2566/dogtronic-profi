<?php
$id = 'sf-header-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'sf-header';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$sticky = get_field('sticky');
if ($sticky) {
    $className .= ' is-sticky';
}

// Capture InnerBlocks content once
ob_start();
?>
<InnerBlocks />
<?php
$inner_blocks_content = ob_get_clean();
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="sf-header__container">
        <!-- Desktop Navigation -->
        <nav class="sf-header__nav-desktop" aria-label="<?php esc_attr_e('Main Navigation', 'sf-blocks'); ?>">
            <?php echo $inner_blocks_content; ?>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button class="sf-header__mobile-toggle js-header-toggle" aria-expanded="false"
            aria-controls="sf-header-mobile-menu">
            <span class="screen-reader-text"><?php esc_html_e('Toggle Menu', 'sf-blocks'); ?></span>
            <span class="sf-header__toggle-icon"></span>
        </button>
    </div>

    <!-- Mobile Menu Drawer -->
    <div id="sf-header-mobile-menu" class="sf-header__nav-mobile js-header-mobile-menu" aria-hidden="true">
        <div class="sf-header__nav-mobile-inner">
            <div class="sf-header__nav-mobile-content">
                <?php echo $inner_blocks_content; ?>
            </div>
        </div>
    </div>
</div>