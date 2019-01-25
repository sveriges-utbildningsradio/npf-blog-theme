<?php

// Register custom taxonomy
function taxonomy_init(){

  $section_labels = array(
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
    'labels'                => $section_labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'section' ),
  );

  register_taxonomy( 'section', 'inspiration', $args );


  // Register the "Experter" tag
  $tag_experter_labels = array(
    'name'                       => _x( 'Experter', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Expert', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Experter', 'textdomain' ),
    'popular_items'              => __( 'Popular Experter', 'textdomain' ),
    'all_items'                  => __( 'All Experter', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Expert', 'textdomain' ),
    'update_item'                => __( 'Update Expert', 'textdomain' ),
    'add_new_item'               => __( 'Add New Expert', 'textdomain' ),
    'new_item_name'              => __( 'New Expert Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Experter with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Experter', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Experter', 'textdomain' ),
    'not_found'                  => __( 'No Experter found.', 'textdomain' ),
    'menu_name'                  => __( 'Experter', 'textdomain' ),
  );

  $tag_experter_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_experter_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'experter' ),
  );

  register_taxonomy( 'tag_experter', ['post', 'inspiration'], $tag_experter_args);

  // Register the "Diagnoser" tag
  $tag_diagnoser_labels = array(
    'name'                       => _x( 'Diagnoser', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Diagnos', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Diagnoser', 'textdomain' ),
    'popular_items'              => __( 'Popular Diagnoser', 'textdomain' ),
    'all_items'                  => __( 'All Diagnoser', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Diagnos', 'textdomain' ),
    'update_item'                => __( 'Update Diagnos', 'textdomain' ),
    'add_new_item'               => __( 'Add New Diagnos', 'textdomain' ),
    'new_item_name'              => __( 'New Diagnos Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Diagnoser with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Diagnoser', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Diagnoser', 'textdomain' ),
    'not_found'                  => __( 'No Diagnoser found.', 'textdomain' ),
    'menu_name'                  => __( 'Diagnoser', 'textdomain' ),
  );

  $tag_diagnoser_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_diagnoser_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'diagnoser' ),
  );

  register_taxonomy( 'tag_diagnoser', ['post', 'inspiration'], $tag_diagnoser_args);

  // Register the "Utmaningar" tag
  $tag_utmaningar_labels = array(
    'name'                       => _x( 'Utmaningar', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Utmaning', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Utmaningar', 'textdomain' ),
    'popular_items'              => __( 'Popular Utmaningar', 'textdomain' ),
    'all_items'                  => __( 'All Utmaningar', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Utmaning', 'textdomain' ),
    'update_item'                => __( 'Update Utmaning', 'textdomain' ),
    'add_new_item'               => __( 'Add New Utmaning', 'textdomain' ),
    'new_item_name'              => __( 'New Utmaning Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Utmaningar with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Utmaningar', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Utmaningar', 'textdomain' ),
    'not_found'                  => __( 'No Utmaningar found.', 'textdomain' ),
    'menu_name'                  => __( 'Utmaningar', 'textdomain' ),
  );

  $tag_utmaningar_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_utmaningar_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'utmaningar' ),
  );

  register_taxonomy( 'tag_utmaningar', ['post', 'inspiration'], $tag_utmaningar_args);

  // Register the "Övrigt" tag
  $tag_ovrigt_labels = array(
    'name'                       => _x( 'Övrigt', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Övrigt', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Övrigt', 'textdomain' ),
    'popular_items'              => __( 'Popular Övrigt', 'textdomain' ),
    'all_items'                  => __( 'All Övrigt', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Övrigt', 'textdomain' ),
    'update_item'                => __( 'Update Övrigt', 'textdomain' ),
    'add_new_item'               => __( 'Add New Övrigt', 'textdomain' ),
    'new_item_name'              => __( 'New Övrigt Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Övrigt with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Övrigt', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Övrigt', 'textdomain' ),
    'not_found'                  => __( 'No Övrigt found.', 'textdomain' ),
    'menu_name'                  => __( 'Övrigt', 'textdomain' ),
  );

  $tag_ovrigt_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_ovrigt_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'ovrigt' ),
  );

  register_taxonomy( 'tag_ovrigt', ['post', 'inspiration'], $tag_ovrigt_args);
}
add_action( 'init', __NAMESPACE__ . '\\taxonomy_init' );

?>