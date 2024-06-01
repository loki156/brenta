<?php
/**
 * Brenta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Brenta
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.4' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function brenta_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Brenta, use a find and replace
		* to change 'brenta' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'brenta', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'brenta' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'brenta_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
}
add_action( 'after_setup_theme', 'brenta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brenta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'brenta_content_width', 640 );
}
add_action( 'after_setup_theme', 'brenta_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brentaaaa_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'brenta' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'brenta' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'brentaaaa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function brenta_scripts() {
	wp_enqueue_style( 'brenta-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'brenta-style', 'rtl', 'replace' );

	wp_enqueue_script( 'brenta-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brenta_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function mytheme_customize_controls_enqueue_scripts() {
    wp_enqueue_script(
        'mytheme-customizer-js', // Handle for the script.
        get_template_directory_uri() . '/js/customizer.js', // Path to the customizer.js file.
        array('jquery', 'customize-controls'), // Dependencies, ensure 'customize-controls' is included.
        null, // Version number, null means it will not append a version number.
        true  // In footer. It is important to set this to true to ensure it loads at the right time.
    );
}
add_action('customize_controls_enqueue_scripts', 'mytheme_customize_controls_enqueue_scripts');


function register_my_menus() {
    register_nav_menus(
        array(
            'mobile-menu' => __('Mobile Menu', 'your-theme-textdomain')
        )
    );
}
add_action('init', 'register_my_menus');

// Register header widget area
function brenta_widgets_init() {
    register_sidebar(array(
        'name'          => __('Header Widget', 'brenta'),
        'id'            => 'header-widget',
        'description'   => __('Widgets added here will appear in the header of the site.', 'brenta'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'brenta_widgets_init');

function mytheme_register_top_header_widgets() {
register_sidebar(array(
        'name'          => __('Top Header', 'mytheme'),
        'id'            => 'top-header',
        'description'   => __('Add widgets here to appear in your top header.', 'mytheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'mytheme_register_top_header_widgets');

function mytheme_register_footer_widgets() {
    for ($i = 1; $i <= 6; $i++) {
        register_sidebar(array(
            'name'          => "Footer Widget Area $i",
            'id'            => "footer-widget-$i",
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'mytheme_register_footer_widgets');

function mytheme_register_footer_bottom_widget() {
    register_sidebar(array(
        'name'          => 'Footer Bottom Widget',
        'id'            => 'footer-bottom-widget',
        'before_widget' => '<div class="footer-bottom-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'mytheme_register_footer_bottom_widget');

function mytheme_register_footer_top_widget() {
    register_sidebar(array(
        'name'          => 'Footer Top Widget',
        'id'            => 'footer-top-widget',
        'before_widget' => '<div class="footer-top-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'mytheme_register_footer_top_widget');

function mytheme_customize_register($wp_customize) { 
	// Add setting for logo width
	$wp_customize->add_setting('logo_width', array(
		'default' => 100,
		'transport' => 'postMessage',
	));

	// Add control for logo width
	$wp_customize->add_control('logo_width_control', array(
		'label' => __('Logo Width', 'your-theme'),
		'section' => 'title_tagline', // Ensure this is the correct section where you want the control
		'settings' => 'logo_width',
		'type'     => 'range',
		'input_attrs' => array(
			'min' => 50,
			'max' => 300,
			'step' => 1,
		),
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
            'label'    => __('Top Footer', 'mytheme'), // This will act as a title
            'section'  => 'footer_settings', // Ensure this is the correct section
            'settings' => 'display_top_footer_widget', // Reuse the setting to avoid creating a new one
            'type'     => 'hidden', // Use hidden type to create spacing and grouping effect
            'priority' => 10, // Adjust priority to control the order within the section
        )
    ));

// Add control for Display Top Footer Widget toggle
$wp_customize->add_control('display_top_footer_widget', array(
    'type'        => 'checkbox',
    'label'       => __('Display Top Footer Widget', 'mytheme'),
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
        'label' => __('Main Footer Top Padding', 'mytheme'),
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
        'label' => __('Main Footer Bottom Padding', 'mytheme'),
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
add_action('customize_register', 'mytheme_customize_register');
function your_theme_customize_preview_js() {
    wp_enqueue_script(
        'your-theme-customizer', // Handle for the script.
        get_template_directory_uri() . '/js/customizer.js', // Path to the script.
        array('jquery', 'customize-preview'), // Dependencies, includes jQuery and Customize Preview scripts.
        '', // Version number.
        true // Load in footer.
    );
}

add_action('customize_preview_init', 'your_theme_customize_preview_js');

function mytheme_sanitize_html_classes($input) {
    $classes = explode(" ", $input); // Split by spaces
    $sanitized_classes = array_map('sanitize_html_class', $classes); // Sanitize each class individually
    return implode(" ", $sanitized_classes); // Rejoin with spaces
}
