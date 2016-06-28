<?php
/**
 * Handles the theme's theme customizer functionality.
 *
 * @package    Themelia
 * @author     dariodev <wp@relishpress.com>
 * @link       http://relishpress.com/themes/themelia
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


# Include Kirki
include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );

# Include Kirki Configuration
require_once( dirname( __FILE__ ) . '/kirki-conf.php' );

# Register Themelia customizer panels, sections, settings, and/or controls.
add_action( 'customize_register', 'themelia_customize_register');

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */

function themelia_customize_register( $wp_customize ) {
	
	if ( $wp_customize->get_control( 'blogname' ) ) {
		$wp_customize->get_control('blogname')->priority = 1;
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	}
	if ( $wp_customize->get_control( 'blogdescription' ) ) {
		$wp_customize->get_control('blogdescription')->priority = 3;
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	if ( $wp_customize->get_control( 'header_textcolor' ) ) {
		$wp_customize->remove_control('header_textcolor');
	}
		
	if ( $wp_customize->get_control( 'display_header_text' ) ) {
		$wp_customize->remove_control('display_header_text');
	}
	
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
		trailingslashit( get_template_directory_uri() ) . "inc/js/customize{$suffix}.js",
		array( 'jquery','customize-preview' ),
		HYBRID_VERSION,
		true
	);
}

add_action( 'customize_controls_print_styles', 'themelia_enqueue_customizer_stylesheet' );
function themelia_enqueue_customizer_stylesheet() {
	// Use the .min script if SCRIPT_DEBUG is turned off.
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_register_style( 'themelia-customizer-css', trailingslashit( get_template_directory_uri() ) . 'inc/css/customizer'.$suffix.'.css', NULL, NULL, 'all' );
	wp_enqueue_style( 'themelia-customizer-css' );
}


# Filters the WordPress 'body_class', runs after the 'hybrid_body_class_filter'.
add_filter( 'body_class', 'themelia_body_class_filter', 5 );
/**
 * Filters the WordPress body class
 *
 */
function themelia_body_class_filter( $classes ) {

	// Header layout.
	$inline_header = array('header-i-l-mr', 'header-i-l-ml', 'header-i-m-lr');
	$stacked_header = array('header-s-l', 'header-s-r');
	
	$selected_header = get_theme_mod( 'get_header_layout' );
	
	if (in_array($selected_header, $stacked_header)) {
		$classes[] = "header-stacked";
	} else {
		$classes[] = "header-inline";
	}
	
	if ( get_theme_mod( 'custom_logo' ) != '' ) { $classes[] = 'custom-logo'; }
	
	$classes[] = get_theme_mod( 'get_header_layout', 'header-i-l-mr' );
	
	// Site Title.
	$classes[] = get_theme_mod( 'display_site_title', true ) ? 'title-is-visible' : 'title-is-unvisible';
	
	// Site Description.
	$classes[] = get_theme_mod( 'display_site_description', true ) ? 'description-is-visible' : 'description-is-unvisible';
		
	return array_map( 'esc_attr', $classes );
}



