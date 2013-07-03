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

// Registering Option Page
register_options_page('Site Options');

// Featured Images

add_theme_support ('post-thumbnails');

add_image_size('cover-art', 265, 9999);

// Media Element Js
wp_register_script( 'mediaelement-js', get_template_directory_uri() . '/js/mediaelement-and-player.min.js');
wp_enqueue_script( 'mediaelement-js', 'true', 'true', 'true', 'true');

//Time Jump
wp_register_script( 'time-jump', get_template_directory_uri() . '/js/timeJump.js');
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



?>