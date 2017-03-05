<?php
// Get Author Data
$author             = get_the_author();
$author_id          = get_the_author_meta( 'ID' );
$author_email       = get_the_author_meta( 'user_email' );
$author_posts_link  = esc_url( get_author_posts_url( $author_id ) );
$author_url         = esc_url( get_the_author_meta('url') );
$author_avatar      = get_avatar( $author_email, apply_filters( 'themelia_author_bio_avatar_size', 120 ) );

// Only display if author has a description
if ( $author_description = get_the_author_meta( 'description' ) ) : ?>

	<aside id="author-box" class="author-info clr">
		<?php if( get_avatar( $author_email )) { ?>
			<a href="<?php echo $author_posts_link; ?>" title="<?php esc_html_e( 'All posts by', 'themelia' ); ?> <?php echo $author; ?>" class="author-avatar clr" rel="author">
				<?php echo $author_avatar; ?>
			</a><!-- .author-avatar -->
		<?php } ?>

		<h4 class="author-heading"><?php esc_html_e( 'Written by', 'themelia' ); ?> <a href="<?php echo $author_posts_link; ?>" title="<?php esc_html_e( 'All posts by', 'themelia' ); ?> <?php echo $author; ?>"><?php echo $author; ?></a></h4>
		<div class="author-bio clr">
			<div class="author-description">
				<?php echo wpautop ( $author_description ); ?>
			</div><!-- .author-description -->
		</div><!-- .author-info-inner -->
	</aside><!-- #author-bio -->

<?php endif; ?>