function themelia_custom_style() {

	$major_second = "h1{font-size:1.602em}h2{font-size:1.424em}h3{font-size:1.266em}h4{font-size:1.125em}h5,h6{font-size:1em}.big,.lead,blockquote{font-size:1.2em}.font_small,blockquote cite,small,sub,sup{font-size:.833em}.smaller{font-size:.694em}";
	$minor_third = "h1{font-size:2.074em}h2{font-size:1.728em}h3{font-size:1.44em}.big,.lead,blockquote,h4{font-size:1.2em}h5,h6{font-size:1em}.font_small,blockquote cite,small,sub,sup{font-size:.889em}.smaller{font-size:.79em}";
	$major_third = "h1{font-size:2.441em}h2{font-size:1.953em}h3{font-size:1.563em}.big,.lead,blockquote,h4{font-size:1.25em}h5,h6{font-size:1em}.font_small,blockquote cite,small,sub,sup{font-size:.8em}.smaller{font-size:.64em}";	
	$perfect_fourth = "h1{font-size:3.157em}h2{font-size:2.369em}h3{font-size:1.777em}.big,.lead,blockquote,h4{font-size:1.333em}h5,h6{font-size:1em}.font_small,blockquote cite,small,sub,sup{font-size:.75em}.smaller{font-size:.563em}";

	$modular_scale_mobile  = get_theme_mod( 'modular_scale_mobile',  'minor-third' );
	$modular_scale_tablet  = get_theme_mod( 'modular_scale_tablet',  'major-second' );
	$modular_scale_desktop = get_theme_mod( 'modular_scale_desktop', 'major-third' );

	if ( $modular_scale_mobile  == 'major-second'   ) $scale_mobile  = $major_second;
	if ( $modular_scale_mobile  == 'minor-third'    ) $scale_mobile  = $minor_third;
	if ( $modular_scale_mobile  == 'major-third'    ) $scale_mobile  = $major_third;
	if ( $modular_scale_mobile  == 'perfect-fourth' ) $scale_mobile  = $perfect_fourth;
	
	if ( $modular_scale_tablet  == 'major-second'   ) $scale_tablet  = ' @media (min-width: 700px) and (max-width: 1024px) { ' . $major_second . ' } ';
	if ( $modular_scale_tablet  == 'minor-third'    ) $scale_tablet  = ' @media (min-width: 700px) and (max-width: 1024px) { ' . $minor_third . ' } ';
	if ( $modular_scale_tablet  == 'major-third'    ) $scale_tablet  = ' @media (min-width: 700px) and (max-width: 1024px) { ' . $major_third . ' } ';
	if ( $modular_scale_tablet  == 'perfect-fourth' ) $scale_tablet  = ' @media (min-width: 700px) and (max-width: 1024px) { ' . $perfect_fourth . ' } ';
	
	if ( $modular_scale_desktop == 'major-second'   ) $scale_desktop = ' @media (min-width: 1025px) { ' . $major_second . ' } ';
	if ( $modular_scale_desktop == 'minor-third'    ) $scale_desktop = ' @media (min-width: 1025px) { ' . $minor_third . ' } ';
	if ( $modular_scale_desktop == 'major-third'    ) $scale_desktop = ' @media (min-width: 1025px) { ' . $major_third . ' } ';
	if ( $modular_scale_desktop == 'perfect-fourth' ) $scale_desktop = ' @media (min-width: 1025px) { ' . $perfect_fourth . ' } ';
	
	$base_typography_mobile  = get_theme_mod( 'base_typography_small',  '16' );
	$base_typography_tablet  = get_theme_mod( 'base_typography_medium', '17' );
	$base_typography_desktop = get_theme_mod( 'base_typography_large',  '18' );

	// Body Background
	$body_backgound_default = '#fff';
	$body_backgound_color = get_theme_mod( 'body_bg_color', $body_backgound_default );
	
	// Link
	$body_link_defaults = array('link' => '#0274be','hover' => '#2f85bf','active' => '#3f8bbf');
	$body_link = get_theme_mod( 'body_link', $body_link_defaults );
	
	// Secondary Text
	$secondary_text_defaults = array('text' => 'rgba(2,2,2,0.84)', 'link' => '#121212','hover' => '#2f85bf','active' => '#3f8bbf');
	$secondary_text = get_theme_mod( 'secondary_font_link', $secondary_text_defaults );
	
	// Site Header Background
	$site_header_default = '#fff';
	$site_header_bg = get_theme_mod( 'site_header_background', $site_header_default );
	
	// Site Header Border
	$site_header_separator_default = 'rgba(39, 55, 64, 0.09)';
	$site_header_separator = get_theme_mod( 'site_header_separator', $site_header_separator_default );
	
	// Site Title Link
	$site_title_defaults = array('link' => '#121212','hover' => '#121212','active' => '#121212');
	$site_title_link_color = get_theme_mod( 'site_title_link_color', $site_title_defaults );
	
	// Top Level Links
	$top_defaults = array('link' => '#121212','hover' => '#121212','active' => '#121212');
	$link_colors = get_theme_mod( 'nav_link_color', $top_defaults );
	
	// Top Level Links - Highlight Border
	$nav_link_highlight_defaults = array('hover' => '#0274BE','current' => '#0274BE');
	$nav_link_highlight = get_theme_mod( 'nav_link_highlight', $nav_link_highlight_defaults );
	
	// Drop Down Links
	$sub_defaults = array('link' => '#121212','hover' => '#121212','active' => '#121212');
	$link_sub_colors = get_theme_mod( 'nav_sub_link_color', $sub_defaults );
	
	// Drop Down Links BG
	$sub_bg_defaults = array('link' => '#FFF','hover' => '#fff','active' => '#fff');
	$link_sub_bg_colors = get_theme_mod( 'nav_sub_link_bg', $sub_bg_defaults );
	
	// Drop Down Links Borders
	$link_sub_borders_defaults = array('outline' => 'rgba(39, 55, 64, 0.09)','separator' => 'rgba(39, 55, 64, 0.09)');
	$link_sub_borders = get_theme_mod( 'link_sub_borders', $link_sub_borders_defaults );
	
	
	// Entry Title Link
	$entry_title_link_defaults = array('link' => '#121212','hover' => '#333','active' => '#444');
	$entry_title_link_colors = get_theme_mod( 'entry_title_link', $entry_title_link_defaults );
	
	$entry_title_link_2_defaults = array('letter-spacing' => 'normal','text-transform' => 'none');
	$entry_title_link_2 = get_theme_mod( 'entry_title_link_2', $entry_title_link_2_defaults );
	
	$content_h1_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$content_h2_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$content_h3_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$content_h4_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$content_h5_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$content_h6_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$content_h1 = get_theme_mod( 'themelia_headings_h1', $content_h1_defaults );
	$content_h2 = get_theme_mod( 'themelia_headings_h2', $content_h2_defaults );
	$content_h3 = get_theme_mod( 'themelia_headings_h3', $content_h3_defaults );
	$content_h4 = get_theme_mod( 'themelia_headings_h4', $content_h4_defaults );
	$content_h5 = get_theme_mod( 'themelia_headings_h5', $content_h5_defaults );
	$content_h6 = get_theme_mod( 'themelia_headings_h6', $content_h6_defaults );
	
	$entry_title_single_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$entry_title_single = get_theme_mod( 'entry_title_singular', $entry_title_single_defaults );
	
	$entry_title_page_defaults = array('color' => '#121212','letter-spacing' => 'normal','text-transform' => 'none');
	$entry_title_page = get_theme_mod( 'entry_title_page', $entry_title_page_defaults );
	
	$custom_css = '';
	$custom_css = get_theme_mod( 'custom_css', '' );
	
	
	// Custom Style Output
	
	
	$custom_style_out   = '';
	
	$custom_style_out  .= 'body { font-size: ' . $base_typography_mobile . 'px;}';
	$custom_style_out  .= ' @media (min-width: 700px) and (max-width: 1024px) { body { font-size: ' . $base_typography_tablet . 'px; }} ';
	$custom_style_out  .= ' @media (min-width: 1025px) { body { font-size: ' . $base_typography_desktop . 'px; }} ';

	$custom_style_out  .= $scale_mobile;
	$custom_style_out  .= $scale_tablet;
	$custom_style_out  .= $scale_desktop;
	
	$custom_style_out  .= 'body { background-color: ' . $body_backgound_color . '; }';
	
	$custom_style_out  .= 'a { color: ' . $body_link['link'] . '; } a:hover { color: ' . $body_link['hover'] . '; } a:active { color: ' . $body_link['active'] . '; } ';
	
	$custom_style_out  .= '#content .font-secondary, #main .breadcrumb-trail, #footer p { color: ' . $secondary_text['text'] . '; }';
	$custom_style_out  .= '#content .font-secondary a, #main .breadcrumb-trail a, .entry-more-link, .social-navigation a, #footer a { color: ' . $secondary_text['link'] . '; } #content .font-secondary a:hover, #main .breadcrumb-trail a:hover, .entry-more-link:hover, .social-navigation a:hover, #footer a:hover { color: ' . $secondary_text['hover'] . '; } #content .font-secondary a:active, #main .breadcrumb-trail a:active, .entry-more-link:active, .social-navigation a:active, #footer a:active { color: ' . $secondary_text['active'] . '; } ';

	$custom_style_out  .= '.site-header { background-color: ' . $site_header_bg . '; }'; 
	$custom_style_out  .= '.site-header:after { background-color: ' . $site_header_separator . '; }'; 
		
	$custom_style_out  .= '.site-title a, .site-title a:visited { color: ' . $site_title_link_color['link'] . '; } .site-title a:hover { color: ' . $site_title_link_color['hover'] . '; } .site-title a:active { color: ' . $site_title_link_color['active'] . '; } ';	
	
	$custom_style_out .= '#menu-primary .menu-items a, #menu-primary .menu-items a:visited { color: ' . $link_colors['link'] . '; } #menu-primary .menu-items a:hover, #menu-primary .menu-items .sfHover > a { color: ' . $link_colors['hover'] . '; } #menu-primary .menu-items a:active { color: ' . $link_colors['active'] . '; } ';

	$custom_style_out .= '#menu-primary .menu-items > li > a:before { background: ' . $nav_link_highlight['hover'] . '; } ';
	$custom_style_out .= '#menu-primary .menu-items > li.current-menu-item > a:before, #menu-primary .menu-items > li.current-menu-ancestor > a:before { background: ' . $nav_link_highlight['current'] . '; } ';

	$custom_style_out .= '#menu-primary .menu-items .sub-menu a, #menu-primary .menu-items .sub-menu a:visited { color: ' . $link_sub_colors['link'] . '; } #menu-primary .menu-items .sub-menu a:hover, #menu-primary .menu-items .sub-menu .sfHover > a { color: ' . $link_sub_colors['hover'] . '; } #menu-primary .menu-items .sub-menu a:active { color: ' . $link_sub_colors['active'] . '; } ';
	
	$custom_style_out .= '#menu-primary .menu-items .sub-menu li a { background-color: ' . $link_sub_bg_colors['link'] . '; } #menu-primary .menu-items .sub-menu li a:hover, #menu-primary .menu-items .sub-menu .sfHover a { background-color: ' . $link_sub_bg_colors['hover'] . '; } #menu-primary .menu-items .sub-menu li a:active { background-color: ' . $link_sub_bg_colors['active'] . '; } ';
	
	$custom_style_out .= '#menu-primary .menu-items .sub-menu, #menu-primary .menu-items .children { border-color: ' . $link_sub_borders['outline'] . '; }';
	$custom_style_out .= '#menu-primary .menu-items .sub-menu ul, #menu-primary .menu-items .children ul { border-top-color: ' . $link_sub_borders['outline'] . '; }';
	$custom_style_out .= '#menu-primary .menu-items .sub-menu li a, #menu-primary .menu-items .children li a { border-color: ' . $link_sub_borders['separator'] . '; }';
	$custom_style_out .= '.slicknav_arrow { border-left-color: ' . $link_sub_borders['separator'] . '; }';
	$custom_style_out .= '.slicknav_nav { border-top-color: ' . $link_sub_borders['separator'] . '; }';
	

	$custom_style_out .= '#menu-primary .slicknav_nav a, #menu-primary .slicknav_nav a:visited { color: ' . $link_sub_colors['link'] . '; } #menu-primary .slicknav_nav a:active { color: ' . $link_sub_colors['active'] . '; } ';	
	
	$custom_style_out .= '#menu-primary .slicknav_nav > li { background-color: ' . $link_sub_bg_colors['link'] . '; } ';
	
	$custom_style_out .= '#menu-primary .slicknav_nav > li { border-bottom-color: ' . $link_sub_borders['separator'] . '; }';

	$custom_style_out .= '.entry-title a, .entry-title a:visited { color: ' . $entry_title_link_colors['link'] . '; } .entry-title a:hover { color: ' . $entry_title_link_colors['hover'] . '; } .entry-title a:active { color: ' . $entry_title_link_colors['active'] . '; } ';
	
	$custom_style_out .= '.entry-title a { letter-spacing: ' . $entry_title_link_2['letter-spacing'] . '; text-transform: ' . $entry_title_link_2['text-transform'] . '; } ';
	
	$custom_style_out .= '#content h1 { color: ' . $content_h1['color'] . '; letter-spacing: ' . $content_h1['letter-spacing'] . '; text-transform: ' . $content_h1['text-transform'] . '; } ';
	$custom_style_out .= '#content h2 { color: ' . $content_h2['color'] . '; letter-spacing: ' . $content_h2['letter-spacing'] . '; text-transform: ' . $content_h2['text-transform'] . '; } ';
	$custom_style_out .= '#content h3 { color: ' . $content_h3['color'] . '; letter-spacing: ' . $content_h3['letter-spacing'] . '; text-transform: ' . $content_h3['text-transform'] . '; } ';
	$custom_style_out .= '#content h4 { color: ' . $content_h4['color'] . '; letter-spacing: ' . $content_h4['letter-spacing'] . '; text-transform: ' . $content_h4['text-transform'] . '; } ';
	$custom_style_out .= '#content h5 { color: ' . $content_h5['color'] . '; letter-spacing: ' . $content_h5['letter-spacing'] . '; text-transform: ' . $content_h5['text-transform'] . '; } ';
	$custom_style_out .= '#content h6 { color: ' . $content_h6['color'] . '; letter-spacing: ' . $content_h6['letter-spacing'] . '; text-transform: ' . $content_h6['text-transform'] . '; } ';
	
	$custom_style_out .= '.singular #content .entry-title { color: ' . $entry_title_single['color'] . '; letter-spacing: ' . $entry_title_single['letter-spacing'] . '; text-transform: ' . $entry_title_single['text-transform'] . '; } ';
	$custom_style_out .= '.singular-page #content .entry-title { color: ' . $entry_title_page['color'] . '; letter-spacing: ' . $entry_title_page['letter-spacing'] . '; text-transform: ' . $entry_title_page['text-transform'] . '; } ';

	$custom_style_out .= $custom_css;
	
	return $custom_style_out;
}
add_action('themelia_my_styles_filter', 'themelia_custom_style', 1002);

