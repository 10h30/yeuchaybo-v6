<?php
/**
 * Yeu Chay Bo
 *
 * This file sets up the Yeu Chay Bo Theme.
 *
 * @package   SEOThemes\CorporatePro
 * @link      https://thuanbui.me/themes/yeuchaybo
 * @author    Thuan Bui
 * @copyright Copyright © 2018 Thuan Bui
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

$child_theme = wp_get_theme();

// Define theme constants (do not remove).
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

// Load Genesis Framework (do not remove).
require_once get_template_directory() . '/lib/init.php';

// Set Localization (do not remove).
load_child_theme_textdomain( CHILD_TEXT_DOMAIN, apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/languages', CHILD_TEXT_DOMAIN ) );

// Enable support for page excerpts.
add_post_type_support( 'page', 'excerpt' );

//Add post type archive support for event
add_post_type_support( 'event', 'genesis-cpt-archives-settings' );


// Enable support for Gutenberg wide images.
add_theme_support( 'align-wide' );

// Enable support for WooCommerce.
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Add portfolio image size.
//add_image_size( 'portfolio', 620, 380, true );

// Add slider image size (incase SEO slider not active).
add_image_size( 'slider', 1280, 720, true );

//* Add image sizes
add_image_size( 'homepage-large', 1200, 600, true );
add_image_size( 'homepage-medium', 640, 360, true );
add_image_size( 'homepage-small', 400, 225, true );

// Enable support for structural wraps.
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'menu-primary',
	'menu-secondary',
	'footer-widgets',
) );

// Enable Accessibility support.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
) );

// Enable custom navigation menus.
add_theme_support( 'genesis-menus', array(
	'primary'   => __( 'Header Menu', 'yeuchaybo' ),
	'secondary' => __( 'After Header Menu', 'yeuchaybo' ),
) );

// Enable viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Enable footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Enable support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Enable HTML5 markup structure.
add_theme_support( 'html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
) );

// Enable support for post formats.
add_theme_support( 'post-formats', array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video',
) );

// Enable support for post thumbnails.
add_theme_support( 'post-thumbnails' );

// Enable automatic output of WordPress title tags.
add_theme_support( 'title-tag' );

// Enable selective refresh and Customizer edit icons.
add_theme_support( 'customize-selective-refresh-widgets' );

// Enable theme support for custom background image.
add_theme_support( 'custom-background', array(
	'default-color' => '#fdfeff',
) );

// Sets the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1000; // Pixels.
}

// Enable logo option in Customizer > Site Identity.
add_theme_support( 'custom-logo', array(
	'height'      => 60,
	'width'       => 240,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( '.site-title', '.site-description' ),
) );

// Display custom logo in site title area.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Enable support for custom header image or video.
add_theme_support( 'custom-header', array(
	'header-selector'    => '.hero-section',
	'default-image'      => CHILD_THEME_URI . '/assets/images/hero.jpg',
	'header-text'        => true,
	'default-text-color' => '#2a3139',
	'width'              => 1280,
	'height'             => 720,
	'flex-height'        => true,
	'flex-width'         => true,
	'uploads'            => true,
	'video'              => true,
	'wp-head-callback'   => 'corporate_custom_header',
) );

// Register default header (just in case).
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Image', 'yeuchaybo' ),
	),
) );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove unused site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Change order of main stylesheet to override plugin styles.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_title_area', 'genesis_do_nav' );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after_header_wrap', 'genesis_do_subnav' );

// Reposition the breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'corporate_hero_section', 'genesis_do_breadcrumbs', 30 );

// Reposition featured image.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_post_content', 'genesis_do_post_image' );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

// Reposition footer widgets inside site footer.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas', 14 );

// Remove footer credits.
remove_action( 'genesis_footer', 'genesis_do_footer' );

// Remove Genesis Portfolio Pro default styles.
add_filter( 'genesis_portfolio_load_default_styles', '__return_false' );

// Remove one click demo branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// Enable shortcodes in text widgets.
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'wp_enqueue_scripts', 'corporate_scripts_styles', 90 );
/**
 * Enqueue theme scripts and styles.
 *
 * @since  1.0.0
 *
 * @return void
 */
