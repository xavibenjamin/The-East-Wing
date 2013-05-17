<?php

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
		'name' => 'Work Widget',
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

?>
