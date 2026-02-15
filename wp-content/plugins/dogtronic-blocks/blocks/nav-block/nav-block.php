<?php
/**
 * Plik szablonu dla bloku Nawigacji z Mega Menu i pełnym wsparciem WCAG.
 *
 * @param array $block Blok z jego ustawieniami i atrybutami.
 */

\defined('ABSPATH') || exit('File cannot be opened directly!');

if (!function_exists('get_field')) {
    if (is_admin()) {
        echo '<p><strong>Blok Nawigacji:</strong> Wtyczka Advanced Custom Fields (ACF) jest wymagana do działania tego bloku.</p>';
    }
    return;
}

$anchor = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';
$base_class = 'navigation-block';
$class_name = $base_class;
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$selected_menu_id = get_field('select_menu');
$menu_title = get_field('section_title');
$layout_orientation = get_field('orientation') ?: 'horizontal';
$layout_align = get_field('alignment') ?: 'flex-start';
$is_collapsible_on_mobile = get_field('menu_is_expanded');

$enable_mega_menu_globally = get_field('enable_add_mega_menu', 'option');

if (!class_exists('Navigation_Block_Walker_Nav_Menu')) {
    /**
     * Zaawansowana klasa Walker do renderowania menu zgodnego z WCAG.
     */
    class Navigation_Block_Walker_Nav_Menu extends Walker_Nav_Menu
    {
        private $is_mega_menu_enabled;

        public function __construct($is_mega_menu_enabled = false)
        {
            $this->is_mega_menu_enabled = $is_mega_menu_enabled;
        }

        public function start_lvl(&$output, $depth = 0, $args = null)
        {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }

        public function end_lvl(&$output, $depth = 0, $args = null)
        {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
        {
            $item_classes = empty($item->classes) ? [] : (array) $item->classes;
            $has_children = in_array('menu-item-has-children', $item_classes);
            $mega_menu_id = $this->is_mega_menu_enabled ? get_post_meta($item->ID, '_menu_item_mega_menu_id', true) : null;
            $has_mega_menu = !empty($mega_menu_id);

            if ($has_mega_menu) {
                $item_classes[] = 'has-mega-menu';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($item_classes), $item, $args, $depth));
            $output .= '<li class="' . esc_attr($class_names) . '">';

            $atts = [
                'title' => !empty($item->attr_title) ? $item->attr_title : '',
                'target' => !empty($item->target) ? $item->target : '',
                'rel' => !empty($item->xfn) ? $item->xfn : '',
                'href' => !empty($item->url) ? $item->url : '#',
            ];
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . esc_html($item->title) . $args->link_after;

            if (!empty($item->description)) {
                $item_output .= '<span class="menu-item-description">' . esc_html($item->description) . '</span>';
            }

            $item_output .= '</a>';
            $item_output .= $args->after;

            if ($has_children || $has_mega_menu) {
                $item_output = str_replace('<a', '<a aria-haspopup="true" aria-expanded="false"', $item_output);
                $toggle_label = sprintf(esc_html__('Rozwiń podmenu dla %s', 'sygnisoft'), $item->title);
                $item_output .= '<button class="submenu-toggle" aria-label="' . $toggle_label . '" aria-expanded="false">';
                $item_output .= '<span class="submenu-toggle-icon" aria-hidden="true"></span>';
                $item_output .= '</button>';
            }

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

            if ($has_mega_menu) {
                $mega_menu_post = get_post($mega_menu_id);
                if ($mega_menu_post) {
                    $output .= '<div class="mega-menu-container">';
                    $output .= '<div class="mega-menu-content">';

                    $output .= '<div class="mega-menu-header">';
                    $output .= '<button class="mega-menu-back-button">';
                    $output .= esc_html__('Do menu głównego', 'sygnisoft');
                    $output .= '</button>';

                    $output .= '<button class="mega-menu-header__close" aria-label="Close menu">';
                    $output .= '<span class="close-icon"><span></span><span></span></span>';
                    $output .= '</button>';

                    $output .= '</div>';

                    $output .= apply_filters('the_content', $mega_menu_post->post_content);

                    $output .= '</div>';
                    $output .= '</div>';
                }


            }
        }

        public function end_el(&$output, $item, $depth = 0, $args = null)
        {
            $output .= "</li>\n";
        }
    }
}
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'navigation-block']); ?>>

    <?php if ($menu_title && $is_collapsible_on_mobile): ?>
        <button class="navigation-block__trigger" aria-expanded="false"
            aria-controls="nav-<?php echo esc_attr($block['id']); ?>">
            <span class="navigation-block__trigger-label"><?php echo esc_html($menu_title); ?></span>
            <span class="navigation-block__trigger-icon"></span>
        </button>
    <?php elseif ($menu_title): ?>
        <div class="navigation-block__title"><?php echo esc_html($menu_title); ?></div>
    <?php endif; ?>

    <?php
    if ($selected_menu_id) {
        $nav_classes = 'navigation-block__nav';
        if ($is_collapsible_on_mobile) {
            $nav_classes .= ' is-collapsible';
        }

        echo '<nav id="nav-' . esc_attr($block['id']) . '" class="' . $nav_classes . '" aria-label="' . esc_attr($menu_title ?: 'Nawigacja') . '">';

        wp_nav_menu([
            'menu' => $selected_menu_id,
            'container' => '',
            'menu_class' => 'navigation-block__nav-elements ' . esc_attr($layout_orientation) . ' ' . esc_attr($layout_align),
            'walker' => new Navigation_Block_Walker_Nav_Menu($enable_mega_menu_globally),
            'depth' => 4,
            'fallback_cb' => false,
        ]);

        echo '</nav>';

    } elseif (is_admin() || current_user_can('edit_theme_options')) {
        echo '<p>Proszę wybrać menu w ustawieniach tego bloku.</p>';
    }
    ?>
</div>