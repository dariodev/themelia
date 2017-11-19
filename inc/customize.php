<?php
/**
 * Handles the theme's theme customizer functionality.
 *
 * @package    Themelia
 * @author     dariodev <wp@relishpress.com>
 * @link       http://relishpress.com/themes/themelia
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

# Register Themelia customizer panels, sections, settings, and/or controls.
add_action( 'customize_register', 'themelia_customize_register');

# Enqueue Themelia customizer styles.
add_action( 'customize_controls_print_styles', 'themelia_enqueue_customizer_stylesheet' );

# Filters the WordPress 'body_class', runs after the 'hybrid_body_class_filter'.
add_filter( 'body_class', 'themelia_body_class_filter', 5 );

# Create custom customizer styles.
add_action('themelia_customizer_styles_filter', 'themelia_customizer_styles', 1002);

# Cache the customizer styles.
add_action( 'wp_enqueue_scripts', 'themelia_customizer_styles_cache', 1002 );

# Reset the cache when saving the customizer.
add_action( 'customize_save_after', 'themelia_reset_style_cache_on_customizer_save' );


/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function themelia_customize_register( $wp_customize ) {

	$wp_customize->get_control('blogname')->priority = 1;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->get_control('blogdescription')->priority = 3;
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Move background color setting alongside background image.
	$wp_customize->get_control( 'background_color' )->section   = 'background_image';
	$wp_customize->get_control( 'background_color' )->priority  = 1;
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	// Change background image section title & priority.
	$wp_customize->get_section( 'background_image' )->title     = __( 'Background', 'themelia' );
	$wp_customize->get_section( 'background_image' )->priority  = 38;

	$wp_customize->get_section( 'colors' )->title     = __( 'Secondary Colors', 'themelia' );
	$wp_customize->get_section( 'colors' )->priority  = 39;

	// Alter Hybrid Core theme_layout, change transport into refresh
	$wp_customize->get_setting( 'theme_layout' )->transport = 'refresh';

	// Load JavaScript files.
	add_action( 'customize_preview_init', 'themelia_enqueue_customizer_scripts' );
}


/**
 * Loads theme customizer JavaScript.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function themelia_enqueue_customizer_scripts() {

	// Use the .min script if SCRIPT_DEBUG is turned off.
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'themelia-customize',
		trailingslashit( get_template_directory_uri() ) . "inc/js/customizer{$suffix}.js",
		array( 'jquery','customize-preview' ),
		'',
		true
	);
}


/**
 * Enqueue Themelia customizer styles.
 *
 */
function themelia_enqueue_customizer_stylesheet() {

	// Use the .min script if SCRIPT_DEBUG is turned off.
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_register_style( 'themelia-customizer-css', trailingslashit( get_template_directory_uri() ) . 'inc/css/customizer'.$suffix.'.css', NULL, NULL, 'all' );
	wp_enqueue_style( 'themelia-customizer-css' );
}


/**
 * Filters the WordPress body class.
 *
 */
function themelia_body_class_filter( $classes ) {

	// Header layout.
	$inline_header = array('header-inline-title-menu', 'header-inline-menu-title');
	$stacked_header = array('header-stack-left', 'header-stack-right', 'header-stack-center');

	$selected_header = get_theme_mod( 'site_header_layout' );

	if (in_array($selected_header, $stacked_header)) {
		$classes[] = "header-stacked";
	} else {
		$classes[] = "header-inline";
	}

	if ( get_theme_mod( 'custom_logo' ) != '' ) { $classes[] = 'custom-logo'; }

	$classes[] = get_theme_mod( 'site_header_layout', 'header-inline-title-menu' );

	// Site Title.
	$classes[] = get_theme_mod( 'site_title', true ) ? 'title-is-visible' : 'title-is-unvisible';

	// Site Description.
	$classes[] = get_theme_mod( 'site_description', true ) ? 'description-is-visible' : 'description-is-unvisible';

	return array_map( 'esc_attr', $classes );
}


/**
 * Create custom customizer style.
 *
 */
