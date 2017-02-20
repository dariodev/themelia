<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<!-- Mobile menu toggle button (hamburger/x icon) -->
		<button id="menu-toggle" class="menu-toggle hamburger hamburger--spin main-menu-btn is-not-active" type="button" aria-controls="menu-primary-items" aria-expanded="false">
		  <span class="hamburger-box">
		    <span class="hamburger-inner"></span>
		  </span>
		  <span class="screen-reader-text"><?php _ex( 'Menu', 'Screen reader text', 'themelia' ); ?></span>
		</button>

		<?php wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'container'       => '',
                'menu_id'         => 'menu-primary-items',
                'menu_class'      => 'menu-primary-items menu-items sm sm-simple',
                'fallback_cb'     => '',
                'items_wrap'      => '<ul id="%s" class="%s" aria-expanded="false">%s</ul>'
            )
        ); ?>

	</nav><!-- #menu-primary -->

<?php endif; // End check for menu. ?>
