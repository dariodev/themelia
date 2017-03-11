<?php
/**
 * WooCommerce support
 */
add_theme_support( 'woocommerce' );

/**
 * Remove default WooCommerce wrappers
 * @since 1.0.0
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action(    'themelia_before_main_content',    'woocommerce_breadcrumb', 20, 0 );

// Change number or products per row to 3
if ( is_active_sidebar( 'special' )  ) :
	add_filter('loop_shop_columns', 'themelia_loop_columns');
endif;

if (!function_exists('themelia_loop_columns')) {
	function themelia_loop_columns() {
		return 3; // 3 products per row
	}
}

/**
 * Disable Jetpack Infinite Scroll for WooCommerce
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
if ( ! function_exists( 'themelia_disable_jetpack_infinite_scroll_conditionally' ) ) {
	/**
	 * _disable_jetpack_infinite_scroll_conditionally Disables infinite scroll on WooCommerce pages
	 * Original code credit https://gist.github.com/rspublishing/6b0b2d2eabafa514bd48045d1860f24b
	 */
	function themelia_disable_jetpack_infinite_scroll_conditionally() {
		if ( true === is_woocommerce() ) {
			remove_theme_support( 'infinite-scroll' );
		}
	}
	add_action( 'template_redirect', 'themelia_disable_jetpack_infinite_scroll_conditionally', 9 );
}


add_filter( 'woocommerce_breadcrumb_defaults', 'themelia_woocommerce_breadcrumbs' );
function themelia_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs" itemprop="breadcrumb"><ul class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li class="trail-item">',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'woocommerce breadcrumb', 'themelia' ),
        );
}

add_filter( 'body_class', 'themelia_woocommerce_classes', 6 );
function themelia_woocommerce_classes( $classes ) {

	if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
		$classes[]	= 'no-wc-breadcrumb';
	}

	/**
	 * Alter number of columns.
	 */
	if ( is_active_sidebar( 'special' )  ) {
		$classes[] = 'woocommerce-columns-3';
	} else {
		$classes[] = 'woocommerce-columns-4';
	}


	// If our main sidebar doesn't contain widgets, adjust the layout to be full-width.
	if ( ! is_active_sidebar( 'special' ) ) {
		$classes[] = 'woocommerce-no-sidebar';
	}

	return $classes;
}

	/**
	 * Add WooCommerce starting wrappers
	 * @since 1.0.0
	 */
	add_action('woocommerce_before_main_content', 'themelia_woocommerce_start', 10);
	function themelia_woocommerce_start()
	{ ?>

<div <?php hybrid_attr( 'main' ); ?>>
    <div <?php hybrid_attr( 'grid-container' ); ?>>
        <div class="grid-100 grid-parent main-inner">

        	<?php do_action( 'themelia_before_main_content' ); ?>

            <main <?php hybrid_attr( 'content' ); ?>>

                <?php do_action( 'themelia_before_content'); ?>

            <?php }

            /**
             * Add WooCommerce ending wrappers
             * @since 1.0.0
             */
            add_action('woocommerce_after_main_content', 'themelia_woocommerce_end', 10);
            function themelia_woocommerce_end()
            {
            ?>

                  <?php do_action( 'themelia_after_content'); ?>

            </main>
			<?php hybrid_get_sidebar( themelia_primary_sidebar('special') ); // Calls themelia_primary_sidebar() function and loads the sidebar/*.php template. ?>
        </div><!-- .inner .main-inner -->
    </div><!-- .grid-container -->
</div><!-- #main -->
<?php
}
