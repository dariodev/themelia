<article <?php hybrid_attr( 'post' ); ?>>

	<?php
		$css_class = ' zero-comments';
		$number    = (int) get_comments_number( get_the_ID() );

		if ( 1 === $number )
			$css_class = ' one-comment';
		elseif ( 1 < $number )
		$css_class = ' multiple-comments';
	?>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer small">
			<?php hybrid_post_format_link(); ?>
			<span class="post-by"><?php echo esc_html_x( 'posted by', 'post author', 'themelia' ) ?></span>
			<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
			<?php edit_post_link(); ?><br />
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => '<span>,</span> ',  'text' => esc_html__( 'Posted in: %s', 'themelia' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '<span>,</span> ', 'text' => esc_html__( 'Tagged: %s', 'themelia' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<div class="entry-byline small">
			<?php hybrid_post_format_link(); ?>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
			<span class="post-by"><?php echo esc_html_x( 'by', 'post author', 'themelia' ) ?></span>
			<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
			<?php if ( comments_open() && 0 < $number  ) : '<span class="sep">' . _ex( ' | ', 'By Line separator', 'themelia' ) . '</span>'; endif ?>
			<?php comments_popup_link( ( '' ), '<span>' . number_format_i18n( 1 ) . '</span>' . __( ' Comment', 'themelia' ), '<span>%</span>' .  __( ' Comments', 'themelia' ), 'comments-link' . $css_class, '' ); ?>
			<?php edit_post_link(); ?>
		</div><!-- .entry-byline -->

		<footer class="entry-footer small">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => '<span>,</span> ',  'text' => esc_html__( 'Posted in: %s', 'themelia' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '<span>,</span> ', 'text' => esc_html__( 'Tagged: %s', 'themelia' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->