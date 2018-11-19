<div class="container">     
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 pb-5">
			<?php while (have_posts()) : the_post(); ?>
                <?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>

                <?php if($postsImg): ?>
                	<?php //The title for image alt/aria attribute ?>
					<?php $title = get_post(get_post_thumbnail_id())->post_title;  ?>
					
					<div class="post-img" style="background-image: url('<?php echo $postsImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>"></div>
				<?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>

			<?php endwhile; ?>
        </div>
    </div>
</div>