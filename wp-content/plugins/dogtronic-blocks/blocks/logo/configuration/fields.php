<?php
/**
 * ACF Fields for Logo Block
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_logo_block',
        'title' => 'Ustawienia Bloku Logo',
        'fields' => array(
            array(
                'key' => 'field_logo_image',
                'label' => 'Plik z logiem',
                'name' => 'logo',
                'type' => 'image',
                'instructions' => 'Wybierz plik z logiem. Jeśli pozostawisz puste, użyte zostanie domyślne logo z motywu.',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ),
            array(
                'key' => 'field_logo_width',
                'label' => 'Szerokość logo',
                'name' => 'width',
                'type' => 'number',
                'instructions' => 'Podaj szerokość w pikselach (opcjonalne).',
                'placeholder' => '150',
            ),
            array(
                'key' => 'field_logo_height',
                'label' => 'Wysokość logo',
                'name' => 'height',
                'type' => 'number',
                'instructions' => 'Podaj wysokość w pikselach (opcjonalne).',
            ),
            array(
                'key' => 'field_logo_link',
                'label' => 'Link loga',
                'name' => 'logo_link',
                'type' => 'link',
                'instructions' => 'Wybierz, dokąd ma prowadzić logo po kliknięciu. Domyślnie prowadzi do strony głównej.',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_logo_link_title',
                'label' => 'Tytuł linku (atrybut title)',
                'name' => 'link_title',
                'type' => 'text',
                'instructions' => 'Tekst, który pojawi się po najechaniu na logo, np. "Przejdź do strony głównej".',
                'placeholder' => 'Przejdź do strony głównej',
            ),
            array(
                'key' => 'field_logo_aria_label',
                'label' => 'Etykieta ARIA (dla dostępności)',
                'name' => 'aria_label',
                'type' => 'text',
                'instructions' => 'Opis dla czytników ekranu, np. "Logo firmy - przejdź do strony głównej". Jeśli puste, użyty zostanie tytuł linku.',
                'placeholder' => 'Logo - Strona główna',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'dogtronic/logo',
                ),
            ),
        ),
    ));
}