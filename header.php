<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="cc-inner" class="site <?php echo 'has-' . get_theme_mod('site_alignment', 'right') . '-nav'; ?>">
    <header id="masthead" class="site-header">
        <div class="hs-header cc-clearover">
        <?php if (get_theme_mod('top_header_display', true)) : ?>
            <div class="hs-top-header">
                <div class="inner is--flex add-10">
                    <?php if (!get_theme_mod('hide_top_left_header', false) && is_active_sidebar('top-left-header')) : ?>
                        <div class="left-align top-left-header col-6">
                            <?php dynamic_sidebar('top-left-header'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!get_theme_mod('hide_top_right_header', false) && is_active_sidebar('top-right-header')) : ?>
                        <div class="right-align top-right-header col-6">
                            <?php dynamic_sidebar('top-right-header'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

            <div class="inner is--flex add-10">
                
                    <div class="is-eq">
                      
                            <div class="hs-logo w-100 add-top-15 add-btm-15">
                                <div class="custom-logo" style="width: <?php echo get_theme_mod('logo_width', 100); ?>px;">
                                    <?php
                                    if ( function_exists( 'the_custom_logo' ) ) {
                                        the_custom_logo();
                                    }
                                    ?>
                               
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
                        <div class="is--left hide-mobile">
                            <div class="magic-field g-font">
                                <?php if (get_theme_mod('header_widget_visibility', true) && is_active_sidebar('header-widget')) : ?>
                                    <?php dynamic_sidebar('header-widget'); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="right-align is--flex no-padding">
                            <div class="sc-wrapper custom-basket-color size-11">
                                <!-- Shopping cart or other elements can be added here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
    </header><!-- #masthead -->

    <div id="content" class="site-content">