function themelia_customizer_styles() {

	// Modular Scale
	$major_second 	= "h1{font-size:1.602em}h2{font-size:1.424em}.big,.lead,blockquote,h3{font-size:1.266em}h4{font-size:1.125em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.79em}";
	$minor_third 	= "h1{font-size:2.074em}h2{font-size:1.728em}h3{font-size:1.44em}.big,.lead,blockquote,h4{font-size:1.2em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.833em}.smaller{font-size:.75em}";
	$major_third 	= "h1{font-size:2.441em}h2{font-size:1.953em}h3{font-size:1.563em}.big,.lead,blockquote,h4{font-size:1.25em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.75em}";
	$perfect_fourth = "h1{font-size:3.157em}h2{font-size:2.369em}h3{font-size:1.777em}.big,.lead,blockquote,h4{font-size:1.333em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.75em}";

	$modular_scale_mobile  		= get_theme_mod( 'modular_scale_mobile',	  'major-second' );
	$modular_scale_tablet  		= get_theme_mod( 'modular_scale_tablet',	  'minor-third' );
	$modular_scale_desktop 		= get_theme_mod( 'modular_scale_desktop',	  'major-third' );
	$modular_scale_desktop_big	= get_theme_mod( 'modular_scale_desktop_big', 'perfect-fourth' );

	if ( $modular_scale_mobile 		== 'major-second'   ) $scale_mobile  = $major_second;
	if ( $modular_scale_mobile		== 'minor-third'    ) $scale_mobile  = $minor_third;
	if ( $modular_scale_mobile 		== 'major-third'    ) $scale_mobile  = $major_third;
	if ( $modular_scale_mobile  	== 'perfect-fourth' ) $scale_mobile  = $perfect_fourth;

	if ( $modular_scale_tablet 		== 'major-second'   ) $scale_tablet  	 = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $major_second .   ' } ';
	if ( $modular_scale_tablet 		== 'minor-third'    ) $scale_tablet  	 = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $minor_third .    ' } ';
	if ( $modular_scale_tablet  	== 'major-third'    ) $scale_tablet 	 = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $major_third .    ' } ';
	if ( $modular_scale_tablet 		== 'perfect-fourth' ) $scale_tablet  	 = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $perfect_fourth . ' } ';

	if ( $modular_scale_desktop 	== 'major-second'   ) $scale_desktop 	 = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $major_second .   ' } ';
	if ( $modular_scale_desktop 	== 'minor-third'    ) $scale_desktop 	 = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $minor_third .    ' } ';
	if ( $modular_scale_desktop 	== 'major-third'    ) $scale_desktop 	 = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $major_third .    ' } ';
	if ( $modular_scale_desktop 	== 'perfect-fourth' ) $scale_desktop 	 = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $perfect_fourth . ' } ';

	if ( $modular_scale_desktop_big == 'major-second'   ) $scale_desktop_big = ' @media (min-width: 1800px) { ' . $major_second .   ' } ';
	if ( $modular_scale_desktop_big == 'minor-third'    ) $scale_desktop_big = ' @media (min-width: 1800px) { ' . $minor_third .    ' } ';
	if ( $modular_scale_desktop_big == 'major-third'    ) $scale_desktop_big = ' @media (min-width: 1800px) { ' . $major_third .    ' } ';
	if ( $modular_scale_desktop_big == 'perfect-fourth' ) $scale_desktop_big = ' @media (min-width: 1800px) { ' . $perfect_fourth . ' } ';

	$base_typography_mobile      = esc_attr( get_theme_mod( 'base_typography_small',  '1em'     ) );
	$base_typography_tablet      = esc_attr( get_theme_mod( 'base_typography_medium', '1.063em' ) );
	$base_typography_desktop     = esc_attr( get_theme_mod( 'base_typography_large',  '1.125em' ) );
	$base_typography_desktop_big = esc_attr( get_theme_mod( 'base_typography_xl',     '1.188em' ) );

	// Site Width
	$default_site_width = '1340px';
	$site_width = esc_attr( get_theme_mod( 'site_width', $default_site_width ) );

	/* Custom Style Output */

	$custom_style_out  = '';

	$custom_style_out .= 'body { font-size: ' . $base_typography_mobile . ';}';
	$custom_style_out .= ' @media (min-width: 600px) and (max-width: 1199px) { body {font-size: ' . $base_typography_tablet . '}} ';
	$custom_style_out .= ' @media (min-width: 1200px) and (max-width: 1799px) { body {font-size: ' . $base_typography_desktop . '}} ';
	$custom_style_out .= ' @media (min-width: 1800px) { body {font-size: ' . $base_typography_desktop_big . '}} ';

	$custom_style_out .= $scale_mobile;
	$custom_style_out .= $scale_tablet;
	$custom_style_out .= $scale_desktop;
	$custom_style_out .= $scale_desktop_big;

	$custom_style_out .= '.grid-container {max-width: ' . $site_width . 'px}';

	return $custom_style_out;
}

/**
 * Cache the customizer styles.
 *
 */
function themelia_customizer_styles_cache() {

	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database
		$data = get_theme_mod( 'themelia_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data == false ) {
			// We'll be adding our actual CSS using a filter
			$data = apply_filters( 'themelia_customizer_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'themelia_customizer_styles', $data );
		}

	// If we're on the customizer, get all the styles using our filter
	} else {
		$data = apply_filters( 'themelia_customizer_styles_filter', null );
	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'themelia-style' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'themelia-style', $data );
}

/**
 * Reset the cache when saving the customizer.
 *
 */
function themelia_reset_style_cache_on_customizer_save() {

	remove_theme_mod( 'themelia_customizer_styles' );
}
