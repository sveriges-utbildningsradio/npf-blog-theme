<?php
/**
 * Template Name: Förstasidan
 */
	global $wp_query;
?>
<?php $wpPosts = new WP_Query( array('post_type' => 'post', 'posts_per_page' => -1, 'taxonomy' => 'post_tag')); ?>

<div class="container">
    <div class="row justify-content-center">
    	<div class="col-12">

		    <?php if( have_rows('carousel') ): ?>
		    	<!-- carousel -->
		        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php $a = 0; ?>
						<?php while( have_rows('carousel') ) : the_row(); ?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $a; ?>" class="<?php if($a == 0) { echo 'active'; } ?>"></li>
							<?php $a++; ?>
		                <?php endwhile; ?>
					</ol>
		            <div class="carousel-inner">
		                <?php $f = 0; ?>
		                <?php while( have_rows('carousel') ) : the_row(); ?>
		                    <?php $bgImage = get_sub_field('carousel_image'); ?>
		                    <?php $carouselTxt = get_sub_field('carousel_text'); ?>

		                    <div class="carousel-item <?php if($f == 0) { echo 'active'; } ?>">
		                        <?php if($bgImage): ?>
		                            <div class="carousel-box" style="background-image: url('<?php echo $bgImage['sizes']["large"]; ?>')" role="img" alt="<?php echo $bgImage['title'] ?>" aria-label="<?php echo $bgImage['title'] ?>"></div>
		                        <?php endif; ?>
								
								<?php if($carouselTxt): ?>
									<div class="caption">
										<h3><?php echo $carouselTxt; ?></h3>
									</div>
								<?php endif; ?>
		                    </div>
		                    <?php $f++; ?>
		                <?php endwhile; ?>
		            </div>
		        </div>
		    <?php endif; ?>

		</div>
	</div>
</div>

<?php while (have_posts()) : the_post(); ?>
	<div class="container">
	    <div class="row justify-content-center">
	    	<div class="col-12 col-md-8">
				<div id="help-content" class="filter-btn">
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
	<?php echo do_shortcode( '[searchandfilter fields="post_tag,category" headings="Beteenden/utmaningar,Situationer" types="checkbox,radio" operators="OR" submit_label="Sök" empty_search_url="'. esc_url(home_url('/')) .'"]'); ?>

<?php endwhile; wp_reset_postdata(); ?>

<div class="container">
    <div class="row">
    	<div class="col-12">

			<!-- POSTS -->
			<div class="post-container">
				<?php while ( $wpPosts->have_posts() ) : $wpPosts->the_post(); ?>
					<?php //The image source ?>
					<?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); ?>

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
					
					<div class="post-item">
						<a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php the_permalink(); ?>">	
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
								<h4><?php the_title(); ?></h4>
								<?php the_excerpt(); ?>
							</div>
						</a>
					</div>
				<?php endif; ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
            <?php
				if (  $wp_query->max_num_pages > 1 )
				echo '<div class="pag_in_ation"><a href="#">+</a></div>'; // you can use <a> as well
            ?>
		</div>
	</div>
</div>
<a href="#" aria-label="Scroll to top" class="scrollToTop">Hur kan vi hjälpa dig?</a>
