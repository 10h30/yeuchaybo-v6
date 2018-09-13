<?php
/**
 * Yeu Chay Bo
 *
 * This file adds the boxed page template to the Yeu Chay Bo Theme.
 *
 * Template Name: Boxed Template
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

add_filter( 'body_class', 'corporate_add_boxed_body_class' );
/**
 * Add contact page body class to the head.
 *
 * @since  1.0.0
 *
 * @param  array $classes Array of body classes.
 *
 * @return array
 */
function corporate_add_boxed_body_class( $classes ) {

	$classes[] = 'boxed-page';

	return $classes;

}

// Run the Genesis loop.
genesis();
