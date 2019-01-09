<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return '&hellip;';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

// Register post type "Diverse"
function cpt_init() {

    $labels = array(
      'name'               => __( 'Inspiration' ), // post type general name
      'singular_name'      => __( 'Inspiration' ), // post type singular name
      'menu_name'          => __( 'Inspiration' ), // admin menu
      'name_admin_bar'     => __( 'Inspiration' ), // add new on admin bar
      'add_new'            => __( 'Add New' ), // 'book'
      'add_new_item'       => __( 'Add New inspiration' ),
      'new_item'           => __( 'New Inspiration' ),
      'edit_item'          => __( 'Edit Inspiration' ),
      'view_item'          => __( 'View Inspiration' ),
      'all_items'          => __( 'All Inspirations' ),
      'search_items'       => __( 'Search Inspirations' ),
      'parent_item_colon'  => __( 'Parent Inspirations:' ),
      'not_found'          => __( 'No Inspirations found.' ),
      'not_found_in_trash' => __( 'No Inspirations found in Trash.' )  
    );

    $args = array(
      'labels'  => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'inspiration' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'taxonomies'         => array('section', 'post_tag'),
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
    );
    register_post_type( 'inspiration', $args );
}
add_action( 'init', __NAMESPACE__ . '\\cpt_init' );


// Register custom taxonomy
function taxonomy_init(){

  $labels = array(
    'name'                       => _x( 'Sections', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Section', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Sections', 'textdomain' ),
    'popular_items'              => __( 'Popular Sections', 'textdomain' ),
    'all_items'                  => __( 'All Sections', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Section', 'textdomain' ),
    'update_item'                => __( 'Update Section', 'textdomain' ),
    'add_new_item'               => __( 'Add New Section', 'textdomain' ),
    'new_item_name'              => __( 'New Section Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Sections with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Sections', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Sections', 'textdomain' ),
    'not_found'                  => __( 'No Sections found.', 'textdomain' ),
    'menu_name'                  => __( 'Sections', 'textdomain' ),
  );

  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'section' ),
  );

  register_taxonomy( 'section', 'inspiration', $args );
}
add_action( 'init', __NAMESPACE__ . '\\taxonomy_init' );


