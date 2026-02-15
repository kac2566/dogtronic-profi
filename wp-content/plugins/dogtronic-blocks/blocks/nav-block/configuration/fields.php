<?php
/**
 * ACF Fields for Nav Block
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
use DogtronicBlocks\Helpers;

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group(array(
    'key' => 'nav-block',
    'title' => 'Bloczek - Nawigacji',
    'fields' => array(
        array(
            'key' => 'select_menu_field',
            'label' => 'Wybierz menu',
            'name' => 'select_menu',
            'type' => 'select',
            'instructions' => 'Wybierz jedno ze zdefiniowanych menu. Jeśli chcesz edytować lub utworzyć nowe menu, przejdź na stronę
                    <a href="' . \admin_url('nav-menus.php') . '" target="_blank">Wygląd -> Menu</a>',
            'choices' => Helpers::getMenusList(),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'value',
            'ui' => 1,
        ),
        array(
            'key' => 'panel_accordion',
            'label' => 'Display',
            'name' => '',
            'type' => 'accordion',
            'open' => 0,
        ),
        array(
            'key' => 'orientation_field',
            'label' => 'Orientacja',
            'name' => 'orientation',
            'type' => 'button_group',
            'choices' => [
                'horizontal' => '<i class="dashicons dashicons-image-flip-horizontal"></i>',
                'vertical' => '<i class="dashicons dashicons-image-flip-vertical"></i>',
            ],
            'layout' => 'horizontal',
            'return_format' => 'value',
            'required' => 0,
            'conditional_logic' => 0,
            'default_value' => 'horizontal',
        ),
        array(
            'key' => 'alignment_field',
            'label' => 'Ułożenie',
            'name' => 'alignment',
            'type' => 'button_group',
            'choices' => [
                'left' => 'Od lewej',
                'center' => 'Na środku',
                'right' => 'Od prawej',
            ],
            'layout' => 'horizontal',
            'return_format' => 'value',
            'required' => 0,
            'conditional_logic' => 0,
            'default_value' => 'left',
        ),
        array(
            'key' => 'menu_is_title_enable',
            'label' => 'Czy włączyć tytuł sekcji?',
            'name' => 'menu_is_title_enable',
            'instructions' => 'Jeśli tytuł sekcji jest pusty, to nie wyświetli się żaden tytuł',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => 'Tak',
            'ui_off_text' => 'Nie',
        ),
        array(
            'key' => 'menu_title',
            'label' => 'Tytuł sekcji',
            'name' => 'section_title',
            'instructions' => 'Wpisz tytuł nawigacji np. Menu, Programy. Jeśli pole będzie puste, nie wyświetli się zaden tytuł',
            'type' => 'text',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'menu_is_title_enable',
                        'operator' => '==',
                        'value' => 1,
                    ),
                ),
            ),
        ),
        array(
            'key' => 'menu_is_expanded_field',
            'label' => 'Czy to menu jest rozwijane za pomocą tytułu sekcji?',
            'name' => 'menu_is_expanded',
            'type' => 'true_false',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => 'Tak',
            'ui_off_text' => 'Nie',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'menu_is_title_enable',
                        'operator' => '==',
                        'value' => 1,
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'dogtronic/nav-block',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
));