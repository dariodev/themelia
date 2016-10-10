<?php if ( is_active_sidebar( 'subsidiary' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebarcustom', 'subsidiary' ); ?>>

		<div class="grid-container">
			<div class="grid-100">

				<?php dynamic_sidebar( 'subsidiary' ); // Displays the subsidiary sidebar. ?>

        	</div>
        </div>

	</aside><!-- #sidebar-subsidiary -->

<?php endif; // End widgets check. ?>