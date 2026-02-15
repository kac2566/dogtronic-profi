<?php
/**
 * Block Patterns.
 *
 * @package Dogtronic
 */

namespace Dogtronic\Setup;

class Patterns
{

    /**
     * Construct.
     */
    public function __construct()
    {
        add_action('init', [$this, 'register_patterns']);
    }

    /**
     * Register patterns from the patterns directory.
     */
    public function register_patterns()
    {
        // Register Categories
        register_block_pattern_category(
            'dogtronic',
            ['label' => __('Dogtronic', 'dogtronic')]
        );

        // Scan patterns directory for nested patterns
        // Structure: patterns/{group}/{name}.php
        $files = glob(get_template_directory() . '/patterns/*/*.php');

        if ($files) {
            foreach ($files as $file) {
                $data = get_file_data($file, [
                    'title' => 'Title',
                    'slug' => 'Slug',
                    'categories' => 'Categories',
                    'keywords' => 'Keywords',
                    'viewportWidth' => 'Viewport Width',
                ]);

                if (!empty($data['slug'])) {
                    $categories = array_filter(array_map('trim', explode(',', $data['categories'])));

                    foreach ($categories as $category) {
                        if (!\WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($category)) {
                            register_block_pattern_category(
                                $category,
                                ['label' => ucfirst($category)]
                            );
                        }
                    }

                    ob_start();
                    require $file;
                    $content = ob_get_clean();

                    register_block_pattern(
                        $data['slug'],
                        [
                            'title' => $data['title'],
                            'categories' => $categories,
                            'keywords' => array_filter(array_map('trim', explode(',', $data['keywords']))),
                            'content' => $content,
                            'viewportWidth' => (int) $data['viewportWidth'],
                        ]
                    );
                }
            }
        }
    }
}
