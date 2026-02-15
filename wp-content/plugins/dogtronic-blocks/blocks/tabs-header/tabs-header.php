<?php
/**
 * Block Name: Tabs Header
 */

$className = 'dogtronic-tabs-header';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$allowed_blocks = ['dogtronic-blocks/tab-title'];
?>
<div class="<?php echo esc_attr($className); ?>">
    <InnerBlocks allowedBlocks="<?php echo esc_attr(json_encode($allowed_blocks)); ?>" />
</div>