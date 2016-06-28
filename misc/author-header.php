<?php
// Get Author Data
$author              = get_the_author();
$author_email        = get_the_author_meta( 'user_email' );
$author_description  = get_the_author_meta( 'description' );
$author_avatar       = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'themelia_author_bio_avatar_size', 128 ) );
$author_url			 = get_the_author_meta( 'url' );
$author_url_stripped = preg_replace('#^https?://#', '', rtrim($author_url,'/'));
?>
<header <?php hybrid_attr( 'archive-header' ); ?>>

	<h1 <?php hybrid_attr( 'archive-title' ); ?>><?php esc_html_e( 'Author: ', 'themelia' ); ?> <?php the_archive_title(); ?></h1>

	<?php if ( $desc = get_the_archive_description() ) : // Check for description. ?>
    
		<?php if( themelia_has_gravatar( $author_email )) : ?>
            <div class="author-avatar clr" rel="author">
                <?php echo $author_avatar; ?>
            </div><!-- .author-avatar -->
        <?php endif ?>
		<div <?php hybrid_attr( 'archive-description author-bio' ); ?>>
			<?php echo $desc; ?>
            <?php if ( $author_url ) { // Check for author url. ?>
            <p><span><?php esc_html_e( 'Web: ', 'themelia' ); ?></span><a href="<?php echo $author_url;?>"><?php echo $author_url_stripped;?></a></p>
            <?php } ?>
		</div><!-- .archive-description -->

	<?php endif; // End desc check. ?>

</header><!-- .archive-header -->