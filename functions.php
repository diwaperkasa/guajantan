<?php

// Start Genesis
require_once get_template_directory() . '/lib/init.php';

// Child theme setup
define('CHILD_THEME_NAME', 'Guajantan Theme');
define('CHILD_THEME_VERSION', '1.0');

add_action( 'after_setup_theme', function() {
    remove_action('genesis_after_header', 'genesis_do_nav');
    remove_action('genesis_after_header', 'genesis_do_subnav');
    remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

    register_nav_menus([
        'primary' => __('Primary Navigation'),
        'header' => __('Header Navigation'),
        'footer' => __('Footer Navigation'),
        'offcanvas' => __('Off Canvas Navigation'),
    ]);
});

/* Load hooks */
foreach (glob(get_stylesheet_directory() . "/hooks/*.php") as $file) {
    include $file;
}

// Load stylesheet
add_action('wp_enqueue_scripts', 'theme_scripts');

function theme_scripts() {
    wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/style.css?' . filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.min.js?' . filemtime( get_stylesheet_directory() . '/js/scripts.min.js' ), [], null, true );
}

function get_wp_menu_tree($menu_location = 'primary')
{
    $locations = get_nav_menu_locations();

    if (!isset($locations[$menu_location])) {
        return [];
    }

    $menu_id = $locations[$menu_location];
    $items   = wp_get_nav_menu_items($menu_id);

    $menu_tree = [];
    $children  = [];

    // Group children by parent
    foreach ($items as $item) {
        $parent_id = intval($item->menu_item_parent);

        if ($parent_id === 0) {
            $menu_tree[$item->ID] = [
                'id'       => $item->ID,
                'title'    => $item->title,
                'url'      => $item->url,
                'object'   => $item->object,
                'target'   => $item->target,
                'children' => []
            ];
        } else {
            $children[$parent_id][] = [
                'id'       => $item->ID,
                'title'    => $item->title,
                'url'      => $item->url,
                'object'   => $item->object,
                'target'   => $item->target,
                'parent'   => $parent_id,
                'children' => []
            ];
        }
    }

    // Assign nested children recursively
    $add_children = function (&$parents) use (&$children, &$add_children) {
        foreach ($parents as &$parent) {
            if (!empty($children[$parent['id']])) {
                $parent['children'] = $children[$parent['id']];
                $add_children($parent['children']);
            }
        }
    };

    $add_children($menu_tree);

    return array_values($menu_tree);
}

function get_dfp_targets()
{
    global $post;
    $targets = [];

    if (is_home() || is_front_page()) {
        $targets[] = 'home';
    } elseif (is_singular(['post', 'wine', 'passport', 'package'])) {
        $categories = wp_get_object_terms($post->ID, 'category');

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $targets[] = $category->slug;

                if ($category->parent) {
                    $term = get_term_by('id', $category->parent, 'category');
                    $targets[] = $term->slug;
                }
            }
        }

        $targets[] = $post->ID;
    } elseif (is_author()) {
        $targets[] = 'home';
    } elseif (is_category()) {
        $term = get_queried_object();
        $targets[] = $term->slug;

        if ($term->parent) {
            $term      = get_term_by('id', $term->parent, 'category');
            $targets[] = $term->slug;
        }
    }

    return $targets;
}

function wpp_custom_taxonomy_separator($separator)
{
    return " | ";
}

add_filter('wpp_taxonomy_separator', 'wpp_custom_taxonomy_separator', 10, 1);