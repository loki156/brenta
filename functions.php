<?php
/**
 * Brenta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Brenta
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
	// Replace the version number of the theme on each release.
	define( 'BRENTA_VERSION', '1.0.6' );


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

   // Add theme support for default Wordpress features.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status' ) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'brenta' ),
		)
	);
	
    // Register a separate mobile menu	
    register_nav_menus(
        array(
            'mobile-menu' => __('Mobile Menu', 'brenta')
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

// default underscore theme sidebar
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

    // Register top header widget area
function brenta_register_top_header_widgets() {
register_sidebar(array(
        'name'          => __('Top Header', 'brenta'),
        'id'            => 'top-header',
        'description'   => __('Add widgets here to appear in your top header.', 'brenta'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'brenta_register_top_header_widgets');


	// Register header widget area
function brenta_register_header_widgets() {
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
add_action('widgets_init', 'brenta_register_header_widgets');

	// Register footer widget area
function brenta_register_footer_widgets() {
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
add_action('widgets_init', 'brenta_register_footer_widgets');

function brenta_register_footer_top_widget() {
    register_sidebar(array(
        'name'          => 'Footer Top Widget',
        'id'            => 'footer-top-widget',
        'before_widget' => '<div class="footer-top-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'brenta_register_footer_top_widget');

function brenta_register_footer_bottom_widget() {
    register_sidebar(array(
        'name'          => 'Footer Bottom Widget',
        'id'            => 'footer-bottom-widget',
        'before_widget' => '<div class="footer-bottom-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'brenta_register_footer_bottom_widget');
	

/**
 * Enqueue scripts and styles.
 */
function brenta_scripts() {
	wp_enqueue_style( 'brenta-style', get_stylesheet_uri(), array(), BRENTA_VERSION );
	wp_style_add_data( 'brenta-style', 'rtl', 'replace' );

	wp_enqueue_script( 'brenta-navigation', get_template_directory_uri() . '/js/navigation.js', array(), BRENTA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brenta_scripts' );

/**
 * Implement the Custom Header feature.
 
require get_template_directory() . '/inc/custom-header.php';
*/


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

function brenta_customize_controls_enqueue_scripts() {
    wp_enqueue_script(
        'brenta-customizer-js', // Handle for the script.
        get_template_directory_uri() . '/js/customizer.js', // Path to the customizer.js file.
        array('jquery', 'customize-controls'), // Dependencies, ensure 'customize-controls' is included.
        null, // Version number, null means it will not append a version number.
        true  // In footer. It is important to set this to true to ensure it loads at the right time.
    );
}
add_action('customize_controls_enqueue_scripts', 'brenta_customize_controls_enqueue_scripts');


