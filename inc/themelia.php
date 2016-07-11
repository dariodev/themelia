<?php
# Register Theme styles.
add_action( 'wp_enqueue_scripts', 'themelia_register_styles', 0 );

# Register custom image sizes.
//add_action( 'init', 'themelia_register_image_sizes', 5 );

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

# Custom filtering for Site Title & Description
add_filter( 'hybrid_site_title', 'themelia_get_site_title');
add_filter( 'hybrid_site_description', 'themelia_get_site_description');

# Add custom image sizes attribute to enhance responsive image functionality for post thumbnails
add_filter( 'wp_get_attachment_image_attributes', 'themelia_post_thumbnail_sizes_attr', 10 , 3 );

#Changing excerpt more
add_filter('excerpt_more', 'themelia_new_excerpt_more');

#Read More Button For Excerpt
add_filter( 'the_excerpt', 'themeprefix_excerpt_read_more_link' );

# Disable default Breadcrumbs for bbPress plugin.
add_filter ('bbp_no_breadcrumb', 'themelia_bbp_no_breadcrumb');


/**
 * Registers custom image sizes for the theme.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_register_image_sizes() {
	// Sets the 'post-thumbnail' size.
	set_post_thumbnail_size( 150, 150, true );
}

/**
 * Registers nav menu locations.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_register_menus() {
	register_nav_menu( 'primary',    esc_html_x( 'Primary Menu', 'nav menu location', 'themelia' ) );
	register_nav_menu( 'mobile',     esc_html_x( 'Mobile  Menu', 'nav menu location', 'themelia' ) );
	register_nav_menu( 'subsidiary', esc_html_x( 'Footer  Menu', 'nav menu location', 'themelia' ) );
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
 * Enqueues scripts.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_enqueue_scripts() {

	$suffix = hybrid_get_min_suffix();

	wp_enqueue_script( 'hoverIntent' );
	wp_enqueue_script( 'plugins', trailingslashit( get_template_directory_uri() ) . "js/jquery.plugins{$suffix}.js", array( 'jquery' ),'1.0.1', true );
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

	// Register styles for use by themes.
	wp_register_style( 'themelia-unsemantic', $theme_css . "unsemantic{$suffix}.css", array(), null, 'all' );
	wp_register_style( 'themelia-ionicons', $theme_css . "ionicons{$suffix}.css", array(), null, 'all' );
	
	wp_register_style( 'themelia-parent',   hybrid_get_parent_stylesheet_uri() );
	wp_register_style( 'themelia-style',    get_stylesheet_uri() );
}


/**
 * Load stylesheets for the front end.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @return void
 */
function themelia_enqueue_styles() {

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
 * @dariodev
 *
 */
 
 
 /**
 * Sidebar attributes.
 *
 * @since  Themelia 1.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
add_filter( 'hybrid_attr_sidebarcustom', 'hybrid_attr_sidebarcustom', 5, 2 );
function hybrid_attr_sidebarcustom( $attr, $context ) {

	$attr['class'] = 'sidebar';
	$attr['role']  = 'complementary';

	if ( $context ) {

		$attr['class'] .= " sidebar-{$context}";
		$attr['id']     = "sidebar-{$context}";

		$sidebar_name = hybrid_get_sidebar_name( $context );

		if ( $sidebar_name ) {
			// Translators: The %s is the sidebar name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Sidebar', 'sidebar aria label', 'hybrid-core' ), $sidebar_name ) );
		}
	}

	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'http://schema.org/WPSideBar';

	return $attr;
}
 
/**
 * Menu fallback. 
 *
 * @param  array $args
 * @return string
 * @since Themelia 1.0.0
 */
/**
 * Menu fallback. Link to the menu editor if that is useful.
 *
 * @param  array $args
 * @return string
 */
function link_to_menu_editor( $args )
{
	if ( ! current_user_can( 'manage_options' ) )
	{
		return;
	}

	// see wp-includes/nav-menu-template.php for available arguments
	extract( $args );

	$link = $link_before
		. '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>'
		. $link_after;

	// We have a list
	if ( FALSE !== stripos( $items_wrap, '<ul' )
		or FALSE !== stripos( $items_wrap, '<ol' )
	)
	{
		$link = "<li>$link</li>";
	}

	$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
	if ( ! empty ( $container ) )
	{
		$output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
	}

	if ( $echo )
	{
		echo $output;
	}

	return $output;
}
 

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
			'<span class="logo_helper"></span><a href="%1$s" title="%2$s" rel="home"><img class="logo-image branding-item" src="%3$s" alt="%2$s" title="%2$s" /></a>',
			apply_filters( 'themelia_logo_href' , esc_url( home_url( '/' ) ) ),
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
			<div class="site-title-wrap clearfix">
				
				<?php themelia_build_logo(); ?>
				
				<div class="titles-wrap branding-item">
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div>
				
			</div>
		<?php // endif;
	}
endif;


/**
 * Custom Paging Navigation.
 *
 * @package Themelia
 */
if ( ! function_exists( 'themelia_paging_nav' ) ) :
	function themelia_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'type'     => 'list',
			'mid_size' => apply_filters( 'themelia_pagination_mid_size', 2 ),
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'themelia' ),
			'next_text' => __( 'Next &rarr;', 'themelia' ),
		) );

		if ( $links ) :

			echo '<div class="pagination">' . $links . '</div>'; 

		endif;
	}
endif;


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
			$title = sprintf( '<h1 %s><a href="%s" rel="home">%s</a></h1>', hybrid_get_attr( 'site-title' ), esc_url( home_url() ), $title );
		else :
			$title = sprintf( '<p %s><a href="%s" rel="home">%s</a></p>', hybrid_get_attr( 'site-title' ), esc_url( home_url() ), $title );
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
		is_active_sidebar( 'primary' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'primary' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
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


function themelia_new_excerpt_more($more) {
	return '&hellip;';
}


//Read More Button For Excerpt
function themeprefix_excerpt_read_more_link( $output ) {
	global $post;
	return $output . ' <a href="' . get_permalink( $post->ID ) . '" class="entry-more-link"><span>' . esc_attr_x( 'Read More', 'excerpt', 'themelia' ) . '</span></a>';
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
