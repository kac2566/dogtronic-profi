<?php

namespace DogtronicBlocks;

if (!defined('ABSPATH')) {
    exit;
}

class Helpers
{
    public static function getMenusList(): array
    {
        $menus = \wp_get_nav_menus();
        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }
}