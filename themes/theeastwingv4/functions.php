<?php

//jQuery Insert From Google
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

// Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer http://blog.kaizeku.com/

function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;

	return (isset($sidebars[$key]));
}

// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function thematic_widgets_init() {
	if ( !function_exists('register_sidebars') )
		return;

	// Register Widgetized areas.
		register_sidebar(array(
		'name' => 'Guest Widget',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
	));

	// Finished intializing Widgets plugin, now let's load the thematic default widgets
}

// Runs our code at the end to check that everything needed has loaded
add_action( 'init', 'thematic_widgets_init' );

function custom_excerpt_more( $more ) {
	return '[.....]';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

// Featured Images

add_theme_support ('post-thumbnails');

add_image_size('cover-art', 265, 265);

// Media Element Js
wp_register_script( 'mediaelement-js', get_template_directory_uri() . '/assets/js/mediaelement-and-player.min.js');
wp_enqueue_script( 'mediaelement-js', 'true', 'true', 'true', 'true');

//Time Jump
wp_register_script( 'time-jump', get_template_directory_uri() . '/assets/js/timeJump.js');
wp_enqueue_script( 'time-jump', 'true', 'true', 'true', 'true' );


// Upcoming Guests Post Type
register_post_type('upcoming-guests', array(  'label' => 'Upcoming Guests','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => true,'supports' => array('title','custom-fields','thumbnail',),'labels' => array (
  'name' => 'Upcoming Guests',
  'singular_name' => 'Upcoming Guest',
  'menu_name' => 'Upcoming Guests',
  'add_new' => 'Add Upcoming Guest',
  'add_new_item' => 'Add New Upcoming Guest',
  'edit' => 'Edit',
  'edit_item' => 'Edit Upcoming Guest',
  'new_item' => 'New Upcoming Guest',
  'view' => 'View Upcoming Guest',
  'view_item' => 'View Upcoming Guest',
  'search_items' => 'Search Upcoming Guests',
  'not_found' => 'No Upcoming Guests Found',
  'not_found_in_trash' => 'No Upcoming Guests Found in Trash',
  'parent' => 'Parent Upcoming Guest',
),) );


// Site Wide Sponsor Post Type
register_post_type('sponsors', array( 'label' => 'Site Wide Sponsors','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => true,'supports' => array('title','editor','custom-fields','thumbnail',),'labels' => array (
  'name' => 'Site Wide Sponsors',
  'singular_name' => 'Site Wide Sponsor',
  'menu_name' => 'Site Wide Sponsors',
  'add_new' => 'Add Site Wide Sponsor',
  'add_new_item' => 'Add New Site Wide Sponsor',
  'edit' => 'Edit',
  'edit_item' => 'Edit Site Wide Sponsor',
  'new_item' => 'New Site Wide Sponsor',
  'view' => 'View Site Wide Sponsor',
  'view_item' => 'View Site Wide Sponsor',
  'search_items' => 'Search Site Wide Sponsors',
  'not_found' => 'No Site Wide Sponsors Found',
  'not_found_in_trash' => 'No Site Wide Sponsors Found in Trash',
  'parent' => 'Parent Site Wide Sponsor',
),) );


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



// Registering Fields for Live Stream Options Page

// Fields
add_action('acf/register_fields', 'my_register_fields');


// Options Page
include_once( 'add-ons/acf-options-page/acf-options-page.php' );


// Registering Live Stream Options Page
register_options_page('Live Stream Options');

register_options_page('AdSpot Options');

function my_register_fields()
{
  //include_once('add-ons/acf-repeater/repeater.php');
  //include_once('add-ons/acf-gallery/gallery.php');
  //include_once('add-ons/acf-flexible-content/flexible-content.php');
}

// Options Page
//include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_live-stream',
    'title' => 'Live Stream',
    'fields' => array (
      array (
        'key' => 'field_51c39f5e13b68',
        'label' => 'Live Stream',
        'name' => 'live_stream',
        'type' => 'true_false',
        'message' => 'Is The East Wing live?',
        'default_value' => 0,
      ),
      array (
        'key' => 'field_51c39fcb1a075',
        'label' => 'Live Guest Name',
        'name' => 'live_guest_name',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_51c3a1586353c',
        'label' => 'Live Episode Number',
        'name' => 'live_episode_number',
        'type' => 'number',
        'default_value' => '',
      ),
    ),
    'location' => array (
      'rules' => array (
        array (
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-live-stream-options',
          'order_no' => 0,
        ),
      ),
      'allorany' => 'all',
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}

/**
 *  Register AdSpot Fields
 */

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_bandwidth-sponsor',
    'title' => 'Bandwidth Sponsor',
    'fields' => array (
      array (
        'key' => 'field_5243265780be1',
        'label' => 'bSponsor Logo',
        'name' => 'bsponsor_logo',
        'type' => 'image',
        'save_format' => 'url',
        'preview_size' => 'full',
        'library' => 'all',
      ),
      array (
        'key' => 'field_524326b080be2',
        'label' => 'bSponsor URL',
        'name' => 'bsponsor_url',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_52432a02d0d25',
        'label' => 'bSponsor',
        'name' => 'bsponsor',
        'type' => 'true_false',
        'message' => '',
        'default_value' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-adspot-options',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}


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
