<?php

// jQuery Insert From Google
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

//Stuff
wp_register_script( 'global-stuff', get_template_directory_uri() . '/assets/js/stuff-ck.js');
wp_enqueue_script( 'global-stuff', 'true', 'true', 'true', 'true' );

// Register Custom Post Type
// add_action( 'init', 'create_post_type');
// function create_post_type() {
//   register_post_type( 'episodes',
//     array(
//       'labels' => array(
//         'name' => 'Episodes',
//         'singular_name' => 'Episode',
//         'menu_name' => 'Episodes',
//         'add_new' => 'Add Episode',
//         'add_new_item' => 'Add New Episode',
//         'edit' => 'Edit',
//         'edit_item' => 'Edit Episode',
//         'new_item' => 'New Episode',
//         'view' => 'View Episode',
//         'view_item' => 'View Episode',
//         'search_items' => 'Search Episodes',
//         'not_found' => 'No Episodes Found',
//         'not_found_in_trash' => 'No Episodes Found in Trash',
//         'parent' => 'Parent Episode',
//       ),
//     'public' => true,
//     'show_ui' => true,
//     'show_in_menu' => true,
//     'show_in_nav_menus' => true,
//     'show_in_admin_bar' => true,
//     'menu_position' => 5,
//     'capability_type' => 'post',
//     'hierarchical' => false,
//     'rewrite' => array('slug' => 'ep', 'with_front' => '' ),
//     'query_var' => true,
//     'exclude_from_search' => false,
//     'has_archive' => true,
//     'supports' => array( 'title','editor','excerpt','custom-fields','thumbnail', 'revisions' ),
//     'taxonomies' => array( 'category' ),
//     )
//   );
// }

// Messing with WP Admin Bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    // we can remove a menu item, like the Comments link, just by knowing the right $id
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wpseo-menu');
    // or we can remove a submenu, like New Link.
    $wp_admin_bar->remove_menu('new-link', 'new-content');
    $wp_admin_bar->remove_menu('new-media', 'new-content');
    $wp_admin_bar->remove_menu('new-user', 'new-content');
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );