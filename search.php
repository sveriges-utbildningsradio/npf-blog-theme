<?php
/* Template Name: Custom Search */
global $wp_query;
?>
<div class="container">     
    <div class="row">
        <div class="col-12 pb-5">
            <?php if ( have_posts() && $s != ''): ?> 
                <h2>Sökresultatet för <span class="orange"><?php echo "$s"; ?></span></h2>

                <div class="row pt-4 pt-md-5">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-12 col-md-4">
                            <a class="layer-effect" aria-label="UR Föräldrar inlägg" href="<?php the_permalink(); ?>">   
                                <?php $postsImg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); ?>

                                <?php if($postsImg): ?>
                                    <?php //The title for image alt/aria attribute ?>
                                    <?php $title = get_post(get_post_thumbnail_id())->post_title;  ?> 
                                    
                                    <div class="layer-container">
                                        <div class="post-img" style="background-image: url('<?php echo $postsImg[0];?>');" role="img" alt="<?php echo $title ?>" aria-label="<?php echo $title ?>"></div>
                                        <div class="layer"></div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-content">
                                    <h4><?php the_title(); ?></h4>
                                </div>
                            </a>                      
                        </div>
                    <?php endwhile; ?>
                </div>
                <h3 class="pt-5">Hittade du inte det du sökte? Sök igen!</h3>
                <div class="search-form pt-4"><?php get_search_form(); ?></div>
            <?php else: ?>
                <h2>Tyvärr fanns det ingenting på sin sökning <span class="orange"><?php echo "$s"; ?></span>, testa igen!</h2>
                <div class="search-form pt-4"><?php get_search_form(); ?></div>

            <?php endif; ?>
        </div>
    </div>
</div>