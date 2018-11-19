<?php
/**
 * Template Name: Inspiration
 */
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10">
			<?php while (have_posts()) : the_post(); ?>

				<?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
				<?php $file = get_field('video_fil') ?: get_field('video_url'); ?>

				<?php if( $file && $postsImg ): ?>
					<?php //The title for image alt/aria attribute ?>
					<?php $title = get_post(get_post_thumbnail_id())->post_title;  ?>

					<?php if( is_string($file)) : ?>
                        <div class="video-embed-container">
                            <iframe title="<?php the_title(); ?>"
                                    src="<?php echo $file ?>"
                                    width="100%"
                                    frameborder="0"
                                    allowfullscreen>
                            </iframe>
                        </div>
						<?php else : ?>
                        <div class="video-element-container">
                            <video data-url="<?php the_permalink(); ?>" id="click" preload="none" controlsList="nodownload" poster="<?php echo $postsImg[0];?>" controls>
                                <source src="<?php echo $file['url']; ?>" type="video/mp4">
                                Din webbläsare stödjer inte HTML5 video!
                            </video>
                            <img class="custom-play play" alt="Play button" src="<?php echo get_template_directory_uri(); ?>/dist/images/Play.svg">
                            <img class="custom-play pause" alt="Pause button" src="<?php echo get_template_directory_uri(); ?>/dist/images/Paus.svg">
                        </div>
					<?php endif; ?>
				<?php elseif( $postsImg ) : ?>
					<?php //The title for image alt/aria attribute ?>
					<?php $title = get_post(get_post_thumbnail_id())->post_title;  ?>

					<div class="post-img" style="background-image: url('<?php echo $postsImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>"></div>
				<?php endif; ?>

				<div class="content">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div> <!-- post-content -->

				<div class="time-share">
					<!-- Date -->
					<div class="time"></div>
					<!-- Share -->
					<div class="share"><i class="fa fa-share-alt"></i> Dela</div>
					<div class="so-me">
						<?php $permalink = get_permalink(); ?>
						<?php $date = date('Ymd'); ?>
						<!-- Facebook -->
						<?php echo do_shortcode( '[addtoany buttons="facebook" url="'. $permalink .'?cmpid=del:fb:'. $date .':foraldrar"]' ); ?>
						<!-- Facebook Messenger -->
						<?php echo do_shortcode( '[addtoany buttons="facebook_messenger" url="'. $permalink .'?cmpid=del:ms:'. $date .':foraldrar"]' ); ?>
						<!-- Whats App -->
						<?php echo do_shortcode( '[addtoany buttons="whatsapp" url="'. $permalink .'?cmpid=del:wa:'. $date .':foraldrar"]' ); ?>
						<!-- Email -->
						<?php echo do_shortcode( '[addtoany buttons="email" url="'. $permalink .'?cmpid=del:em:'. $date .':foraldrar"]' ); ?>

						<input id="copy-url" aria-label="Kopiera delbar länk" type="url" value="<?php echo $permalink ?>?cmpid=del:cl:<?php echo $date ?>:foraldrar" readonly="">
						<div id="copy-link"><i class="fa fa-link"></i></div>
						<p id="copy-txt"></p>
					</div>
				</div>

			<?php endwhile; wp_reset_postdata(); ?>

			<?php $inspo = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3, 'cat' => 25)); ?>
			<div class="related-contaier">
				<div class="row">
					<?php while( $inspo->have_posts() ) : $inspo->the_post() ; ?>
						<div class="col-12 col-md-4">
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
										<div class="layer"></div> <!-- layer -->
									</div> <!-- layer-container -->
								<?php endif; ?>

								<div class="post-content">
									<h5><?php the_title(); ?></h5>
								</div> <!-- post-content -->
							</a> <!-- layer-effect -->
						</div> <!-- col-12 col-md-4 -->
					<?php endwhile; wp_reset_postdata(); ?>
				</div> <!-- row -->
			</div> <!-- py-4 -->
		</div> <!-- col-12 col-md-10 -->
	</div> <!-- row justify-content-center -->
</div> <!-- container -->
