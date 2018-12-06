<?php
/**
 * Tag and Category page
 */
?>
<?php $wpFrontpage = new WP_Query( array('p' => 804, 'post_type' => 'any')); ?>

<?php while ($wpFrontpage->have_posts()) : $wpFrontpage->the_post(); ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8">
				<div class="filter-btn">
					<h2><?php the_title(); ?></h2>
					<i class="fa fa-angle-down"></i>
				</div>
			</div>
		</div>
	</div>

	<?php 
	ob_start();
	dynamic_sidebar('sidebar-primary');
	$sidebar = ob_get_contents(); 
	ob_end_clean(); 
	?>
	<div id="widget"><?php echo $sidebar ?></div>
	
	<!-- SORT OF POSTS -->
	<?php echo do_shortcode( '[searchandfilter fields="post_tag,category" types="checkbox,radio" headings="Beteenden/utmaningar,Situationer" operators="OR" submit_label="Sök" empty_search_url="'. esc_url(home_url('/')) .'"]'); ?>

<?php endwhile; wp_reset_postdata(); ?>

<div class="container">
    <div class="row">
    	<div class="col-12">
			<?php if( have_posts() ): ?>
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
										<?php $file = get_field('video_fil'); ?>
										<?php $embed = get_field('video_url'); ?>
										<div class="post-img" style="background-image: url('<?php echo $postsImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>">
											<?php if( $file || $embed ): ?>
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
			<?php else : ?>
				<h3 class="py-5">Inga inlägg, testa att välj ett annat alternativ!</h3>
			<?php endif; ?>
		</div>
	</div>
</div>
<a href="#help-content" aria-label="Scroll to top" class="scrollToTop">Hur kan vi hjälpa dig?</a>