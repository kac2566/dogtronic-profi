<?php
/**
 * Block Name: Tabs Content
 */

$className = 'dogtronic-tabs-content';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$allowed_blocks = ['dogtronic-blocks/tab-panel'];
?>
<div class="<?php echo esc_attr($className); ?>">
    <InnerBlocks />
</div>