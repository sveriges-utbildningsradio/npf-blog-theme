<?php
/**
 * Template Name: Länkar
 */
?>
<div class="container">     
    <div class="row">
        <div class="col-12 pb-5">

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

            <?php if( have_rows('links') ): ?>
                <div class="row pt-5">

                    <?php while ( have_rows('links') ) : the_row() ; ?>
                        <div class="col-12 col-md-4">
                            <?php
                            $title = get_sub_field('titel');
                            $txt = get_sub_field('text');
                            $link = get_sub_field('link');
                            $image = get_sub_field('image');
                            ?>
                            <a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php echo $link ?>">
                                <div class="layer-container">
                                    <?php if($image): ?>
                                        <div class="post-img" style="background-image: url('<?php echo $image['sizes']['medium']?>');" role="img" alt="<?php echo $image['title'] ?>" aria-label="<?php echo $image['title'] ?>"></div>
                                    <?php endif; ?>
                                    <div class="layer"></div>
                                </div>
                                
                                <div class="post-content">
                                    <h4><?php echo $title; ?></h4>
                                    <p><?php echo $txt; ?></p>
                                </div>
                            </a>                      
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>