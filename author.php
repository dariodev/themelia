<?php get_header(); // Loads the header.php template. ?>

<div <?php hybrid_attr( 'main' ); ?>>
	<div <?php hybrid_attr( 'grid-container' ); ?>>
		<div class="grid-100 grid-parent main-inner">

			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>

			<main <?php hybrid_attr( 'content' ); ?>>

				<?php locate_template( array( 'misc/author-header.php' ), true ); // Loads the misc/archive-header.php template. ?>

				<?php if ( have_posts() ) : // Checks if any posts were found. ?>

					<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

						<?php the_post(); // Loads the post data. ?>

						<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>

					<?php endwhile; // End found posts loop. ?>

					<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

				<?php else : // If no posts were found. ?>

					<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

				<?php endif; // End check for posts. ?>

			</main><!-- #content -->

			<?php hybrid_get_sidebar( themelia_primary_sidebar('primary') ); // Calls themelia_primary_sidebar() function and loads the sidebar/*.php template. ?>

		</div><!-- .inner .main-inner -->
	</div><!-- .grid-container -->
</div><!-- #main -->

<?php hybrid_get_sidebar( 'subsidiary' ); // Loads the sidebar/subsidiary.php template. ?>

<?php get_footer(); // Loads the footer.php template. ?>
