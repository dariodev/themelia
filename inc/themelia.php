<?php
# Detect javascript.
add_action( 'wp_head', 'themelia_javascript_detection', 0 );

# Register Theme styles.
add_action( 'wp_enqueue_scripts', 'themelia_register_styles', 0 );

# Register custom image sizes.
add_action( 'init', 'themelia_register_image_sizes', 5 );

# Register custom menus.
add_action( 'init', 'themelia_register_menus', 5 );

# Register sidebars.
add_action( 'widgets_init', 'themelia_register_sidebars', 5 );

# Register custom layouts.
add_action( 'hybrid_register_layouts', 'themelia_register_layouts' );

# Add custom scripts and styles
add_action( 'wp_enqueue_scripts', 'themelia_enqueue_scripts', 5 );
add_action( 'wp_enqueue_scripts', 'themelia_enqueue_styles',  5 );

# Adds custom settings for the visual editor.
add_filter( 'tiny_mce_before_init', 'themelia_tiny_mce_before_init' );

# Add custom attributes
add_filter( 'hybrid_attr_content', 'themelia_attr_content' );
add_filter( 'hybrid_attr_sidebar', 'themelia_attr_sidebar' );
add_filter( 'hybrid_attr_sidebarcustom', 'themelia_attr_sidebarcustom', 5, 2 );
add_filter( 'hybrid_attr_container', 'themelia_attr_container', 5 );
add_filter( 'hybrid_attr_branding', 'themelia_attr_branding', 5 );
add_filter( 'hybrid_attr_access', 'themelia_attr_access', 5 );
add_filter( 'hybrid_attr_access-inner', 'themelia_attr_access_inner', 5 );
add_filter( 'hybrid_attr_main', 'themelia_attr_main', 5 );

# Custom filtering for Site Title & Description
add_filter( 'hybrid_site_title', 'themelia_get_site_title');
add_filter( 'hybrid_site_description', 'themelia_get_site_description');

# Add custom image sizes attribute to enhance responsive image functionality for post thumbnails
add_filter( 'wp_get_attachment_image_attributes', 'themelia_post_thumbnail_sizes_attr', 10 , 3 );

# Changing excerpt more
add_filter('excerpt_more', 'themelia_excerpt_more');

# Read More Button For Excerpt
add_filter( 'the_excerpt', 'themelia_excerpt_read_more_link' );

# Disable default Breadcrumbs for bbPress plugin.
add_filter ('bbp_no_breadcrumb', 'themelia_bbp_no_breadcrumb');

# Filters the archive title.
remove_filter( 'get_the_archive_title', 'hybrid_archive_title_filter',   5  );
add_filter(    'get_the_archive_title', 'themelia_archive_title_filter', 5  );


