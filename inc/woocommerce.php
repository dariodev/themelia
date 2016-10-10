<?php	
/**
 * WooCommerce support
 */
add_theme_support( 'woocommerce' );

/**
 * Remove default WooCommerce wrappers
 * @since 1.0
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Change number or products per row to 3
if ( is_active_sidebar( 'woocommerce' )  ) :
	add_filter('loop_shop_columns', 'loop_columns');
endif;

if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter( 'body_class', 'themelia_woocommerce_classes', 6 );
function themelia_woocommerce_classes( $classes ) {

	if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
		$classes[]	= 'no-wc-breadcrumb';
	}

	/**
	 * What is this?!
	 * Take the blue pill, close this file and forget you saw the following code.
	 * Or take the red pill, filter storefront_make_me_cute and see how deep the rabbit hole goes...
	 */
	$cute = apply_filters( 'storefront_make_me_cute', false );

	if ( true === $cute ) {
		$classes[] = 'woocommerce-columns-' . loop_columns();
	}

	if ( is_active_sidebar( 'woocommerce' )  ) {
		$classes[] = 'woocommerce-columns-3';
	} else {
		$classes[] = 'woocommerce-columns-4';
	}


	// If our main sidebar doesn't contain widgets, adjust the layout to be full-width.
	if ( ! is_active_sidebar( 'woocommerce' ) ) {
		$classes[] = 'woocommerce-no-sidebar';
	}

	return $classes;
}

	/**
	 * Add WooCommerce starting wrappers
	 * @since 1.3.22
	 */
	add_action('woocommerce_before_main_content', 'themelia_woocommerce_start', 10);
	function themelia_woocommerce_start()
	{ ?>

	<main <?php hybrid_attr( 'content' ); ?>>

		<?php do_action( 'themelia_before_content'); ?>

	<?php }

	/**
	 * Add WooCommerce ending wrappers
	 * @since 1.3.22
	 */
	add_action('woocommerce_after_main_content', 'themelia_woocommerce_end', 10);
	function themelia_woocommerce_end()
	{
	?>

		  <?php do_action( 'themelia_after_content'); ?>

	</main>

<?php
}