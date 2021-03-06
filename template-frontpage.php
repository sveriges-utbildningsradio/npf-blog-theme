<?php
/**
 * Template Name: Förstasidan
 */
?>
<?php
$feedType = get_field('feed_type');
?>

<!-- Ändra flödet om användaren har filtrerat -->

<?php if (isset($_GET['alter'])) { ?>
	
	<?php
	$alterTerms = explode(',', $_GET['terms']);
	$alterTaxonomies = explode(',', $_GET['tax']);
	$alterCategory = $_GET['cate'];
	$alterTermsLength = sizeof($alterTerms);
	$alterArgs = array(
		'posts_per_page' => -1,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status' => 'publish',
		'tax_query' => array(
		  // 'relation' => 'AND',
		)
	);

	if ($alterTerms[0] != "") {
		foreach ($alterTaxonomies as $alterTaxonomy) {
			array_push($alterArgs['tax_query'], array(
				'taxonomy' => $alterTaxonomy,
				'field' => 'slug',
				'terms' => $alterTerms
				)
			);
		}
	}

	if ($alterCategory) {
		array_push($alterArgs['tax_query'], array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $alterCategory
			)
		);
	}

	$alterQuery = new WP_Query($alterArgs);

	if ( $alterQuery->have_posts() ) { ?>
		<div class="container">
			<div class="row">
				<!-- <div class="col-12"> -->
				<!-- <?php
				if ($alterTermsLength > 1) {

					$resultMsg = "Resultat med taggarna " . str_replace(',', ', ', $_GET['terms']);	?>
					<?php 
					if ($alterCategory) {
						$resultMsg .= " och kategorin " . ucfirst(get_term_by('slug', $alterCategory, 'category')->name);
					} ?>

					<h3><?= $resultMsg; ?></h3> <?php 
					
				} else if($alterTermsLength == 1 && !empty($alterTerms[0])){
					$resultMsg = "Resultat med taggen " . $_GET['terms']; 

					if ($alterCategory) {
						$resultMsg .= " och kategorin " . ucfirst(get_term_by('slug', $alterCategory, 'category')->name);
					}
					?>
					<h3><?= $resultMsg; ?></h3>
					<?php 
				} else if (!empty($alterCategory)) { ?>
					<h3>Resultat med kategorin <?= ucfirst($alterCategory); ?></h3>
				<?php } ?> -->
				<!-- </div> -->

				<div class="col-12">
					<!-- POSTS -->
					<div class="post-container">
						<?php while ( $alterQuery->have_posts() ) { $alterQuery->the_post(); ?>

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

						<?php } wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="minor-margin"><?php get_template_part('/parts/help_bar'); ?></div>
<?php 
} else { ?>


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

<!-- SORT OF POSTS -->
<?php get_template_part('/parts/help_bar'); ?>

<?php if ($feedType == 'manual-feed'):

	$rowsToLoad = 10;
	$rowCounter = 0;

	?>

	<div class="container manual">
		<?php if( have_rows('feed') ):
		    while ( have_rows('feed') ) : the_row();
		    	if ($rowCounter >= $rowsToLoad) { ?>
		    		<div class="view-more-row hide">
		    		<?php 
		    		if( get_row_layout() == 'three_columns' ):
		    			get_template_part('parts/three_columns');
		    		elseif( get_row_layout() == 'two_columns' ): 
		    			get_template_part('parts/two_columns');
		    		endif;
		    		?>
		    		</div>
		    		<?php
		    	} else {
			        if( get_row_layout() == 'three_columns' ):
			        	get_template_part('parts/three_columns');
			        elseif( get_row_layout() == 'two_columns' ): 
			        	get_template_part('parts/two_columns');
			        endif;
		        }
		        $rowCounter++;
		    endwhile; ?>

		    <div class="loadmore-container">
		    	<div class="loadmore-manual">Visa mer</div>
		    </div>

		    <?php 
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

<?php } ?>