<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>
	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>
		<!-- Mobile menu toggle button (hamburger/x icon) -->
		<button id="menu-toggle" class="menu-toggle hamburger hamburger--spin main-menu-btn is-not-active" type="button" aria-controls="primary-menu" aria-expanded="false">
		  <span class="hamburger-box">
		    <span class="hamburger-inner"></span>
		  </span>
		  <span class="screen-reader-text">Menu</span>
		</button>

		<div class="big-wrap">
			<?php wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container'       => '',
					'menu_id'         => 'menu-primary-items',
					'menu_class'      => 'menu-items menu-primary sf-menu js-superfish sm sm-simple',
					'fallback_cb'     => '',
					'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
				)
			); ?>
		</div>
	</nav><!-- #menu-primary -->

<?php endif; // End check for menu. ?>