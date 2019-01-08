<?php

if( have_rows('posts') ): ?>
	<div class="row">
	    <?php while ( have_rows('posts') ) : the_row();
	    	$postObj = get_sub_field('post');
	    	$postImg = wp_get_attachment_image_src( get_post_thumbnail_id($postObj->ID), 'medium' );
	    	$file = get_field('video_fil', $postObj->ID);
			$embed = get_field('video_url', $postObj->ID); ?>
			
	    	<div class="col-sm-12 col-md-4">
	    		<a href="<?= get_permalink($postObj->ID); ?>" class="layer-effect">
		    		<div class="three-columns item">
		    			<?php if($postImg): ?>

						<div class="layer-container">
							<div class="post-img" style="background-image: url('<?= $postImg[0]; ?>')" role="img" alt="<?= $postObj->post_title; ?>" aria-label="<?= $postObj->post_title; ?>">
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
							<h4><?= $postObj->post_title; ?></h4>
							<p><?= $postObj->post_excerpt; ?></p>
						</div>

					</div>
				</a>
			</div>
	    <?php endwhile; ?>
	</div>
<?php endif; ?>