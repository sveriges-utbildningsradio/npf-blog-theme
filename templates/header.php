<header>
    <a class="logo-hover" aria-label="UR Logo" href="<?= esc_url(home_url('/')); ?>">
        <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'small' );
        ?>
        <img class="logo" alt="UR Logo" src="<?php echo $image[0]; ?>"> 
    </a>
    <h1 class="tagline"><?php bloginfo('description'); ?></h1>

    <div class="search-form header-search"><?php get_search_form(); ?></div>

    <a href="#" arai-label="Menu" class="mobile-menu">
        <img class="bars" alt="Menu open" src="<?php echo get_template_directory_uri(); ?>/dist/images/menu.svg">
        <img class="times" alt="Menu close" src="<?php echo get_template_directory_uri(); ?>/dist/images/exit.svg">
    </a>

    <div class="navigation">
        <div class="search-form mobile-search"><?php get_search_form(); ?></div>
        <nav>
            <?php
            if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
        </nav>
    </div>
</header>
