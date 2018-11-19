<?php
add_theme_support( 'custom-logo' );

function thumb() {
	add_image_size('medium', 500, 500);
}
add_action('after_setup_theme', __NAMESPACE__ . '\\thumb');

//41 word in excerpt
function wpdocs_custom_excerpt_length( $length ) {
    return 41;'';
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// media max-size
@ini_set( 'upload_max_size' , '200M' );
@ini_set( 'post_max_size', '200M');
@ini_set( 'max_execution_time', '300' );

// search posts
function template_chooser($template) {    
    global $wp_query;   
    $post_type = get_query_var('post_type');   

    if( $wp_query->is_search && $post_type == 'post' ) {

        return locate_template('search.php');  //redirect to search.php
    }   
    return $template;
}
add_filter('template_include', 'template_chooser');

//tax
function extra_init() {
	// create a new taxonomy
	register_taxonomy(
		'extra',
		'post',
		array(
			'label' => __( 'Extra' ),
			'rewrite' => array( 'slug' => 'extra' ),
			'capabilities' => array(
				'assign_terms' => 'edit_posts',
				'edit_terms' => 'publish_posts'
			)
		)
	);
}
add_action( 'init', 'extra_init' );