/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery(document).ready(function($) {
    // Modify the label to include a span for dynamic width display
    var label = $('#customize-control-logo_width_control .customize-control-title');
    if (label.length) {
        label.html('Logo Width: <span class="width-value">100px</span>'); // Initialize with default value
    }

    // Update the span when the control value changes
    wp.customize('logo_width', function(value) {
        value.bind(function(newVal) {
            $('.width-value').text(newVal + 'px'); // Update the label text dynamically
            $('.custom-logo').css('width', newVal + 'px'); // Also update the actual logo width
        });
    });

    // Main Footer Top Padding
    wp.customize('main_footer_top_padding', function(value) {
        value.bind(function(newval) {
            $('.hs-footer .gutter').css('padding-top', newval + 'px');
        });
    });

    // Main Footer Bottom Padding
    wp.customize('main_footer_bottom_padding', function(value) {
        value.bind(function(newval) {
            $('.hs-footer .gutter').css('padding-bottom', newval + 'px');
        });
    });
});

