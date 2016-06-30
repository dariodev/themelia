<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>

	<div class="grid-100">
		<?php breadcrumb_trail(
			array( 
				'container'     => 'nav', 
				'show_on_front' => false,
				'show_browse'   => false,
				'show_title'    => true,
				'before'        => '',
				'after'         => '',
				'labels'        => array( 
					'browse'    => esc_html_x( 'You are here', 'Breadcrumb', 'themelia' ),
					'home'      => esc_html_x( 'Home', 'Breadcrumb', 'themelia' ),
				) 
			) 
		); ?>
	</div>
	
<?php endif; // End check for breadcrumb support. ?>