function corporate_scripts_styles() {

	// Remove Simple Social Icons CSS (included with theme).
	wp_dequeue_style( 'simple-social-icons-font' );

	// Enqueue custom Google fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Nunito+Sans:400,600,700', array(), CHILD_THEME_VERSION );

	// Conditionally load WooCommerce styles.
	if ( corporate_is_woocommerce_page() ) {

		wp_enqueue_style( CHILD_TEXT_DOMAIN . '-woocommerce', CHILD_THEME_URI . '/woocommerce.css', array(), CHILD_THEME_VERSION );

	}

	// Conditionally load slider scripts.
	if ( ! class_exists( 'SEO_Slider_Widget' ) ) {

		wp_enqueue_script( CHILD_TEXT_DOMAIN . '-modernizr', CHILD_THEME_URI . '/assets/scripts/min/modernizr.min.js', array( 'jquery' ), '3.5.0', true );

		wp_enqueue_script( CHILD_TEXT_DOMAIN . '-slick', CHILD_THEME_URI . '/assets/scripts/min/slick.min.js', array( 'jquery' ), '1.8.1', true );

	}

	// Enqueue Font-Awesome 5
	wp_enqueue_script( 'font-awesome-free', '//use.fontawesome.com/releases/v5.3.1/js/fontawesome.js', array(), null );
	wp_enqueue_script( 'font-awesome-brand', '//use.fontawesome.com/releases/v5.3.1/js/brands.js', array(), null );


	// Enqueue custom theme scripts.
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-pro', CHILD_THEME_URI . '/assets/scripts/min/theme.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Enqueue responsive menu script.
	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-menus', CHILD_THEME_URI . '/assets/scripts/min/menus.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Disable superfish args.
	wp_deregister_script( 'superfish-args' );

	// Localize responsive menus script.
	wp_localize_script( CHILD_TEXT_DOMAIN . '-menus', 'genesis_responsive_menu', array(
		'mainMenu'         => '',
		'subMenu'          => '',
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
	) );
}

// Load helper functions.
require_once CHILD_THEME_DIR . '/includes/helpers.php';

// Load general functions.
require_once CHILD_THEME_DIR . '/includes/general.php';

// Load widget areas.
require_once CHILD_THEME_DIR . '/includes/widgets.php';

// Load hero section.
require_once CHILD_THEME_DIR . '/includes/hero.php';

// Load Customizer settings.
require_once CHILD_THEME_DIR . '/includes/customize.php';

// Load default settings.
require_once CHILD_THEME_DIR . '/includes/defaults.php';

// Load recommended plugins.
require_once CHILD_THEME_DIR . '/includes/plugins.php';

add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
/**
 * Filter the HTML script tag of `font-awesome` script to add `defer` attribute.
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return   Filtered HTML script tag.
 */
function add_defer_attribute( $tag, $handle ) {

    if ( 'font-awesome' === $handle ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }

    return $tag;

}

