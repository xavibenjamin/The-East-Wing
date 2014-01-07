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

// Featured Images

add_theme_support ('post-thumbnails');

add_image_size('cover-art', 265, 265);

// Media Element Js
wp_register_script( 'mediaelement-js', get_template_directory_uri() . '/assets/js/mediaelement-and-player.min.js');
wp_enqueue_script( 'mediaelement-js', 'true', 'true', 'true', 'true');

//Time Jump
wp_register_script( 'time-jump', get_template_directory_uri() . '/assets/js/timeJump.js');
wp_enqueue_script( 'time-jump', 'true', 'true', 'true', 'true' );


// Off Air Post Type

add_action( 'init', 'create_post_type');
function create_post_type() {
  register_post_type( 'offair',
    array(
      'labels' => array(
        'name' => 'Off Air Episodes',
        'singular_name' => 'Off Air Episode',
        'menu_name' => 'Off Air Episodes',
        'add_new' => 'Add Off Air Episode',
        'add_new_item' => 'Add New Off Air Episode',
        'edit' => 'Edit',
        'edit_item' => 'Edit Off Air Episode',
        'new_item' => 'New Off Air Episode',
        'view' => 'View Off Air Episode',
        'view_item' => 'View Off Air Episode',
        'search_items' => 'Search Off Air Episodes',
        'not_found' => 'No Off Air Episodes Found',
        'not_found_in_trash' => 'No Off Air Episodes Found in Trash',
        'parent' => 'Parent Off Air Episode',
      ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array('slug' => ''),
    'query_var' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'supports' => array( 'title','editor','excerpt','custom-fields','thumbnail', 'revisions' ),
    'taxonomies' => array( 'category' ),
    )
  );
}

// The East Wing Episodes : Off Air Episodes - Post to Posts

function my_connection_types() {
  p2p_register_connection_type( array(
    'name' => 'EastWing_to_OffAir',
    'from' => 'post',
    'to' => 'offair'
  ) );
}
add_action( 'p2p_init', 'my_connection_types' );



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
    // we can add a submenu item too
    $wp_admin_bar->add_menu( array(
        'parent' => false,
        'id' => 'live-stream-admin-menu',
        'title' => __('Live Stream'),
        'href' => admin_url( 'admin.php?page=acf-options-live-stream-options')
    ) );
    $wp_admin_bar->add_menu( array(
        'parent' => 'live-stream-admin-menu',
        'id' => 'live_stream_page',
        'title' => __('Live Page'),
        'href' => ('/live')
    ) );
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
