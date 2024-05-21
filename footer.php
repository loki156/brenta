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

?>

	<div class="hs-footer">
    <div class="inner is--flex">
        
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
        
    </div><!-- end inner -->
</div><!-- end footer -->

<?php wp_footer(); ?>

</body>
</html>
