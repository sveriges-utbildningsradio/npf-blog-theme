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
	<?php echo do_shortcode( '[searchandfilter fields="post_tag,category" types="checkbox,radio" headings="Beteenden,Situationer" operators="OR" submit_label="Sök" empty_search_url="'. esc_url(home_url('/')) .'"]'); ?>

<?php endwhile; wp_reset_postdata(); ?>