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
		HYBRID_VERSION,
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

	$selected_header = get_theme_mod( 'themelia_header_layout' );

	if (in_array($selected_header, $stacked_header)) {
		$classes[] = "header-stacked";
	} else {
		$classes[] = "header-inline";
	}

	if ( get_theme_mod( 'custom_logo' ) != '' ) { $classes[] = 'custom-logo'; }

	$classes[] = get_theme_mod( 'themelia_header_layout', 'header-inline-title-menu' );

	// Site Title.
	$classes[] = get_theme_mod( 'themelia_site_title', true ) ? 'title-is-visible' : 'title-is-unvisible';

	// Site Description.
	$classes[] = get_theme_mod( 'themelia_site_description', true ) ? 'description-is-visible' : 'description-is-unvisible';

	return array_map( 'esc_attr', $classes );
}


/**
 * Create custom customizer style.
 *
 */
function themelia_customizer_styles() {

	/* Get values */

	// Modular Scale
	$major_second 	= "h1{font-size:1.602em}h2{font-size:1.424em}.big,.lead,blockquote,h3{font-size:1.266em}h4{font-size:1.125em}h5,h6{font-size:1em}.font-secondary,blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.79em}";
	$minor_third 	= "h1{font-size:2.074em}h2{font-size:1.728em}h3{font-size:1.44em}.big,.lead,blockquote,h4{font-size:1.2em}h5,h6{font-size:1em}.font-secondary,blockquote cite,small,.small,sup{font-size:.833em}.smaller{font-size:.75em}";
	$major_third 	= "h1{font-size:2.441em}h2{font-size:1.953em}h3{font-size:1.563em}.big,.lead,blockquote,h4{font-size:1.25em}h5,h6{font-size:1em}.font-secondary,blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.75em}";
	$perfect_fourth = "h1{font-size:3.157em}h2{font-size:2.369em}h3{font-size:1.777em}.big,.lead,blockquote,h4{font-size:1.333em}h5,h6{font-size:1em}.font-secondary,blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.75em}";

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

	$base_typography_mobile      = get_theme_mod( 'base_typography_small',  '1em'     );
	$base_typography_tablet      = get_theme_mod( 'base_typography_medium', '1.063em' );
	$base_typography_desktop     = get_theme_mod( 'base_typography_large',  '1.125em' );
	$base_typography_desktop_big = get_theme_mod( 'base_typography_xl',     '1.188em' );
	
	// Content Width
	$content_width = get_theme_mod( 'themelia_content_width' );

	// Link
	$body_link = get_theme_mod( 'body_link' );

	// Secondary Text
	$secondary_text = get_theme_mod( 'secondary_font_link' );

	// Site Header Background
	$site_header_bg = get_theme_mod( 'site_header_background' );

	// Site Header Border
	$site_header_separator = get_theme_mod( 'site_header_separator' );
	
	// Site Title
	$site_title = get_theme_mod( 'site_title_font' );
	
	// Site Description
	$site_description = get_theme_mod( 'site_description_font' );
	$site_description_color = get_theme_mod( 'site_description_color' );

	// Site Title Link
	$site_title_link_color = get_theme_mod( 'site_title_link_color' );

	// Top Level Links
	$link_colors = get_theme_mod( 'nav_link_color' );

	// Top Level Links - Highlight Border
	$nav_link_highlight = get_theme_mod( 'nav_link_highlight' );

	// Drop Down Links
	$link_sub_colors = get_theme_mod( 'nav_sub_link_color' );

	// Drop Down Links BG
	$link_sub_bg_colors = get_theme_mod( 'nav_sub_link_bg' );

	// Drop Down Links Borders
	$link_sub_borders = get_theme_mod( 'link_sub_borders' );

	// Entry Title Link
	$entry_title_link_colors = get_theme_mod( 'entry_title_link' );

	$entry_title_link_2 = get_theme_mod( 'entry_title_link_2' );

	$content_h1 = get_theme_mod( 'themelia_headings_h1' );
	$content_h2 = get_theme_mod( 'themelia_headings_h2' );
	$content_h3 = get_theme_mod( 'themelia_headings_h3' );
	$content_h4 = get_theme_mod( 'themelia_headings_h4' );
	$content_h5 = get_theme_mod( 'themelia_headings_h5' );
	$content_h6 = get_theme_mod( 'themelia_headings_h6' );

	$entry_title_single = get_theme_mod( 'entry_title_singular' );

	$entry_title_page = get_theme_mod( 'entry_title_page' );


	/* Custom Style Output */

	$custom_style_out  = '';

	$custom_style_out .= 'body { font-size: ' . $base_typography_mobile . ';}';
	$custom_style_out .= ' @media (min-width: 600px) and (max-width: 1199px) { body { font-size: ' . $base_typography_tablet . '; }} ';
	$custom_style_out .= ' @media (min-width: 1200px) and (max-width: 1799px) { body { font-size: ' . $base_typography_desktop . '; }} ';
	$custom_style_out .= ' @media (min-width: 1800px) { body { font-size: ' . $base_typography_desktop_big . '; }} ';

	$custom_style_out .= $scale_mobile;
	$custom_style_out .= $scale_tablet;
	$custom_style_out .= $scale_desktop;
	$custom_style_out .= $scale_desktop_big;
	
	$custom_style_out .= '.grid-container: ' . $content_width;

	$custom_style_out .= 'a { color: ' . $body_link['link'] . '; } a:active { color: ' . $body_link['active'] . '; } a:visited { color: ' . $body_link['visited'] . '; } a:hover { color: ' . $body_link['hover'] . '; }  ';

	$custom_style_out .= '.breadcrumb-trail { color: ' . $secondary_text['text'] . '; }';
	$custom_style_out .= '.breadcrumb-trail a, .breadcrumb-trail a:visited, .entry-more-link, .entry-more-link:visited, .social-navigation a, .social-navigation a:visited { color: ' . $secondary_text['link'] . '; } .breadcrumb-trail a:hover, .entry-more-link:hover, .social-navigation a:hover { color: ' . $secondary_text['hover'] . '; } .breadcrumb-trail a:active, .entry-more-link:active, .social-navigation a:active { color: ' . $secondary_text['active'] . '; } ';

	$custom_style_out .= '.site-header { background-color: ' . $site_header_bg . '; }';
	$custom_style_out .= '.site-header:after { background-color: ' . $site_header_separator . '; }';
	
	$custom_style_out .= '.site-title-wrap .site-title, .site-title-wrap:visited .site-title { color: ' . $site_title_link_color['link'] . '; } .site-title-wrap:hover .site-title { color: ' . $site_title_link_color['hover'] . '; } .site-title-wrap:active .site-title { color: ' . $site_title_link_color['active'] . '; } ';
	$custom_style_out .= '.site-description { color: ' . $site_description_color . '; }';
	
	$custom_style_out .= '.sm-simple a, .sm-simple a:visited { color: ' . $link_colors['link'] . '; } .sm-simple a:hover { color: ' . $link_colors['hover'] . '; } .sm-simple a:active { color: ' . $link_colors['active'] . '; } .sm-simple a.highlighted { color: ' . $link_colors['active'] . '; } ';
	$custom_style_out .= '.sm-simple > li > a:before { background: ' . $nav_link_highlight['hover'] . '; } ';
	$custom_style_out .= '.sm-simple > li.current-menu-item > a:before, .sm-simple .sub-menu li.current-menu-ancestor > a:before { background: ' . $nav_link_highlight['current'] . '; } ';
	$custom_style_out .= '.sm-simple .sub-menu a, .sm-simple .sub-menu a:visited { color: ' . $link_sub_colors['link'] . '; } .sm-simple .sub-menu a:hover, .sm-simple .sub-menu li a.highlighted  { color: ' . $link_sub_colors['hover'] . '; } #menu-primary .menu-items .sub-menu a:active { color: ' . $link_sub_colors['active'] . '; } ';
	$custom_style_out .= '.sm-simple .sub-menu li a { background-color: ' . $link_sub_bg_colors['link'] . '; } #menu-primary .menu-items .sub-menu li a:hover, .sm-simple .sub-menu li a.highlighted  { background-color: ' . $link_sub_bg_colors['hover'] . '; } #menu-primary .menu-items .sub-menu li a:active { background-color: ' . $link_sub_bg_colors['active'] . '; } ';
	$custom_style_out .= '.sm-simple .sub-menu { border-color: ' . $link_sub_borders['outline'] . '; }';
	$custom_style_out .= '.sm-simple .sub-menu ul { border-top-color: ' . $link_sub_borders['outline'] . '; }';
	$custom_style_out .= '.sm-simple .sub-menu li { border-color: ' . $link_sub_borders['separator'] . '; }';

	$custom_style_out .= 'h1 { color: ' . $content_h1['color'] . '; letter-spacing: ' . $content_h1['letter-spacing'] . '; text-transform: ' . $content_h1['text-transform'] . '; } ';
	$custom_style_out .= 'h2 { color: ' . $content_h2['color'] . '; letter-spacing: ' . $content_h2['letter-spacing'] . '; text-transform: ' . $content_h2['text-transform'] . '; } ';
	$custom_style_out .= 'h3 { color: ' . $content_h3['color'] . '; letter-spacing: ' . $content_h3['letter-spacing'] . '; text-transform: ' . $content_h3['text-transform'] . '; } ';
	$custom_style_out .= 'h4 { color: ' . $content_h4['color'] . '; letter-spacing: ' . $content_h4['letter-spacing'] . '; text-transform: ' . $content_h4['text-transform'] . '; } ';
	$custom_style_out .= 'h5 { color: ' . $content_h5['color'] . '; letter-spacing: ' . $content_h5['letter-spacing'] . '; text-transform: ' . $content_h5['text-transform'] . '; } ';
	$custom_style_out .= 'h6 { color: ' . $content_h6['color'] . '; letter-spacing: ' . $content_h6['letter-spacing'] . '; text-transform: ' . $content_h6['text-transform'] . '; } ';

	$custom_style_out .= '.entry-title a { color: ' . $entry_title_link_colors['link'] . '; } .entry-title a:visited { color: ' . $entry_title_link_colors['visited'] . '; } .entry-title a:hover { color: ' . $entry_title_link_colors['hover'] . '; } .entry-title a:active { color: ' . $entry_title_link_colors['active'] . '; } ';
	$custom_style_out .= '.entry-title a { letter-spacing: ' . $entry_title_link_2['letter-spacing'] . '; text-transform: ' . $entry_title_link_2['text-transform'] . '; } ';

	$custom_style_out .= '.singular .entry-title { color: ' . $entry_title_single['color'] . '; letter-spacing: ' . $entry_title_single['letter-spacing'] . '; text-transform: ' . $entry_title_single['text-transform'] . '; }  ';
	$custom_style_out .= '.singular-page .entry-title { color: ' . $entry_title_page['color'] . '; letter-spacing: ' . $entry_title_page['letter-spacing'] . '; text-transform: ' . $entry_title_page['text-transform'] . '; } ';

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
			//$data .= 'Timestamp: ' . current_time( 'timestamp', true );
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
