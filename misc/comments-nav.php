<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : // Check for paged comments. ?>

	<nav class="comments-nav" role="navigation" aria-labelledby="comments-nav-title">

		<h3 id="comments-nav-title" class="screen-reader-text"><?php esc_html_e( 'Comments Navigation', 'themelia' ); ?></h3>

		<?php previous_comments_link( esc_html_x( '&larr; Previous', 'comments navigation', 'themelia' ) ); ?>

		<span class="page-numbers"><?php
			// Translators: Comments page numbers. 1 is current page and 2 is total pages.
			printf( esc_html__( 'Page %1$s of %2$s', 'themelia' ), get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() );
		?></span>

		<?php next_comments_link( esc_html_x( 'Next &rarr;', 'comments navigation', 'themelia' ) ); ?>

	</nav><!-- .comments-nav -->

<?php endif; // End check for paged comments. ?>