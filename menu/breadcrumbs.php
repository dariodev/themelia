<?php if ( true == get_theme_mod( 'display_breadcrumbs', true ) && function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>

	<?php
	breadcrumb_trail(
		array(
			'container'     => 'nav',
			'show_on_front' => false,
			'show_browse'   => false,
			'show_title'    => true,
			'before'        => '',
			'after'         => '',
			'labels'        => array(
				'browse' => esc_html_x( 'You are here', 'Breadcrumb', 'themelia' ),
				'home'   => esc_html_x( 'Home', 'Breadcrumb', 'themelia' ),
			)
		)
	);
	?>

	<?php
endif; // End check for breadcrumb support.
