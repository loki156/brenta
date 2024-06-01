<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="cc-inner" class="site <?php echo 'has-' . get_theme_mod('site_alignment', 'right') . '-nav'; ?> <?php echo 'has-' . get_theme_mod('brenta_layout_width', 'medium') . '-layout'; ?>">
	
<div class="hs-header cc-clearover">
        <?php
        $top_header_display = get_theme_mod('top_header_display', true);
        $top_header_visibility = get_theme_mod('top_header_visibility', 'show_on_all');
        $top_header_alignment = get_theme_mod('top_header_alignment', 'left'); // Get the alignment setting

        if ($top_header_display): // Check if the top header should be displayed
        ?>
            <div class="hs-top-header <?php echo esc_attr($top_header_visibility); ?> <?php echo esc_attr($top_header_alignment); ?>">            <div class="inner is--flex add-10">
            <?php if (is_active_sidebar('top-header')) : ?>
                    <div class="top-header-content col-12">
                        <?php dynamic_sidebar('top-header'); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
        <?php endif; ?>
        <div class="inner is--flex add-10">
                    <div class="is-eq">
                            <div class="hs-logo">
                            <div class="custom-logo" style="width: <?php echo get_theme_mod('logo_width', 100); ?>px;">
    <?php
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
    if ( is_front_page() && is_home() ) :
    ?>
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <?php
    else :
    ?>
    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
    <?php
    endif;
    $brenta_description = get_bloginfo( 'description', 'display' );
    if ( $brenta_description || is_customize_preview() ) :
    ?>
    <p class="site-description"><?php echo $brenta_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    <?php endif; ?>
</div>
                        </div>
                    </div>

                    <div class="is--center">
                        <div class="hs-menu">
                            <div class="nav-options <?php 
                                echo 'size-' . get_theme_mod('navigation_font_size', '9') . ' ';
                                echo 'weight-' . get_theme_mod('navigation_font_weight', '400') . ' ';
                                $text_transform = get_theme_mod('navigation_text_transform', 'none');
                                if ($text_transform !== 'none') {
                                    echo 'is-' . $text_transform . ' ';
                                }
                                $letter_spacing = get_theme_mod('navigation_letter_spacing', '0');
                                echo 'is-letter-spacing-' . str_replace(['.', '-'], ['', 'm'], $letter_spacing) . ' ';
                                if (get_theme_mod('navigation_animated_underline', false)) {
                                    echo 'snip-nav ';  // Ensure 'snip-nav' is added when the toggle is enabled
                                    echo get_theme_mod('navigation_animated_styles', '--effect01') . ' ';
                                    echo get_theme_mod('navigation_line_height', '--line01') . ' ';
                                }
                                // Ensure there is always a space before the custom classes and only one space between them
                                $custom_class = get_theme_mod('navigation_custom_class', '');
                                if (!empty($custom_class)) {
                                    $custom_class = preg_replace('/\s+/', ' ', trim($custom_class)); // Replace multiple spaces with a single space
                                    echo ' ' . $custom_class; // Add a space before the custom class
                                }
                            ?>">
                                <nav>
                                    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="is--right is-eq">
                        <div class="is--left">
                            <div class="magic-field">
								<?php
        $header_widget_display = get_theme_mod('header_widget_display', true);
        $header_widget_visibility = get_theme_mod('header_widget_visibility', 'show_on_all');
       
        if ($header_widget_display): // Check if the top header should be displayed
        ?>
                               <div class="header-widget <?php echo esc_attr($header_widget_visibility); ?>">            
            <?php if (is_active_sidebar('header-widget')) : ?>
                    
                        <?php dynamic_sidebar('header-widget'); ?>
                   
                <?php endif; ?>
                
            
        </div>
        <?php endif; ?>
								
								
								
								
                            </div>
                        </div>

                        <div class="right-align is--flex no-padding">
                            <div class="sc-wrapper custom-basket-color size-11">
                                <!-- Shopping cart or other elements can be added here -->
                            </div>
							<!-- Mobile Navigation Toggle Button -->
                        <div class="button_container only-mobile" id="toggle">
                            <span class="top">&#160;</span>
                            <span class="middle">&#160;</span>
                            <span class="bottom">&#160;</span>
                        </div>
							<!-- Mobile Navigation Overlay -->
                        <div class="overlay" id="overlay">
                            <div class="inner">
                                <div class="left-align w-100">
                                    <div class="is--left add-top-30">
                                        <div class="magic-field g-font">
                                            <!-- Additional elements can be added here if needed -->
                                        </div>
                                    </div>

                                    <div class="m-wrapper g-font size-25 weight-500 add-top-30">
                                        <div class="jmd-nav mobile-nav col-12 center-align">
                                            <div class="nav-mobile-options weight-600 size-16">
                                                <?php
                                                wp_nav_menu(array(
                                                    'theme_location' => 'mobile-menu', // ensure 'mobile-menu' is registered in functions.php
                                                    'menu_class'     => 'mobile-menu-class', // add your menu class here
                                                    'container'      => false // no container wrapping the ul
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">



<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggle');
    var overlay = document.getElementById('overlay');

    toggleButton.addEventListener('click', function() {
        this.classList.toggle('active');
        overlay.classList.toggle('open');
    });
});
</script>

  
