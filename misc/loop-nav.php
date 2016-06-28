<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

        <?php
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'themelia' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'themelia' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'themelia' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'themelia' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		?>

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

    <?php themelia_paging_nav( 'nav-below' ); ?>

<?php endif; // End check for type of page being viewed. ?>