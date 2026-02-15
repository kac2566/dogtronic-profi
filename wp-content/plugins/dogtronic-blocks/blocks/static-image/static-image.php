<?php
$image_desktop = get_field('image_desktop');
$image_mobile = get_field('image_mobile');
$image_contrast = get_field('image_contrast');
$size = get_field('image_size') ?: 'full';

if (!function_exists('dogtronic_get_image_url_by_size')) {
	function dogtronic_get_image_url_by_size($image_array, $size)
	{
		if (!$image_array || !is_array($image_array)) {
			return '';
		}
		if (isset($image_array['sizes'][$size])) {
			return $image_array['sizes'][$size];
		}
		return $image_array['url'];
	}
}

$url_desktop = dogtronic_get_image_url_by_size($image_desktop, $size);
$url_mobile = dogtronic_get_image_url_by_size($image_mobile, $size);
$url_contrast = dogtronic_get_image_url_by_size($image_contrast, $size);

$alt = !empty($image_desktop['alt']) ? $image_desktop['alt'] : (!empty($image_mobile['alt']) ? $image_mobile['alt'] : '');

$id = 'dogtronic-static-image-' . $block['id'];

$className = 'dogtronic-static-image';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

if ($image_desktop):
	?>
	<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
		<picture>
			<?php if ($url_contrast): ?>
				<source srcset="<?php echo esc_url($url_contrast); ?>" media="(prefers-contrast: more)">
			<?php endif; ?>

			<?php if ($url_mobile): ?>
				<source srcset="<?php echo esc_url($url_mobile); ?>" media="(max-width: 767px)">
			<?php endif; ?>

			<img src="<?php echo esc_url($url_desktop); ?>" alt="<?php echo esc_attr($alt); ?>">
		</picture>
	</div>
	<?php
else:
	?>
	<div class="dogtronic-block-placeholder">
		<p>Please select an image.</p>
	</div>
	<?php
endif;
