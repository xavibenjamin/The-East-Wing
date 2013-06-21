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

// Registering Live Stream Options Page
register_options_page('Live Stream Options');

// Featured Images

add_theme_support ('post-thumbnails');

add_image_size('cover-art', 265, 9999);

// Media Element Js
wp_register_script( 'mediaelement-js', get_template_directory_uri() . '/js/mediaelement-and-player.min.js');
wp_enqueue_script( 'mediaelement-js', 'true', 'true', 'true', 'true');

//Time Jump
wp_register_script( 'time-jump', get_template_directory_uri() . '/js/timeJump.js');
wp_enqueue_script( 'time-jump', 'true', 'true', 'true', 'true' );

/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */ 

// Fields 
add_action('acf/register_fields', 'my_register_fields');

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


?>