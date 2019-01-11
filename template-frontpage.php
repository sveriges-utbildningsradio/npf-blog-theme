<?php
/**
 * Template Name: Förstasidan
 */
?>
<?php
$feedType = get_field('feed_type');
?>

<div class="container">
    <div class="row justify-content-center">
    	<div class="col-12">

		    <?php if( have_rows('carousel') ): ?>
		    	<!-- carousel -->
		        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-time="<?= get_field('carousel_slide_time') ?>">
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
		                    <?php $carouselTxtPos = get_sub_field('carousel_text_position'); ?>

		                    <div class="carousel-item <?php if($f == 0) { echo 'active'; } ?>">
		                        <?php if($bgImage): ?>
		                            <div class="carousel-box" style="background-image: url('<?php echo $bgImage['sizes']["large"]; ?>')" role="img" alt="<?php echo $bgImage['title'] ?>" aria-label="<?php echo $bgImage['title'] ?>"></div>
		                        <?php endif; ?>
								
								<?php if($carouselTxt): ?>
									<div class="caption <?= $carouselTxtPos; ?>">
										<h3><?= $carouselTxt; ?></h3>
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

<?php if ($feedType == 'manual-feed'): ?>

	<div class="container manual">
		<?php if( have_rows('feed') ):
		    while ( have_rows('feed') ) : the_row();
		        if( get_row_layout() == 'three_columns' ):
		        	get_template_part('parts/three_columns');
		        elseif( get_row_layout() == 'two_columns' ): 
		        	get_template_part('parts/two_columns');
		        endif;
		    endwhile;
		endif; ?>
	</div>

<?php else: ?>

	<?php

	$autoArgs = array(
		'post_type' => 'post',
		'posts_per_page' => get_field('number_of_posts'),
		'taxonomy' => 'post_tag',
		'order' => 'DESC',
		'orderby' => 'post_date'

	);

	$autoQuery = new WP_Query( $autoArgs );

	?>

	<div class="container">
	    <div class="row">
	    	<div class="col-12">

				<!-- POSTS -->
				<div class="post-container">
					<?php while ( $autoQuery->have_posts() ) : $autoQuery->the_post(); 
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
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
		
		<?php 
		if ($autoQuery->max_num_pages > 1) { ?>
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
		
	</div>

	<script>
	var posts_custom = '<?php echo serialize( $autoQuery->query_vars ) ?>',
	    current_page_custom = <?php echo $autoQuery->query_vars['paged'] + 1 ?>,
	    max_page_custom = <?php echo $autoQuery->max_num_pages ?>;
	</script>
	
<?php endif ?>

<a href="#" aria-label="Scroll to top" class="scrollToTop">Hur kan vi hjälpa dig?</a>