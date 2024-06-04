<?php
/**
 * Brenta Theme Customizer
 *
 * @package Brenta
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function brenta_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'brenta_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'brenta_customize_partial_blogdescription',
			)
		);
	}
	
	// Add setting for logo width
	$wp_customize->add_setting('logo_width', array(
		'default' => 100,
		'transport' => 'postMessage',
	));

	// Add control for logo width
	$wp_customize->add_control('logo_width_control', array(
		'label' => __('Logo Width', 'brenta'),
		'section' => 'title_tagline', // Ensure this is the correct section where you want the control
		'settings' => 'logo_width',
		'type'     => 'range',
		'input_attrs' => array(
			'min' => 50,
			'max' => 500,
			'step' => 1,
		),
	));
	
	// Add setting for displaying site title and tagline
$wp_customize->add_setting('display_site_title_tagline', array(
    'default' => false,
    'transport' => 'refresh',
));

// Add control for displaying site title and tagline
$wp_customize->add_control('display_site_title_tagline_control', array(
    'label' => __('Display Site Title and Tagline', 'brenta'),
    'section' => 'title_tagline', // Adjust the section as needed
    'settings' => 'display_site_title_tagline',
    'type' => 'checkbox',
));
	
    // Add setting for Display Top Footer Widget toggle
$wp_customize->add_setting('display_top_footer_widget', array(
    'default'           => true,
    'transport'         => 'refresh',
    'sanitize_callback' => 'wp_validate_boolean',
));
	
	// Add a pseudo-control for the title "Top Footer"
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'top_footer_title_control',
        array(
            'label'    => __('Top Footer', 'brenta'), // This will act as a title
            'section'  => 'footer_settings', // Ensure this is the correct section
            'settings' => 'display_top_footer_widget', // Reuse the setting to avoid creating a new one
            'type'     => 'hidden', // Use hidden type to create spacing and grouping effect
            'priority' => 10, // Adjust priority to control the order within the section
        )
    ));

// Add control for Display Top Footer Widget toggle
$wp_customize->add_control('display_top_footer_widget', array(
    'type'        => 'checkbox',
    'label'       => __('Display Top Footer Widget', 'brenta'),
    'section'     => 'footer_settings',
    'settings'    => 'display_top_footer_widget',
));
	
	 // Main Footer Top Padding
    $wp_customize->add_setting('main_footer_top_padding', array(
        'default' => 20,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('main_footer_top_padding', array(
        'type' => 'range',
        'section' => 'footer_settings',
        'label' => __('Main Footer Top Padding', 'brenta'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    ));

    // Main Footer Bottom Padding
    $wp_customize->add_setting('main_footer_bottom_padding', array(
        'default' => 20,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('main_footer_bottom_padding', array(
        'type' => 'range',
        'section' => 'footer_settings',
        'label' => __('Main Footer Bottom Padding', 'brenta'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    ));
    
    // Add Panel for Template Settings
    $wp_customize->add_panel('template_settings_panel', array(
        'title'    => __('Template Settings', 'mytheme'),
        'priority' => 25,
    ));
     // Add new section for Page Settings under the Template Settings panel
     $wp_customize->add_section('page_settings', array(
        'title'    => __('Page Settings', 'mytheme'),
        'panel'    => 'template_settings_panel', // Ensure this ID matches the panel ID
        'priority' => 160,
    ));

    // Add setting for custom classes
    $wp_customize->add_setting('page_custom_classes', array(
        'default'   => '',
        'transport' => 'refresh', // Change to refresh if not using postMessage with JS
        'sanitize_callback' => 'mytheme_sanitize_html_classes',
    ));

    // Add control for custom classes
    $wp_customize->add_control('page_custom_classes_control', array(
        'label'    => __('Custom Classes for Main Element', 'mytheme'),
        'section'  => 'page_settings',
        'settings' => 'page_custom_classes',
        'type'     => 'text',
    ));
    // Add a custom title for Top Header settings
    $wp_customize->add_setting('top_header_title', array(
        'sanitize_callback' => 'sanitize_text_field', // Ensures safe text is stored
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'top_header_title',
        array(
            'label'    => __('Top Header', 'mytheme'),
            'section'  => 'global_settings',
            'settings' => 'top_header_title',
            'type'     => 'hidden', // Hidden type just to use it as a separator with a title
            'priority' => 19, // Set the priority to appear before the top header settings
        )
    ));

    // Setting for displaying the top header
    $wp_customize->add_setting('top_header_display', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'top_header_display_control',
        array(
            'label'    => __('Display Top Header', 'mytheme'),
            'section'  => 'global_settings',
            'settings' => 'top_header_display',
            'type'     => 'checkbox',
            'priority' => 20,
        )
    ));

    // Add setting for Top Header Visibility
    $wp_customize->add_setting('top_header_visibility', array(
        'default'   => 'show_on_all',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for Top Header Visibility
    $wp_customize->add_control('top_header_visibility_control', array(
        'label'    => __('Visibility', 'mytheme'),
        'section'  => 'global_settings',
        'settings' => 'top_header_visibility',
        'type'     => 'select',
        'choices'  => array(
            'show_on_all' => 'Show on all devices',
            'hide_on_tablet' => 'Hide on tablet',
            'hide_on_mobile' => 'Hide on mobile',
            'hide_on_tablet_mobile' => 'Hide on tablet & mobile',
        ),
        'priority' => 21,
    ));
	// Add setting for Top Header Alignment
    $wp_customize->add_setting('top_header_alignment', array(
        'default'   => 'left',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for Top Header Alignment
    $wp_customize->add_control('top_header_alignment_control', array(
        'label'    => __('Alignment', 'mytheme'),
        'section'  => 'global_settings',
        'settings' => 'top_header_alignment',
        'type'     => 'select',
        'choices'  => array(
            'left' => 'Left',
            'right' => 'Right',
            'center' => 'Center',
            'left-right-mobile' => 'Left on Desktop, Right on Mobile',
            'right-left-mobile' => 'Right on Desktop, Left on Mobile'
        ),
        'priority' => 22,
    ));
	
	// New settings moved from functions.php
    $wp_customize->add_setting('brenta_layout_width', array(
        'default'           => 'medium',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('brenta_layout_width_control', array(
        'label'    => __('Layout Width', 'brenta'),
        'section'  => 'global_settings',
        'settings' => 'brenta_layout_width',
        'type'     => 'select',
        'choices'  => array(
            'small'       => __('Small (800px)', 'mytheme'),
            'medium'      => __('Medium (980px)', 'mytheme'),
            'large'       => __('Large (1170px)', 'mytheme'),
            'extra_large' => __('Extra Large (1400px)', 'mytheme'),
            'full_width'  => __('Full Width (100%)', 'mytheme'),
        ),
        'priority' => 10,
    ));

    // Add Section for Navigation Styles
    $wp_customize->add_section('navigation_settings', array(
        'title'    => __('Navigation Styles', 'mytheme'),
        'panel'    => 'template_settings_panel',
        'priority' => 20,
    ));

    // Add Setting for Navigation Alignment in Global Settings
    $wp_customize->add_setting('site_alignment', array(
        'default'   => 'right',
        'transport' => 'refresh',
    ));

    // Add Control for Navigation Alignment
    $wp_customize->add_control('site_alignment_control', array(
        'label'    => __('Navigation Alignment', 'mytheme'),
        'section'  => 'global_settings',
        'settings' => 'site_alignment',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('Left Align', 'mytheme'),
            'center' => __('Center Align', 'mytheme'),
            'right'  => __('Right Align', 'mytheme')
        ),
    ));
	

    // Add Setting for Navigation Font Size
    $wp_customize->add_setting('navigation_font_size', array(
        'default'   => '9px',
        'transport' => 'refresh',
    ));

    // Add Control for Navigation Font Size
    $wp_customize->add_control('navigation_font_size_control', array(
        'label'    => __('Font Size', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_font_size',
        'type'     => 'select',
        'choices'  => array_combine(range(9, 30), array_map(function($size) { return $size . 'px'; }, range(9, 30))) // Creates options from 9px to 30px with "px" suffix
    ));

    // Add Setting for Navigation Font Weight
    $wp_customize->add_setting('navigation_font_weight', array(
        'default'   => '400', // Default value for font weight
        'transport' => 'refresh',
    ));

    // Add Control for Navigation Font Weight
    $wp_customize->add_control('navigation_font_weight_control', array(
        'label'    => __('Font Weight', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_font_weight',
        'type'     => 'select',
        'choices'  => array(
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900'
        ),
    ));

    // Add Setting for Navigation Text Transform
    $wp_customize->add_setting('navigation_text_transform', array(
        'default'   => 'none', // Default value for text transform
        'transport' => 'refresh',
    ));

    // Add Control for Navigation Text Transform
    $wp_customize->add_control('navigation_text_transform_control', array(
        'label'    => __('Text Transform', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_text_transform',
        'type'     => 'select',
        'choices'  => array(
            'none'       => 'None',
            'uppercase'  => 'Uppercase',
            'lowercase'  => 'Lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    // Add Setting for Navigation Letter Spacing
    $wp_customize->add_setting('navigation_letter_spacing', array(
        'default'   => '0',
        'transport' => 'refresh',
    ));

    // Generate choices for letter spacing
    $spacing_values = array_merge(range(-1, -0.1, 0.1), range(0, 2, 0.1));
    $spacing_choices = array();
    foreach ($spacing_values as $value) {
        $key = str_replace('.', '', (string)$value);
        $key = str_replace('-', 'm', $key); // Replace negative sign with 'm' for minus
        $spacing_choices[$key] = $value . 'px';
    }

    // Add Control for Navigation Letter Spacing
    $wp_customize->add_control('navigation_letter_spacing_control', array(
        'label'    => __('Letter Spacing', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_letter_spacing',
        'type'     => 'select',
        'choices'  => $spacing_choices,
    ));

    // Add Setting for Navigation Animated Underline Toggle
    $wp_customize->add_setting('navigation_animated_underline', array(
        'default'   => false,
        'transport' => 'refresh',
    ));

    // Add Control for Navigation Animated Underline Toggle
    $wp_customize->add_control('navigation_animated_underline_control', array(
        'label'    => __('Enable Underline Styles', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_animated_underline',
        'type'     => 'checkbox',
    ));

    // Add Setting for Animated Styles
    $wp_customize->add_setting('navigation_animated_styles', array(
        'default'   => '--effect01',
        'transport' => 'refresh',
    ));

    // Add Control for Animated Styles
    $wp_customize->add_control('navigation_animated_styles_control', array(
        'label'    => __('Animated Styles', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_animated_styles',
        'type'     => 'select',
        'choices'  => [
            '--effect01' => 'Style 1',
            '--effect02' => 'Style 2',
            '--effect03' => 'Style 3',
            '--effect04' => 'Style 4',
            '--effect05' => 'Style 5',
        ],
        'active_callback' => function() {
            return get_theme_mod('navigation_animated_underline', false);
        }
    ));

    // Add Setting for Line Height
    $wp_customize->add_setting('navigation_line_height', array(
        'default'   => '--line01',
        'transport' => 'refresh',
    ));

    // Add Control for Line Height
    $wp_customize->add_control('navigation_line_height_control', array(
        'label'    => __('Line Height', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_line_height',
        'type'     => 'select',
        'choices'  => [
            '--line01' => '1px',
            '--line02' => '2px',
            '--line03' => '3px',
            '--line04' => '4px',
            '--line05' => '5px',
        ],
        'active_callback' => function() {
            return get_theme_mod('navigation_animated_underline', false);
        }
    ));

    // Add Setting for Custom Class
    $wp_customize->add_setting('navigation_custom_class', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mytheme_sanitize_html_classes', // Custom sanitization function
    ));

    // Add Control for Custom Class
    $wp_customize->add_control('navigation_custom_class_control', array(
        'label'    => __('Add Custom Class', 'mytheme'),
        'section'  => 'navigation_settings',
        'settings' => 'navigation_custom_class',
        'type'     => 'text',
        'description' => 'Enter a custom class to add to the navigation options.',
    ));

// Setting for displaying the top header
    $wp_customize->add_setting('top_header_display', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'top_header_display_control',
        array(
            'label'    => __('Display Top Header', 'mytheme'),
            'section'  => 'global_settings',
            'settings' => 'top_header_display',
            'type'     => 'checkbox',
            'priority' => 20,
        )
    ));

// Add Setting for Display Header Widget Toggle
    $wp_customize->add_setting('header_widget_display', array(
        'default'   => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_validate_boolean',
    ));
	
	// Add a pseudo-control for the title "Header Widgets"
 $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'header_widget_title_control',
    array(
        'label'    => __('Header Widgets', 'mytheme'), // This will act as a title
        'section'  => 'global_settings', // Make sure this is the correct section
        'settings' => 'header_widget_display', // Reuse the setting to avoid creating a new one
        'type'     => 'hidden', // Use hidden type to create spacing and grouping effect
        'priority' => 30, // Adjust priority to control the order within the section
    )
));

    // Add Control for Display Header Widget Toggle Switch
    $wp_customize->add_control('header_widget_display_control', array(
        'label'    => __('Display Header Widget', 'mytheme'),
        'section'  => 'global_settings',
        'settings' => 'header_widget_display',
        'type'     => 'checkbox',
        'priority' => 31,
    ));

    // Add setting for Header Widget Visibility
    $wp_customize->add_setting('header_widget_visibility', array(
        'default'   => 'hide_on_mobile',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for Header Widget Visibility
    $wp_customize->add_control('header_widget_visibility_control', array(
        'label'    => __('Visibility', 'mytheme'),
        'section'  => 'global_settings',
        'settings' => 'header_widget_visibility',
        'type'     => 'select',
        'choices'  => array(
            'show_on_all' => 'Display on all devices',
            'hide_on_tablet' => 'Hide on tablet',
            'hide_on_mobile' => 'Hide on mobile',
            'hide_on_tablet_mobile' => 'Hide on tablet & mobile',
        ),
        'priority' => 32,
    ));
	
// Add Section for Global Settings
$wp_customize->add_section('global_settings', array(
    'title'    => __('Global Settings', 'mytheme'),
    'panel'    => 'template_settings_panel',
    'priority' => 10,
));
 // Add Footer Settings section
 $wp_customize->add_section('footer_settings', array(
    'title'    => __('Footer Settings', 'mytheme'),
    'panel'    => 'template_settings_panel',
    'priority' => 160,
));

// Add setting for Footer Columns
$wp_customize->add_setting('footer_columns', array(
    'default'           => '1',
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
));

// Add control for Footer Columns
$wp_customize->add_control('footer_columns', array(
    'type'    => 'select',
    'label'   => __('Display Columns', 'mytheme'),
    'section' => 'footer_settings',
	'description' => 'Display columns in the main footer section',
    'choices' => array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
    ),
));

// Add setting for Advanced Settings toggle
$wp_customize->add_setting('footer_advanced_settings', array(
    'default'           => false,
    'transport'         => 'refresh',
    'sanitize_callback' => 'wp_validate_boolean',
));

// Add control for Advanced Settings toggle
$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'footer_advanced_settings',
    array(
        'label'       => __('Advanced Settings', 'mytheme'),
        'section'     => 'footer_settings',
        'settings'    => 'footer_advanced_settings',
        'type'        => 'checkbox',
        
    )
));

$footer_columns = get_theme_mod('footer_columns', '1');
for ($i = 1; $i <= 6; $i++) {
    $wp_customize->add_setting("footer_widget_area_col_$i", array(
        'default'           => 'col-' . (12 / $footer_columns),
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control("footer_widget_area_col_$i", array(
        'label'       => __("Footer Widget Area $i", 'mytheme'),
        'section'     => 'footer_settings',
        'settings'    => "footer_widget_area_col_$i",
        'type'        => 'select',
        'choices'     => array(
            'col-1' => 'col-1',
            'col-2' => 'col-2',
            'col-3' => 'col-3',
            'col-4' => 'col-4',
            'col-5' => 'col-5',
            'col-6' => 'col-6',
            'col-7' => 'col-7',
            'col-8' => 'col-8',
            'col-9' => 'col-9',
            'col-10' => 'col-10',
            'col-11' => 'col-11',
            'col-12' => 'col-12',
        ),
        'active_callback' => function() {
            return get_theme_mod('footer_advanced_settings', false);
        }
    ));
}
}
add_action('customize_register', 'brenta_customize_register');

function brenta_customize_preview_js() {
    wp_enqueue_script(
        'brenta-customizer', // Handle for the script.
        get_template_directory_uri() . '/js/customizer.js', // Path to the script.
        array('jquery', 'customize-preview'), // Dependencies, includes jQuery and Customize Preview scripts.
        '', // Version number.
        true // Load in footer.
    );
}

add_action('customize_preview_init', 'brenta_customize_preview_js');

function mytheme_sanitize_html_classes($input) {
    $classes = explode(" ", $input); // Split by spaces
    $sanitized_classes = array_map('sanitize_html_class', $classes); // Sanitize each class individually
    return implode(" ", $sanitized_classes); // Rejoin with spaces
}
