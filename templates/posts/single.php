<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10">
			<?php while (have_posts()) : the_post(); ?>

				<?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
				<?php $file = get_field('video_url'); ?>
				
				<?php if( $file  && $postsImg ): ?>
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

				<!-- Tags & Categories -->
				<?php
				// Category
				$post_id = get_the_ID();
				$category_object = get_the_category($post_id);
				$category_name = $category_object[0]->name;

				$unCat = 'Uncategorized';
				$oKat = 'Okategoriserade';
				?>
				<?php if(get_the_tag_list() == true): ?>
					<strong>Taggar: </strong><span class="underline tag-buttons"><?php echo get_the_tag_list('',' ',''); ?></span><br>
				<?php endif; ?>

				<?php if($category_name === $unCat || $category_name === $oKat || $category_name === ''): ?>
					<!-- do nothing -->
				<?php else: ?>
					<strong>Kategori: </strong><span class="underline tag-buttons"><?php echo the_category(' '); ?></span>
				<?php endif; ?>

				<div class="time-share">
					<!-- Date -->
					<div class="time"><?php echo get_the_date(); ?></div>
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

				<h6 class="text-center underline"><a href="<?= esc_url(home_url('/')); ?>">Tillbaka till startsidan</a></h6>

			<?php endwhile; wp_reset_postdata(); ?>

			<!-- Related posts -->
			<?php
			$orig_post = $post;
			global $post;

			$tags = wp_get_post_tags($post->ID);
			if ($tags) :

				$tag_ids = array();
				foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;

				$args = array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> 3
				);

				$my_query = new wp_query( $args );
				if( $my_query->have_posts() ) :?>

					<div class="related-contaier">
						<h4>Relaterat</h4>

						<?php if (get_field('pick_related_posts_manually')) { 
							if( have_rows('related_posts') ): ?>
								<div class="row">
								    <?php while ( have_rows('related_posts') ) : the_row(); 
								    	$relatedObj = get_sub_field('related_post');
								    	$relatedId = $relatedObj->ID;
								    	$relatedImg = wp_get_attachment_image_src( get_post_thumbnail_id($relatedId), 'large' ); 
								    	?>
								    	<div class="col-12 col-md-4">
								    		<a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php the_permalink($relatedId); ?>">
								    			<?php if($relatedImg): ?>
								    				<?php $title = get_post(get_post_thumbnail_id($relatedImg))->post_title;  ?>
								    				
								    				<div class="layer-container">
								    					<?php $embed = get_field('video_url', $relatedId); ?>
								    					<div class="post-img" style="background-image: url('<?php echo $relatedImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>">
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
								    				<h5><?= $relatedObj->post_title; ?></h5>
								    			</div> <!-- post-content -->
								    		</a>
								    	</div>
								    <?php endwhile; ?>
								</div>
							<?php endif; ?>
							
						<?php } else { ?>

						<div class="row">
							<?php while( $my_query->have_posts() ) : $my_query->the_post() ; ?>
								<div class="col-12 col-md-4">
									<a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php the_permalink(); ?>">
										<?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>

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
						<?php } ?>
					</div> <!-- py-4 -->
				<?php endif; ?>
			<?php endif; ?>
			<?php $post = $orig_post; ?>
			<?php wp_reset_query(); ?>
		</div> <!-- col-12 col-md-10 -->
	</div> <!-- row justify-content-center -->
</div> <!-- container -->
