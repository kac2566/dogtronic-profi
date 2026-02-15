<?php
/**
 * Block Name: Tab Title
 */

$label = get_field('label') ?: 'Tab';
$id = 'dogtronic-tab-title-' . $block['id'];

$className = 'dogtronic-tab-title';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

?>
<button id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" type=" button" role="tab"
    aria-selected="false">
    <?php echo esc_html($label); ?>
</button>