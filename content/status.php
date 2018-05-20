<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<?php if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>

			<header class="entry-header">
				<?php echo get_avatar( get_the_author_meta( 'email' ) ); ?>
			</header><!-- .entry-header -->

		<?php endif; // End avatars check. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<div class="entry-byline small">
			<?php hybrid_post_format_link(); ?>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
			<?php
			if ( true != get_theme_mod( 'postby_full' ) )
				{ ?>
				<span class="post-by"><?php echo esc_html_x( 'by', 'post author', 'themelia' ) ?></span>
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
				<?php
				}
			?>
			<?php themelia_comments_link(); ?>
			<?php themelia_edit_link(); ?>
		</div><!-- .entry-byline -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => '<span>,</span> ',  'text' => __( '<span class="title">Posted in: </span>%s', 'themelia' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '<span>,</span> ', 'text' => __( '<span class="title">Tagged: </span>%s', 'themelia' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<?php if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>

			<header class="entry-header">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_avatar( get_the_author_meta( 'email' ) ); ?></a>
			</header><!-- .entry-header -->

		<?php endif; // End avatars check. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<?php //if ( ! get_option( 'show_avatars' ) ) : // If avatars are not enabled. ?>

			<footer class="entry-footer">
				<?php themelia_comments_link(); ?>
				<?php themelia_edit_link(); ?>
			</footer><!-- .entry-footer -->

		<?php //endif; // End avatars check. ?>

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