/**
 * Cache the customizer styles
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
			$data = apply_filters( 'themelia_my_styles_filter', null );
			//$data .= 'Timestamp: ' . current_time( 'timestamp', true );
			// Set the theme_mod.
			set_theme_mod( 'themelia_customizer_styles', $data );
		}

	// If we're on the customizer, get all the styles using our filter
	} else {
		$data = apply_filters( 'themelia_my_styles_filter', null );
	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'my-style' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'themelia-style', $data );

}
add_action( 'wp_enqueue_scripts', 'themelia_customizer_styles_cache', 1002 );

/**
 * Reset the cache when saving the customizer
 */
add_action( 'customize_save_after', 'my_reset_style_cache_on_customizer_save' );
function my_reset_style_cache_on_customizer_save() {
	remove_theme_mod( 'themelia_customizer_styles' );
}

/**
 * TO DO:
 * Set custom font stacks.
 * 
 */
//return apply_filters( 'kirki/fonts/standard_fonts', $standard_fonts );
//add_action('kirki/fonts/standard_fonts', 'get_new_fonts');
function get_new_fonts() {
	$i18n = Kirki_l10n::get_strings();
	$standard_fonts = array(
		'serif' => array(
			'label' => $i18n['serif'],
			'stack' => 'Georgia,Times,"Times New Roman",serif',
		),
		'sans-serif' => array(
			'label'  => $i18n['sans-serif'],
			'stack'  => 'Helvetica,Arial,sans-serif',
		),
		'monospace' => array(
			'label' => $i18n['monospace'],
			'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
		),
	);
	return $standard_fonts;
}
	
/**
 * TO DO:
 * Set your own array of Google fonts
 * 
 */
//add_action('kirki/fonts/google_fonts_path', 'my_fonts_array');
function my_fonts_array() {
	$path_new = wp_normalize_path( dirname( __FILE__ ) ) . '/myfonts_2.php';
	return $path_new;
}
		