/**
 * Javascript detection.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

/**
 * Registers custom image sizes for the theme.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_register_image_sizes() {

	// Sets the 'post-thumbnail' size.
	// set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'hero-image', 1280 );
}


/**
 * Registers nav menu locations.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_register_menus() {

	register_nav_menu( 'primary',    esc_html_x( 'Primary', 'nav menu location', 'themelia' ) );
	register_nav_menu( 'subsidiary', esc_html_x( 'Footer', 'nav menu location', 'themelia' ) );
}


/**
 * Registers layouts.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_register_layouts() {

	hybrid_register_layout( '1c',   array( 'label' => esc_html__( '1 Column',                     'themelia' ), 'image' => '%s/images/layouts/1c.png'   ) );
	hybrid_register_layout( '2c-l', array( 'label' => esc_html__( '2 Columns: Content / Sidebar', 'themelia' ), 'image' => '%s/images/layouts/2c-l.png' ) );
	hybrid_register_layout( '2c-r', array( 'label' => esc_html__( '2 Columns: Sidebar / Content', 'themelia' ), 'image' => '%s/images/layouts/2c-r.png' ) );
}


/**
 * Registers sidebars.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => esc_html_x( 'Primary', 'sidebar', 'themelia' ),
			'description' => esc_html__( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'themelia' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'subsidiary',
			'name'        => esc_html_x( 'Subsidiary', 'sidebar', 'themelia' ),
			'description' => esc_html__( 'A sidebar located in the upper footer of the site. Optimized for one wide widget (and multiples thereof).', 'themelia' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer-1',
			'name'        => _x( 'Footer 1', 'sidebar', 'themelia' ),
			'description' => __( 'A sidebar located in the footer of the site. Optimized for one, two, three or four widgets (and multiples thereof).', 'themelia' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer-2',
			'name'        => _x( 'Footer 2', 'sidebar', 'themelia' ),
			'description' => __( 'A sidebar located in the footer of the site. Optimized for one, two, three or four widgets (and multiples thereof).', 'themelia' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer-3',
			'name'        => _x( 'Footer 3', 'sidebar', 'themelia' ),
			'description' => __( 'A sidebar located in the footer of the site. Optimized for one, two, three or four widgets (and multiples thereof).', 'themelia' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer-4',
			'name'        => _x( 'Footer 4', 'sidebar', 'themelia' ),
			'description' => __( 'A sidebar located in the footer of the site. Optimized for one, two, three or four widgets (and multiples thereof).', 'themelia' )
		)
	);
}

if ( class_exists( 'WooCommerce' ) || class_exists( 'Easy_Digital_Downloads' ) ) {

	add_action( 'widgets_init', 'themelia_register_special_sidebar', 5 );
}

function themelia_register_special_sidebar() {

	hybrid_register_sidebar(
		array(
			'id'          => 'special',
			'name'        => esc_html_x( 'Shop', 'sidebar', 'themelia' ),
			'description' => esc_html__( 'This is the replacement of the main sidebar. It is displayed on shop pages (WooCommerce or EDD).', 'themelia' )
		)
	);
}

function themelia_primary_sidebar() {

	if ( class_exists( 'WooCommerce' ) || class_exists( 'Easy_Digital_Downloads' ) ) {
		if ( is_singular( 'product' ) || is_post_type_archive( 'product' ) || is_singular( 'download' ) || is_post_type_archive( 'download' ) ) {
			return 'special';
		} else {
			return 'primary';
		}
	} else {
		return 'primary';
	}
}

/**
 * Filters `get_the_archve_title` to add better archive titles than core.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @param  string  $title
 * @return string
 */
function themelia_archive_title_filter( $title ) {

	if ( is_home() && ! is_front_page() )
		$title = get_post_field( 'post_title', get_queried_object_id() );

	elseif ( is_category() )
		$title = single_cat_title( '', false );

	elseif ( is_tag() )
		$title = single_tag_title( '', false );

	elseif ( is_tax( 'post_format' ) )
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title' );
			}

	elseif ( is_tax() )
		$title = single_term_title( '', false );

	elseif ( is_author() )
		$title = hybrid_get_single_author_title();

	elseif ( is_search() )
		$title = hybrid_get_search_title();

	elseif ( is_post_type_archive() )
		$title = post_type_archive_title( '', false );

	elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
		$title = hybrid_get_single_minute_hour_title();

	elseif ( get_query_var( 'minute' ) )
		$title = hybrid_get_single_minute_title();

	elseif ( get_query_var( 'hour' ) )
		$title = hybrid_get_single_hour_title();

	elseif ( is_day() )
		$title = hybrid_get_single_day_title();

	elseif ( get_query_var( 'w' ) )
		$title = hybrid_get_single_week_title();

	elseif ( is_month() )
		$title = single_month_title( ' ', false );

	elseif ( is_year() )
		$title = hybrid_get_single_year_title();

	elseif ( is_archive() )
		$title = hybrid_get_single_archive_title();

	return apply_filters( 'hybrid_archive_title', $title );
}


/**
 * Returns the font args for the theme's Google Fonts call.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function themelia_get_locale_font_args() {

	$fonts  = themelia_get_locale_fonts();
	$locale = strtolower( get_locale() );
	$args   = isset( $fonts[ $locale ] ) ? $fonts[ $locale ] : $fonts['default'];

	return apply_filters( "themelia_{$locale}_font_args", $args );
}

/**
 * Returns an array of locale-specific font arguments
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function themelia_get_locale_fonts() {

	$fonts = array(
		'default' => array( 'family' => themelia_get_font_families(), 'subset' => themelia_get_font_subsets() ),
	);

	if ( !class_exists( 'Kirki' ) ) {
		// Return only if Kirki library is not included
		return apply_filters( 'themelia_get_locale_fonts', $fonts );
	}
}

/**
 * Returns an array of the font families to load from Google Fonts.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function themelia_get_font_families() {

	return array(
		'roboto'	=> 'Roboto:300,400,400i,500,600,700,700i',
		'work-sans'	=> 'Work+Sans:200,300,400,500,600,700'
	);
}

/**
 * Returns an array of the font subsets to include.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function themelia_get_font_subsets() {

	return array( 'latin' );
}




/**
 * Enqueues scripts.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_enqueue_scripts() {

	$suffix = hybrid_get_min_suffix();

	//wp_enqueue_script( 'hoverIntent' );
	wp_enqueue_script( 'imagesloaded', trailingslashit( get_template_directory_uri() ) . "js/imagesloaded.pkgd{$suffix}.js", array( 'jquery' ),'1.0.1', true );
	wp_enqueue_script( 'fitvids', trailingslashit( get_template_directory_uri() ) . "js/jquery.fitvids{$suffix}.js", array( 'jquery' ),'1.0.1', true );
	wp_enqueue_script( 'smartmenus', trailingslashit( get_template_directory_uri() ) . "js/jquery.smartmenus{$suffix}.js", array( 'jquery' ), '1.0.1', true );
	wp_enqueue_script( 'smartmenus-keyboard', trailingslashit( get_template_directory_uri() ) . "js/jquery.smartmenus.keyboard{$suffix}.js", array( 'jquery' ), '1.0.1', true );
	wp_enqueue_script( 'themelia', trailingslashit( get_template_directory_uri() ) . "js/themelia{$suffix}.js", array( 'jquery' ), '1.0.1', true );
	// Load the html5 shiv.
	wp_enqueue_script( 'themelia-html5', get_template_directory_uri() . '/js/html5{$suffix}.js', array(), '3.7.3' );
	wp_script_add_data( 'themelia-html5', 'conditional', 'lt IE 9' );

	wp_localize_script(
		'themelia',
		'themelia_i18n',
		array(
			'search_toggle' => esc_html__( 'Expand Search Form', 'themelia' )
		)
	);

}


/**
 * Registers stylesheets for the theme.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @global object  $wp_styles
 */
function themelia_register_styles() {

	global $wp_styles;

	$suffix = hybrid_get_min_suffix();
	$theme_css = trailingslashit( get_template_directory_uri() ) . 'css/';

	// Register fonts.
	hybrid_register_font( 'themelia', themelia_get_locale_font_args() );

	// Register styles for use by themes.
	wp_register_style( 'themelia-unsemantic', $theme_css . "unsemantic{$suffix}.css", array(), null, 'all' );
	wp_register_style( 'themelia-ionicons', $theme_css . "ionicons{$suffix}.css", array(), null, 'all' );
	wp_register_style( 'themelia-parent',   hybrid_get_parent_stylesheet_uri() );
	wp_register_style( 'themelia-style',    get_stylesheet_uri() );

	// Registering locale style for embeds. @see https://core.trac.wordpress.org/ticket/36839
	wp_register_style( 'themelia-locale', get_locale_stylesheet_uri() );
}


/**
 * Load stylesheets for the front end.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_enqueue_styles() {

	// Load fonts.
	hybrid_enqueue_font( 'themelia' );

	// Load Ionicons.
	wp_enqueue_style( 'themelia-ionicons' );

	// Load Unsemantic CSS framework.
	wp_enqueue_style( 'themelia-unsemantic' );

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() )
		wp_enqueue_style( 'themelia-parent' );

	// Load theme stylesheet.
	wp_enqueue_style( 'themelia-style' );

}


/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return array
 */
function themelia_get_editor_styles() {

	// Set up an array for the styles.
	$editor_styles = array();

	// Add the theme's editor styles.
	$editor_styles[] = themelia_get_parent_editor_stylesheet_uri();

	// If a child theme, add its editor styles.
	if ( is_child_theme() && $style = themelia_get_editor_stylesheet_uri() )
		$editor_styles[] = themelia_get_editor_stylesheet_uri();

	// Add the locale stylesheet.
	$editor_styles[] = get_locale_stylesheet_uri();

	// Return the styles.
	return $editor_styles;
}


/**
 * Returns the active theme editor stylesheet URI.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return string
 */
function themelia_get_editor_stylesheet_uri() {

	$style_uri = '';
	$suffix    = hybrid_get_min_suffix();
	$dir       = trailingslashit( get_stylesheet_directory() );
	$uri       = trailingslashit( get_stylesheet_directory_uri() );

	if ( $suffix && file_exists( "{$dir}css/editor-style{$suffix}.css" ) )
		$style_uri = "{$uri}css/editor-style{$suffix}.css";

	else if ( file_exists( "{$dir}css/editor-style.css" ) )
		$style_uri = "{$uri}css/editor-style.css";

	return $style_uri;
}


/**
 * Returns the parent theme editor stylesheet URI.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return string
 */
function themelia_get_parent_editor_stylesheet_uri() {

	$style_uri = '';
	$suffix    = hybrid_get_min_suffix();
	$dir       = trailingslashit( get_template_directory() );
	$uri       = trailingslashit( get_template_directory_uri() );

	if ( $suffix && file_exists( "{$dir}css/editor-style{$suffix}.css" ) )
		$style_uri = "{$uri}css/editor-style{$suffix}.css";

	else if ( file_exists( "{$dir}css/editor-style.css" ) )
		$style_uri = "{$uri}css/editor-style.css";

	return $style_uri;
}


/**
 * Adds the <body> class to the visual editor.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @param  array  $settings
 * @return array
 */
function themelia_tiny_mce_before_init( $settings ) {

	$settings['body_class'] = join( ' ', get_body_class() );

	return $settings;
}


/**
 * Sidebar attributes.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function themelia_attr_sidebarcustom( $attr, $context ) {

	$attr['class'] = 'sidebar';
	$attr['role']  = 'complementary';

	if ( $context ) {

		$attr['class'] .= " sidebar-{$context}";
		$attr['id']     = "sidebar-{$context}";

		$sidebar_name = hybrid_get_sidebar_name( $context );

		if ( $sidebar_name ) {
			// Translators: The %s is the sidebar name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Sidebar', 'sidebar aria label', 'themelia' ), $sidebar_name ) );
		}
	}

	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/WPSideBar';

	return $attr;
}


/**
 * Custom attributes / build layout.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function themelia_attr_content( $attr ) {

	if ( '1c' == hybrid_get_theme_layout() ) :
		$attr['class'] .= ' grid-100';
	endif;

	if ( '2c-l' == hybrid_get_theme_layout() ) :
		$attr['class'] .= ' grid-70 tablet-grid-66';
	endif;

	if ( '2c-r' == hybrid_get_theme_layout() ) :
		$attr['class'] .= ' grid-70 tablet-grid-66 push-30 tablet-push-33';
	endif;

	return $attr;
}

function themelia_attr_sidebar( $attr ) {

	if ( '2c-r' == hybrid_get_theme_layout() ) :
		$attr['class'] .= ' pull-70 tablet-pull-66';
	endif;

	$attr['class'] .= ' grid-30 tablet-grid-33';

	return $attr;
}


/**
 * Custom filters / Containers attributes.
 *
 * @since  Themelia 1.0.4
 * @access public
 * @param  array   $attr
 * @return array
 */
function themelia_attr_container( $attr ) {

	$attr['id']       = 'container';
	$attr['class']    = 'container';

	return $attr;
}

function themelia_attr_branding( $attr ) {

	$attr['id']       = 'branding';
	$attr['class']   .= ' grid-container';

	return $attr;
}

function themelia_attr_access( $attr ) {

	$attr['id']       = 'access';
	$attr['class']    = 'site-access';
	$attr['class']   .= ' grid-100';

	return $attr;
}

function themelia_attr_access_inner( $attr ) {

	$attr['id']       = 'access-inner';
	$attr['class']    = 'access-inner';
	$attr['class']   .= ' relative';

	return $attr;
}

function themelia_attr_main( $attr ) {

	$attr['id']       = 'main';
	$attr['class']    = 'main';

	return $attr;
}


if ( ! function_exists( 'themelia_build_logo' ) ) :
	/**
	 * Build the logo
	 *
	 * @since Themelia 1.0.0
	 */
	function themelia_build_logo() {

		// Get our logo URL if we're using the custom logo
		$logo_url = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;

		// Get our logo from the custom logo
		$logo = $logo_url[0];

		// If we don't have a logo, return
		if ( empty( $logo ) )
			return;

		// Print our HTML
		printf(
			'<div class="logo-wrap flex-center"><img class="logo-image branding-item" src="%2$s" alt="%1$s" /></div>',
			apply_filters( 'themelia_logo_title', esc_attr( get_bloginfo( 'name', 'display' ) ) ),
			apply_filters( 'themelia_logo', esc_url( $logo ) )
		);
	}
endif;

if ( ! function_exists( 'themelia_construct_site_title' ) ) :
	/**
	 * Build the site title and tagline
	 *
	 * @since Themelia 1.0.0
	 */
	function themelia_construct_site_title()
	{
		 ?>

			<!-- Site title and logo -->

		<?php
        printf(
            '<a href="%1$s" class="site-title-wrap clearfix">',
            apply_filters( 'themelia_logo_href' , esc_url( home_url( '/' ) ) )
        );
        ?>

				<?php themelia_build_logo(); ?>

				<div class="branding-item-wrap flex-center">
					<div class="titles-wrap branding-item">
						<?php hybrid_site_title(); ?>
						<?php hybrid_site_description(); ?>
					</div>
				</div>
			</a>
		<?php // endif;
	}
endif;


if ( ! function_exists( 'themelia_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @package Themelia
	 */
	function themelia_paging_nav() {

		$args = array(
			'mid_size'  => apply_filters( 'themelia_pagination_mid_size', 2 ),
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'themelia' ),
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'themelia' )
			);

		the_posts_pagination( $args );
	}
}


if ( ! function_exists( 'themelia_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function themelia_post_nav() {

		$args = array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'themelia' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'themelia' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'themelia' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'themelia' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		);

		the_post_navigation( $args );
	}
}


/**
 * Returns the linked site title wrapped in an `<h1>` tag if we are on the front page, else wrap it in a `<p>` tag.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return string
 */
function themelia_get_site_title() {

	if ( $title = get_bloginfo( 'name' ) )
		if ( is_front_page() && is_home() ) :
			$title = sprintf( '<h1 %s>%s</h1>', hybrid_get_attr( 'site-title' ), $title );
		else :
			$title = sprintf( '<p %s>%s</p>', hybrid_get_attr( 'site-title' ), $title );
		endif;

	return $title;
}


/**
 * Returns the site description wrapped in an `<p>` tag.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return string
 */
function themelia_get_site_description() {

	if ( $desc = get_bloginfo( 'description' ) )
		$desc = sprintf( '<p %s>%s</p>', hybrid_get_attr( 'site-description' ), $desc );

	echo $desc;
}


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Themelia 1.0.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function themelia_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'primary' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, (max-width: 1620px) 90vw, 1200px';
	}
	return $attr;
}


if ( ! function_exists( 'themelia_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own themelia_post_thumbnail() function to override in a child theme.
 *
 * @since Themelia 1.0.0
 */
function themelia_post_thumbnail() {

	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;


/**
 * Filter the string displayed after a trimmed excerpt
 *
 * @since Themelia 1.0.0
 */
function themelia_excerpt_more($more) {

	return '&hellip;';
}


/**
 * Read More Button For Excerpt
 *
 * @since Themelia 1.0.0
 */
function themelia_excerpt_read_more_link( $output ) {

	global $post;
	return $output . ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="entry-more-link"><span>' . esc_attr_x( 'Read More', 'excerpt', 'themelia' ) . '</span></a>';
}


/**
 * Checks to see if the specified email address has a Gravatar image.
 *
 * @param	$email_address	The email of the address of the user to check
 * @return			          Whether or not the user has a gravatar
 * @since  Themelia 1.0.0
 */
function themelia_has_gravatar( $email_address ) {

	// Build the Gravatar URL by hasing the email address
	$url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';

	// Now check the headers...
	$headers = @get_headers( $url );

	// If 200 is found, the user has a Gravatar; otherwise, they don't.
	return preg_match( '|200|', $headers[0] ) ? true : false;

} // end example_has_gravatar


/**
 * Disable default Breadcrumbs for bbPress plugin.
 *
 * @since  Themelia 1.0.0
 */
function themelia_bbp_no_breadcrumb ($param) {

	return true;
}
