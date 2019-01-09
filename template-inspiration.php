<?php
/**
 * Template Name: Inspiration
 */
?>

<?php

$insp_args = array(
	'posts_per_page' => -1,
	'order' => 'DESC', 
	'orderby' => 'date',
	'tax_query' => array(
		array(
			'taxonomy' => 'section',
			'field' => 'slug',
			'terms' => get_field('inspiration_category')->name
		)
	)
);

$insp_query = new WP_Query($insp_args);

?>


<div class="container">
	<div class="row">

	<?php while (have_posts()) : the_post(); ?>
		<div class="col-12">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
		<?php if ( $insp_query->have_posts() ) { ?>
			<?php 
			$counter = 0;
			while ( $insp_query->have_posts() ) { $insp_query->the_post(); ?>

				<?php if ($counter % 4 == 0): ?>
					<?php 
					$postID = $post->ID;
					$postImg = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'medium' );
					$embed = get_field('video_url', $postID); ?>
						<div class="col-sm-12 col-md-12">
							<a href="<?= get_permalink($postObj->ID); ?>" class="layer-effect">
								<div class="two-columns item">
									<div class="row">
										<div class="col-md-6">
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
										</div>

										<div class="col-md-6 no-padding-left">
										    <div class="post-content">
										    	<?php echo $postObj; ?>
												<h4><?= get_the_title($postID); ?></h4>
												<p><?= get_the_excerpt($postID);; ?></p>
											</div>
										</div>

									</div>
								</div>
							</a>
						</div>

				<?php else: ?>

					<?php
			    	$postID = $post->ID;
			    	$postImg = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'medium' );
					$embed = get_field('video_url', $postID); ?>
					
			    	<div class="col-sm-12 col-md-4">
			    		<a href="<?= get_permalink($postObj->ID); ?>" class="layer-effect">
				    		<div class="three-columns item">
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
									<h4><?= get_the_title($postID); ?></h4>
									<p><?= get_the_excerpt($postID);; ?></p>
								</div>

							</div>
						</a>
					</div>

				<?php endif ?>
				<?php
				$counter++;
			}
			wp_reset_postdata();
		} ?>
	</div> <!-- row -->
</div> <!-- container -->