/**********************************
 *
 * Replace Header Site Title with Inline Logo
 *
 * @author AlphaBlossom / Tony Eppright, Neil Gee
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 * @link https://wpbeaches.com/adding-in-a-responsive-html-logoimage-header-via-the-customizer-for-genesis/
 *
 * @edited by Sridhar Katakam
 * @link https://sridharkatakam.com/
 *
************************************/
add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
function custom_header_inline_logo( $title, $inside, $wrap ) {

    $logo = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="40" viewBox="0 0 303.5 62.5">
                <style type="text/css">
                	
                </style>
                <path class="ycblogo" d="M11.9 15.2l2.4 7.1c0.1 0.4 0.2 1.1 0.3 2.2 0.1 1.1 0.2 2.1 0.2 3.1 0.6-2.7 1.2-4.4 1.6-5.3l3.9-7.1h11.9L19.5 34.8l-1.6 15.2H7.1l1.5-15.2L0 15.2H11.9z"/>
                <path class="ycblogo" d="M87 35.7c-0.1 1.3-0.3 2.4-0.4 3.2 -0.1 0.9-0.5 2.2-1 4 -0.5 1.8-2.2 3.6-4.9 5.3 -2.7 1.7-6 2.5-9.8 2.5 -4.1 0-7.3-0.9-9.6-2.8 -2.4-1.9-3.5-4.5-3.5-7.8l0.2-4.4L60.1 15.2h10.8l-2.1 19.8 -0.1 2.4c0 0.9 0.3 1.7 0.9 2.2 0.6 0.5 1.4 0.8 2.4 0.8 1.3 0 2.3-0.3 2.8-0.9 0.6-0.6 0.9-1.2 1.1-1.7 0.1-0.5 0.3-1.4 0.5-2.8l2-19.8h10.8L87 35.7z"/>
                <path class="ycblogo" d="M126.7 27.1c-1.8-1.4-3.7-2-5.7-2 -2.4 0-4.5 0.8-6.1 2.5 -1.7 1.6-2.5 3.6-2.5 6 0 2.1 0.7 3.7 2 5 1.3 1.3 3 1.9 5.1 1.9 0.6 0 1.1 0 1.7-0.1 0.5-0.1 1.1-0.3 1.7-0.5 0.8-0.3 1.8-0.8 2.8-1.6l4.3 7.6c-1.1 0.9-2 1.6-2.6 2 -0.6 0.4-1.9 1-3.7 1.8 -1.8 0.8-4.1 1.2-6.9 1.2 -4.7 0-8.5-1.4-11.3-4.3 -2.8-2.9-4.2-6.8-4.2-11.6 0-5.6 1.9-10.4 5.7-14.3 3.8-4 8.4-5.9 13.8-5.9 2.6 0 4.7 0.3 6.3 1 1.5 0.7 2.7 1.3 3.4 1.8 0.7 0.5 1.6 1.2 2.6 2.2L126.7 27.1z"/>
                <polygon class="ycblogo" points="135.6 15.2 146.3 15.2 145.1 26.8 153.7 26.8 155 15.2 165.7 15.2 162.1 50 151.3 50 152.7 36.6 144.1 36.6 142.7 50 131.9 50 "/>
                <path class="ycblogo" d="M178.9 15.2h11.8l7.6 34.8H187.4l-1-5.4h-9.4l-2 5.4h-11L178.9 15.2zM179.8 37h5.6l-1.1-6.5c-0.1-0.9-0.2-1.8-0.2-2.7s-0.1-1.5-0.1-2c0-0.7 0.1-2.1 0.3-4.1 -0.1 0.9-0.3 2-0.5 3.2 -0.2 1.2-0.5 2.4-0.8 3.6l-0.6 2L179.8 37z"/>
                <path class="ycblogo" d="M208.7 15.2l2.4 7.1c0.1 0.4 0.2 1.1 0.3 2.2 0.1 1.1 0.2 2.1 0.2 3.1 0.6-2.7 1.2-4.4 1.6-5.3l3.9-7.1h11.9l-12.8 19.6 -1.6 15.2H203.9l1.5-15.2 -8.6-19.6H208.7z"/>
                <path class="ycblogo" d="M239.6 15.2h14.3c1.1 0 1.9 0 2.7 0 0.7 0 1.4 0.1 2 0.1 2 0.3 3.5 1.1 4.6 2.4 1.1 1.3 1.7 3 1.7 5 0 4.2-2 7-5.9 8.4 4.3 0.6 6.5 3.1 6.5 7.6 0 1.9-0.5 3.7-1.5 5.4s-2.4 3.1-4.3 4.1c-1.9 1-4.7 1.6-8.6 1.6h-15.2L239.6 15.2zM247.6 41.6h2.2c3 0 4.5-1 4.5-3.1 0-0.9-0.3-1.6-0.8-2 -0.6-0.4-1.6-0.6-3-0.6h-2.3L247.6 41.6zM249 27.7h2.1c0.9 0 1.7-0.2 2.2-0.6 0.6-0.4 0.8-0.9 0.8-1.6 0-1.3-0.9-1.9-2.7-1.9h-2.1L249 27.7z"/>
                <path class="ycblogo" d="M33.8 15.2h21.5l-0.9 8.4H43.7l-0.5 4.6h9.5l-0.9 8.4H42.4l-0.6 5.2h11.1l-0.8 8.4H30.1L33.8 15.2zM46.2 0l9.2 6.4 -2.6 5 -7.5-2.7 -8.1 2.7 -1.5-5L46.2 0z"/>
                <path class="ycblogo" d="M287.6 14.5c4.8 0 8.6 1.5 11.5 4.4 2.9 2.9 4.3 6.8 4.3 11.7 0 5.7-1.9 10.4-5.7 14.3 -3.8 3.9-8.5 5.8-14 5.8 -4.8 0-8.7-1.5-11.6-4.4 -2.9-2.9-4.3-6.9-4.3-11.8l0.1-1.9c0.5-5.3 2.6-9.6 6.3-13C278 16.2 282.5 14.5 287.6 14.5M289.1 0l9.2 6.4 -2.6 5 -7.5-2.7 -8.1 2.7 -1.5-5L289.1 0zM279.2 32.6l0 0.8c0 2 0.5 3.6 1.6 4.9 1.1 1.2 2.5 1.9 4.2 1.9 2 0 3.7-0.8 5.1-2.4s2.2-3.6 2.2-5.8c0-2-0.5-3.6-1.6-4.8 -1.1-1.2-2.5-1.9-4.2-1.9 -1.8 0-3.4 0.7-4.8 2.1C280.3 28.7 279.4 30.5 279.2 32.6M279.2 54c-1 1-1.5 2.2-1.5 3.7 0 1.3 0.5 2.4 1.4 3.4 0.9 0.9 2 1.4 3.2 1.4 1.5 0 2.7-0.5 3.8-1.4 1-1 1.5-2.2 1.5-3.6 0-1.4-0.5-2.5-1.4-3.5 -0.9-1-2-1.4-3.2-1.4C281.5 52.5 280.2 53 279.2 54"/>
                <path class="ycblogo" d="M180.1 52.5c1.3 0 2.3 0.5 3.2 1.4 0.9 1 1.4 2.1 1.4 3.5 0 1.4-0.5 2.6-1.5 3.6 -1 1-2.3 1.5-3.8 1.5 -1.3 0-2.3-0.5-3.2-1.4 -0.9-0.9-1.4-2.1-1.4-3.4 0-1.4 0.5-2.7 1.5-3.7C177.4 53 178.7 52.5 180.1 52.5"/>
                </svg>';
	$inside = sprintf( '<a href="%s" titlle="' . esc_attr( get_bloginfo( 'name' ) ) . '">%s<span class="screen-reader-text">%s</span></a>', trailingslashit( home_url() ), $logo, get_bloginfo( 'name' ) );

	// Determine which wrapping tags to use
	$wrap = genesis_is_root_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	// A little fallback, in case an SEO plugin is active
	$wrap = genesis_is_root_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	// And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );

}

add_filter( 'genesis_attr_site-description', 'abte_add_site_description_class' );
/**
 * Add class for screen readers to site description.
 *
 * Unhook this if you'd like to show the site description.
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing HTML attributes for site description element.
 * @return string Amended HTML attributes for site description element.
 */
function abte_add_site_description_class( $attributes ) {
	$attributes['class'] .= ' screen-reader-text';

	return $attributes;
}

