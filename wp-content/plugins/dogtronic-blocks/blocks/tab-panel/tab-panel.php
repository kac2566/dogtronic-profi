<?php
/**
 * Block Name: Tab Panel
 */

$id = 'dogtronic-tab-panel-' . $block['id'];

$className = 'dogtronic-tab-panel';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" role="tabpanel" hidden>
    <InnerBlocks />
</div>