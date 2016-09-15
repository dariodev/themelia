<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<?php
		// Previous/next post navigation.
		themelia_post_nav();
	?>

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php
		// Pagination.
		themelia_paging_nav();
	?>

<?php endif; // End check for type of page being viewed. ?>