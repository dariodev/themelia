<?php
/**
 * "There is no must in art because art is free."
 * ~ Wassily Kandinsky (Concerning the Spiritual in Art, 1977)
 *
 * Based on Hybrid Base theme Copyright (c) 2013 - 2016, Justin Tadlock
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Themelia
 * @subpackage Functions
 * @version    1.0.0
 * @author     Dario Devcic <dario@relishpress.com>
 * @copyright  Copyright (c) 2016, Dario Devcic
 * @link       http://relishpress.com/themes/themelia
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Get the template directory and make sure it has a trailing slash.
$themelia_base_dir = trailingslashit( get_template_directory() );

// Load the Hybrid Core framework and launch it.
require_once( $themelia_base_dir . 'library/hybrid.php' );
new Hybrid();

// Load theme-specific files.
require_once( $themelia_base_dir . 'inc/custom-background.php' );

// No need to include embeded Kirki toolkit if Kirki plugin is installed.
if ( !class_exists( 'Kirki' ) ) {
	// Include Kirki
	include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );
}

// Include Kirki Configuration
require_once( dirname( __FILE__ ) . '/inc/kirki-conf.php' );

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'themelia_theme_setup', 5 );


/**
 * Theme setup function. This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function themelia_theme_setup() {

	// Load Themelia functions.
	require_once( trailingslashit( get_template_directory() ) . 'inc/themelia.php' );

	// Load customizer.
	require_once( trailingslashit( get_template_directory() ) . 'inc/customize.php' );

	// Load WooCommerce compatibility.
	if ( class_exists( 'WooCommerce' ) ) {
		require trailingslashit( get_template_directory() ) . '/inc/woocommerce.php';
	}

	// Theme layouts.
	add_theme_support( 'theme-layouts', array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) );

	// Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	// The best thumbnail/image script ever.
	add_theme_support( 'get-the-image' );

	// Breadcrumbs. Yay!
	add_theme_support( 'breadcrumb-trail' );

	// Automatically add feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Post formats.
	add_theme_support(
		'post-formats',
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' )
	);

	// Setup the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', array(
		'height'      => 160,
		'width'       => 160,
		'flex-width'  => true,
	));

	add_theme_support(
		'infinite-scroll',
		array(
			'container'	=> 'content',
			'type'		=> 'click',
			'wrapper'	=> false,
			'footer'	=> false,
			'render'	=> 'themelia_jetpack_infinite_scroll_render',
	));

	// Editor styles.
	add_editor_style( themelia_get_editor_styles() );

	// Handle content width for embeds and images.
	// Note: this is the largest size based on the theme's various layouts.
	hybrid_set_content_width( 1280 );
}

if( ! function_exists('themelia_jetpack_infinite_scroll_render') ) {
	function themelia_jetpack_infinite_scroll_render() {

		while ( have_posts() ) {
			the_post();
			hybrid_get_content_template();
		}
	}
}
