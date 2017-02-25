<article <?php hybrid_attr( 'post' ); ?>>

	<?php
		$css_class = 'comments-link zero-comments';
		$number    = (int) get_comments_number( get_the_ID() );
		$comm_sep  = '<span class="comments-sep no-comments"></span>';

		if ( 1 === $number ) {
			$css_class = 'comments-link one-comment';
			$comm_sep  = '<span class="comments-sep"></span>';
		} elseif ( 1 < $number ) {
			$css_class = 'comments-link multiple-comments';
			$comm_sep  = '<span class="comments-sep"></span>';
		}
	?>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline small">
				<?php hybrid_post_format_link(); ?>
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php
					echo $comm_sep;
					comments_popup_link(
						'',
						sprintf( __( '<span class="comments-number">1</span><span class="comments-txt"> comment</span><span class="screen-reader-text"> on "%1$s"</span>', 'themelia' ),
							get_the_title()
						),
					    sprintf( __( '<span class="comments-number">%1$s</span><span class="comments-txt"> comments</span><span class="screen-reader-text"> on "%2$s"</span>', 'themelia' ),
							$number,
							get_the_title()
						),
					    $css_class,
					    ''
					);
				?>
				<?php themelia_edit_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer small">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => '<span>,</span> ',  'text' => esc_html__( 'Posted in: %s', 'themelia' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '<span>,</span> ', 'text' => esc_html__( 'Tagged: %s', 'themelia' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

		<?php get_template_part( 'misc/author-box' ); ?>

	<?php else : // If not viewing a single post. ?>

		<header class="entry-header">

			<div class="entry-byline small">
				<?php hybrid_post_format_link(); ?>
				<?php
					comments_popup_link(
						'',
						sprintf( __( '<span class="comments-number">1</span><span class="comments-txt"> comment</span><span class="screen-reader-text"> on "%1$s"</span>', 'themelia' ),
							get_the_title()
						),
					    sprintf( __( '<span class="comments-number">%1$s</span><span class="comments-txt"> comments</span><span class="screen-reader-text"> on "%2$s"</span>', 'themelia' ),
							$number,
							get_the_title()
						),
					    $css_class,
					    ''
					);
				?>
				<?php themelia_edit_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
