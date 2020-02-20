<?php if ( ! in_array( hybrid_get_theme_layout(), array( '1c', '1c-narrow' ) ) ) : // If not a one-column layout. ?>

	<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

		<h3 id="sidebar-primary-title" class="screen-reader-text"><?php
			// Translators: %s is the sidebar name. This is the sidebar title shown to screen readers.
			printf( _x( '%s Sidebar', 'Screen reader text - sidebar title', 'themelia' ), hybrid_get_sidebar_name( 'primary' ) );
		?></h3>

		<div class="sidebar-inner">
			<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

				<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

			<?php endif; // End widgets check. ?>
		</div>

	</aside><!-- #sidebar-primary -->

<?php endif; // End layout check. ?>
