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

// Register post type "Inspiration"
get_template_part('/lib/custom/my_cpt');

// Register custom tags and taxonomies
get_template_part('/lib/custom/my_tags');


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


function get_help_results_ajax_handler(){

  $category = $_POST['category'];
  $terms = $_POST['terms'];
  $taxonomies = $_POST['taxonomies'];
  $usedTaxes = [];
  $usedTerms = [];

  $args = array(
    'posts_per_page' => -1,
    'orderby' => 'date',
    'post_status' => 'publish',
    'tax_query' => array(
      // 'relation' => 'AND',
    )
  );

  foreach ($taxonomies as $taxonomy) {
    array_push($args['tax_query'], array(
      'taxonomy' => $taxonomy,
      'field' => 'slug',
      'terms' => $terms
    ));
  }

  if (!empty($category)) {
    array_push($args['tax_query'], array(
      'taxonomy' => 'category',
      'field' => 'slug',
      'terms' => $category
    ));
  }

  query_posts( $args );
  global $wp_query;
  $postsCount = count($wp_query->posts);

  if( have_posts() ) :

    $counter = 1;
    while( have_posts() ): the_post();

      $postObj = get_sub_field('post');
      $postImg = wp_get_attachment_image_src( get_post_thumbnail_id($postObj->ID), 'medium' );
      $embed = get_field('video_url', $post->ID); 
      $highlight = get_field('highlight_this_post', $post->ID) ? get_field('background_color', $post->ID) : "";
      $external_link = get_field('use_external_link', $post->ID) ? get_field('external_link', $post->ID) : "";
      $external_link_text = get_field('external_link_text', $post->ID);
      ?>
      
        <div class="col-sm-12 col-md-4">

          <a href="<?= get_permalink($post->ID); ?>" class="layer-effect">
            <div class="three-columns item" data-count="<?= $postsCount; ?>">
              <?php if($postImg): ?>

            <div class="layer-container">
              <div class="post-img" style="background-image: url('<?= $postImg[0]; ?>')" role="img" alt="<?= $postObj->post_title; ?>" aria-label="<?= $postObj->post_title; ?>">
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
              <p><?php the_excerpt(); ?></p>
            </div>

          </div>
        </a>

      </div>

    <?php

    if ($counter === 3) {
      die();
    }

    $counter++;

    endwhile;
  endif;
  die;

}

add_action('wp_ajax_get_help_results', __NAMESPACE__ . '\\get_help_results_ajax_handler');
add_action('wp_ajax_nopriv_get_help_results', __NAMESPACE__ . '\\get_help_results_ajax_handler');


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


// Add options page
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page('Temainställningar');
  
}
