<?php

// Register post type "Inspiration"
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
      // 'taxonomies'         => array('section', 'post_tag'),
      'taxonomies'         => array('section', 'tag_personer'),
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
    );
    register_post_type( 'inspiration', $args );
}
add_action( 'init', __NAMESPACE__ . '\\cpt_init' );

?>