<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head <?php hybrid_attr( 'head' ); ?>>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div <?php hybrid_attr( 'container' ); ?>>

		<a href="#content" class="skip-link screen-reader-text focusable"><?php esc_html_e( 'Skip to content', 'themelia' ); ?></a><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

			<div <?php hybrid_attr( 'branding' ); ?>>
				<div <?php hybrid_attr( 'access' ); ?>>
                    <div <?php hybrid_attr( 'access-inner' ); ?>>

						<?php themelia_construct_site_title(); ?>

						<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

					</div><!-- .access-inner -->
				</div><!-- #access -->
			</div><!-- #branding -->

		</header><!-- #header -->

		<div <?php hybrid_attr( 'main' ); ?>>
			<div <?php hybrid_attr( 'grid-container' ); ?>>
				<div class="grid-100 grid-parent main-inner">
					<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
