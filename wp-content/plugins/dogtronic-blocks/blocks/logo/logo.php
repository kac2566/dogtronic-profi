<?php
/**
 * Logo Block template.
 *
 * @param array $block The block settings and attributes.
 */

$logo = get_field('logo');
$width = get_field('width') ?: 252;
$height = get_field('height') ?: 60;
$logo_link_array = get_field('logo_link');
$link_title = get_field('link_title');
$aria_label = get_field('aria_label');

$link_url = !empty($logo_link_array['url']) ? $logo_link_array['url'] : home_url('/');

$link_target = !empty($logo_link_array['target']) ? 'target="' . esc_attr($logo_link_array['target']) . '" rel="noopener noreferrer"' : '';

$title_attribute = !empty($link_title) ? 'title="' . esc_attr($link_title) . '"' : 'title="Przejdź do strony głównej"';

$aria_label_value = !empty($aria_label) ? $aria_label : $link_title;
$aria_label_attribute = !empty($aria_label_value) ? 'aria-label="' . esc_attr($aria_label_value) . '"' : 'aria-label="Logo P4Health - Przejdź do strony głównej"';


// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'website-logo';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <a href="<?php echo esc_url($link_url); ?>" <?php echo $link_target; ?> <?php echo $title_attribute; ?> <?php echo $aria_label_attribute; ?>>
        <?php if (!empty($logo)): ?>
                <img 
                    src="<?php echo esc_url($logo['url']); ?>" 
                    alt="<?php echo esc_attr($logo['alt']); ?>" 
                    <?php if ($height)
                        echo 'height="' . esc_attr($height) . '"'; ?> 
                    <?php if ($width)
                        echo 'width="' . esc_attr($width) . '"'; ?> 
                />
        <?php else: ?>
                <img 
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" 
                    alt="Logo" 
                    <?php if ($height)
                        echo 'height="' . esc_attr($height) . '"'; ?> 
                    <?php if ($width)
                        echo 'width="' . esc_attr($width) . '"'; ?> 
                />
        <?php endif; ?>
    </a>
</div>