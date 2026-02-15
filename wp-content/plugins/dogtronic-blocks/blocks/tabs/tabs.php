<?php
/**
 * Block Name: Tabs Parent
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'dogtronic-tabs-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'dogtronic-block-tabs';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="dogtronic-tabs-container">
        <?php
        $allowed_blocks = array('dogtronic-blocks/tabs-header', 'dogtronic-blocks/tabs-content');
        $template = array(
            array('dogtronic-blocks/tabs-header', array()),
            array('dogtronic-blocks/tabs-content', array())
        );
        ?>
        <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>"
            template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
    </div>
</div>