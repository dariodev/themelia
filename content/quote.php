<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

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

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<div class="entry-byline small">
			<?php hybrid_post_format_link(); ?>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
			<?php echo sprintf( ' <a class="permalink" href="%s">&#8734; Permalink</a>', esc_url( get_permalink() ) ) ?>
			<?php themelia_comments_link(); ?>
			<?php themelia_edit_link(); ?>
		</div><!-- .entry-byline -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
