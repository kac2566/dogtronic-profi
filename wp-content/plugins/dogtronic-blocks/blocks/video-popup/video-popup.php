<?php
/**
 * Block Name: Video Popup
 *
 * Description: A video block that opens in a global popup.
 */

$video_file = get_field('video_file');
$cover_image = get_field('cover_image');
$play_label = get_field('play_label') ?: 'Play Video';

$video_url = '';
if ($video_file && isset($video_file['url'])) {
    $video_url = $video_file['url'];
}

$className = 'dogtronic-video-popup-trigger';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$id = 'dogtronic-video-popup-' . $block['id'];

if ($video_url):
    ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"
        data-video-url="<?php echo esc_url($video_url); ?>" role="button" tabindex="0"
        aria-label="<?php echo esc_attr($play_label); ?>">
        <?php if ($cover_image): ?>
            <img src="<?php echo esc_url($cover_image['sizes']['large'] ?? $cover_image['url']); ?>"
                alt="<?php echo esc_attr($cover_image['alt']); ?>" class="dogtronic-video-popup-cover">
        <?php endif; ?>

        <div class="dogtronic-video-popup-play-button">
            <svg width="66" height="66" viewBox="19 19 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M19 51.5C19 33.5507 33.5507 19 51.5 19C69.4493 19 84 33.5507 84 51.5C84 69.4493 69.4493 84 51.5 84C33.5507 84 19 69.4493 19 51.5ZM65.7473 48.222C68.319 49.6508 68.319 53.3495 65.7473 54.7782L47.0712 65.1538C44.5717 66.5424 41.5 64.7351 41.5 61.8757V41.1245C41.5 38.2652 44.5717 36.4578 47.0712 37.8464L65.7473 48.222Z"
                        fill="#FAFAFB" />
                </g>
            </svg>


            <span class="screen-reader-text"><?php echo esc_html($play_label); ?></span>
        </div>
    </div>
    <?php
else:
    ?>
    <div class="dogtronic-block-placeholder">
        <p><?php esc_html_e('Please select a video file.', 'dogtronic-blocks'); ?></p>
    </div>
    <?php
endif;
