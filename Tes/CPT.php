<?php

// Our custom post type function
function create_posttype() {
	register_post_type( 'industry',
					   // CPT Options
					   array(
						   'labels' => array(
							   'name' => __( 'Industries' ),
							   'singular_name' => __( 'Industry' )
						   ),
						   'public' => true,
						   'has_archive' => true,
						   'rewrite' => array('slug' => 'industries'),
						   'hierarchical' => false,
						   'supports' => array(
							   'title', // post title
							   'editor', // post content
							   'thumbnail', // featured images
							   'excerpt', // post 
							   'revisions', // post revisions
							   'post-formats', // post formats
						   )

					   )
					  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );



add_shortcode( 'custom_field', function($args) {
	ob_start();
	
	$queried_object = get_queried_object();
	$field_name = get_field( $args['field_name'] );
	
	foreach ($field_name as $value) {
		if( $args['url'] ) {
			echo "<a href='" . $value[ $args['url'] ] . "' target='_blank'>" . $value[ $args['text'] ] . "</a>";
		} else {
			echo "<p>" . $value[ $args['subfield_name'] ] . "</p>";
		}
	}
	
	return ob_get_clean();
} );


function create_board_post_type() {
	$labels = array(
		'name' => 'Staff',
		'singular_name' => 'Staff Member',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Staff Member',
		'edit_item' => 'Edit Staff Member',
		'new_item' => 'New Staff Member',
		'view_item' => 'View Staff Member',
		'search_items' => 'Search Staff',
		'not_found' => 'No staff members found',
		'not_found_in_trash' => 'No staff members found in Trash',
		'parent_item_colon' => 'Parent Staff Member:',
		'menu_name' => 'Staff',
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'Staff',
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_icon' => 'dashicons-groups',
	);
	register_post_type('staff', $args);
}