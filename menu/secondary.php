<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>

	<nav <?php hybrid_attr( 'menu', 'secondary' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'depth'           => 1,
				'menu_id'         => 'menu-secondary-items',
				'menu_class'      => 'menu-items sf-menu js-superfish',
				'fallback_cb'     => '',
				'items_wrap'      => '<div class="wrap-mobile grid-container"><div class="grid-100"><ul id="%s" class="%s">%s</ul></div></div>'
			)
		); ?>

	</nav><!-- #menu-secondary -->

<?php endif; // End check for menu. ?>