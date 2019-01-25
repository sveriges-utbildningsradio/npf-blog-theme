<?php
/**
 * Tag and Category page
 */
?>
	
<!-- SORT OF POSTS -->
<?php get_template_part('/parts/help_bar'); ?>

<div class="container">
	<?php if( have_posts() ): ?>
	<div class="row">
		<div class="col-12">
			<!-- POSTS -->
			<div class="post-container">
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="post-item">
						<a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php the_permalink(); ?>">	
							<?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); ?>
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
								<h3><?php the_title(); ?></h3>
								<?php the_excerpt(); ?>
							</div>
						</a>
					</div>

				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>

	<?php 
	if ($wp_query->max_num_pages > 1) { ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="loadmore-container">
				<div class="loadmore">Visa mer</div>
			</div>
		</div>
	</div>
	<?php 
	}
	?>

	<script>
	var posts_custom = '<?php echo serialize( $wp_query->query_vars ) ?>',
	    current_page_custom = <?php echo $wp_query->query_vars['paged'] + 1 ?>,
	    max_page_custom = <?php echo $wp_query->max_num_pages ?>;
	</script>
	<?php else : ?>
	<div class="row">
		<div class="col-12">
			<h3 class="py-5">Inga inlägg, testa att välj ett annat alternativ!</h3>
		</div>
	</div>
	<?php endif; ?>

</div>
<a href="#help-content" aria-label="Scroll to top" class="scrollToTop">Hur kan vi hjälpa dig?</a>