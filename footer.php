<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Brenta
 */

// Fetch padding values from the Customizer settings
$main_footer_top_padding = get_theme_mod('main_footer_top_padding', '20'); // Default value if not set
$main_footer_bottom_padding = get_theme_mod('main_footer_bottom_padding', '20'); // Default value if not set
?>

    <div class="hs-footer">
		<?php if (get_theme_mod('display_top_footer_widget', true)) : ?>
        <div class="footer-top">
            <div class="inner">
                <div class="gutter">
                    <?php if (is_active_sidebar('footer-top-widget')) : ?>
                        <?php dynamic_sidebar('footer-top-widget'); ?>
                    <?php endif; ?>
                </div><!-- end gutter -->
            </div><!-- end inner -->
        </div><!-- end footer top -->
    <?php endif; ?>
		 <div class="inner">
        <div class="main-gutter is--flex" style="padding-top: <?php echo esc_attr($main_footer_top_padding); ?>px; padding-bottom: <?php echo esc_attr($main_footer_bottom_padding); ?>px;">
            <?php
            $footer_columns = get_theme_mod('footer_columns', '1');
            $advanced_settings = get_theme_mod('footer_advanced_settings', false);
            for ($i = 1; $i <= $footer_columns; $i++) {
                $col_class = $advanced_settings ? get_theme_mod("footer_widget_area_col_$i", 'col-' . (12 / $footer_columns)) : 'col-' . (12 / $footer_columns);
                if (is_active_sidebar("footer-widget-$i")) {
                    echo "<div class='$col_class'>";
                    dynamic_sidebar("footer-widget-$i");
                    echo '</div>';
                }
            }
			
            ?>
        </div><!-- end main gutter -->
    </div><!-- end inner -->

    <div class="footer-btm">
        <div class="inner">
            <div class="gutter">
                <?php if (is_active_sidebar('footer-bottom-widget')) : ?>
                    <?php dynamic_sidebar('footer-bottom-widget'); ?>
                <?php endif; ?>
            </div><!-- end gutter -->
        </div><!-- end inner -->
    </div><!-- end footer btm -->
		</div><!-- end footer -->

<?php wp_footer(); ?>

</body>
</html>
