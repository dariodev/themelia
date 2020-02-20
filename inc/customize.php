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
 */
function themelia_customizer_styles() {

	// Modular Scale.
	$major_second   = 'h1{font-size:1.602em}h2{font-size:1.424em}.big,.lead,blockquote,h3{font-size:1.266em}h4{font-size:1.125em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.79em}';
	$minor_third    = 'h1{font-size:2.074em}h2{font-size:1.728em}h3{font-size:1.44em}.big,.lead,blockquote,h4{font-size:1.2em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.833em}.smaller{font-size:.75em}';
	$major_third    = 'h1{font-size:2.441em}h2{font-size:1.953em}h3{font-size:1.563em}.big,.lead,blockquote,h4{font-size:1.25em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.75em}';
	$perfect_fourth = 'h1{font-size:3.157em}h2{font-size:2.369em}h3{font-size:1.777em}.big,.lead,blockquote,h4{font-size:1.333em}h5,h6{font-size:1em}blockquote cite,small,.small,sup{font-size:.889em}.smaller{font-size:.75em}';

	$modular_scale_mobile      = get_theme_mod( 'modular_scale_mobile', 'major-second' );
	$modular_scale_tablet      = get_theme_mod( 'modular_scale_tablet', 'minor-third' );
	$modular_scale_desktop     = get_theme_mod( 'modular_scale_desktop', 'major-third' );
	$modular_scale_desktop_big = get_theme_mod( 'modular_scale_desktop_big', 'perfect-fourth' );

	if ( 'major-second' === $modular_scale_mobile ) $scale_mobile   = $major_second;
	if ( 'minor-third' === $modular_scale_mobile ) $scale_mobile    = $minor_third;
	if ( 'major-third' === $modular_scale_mobile ) $scale_mobile    = $major_third;
	if ( 'perfect-fourth' === $modular_scale_mobile ) $scale_mobile = $perfect_fourth;

	if ( 'major-second' === $modular_scale_tablet ) $scale_tablet    = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $major_second . ' } ';
	if ( 'minor-third' === $modular_scale_tablet ) $scale_tablet     = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $minor_third . ' } ';
	if ( 'major-third' === $modular_scale_tablet  ) $scale_tablet    = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $major_third . ' } ';
	if ( 'perfect-fourth' === $modular_scale_tablet  ) $scale_tablet = ' @media (min-width: 600px)  and (max-width: 1199px) { ' . $perfect_fourth . ' } ';

	if ( 'major-second' === $modular_scale_desktop ) $scale_desktop   = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $major_second . ' } ';
	if ( 'minor-third' === $modular_scale_desktop ) $scale_desktop    = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $minor_third . ' } ';
	if ( 'major-third' === $modular_scale_desktop ) $scale_desktop    = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $major_third . ' } ';
	if ( 'perfect-fourth' === $modular_scale_desktop ) $scale_desktop = ' @media (min-width: 1200px) and (max-width: 1799px) { ' . $perfect_fourth . ' } ';

	if ( 'major-second' === $modular_scale_desktop_big ) $scale_desktop_big   = ' @media (min-width: 1800px) { ' . $major_second . ' } ';
	if ( 'minor-third' === $modular_scale_desktop_big ) $scale_desktop_big    = ' @media (min-width: 1800px) { ' . $minor_third . ' } ';
	if ( 'major-third' === $modular_scale_desktop_big ) $scale_desktop_big    = ' @media (min-width: 1800px) { ' . $major_third . ' } ';
	if ( 'perfect-fourth' === $modular_scale_desktop_big ) $scale_desktop_big = ' @media (min-width: 1800px) { ' . $perfect_fourth . ' } ';

	$base_typography_mobile      = esc_attr( get_theme_mod( 'base_typography_small', '1em' ) );
	$base_typography_tablet      = esc_attr( get_theme_mod( 'base_typography_medium', '1.063em' ) );
	$base_typography_desktop     = esc_attr( get_theme_mod( 'base_typography_large', '1.125em' ) );
	$base_typography_desktop_big = esc_attr( get_theme_mod( 'base_typography_xl', '1.188em' ) );

	// Site Width.
	$default_site_width = '1340';
	$site_width         = esc_attr( get_theme_mod( 'site_width', $default_site_width ) );

	/* Custom Style Output */

	$custom_style_out = '';

	$custom_style_out .= 'body { font-size: ' . $base_typography_mobile . ';}';
	$custom_style_out .= ' @media (min-width: 600px) and (max-width: 1199px) { body {font-size: ' . $base_typography_tablet . '}} ';
	$custom_style_out .= ' @media (min-width: 1200px) and (max-width: 1799px) { body {font-size: ' . $base_typography_desktop . '}} ';
	$custom_style_out .= ' @media (min-width: 1800px) { body {font-size: ' . $base_typography_desktop_big . '}} ';

	$custom_style_out .= $scale_mobile;
	$custom_style_out .= $scale_tablet;
	$custom_style_out .= $scale_desktop;
	$custom_style_out .= $scale_desktop_big;

	$custom_style_out .= '.grid-container {max-width: ' . $site_width . 'px}';

	$hamburger_bp_min = esc_attr( get_theme_mod( 'hamburger_breakpoint', '1200' ) );
	$hamburger_bp_max = $hamburger_bp_min - 1;

	$custom_style_out .= '@media (min-width:' . $hamburger_bp_min . 'px){.sm-simple>.menu-item{padding:0 10px}.sm-simple>.menu-item.pr0{padding-right:0}.sm-simple>.menu-item.pl0{padding-left:0}.sm-simple>li>a:before{content:"";display:block;height:3px;left:0;right:0;bottom:0;position:absolute;transition:transform .3s ease;transform:scaleX(0)}.sm-simple>li>a.highlighted:before,.sm-simple>li>a:hover:before{background:#b10e1e;transform:scaleX(1)}.sm-simple>li.current-menu-item>a:before,.sm-simple>li.current-page-ancestor>a:before,.sm-simple>li.current_page_item>a:before,.sm-simple>li.current_page_parent>a:before{background:#ba321d;transform:scaleX(1)}.no-js .sm ul ul{min-width:12em;left:100%!important;top:0!important}.sm-simple a.highlighted .sub-arrow:after{content:"\f3d0"}.site-title-wrap{float:left;position:relative}.header-inline-menu-title .site-title-wrap{padding-left:15px}.menu-primary{align-items:center;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;margin-left:auto}.site-header .menu-items{float:left}.sm-simple ul{position:absolute;width:12em}.sm-simple li{float:left}.sm-simple.sm-rtl li{float:right}.sm-simple ul li,.sm-simple.sm-rtl ul li,.sm-simple.sm-vertical li{float:none}.sm-simple a{white-space:nowrap}.sm-simple ul a,.sm-simple.sm-vertical a{white-space:normal}.sm-simple .sm-nowrap>li>:not(ul) a,.sm-simple .sm-nowrap>li>a{white-space:nowrap}.sm-simple a{padding-top:.5em;padding-bottom:.5em;width:auto}.sm-simple ul li a{padding:.85em}.header-i-m-lr .sm-simple li:first-child a,.header-s-l .sm-simple li:first-child a{padding-left:0}.sm-simple a.disabled{background:#fff;color:#ccc}.sm-simple a.has-submenu{padding-right:10px}.sm-simple a .sub-arrow{width:8px;background:0 0}.sm-simple a .sub-arrow:after{font-size:12px}.sm-simple>li:first-child{border-left:0}.sm-simple ul{border:1px solid rgba(39,55,64,.09);-webkit-box-shadow:0 1px 1px rgba(0,0,0,.01);-moz-box-shadow:0 1px 1px rgba(0,0,0,.01);box-shadow:0 1px 1px rgba(0,0,0,.01);background:#fff}.sm-simple ul a.has-submenu{padding-right:30px}.sm-simple ul a .sub-arrow{position:absolute;right:12px}.sm-simple ul a .sub-arrow:after{position:absolute;right:12px;top:50%;margin-top:-6px;-ms-transform:rotate(-90deg);-webkit-transform:rotate(-90deg);transform:rotate(-90deg)}.sm-simple .sub-menu li{border-bottom:1px solid rgba(39,55,64,.09)}.sm-simple .sub-menu li:last-child{border-bottom:none}.sm-simple ul>li:first-child{border-top:0}.sm-simple span.scroll-down,.sm-simple span.scroll-up{display:none;position:absolute;overflow:hidden;visibility:hidden;background:#fff;height:20px}.sm-simple span.scroll-down-arrow,.sm-simple span.scroll-up-arrow{position:absolute;top:-2px;left:50%;margin-left:-8px;width:0;height:0;overflow:hidden;border-width:8px;border-style:dashed dashed solid dashed;border-color:transparent transparent #555 transparent}.sm-simple span.scroll-down-arrow{top:6px;border-style:solid dashed dashed dashed;border-color:#555 transparent transparent transparent}.sm-simple.sm-rtl a.has-submenu{padding-right:20px;padding-left:32px}.sm-simple.sm-rtl a .sub-arrow{right:auto;left:20px}.sm-simple.sm-rtl.sm-vertical a.has-submenu{padding:11px 20px}.sm-simple.sm-rtl.sm-vertical a .sub-arrow{right:20px;margin-right:-12px}.sm-simple.sm-rtl>li:first-child{border-left:1px solid #eee}.sm-simple.sm-rtl>li:last-child{border-left:0}.sm-simple.sm-rtl ul a.has-submenu{padding:11px 20px}.sm-simple.sm-rtl ul a .sub-arrow{right:20px;margin-right:-12px}.sm-simple.sm-vertical a .sub-arrow{right:auto;margin-left:-12px}.sm-simple.sm-vertical li{border-left:0;border-top:1px solid #eee}.sm-simple.sm-vertical>li:first-child{border-top:0}.access-inner{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between}.header-inline-menu-title .access-inner{-webkit-box-orient:horizontal;-webkit-box-direction:reverse;-ms-flex-direction:row-reverse;flex-direction:row-reverse}.menu-primary{width:auto}.header-inline-title-menu .site-access li:last-child,.header-stack-right .site-access li:last-child{padding-right:0}.header-inline-menu-title .site-access li:first-child,.header-stack-left .site-access li:first-child{padding-left:0}.main-menu-btn{display:none!important}.menu-primary-items{position:relative;top:0}.menu-primary-items[aria-expanded=false]{display:block}}';

	$custom_style_out .= '@media only screen and (max-width:' . $hamburger_bp_max . 'px){.sm-simple a .sub-arrow{background-color:rgba(39,55,64,.05)}.sm-simple a.highlighted .sub-arrow{background-color:rgba(39,55,64,.07)}.sm-simple ul a .sub-arrow,.sm-simple ul a.highlighted .sub-arrow{background-color:transparent}.sm-simple li a{border-top:1px solid rgba(39,55,64,.09)}.sm-simple li a{padding-top:15px;padding-bottom:15px}.sm-simple li a.has-submenu{padding-right:60px}.sm-simple li li{margin-left:0}.sm-simple li li a{padding-left:15px;padding-right:5px;padding-top:15px;padding-bottom:15px}.sm-simple .sub-menu li a:hover{background:0 0}.sm-simple li.cta a{border:none;margin-top:15px;margin-bottom:25px;text-align:center}}';

	$headerstack_bp = esc_attr( get_theme_mod( 'headerstack_breakpoint', '0' ) );
	if ( ( $headerstack_bp > 0 ) && ( $hamburger_bp_min <= 0 ) ) {
		$custom_style_out .= '@media (max-width:' . $headerstack_bp . 'px){#access-inner{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.site-title-wrap{padding:0!important;margin-left:auto!important;margin-right:auto!important;text-align:center!important}.site-title{text-align:center}.menu-primary{margin-left:auto!important;margin-right:auto!important}#menu-primary-items{margin-left:auto!important;margin-right:auto!important;-ms-flex-wrap:wrap;-webkit-flex-wrap:wrap;flex-wrap:wrap;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}}';
	}

	$btndefaults = array(
		'btn-primary'   => '#00823B',
		'btn-cart'      => '#00823B',
		'btn-secondary' => '#E8E8E8',
	);
	$btnvalue    = get_theme_mod( 'buttons_color', $btndefaults );

	$custom_style_out .= '.btn-primary, .btn, input[type="submit"], .gform_button {background:' . $btnvalue['btn-primary'] . '}';

	$custom_style_out .= '.woocommerce #main a.button, .woocommerce #main button.button, .sidebar-primary .edd_checkout a, .sidebar-special .edd_checkout a, #main .edd_go_to_checkout.button, #main .edd-add-to-cart.button, #main .woocommerce a.button.alt, #main .woocommerce button.button.alt, #main .woocommerce input.button.alt {background:' . $btnvalue['btn-cart'] . '}';

	$custom_style_out .= '.woocommerce #main #respond input#submit, #main .woocommerce button.button {background:' . $btnvalue['btn-secondary'] . '}';

	return $custom_style_out;
}

/**
 * Cache the customizer styles.
 */
function themelia_customizer_styles_cache() {

	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database.
		$data = get_theme_mod( 'themelia_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data === false ) {
			// We'll be adding our actual CSS using a filter.
			$data = apply_filters( 'themelia_customizer_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'themelia_customizer_styles', $data );
		}

		// If we're on the customizer, get all the styles using our filter.
	} else {
		$data = apply_filters( 'themelia_customizer_styles_filter', null );
	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'themelia-style' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples.
	wp_add_inline_style( 'themelia-style', $data );
}

/**
 * Reset the cache when saving the customizer.
 */
function themelia_reset_style_cache_on_customizer_save() {

	remove_theme_mod( 'themelia_customizer_styles' );
}
