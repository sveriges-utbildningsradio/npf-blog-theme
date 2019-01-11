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

function alter_query( $query ) {
  // if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
  if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
    // $query->set( 'posts_per_page', -1 );
    $query->set( 'posts_per_page', 10 );
    $query->set( 'orderby', 'post_date' );
    $query->set( 'order', 'DESC' );
  }
}

add_action( 'pre_get_posts', __NAMESPACE__ . '\\alter_query' );


// Ajax loading
function my_load_more_scripts() {
 
  global $wp_query; 

  wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/myloadmore.js', array('jquery') );

  wp_localize_script( 'my_loadmore', 'loadmore_params', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
    'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
    'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
    'max_page' => $wp_query->max_num_pages
  ) );
 
  wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\my_load_more_scripts' );


function loadmore_ajax_handler(){
 
  $args = json_decode( stripslashes( $_POST['query'] ), true );
  $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
  $args['post_status'] = 'publish';
  $args['posts_per_page'] = $_POST['posts_per_page'];
  $args['order'] = 'DESC';
  $args['orderby'] = 'date';
 
  query_posts( $args );
 
  if( have_posts() ) :
 
    while( have_posts() ): the_post();

      $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); 
      $highlight = get_field('highlight_this_post') ? get_field('background_color') : "";
      $external_link = get_field('use_external_link') ? get_field('external_link') : "";
      $external_link_text = get_field('external_link_text');
      ?>


      <?php if($post->ID === 895): ?>
        <!-- NEWSLETTER -->
        <?php $pLink = get_field('lank'); ?>
      
          <div class="newsletter-item" href="<?php echo $pLink['url']; ?>" target="<?php echo $pLink['target']; ?>">
            <?php if($postsImg): ?>
              <?php //The title for image alt/aria attribute ?>
              <?php $title = get_post(get_post_thumbnail_id())->post_title;  ?> 

              <div class="news-img" style="background-image: url('<?php echo $postsImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>"></div>
            <?php endif; ?>
            <div class="new-txt-content">
              <h4><?php the_title(); ?></h4>
              <?php the_content(); ?>
            </div>
          </div>

      <?php else: ?>
      
      <?php if ($highlight != ""): ?>
        <div class="post-item highlight-post" style="background-color: <?= $highlight; ?>">
        <?php else: ?>
        <div class="post-item">
      <?php endif ?>
        <a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php the_permalink(); ?>">  
          <?php if($postsImg): ?>
            <?php //The title for image alt/aria attribute ?>
            <?php $title = get_post(get_post_thumbnail_id())->post_title;  ?> 
            <div class="layer-container">
              <?php $embed = get_field('video_url'); ?>
              <div class="post-img" style="background-image: url('<?php echo $postsImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>">
                <?php if( $embed ): ?>
                  <div class="video-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/video.svg" alt="Video icon">
                  </div>
                <?php endif; ?>
              </div>
              <div class="layer"></div>
            </div>
          <?php endif; ?>
          
          <div class="post-content">
            <h4><?php the_title(); ?></h4>
            <?php the_excerpt(); ?>
          </div>
        </a>
        <?php if ($highlight != "" && $external_link != ""): ?>
          <div class="link-container">
            <a href="<?= $external_link; ?>" target="_blank"><?= $external_link_text; ?></a>
          </div>
        <?php endif; ?>
        </div>
      <?php
      endif;
 
    endwhile;

  endif;
  die;
}
  
add_action('wp_ajax_loadmore', __NAMESPACE__ . '\\loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', __NAMESPACE__ . '\\loadmore_ajax_handler');
