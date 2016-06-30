<li <?php hybrid_attr( 'comment' ); ?>>

	<article>
		<header class="comment-meta">
			<?php echo get_avatar( $comment ); ?>
			<?php $comment_time  = get_comment_time( _x( 'F j, Y g:i a', 'comment time format 2', 'hybrid-core' ) ); ?>
			<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite><br>
			<a <?php hybrid_attr( 'comment-permalink' ); ?>><time <?php hybrid_attr( 'comment-published' ); ?>><?php echo $comment_time; //printf( esc_html__( '%s ago', 'themelia' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
			<?php edit_comment_link(); ?>
		</header><!-- .comment-meta -->

		<div <?php hybrid_attr( 'comment-content' ); ?>>
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php hybrid_comment_reply_link(); ?>
	</article>

<?php // No closing </li> is needed.  WordPress will know where to add it. ?>