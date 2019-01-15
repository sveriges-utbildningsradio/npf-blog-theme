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


  // Register the "Personer" tag
  $tag_personer_labels = array(
    'name'                       => _x( 'Personer', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Person', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Personer', 'textdomain' ),
    'popular_items'              => __( 'Popular Personer', 'textdomain' ),
    'all_items'                  => __( 'All Personer', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Person', 'textdomain' ),
    'update_item'                => __( 'Update Person', 'textdomain' ),
    'add_new_item'               => __( 'Add New Person', 'textdomain' ),
    'new_item_name'              => __( 'New Person Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Personer with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Personer', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Personer', 'textdomain' ),
    'not_found'                  => __( 'No Personer found.', 'textdomain' ),
    'menu_name'                  => __( 'Personer', 'textdomain' ),
  );

  $tag_personer_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_personer_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'personer' ),
  );

  register_taxonomy( 'tag_personer', ['post', 'inspiration'], $tag_personer_args);

  // Register the "Känslor" tag
  $tag_kanslor_labels = array(
    'name'                       => _x( 'Känslor', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Känsla', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Känslor', 'textdomain' ),
    'popular_items'              => __( 'Popular Känslor', 'textdomain' ),
    'all_items'                  => __( 'All Känslor', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Känsla', 'textdomain' ),
    'update_item'                => __( 'Update Känsla', 'textdomain' ),
    'add_new_item'               => __( 'Add New Känsla', 'textdomain' ),
    'new_item_name'              => __( 'New Känsla Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Känslor with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Känslor', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Känslor', 'textdomain' ),
    'not_found'                  => __( 'No Känslor found.', 'textdomain' ),
    'menu_name'                  => __( 'Känslor', 'textdomain' ),
  );

  $tag_kanslor_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_kanslor_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'kanslor' ),
  );

  register_taxonomy( 'tag_kanslor', ['post', 'inspiration'], $tag_kanslor_args);

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

  // Register the "Ämnen" tag
  $tag_amnen_labels = array(
    'name'                       => _x( 'Ämnen', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Ämne', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Ämnen', 'textdomain' ),
    'popular_items'              => __( 'Popular Ämnen', 'textdomain' ),
    'all_items'                  => __( 'All Ämnen', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Ämne', 'textdomain' ),
    'update_item'                => __( 'Update Ämne', 'textdomain' ),
    'add_new_item'               => __( 'Add New Ämne', 'textdomain' ),
    'new_item_name'              => __( 'New Ämne Name', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate Ämnen with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove Ämnen', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Ämnen', 'textdomain' ),
    'not_found'                  => __( 'No Ämnen found.', 'textdomain' ),
    'menu_name'                  => __( 'Ämnen', 'textdomain' ),
  );

  $tag_amnen_args = array(
    'hierarchical'          => true,
    'labels'                => $tag_amnen_labels,
    'show_ui'               => true,
    'show_admin_column'     => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'amnen' ),
  );

  register_taxonomy( 'tag_amnen', ['post', 'inspiration'], $tag_amnen_args);
}
add_action( 'init', __NAMESPACE__ . '\\taxonomy_init' );

?>