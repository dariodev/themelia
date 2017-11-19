<?php if ( ! in_array( hybrid_get_theme_layout(), array( '1c', '1c-narrow' ) ) ) : // If not a one-column layout. ?>

	<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

		<h3 id="sidebar-primary-title" class="screen-reader-text"><?php
			// Translators: %s is the sidebar name. This is the sidebar title shown to screen readers.
			printf( _x( '%s Sidebar', 'Screen reader text - sidebar title', 'themelia' ), hybrid_get_sidebar_name( 'primary' ) );
		?></h3>

		<div class="sidebar-inner">
			<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

                <?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

			<?php else : // If the sidebar has no widgets. ?>

				<section id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</section>

                <?php if ( themelia_widget_exists( 'WP_Widget_Recent_Posts' ) ) : ?>

                    <?php the_widget(
                        'WP_Widget_Recent_Posts',
                        array(),
                        array(
                            'before_widget' => '<section class="widget widget_meta">',
                            'after_widget'  => '</section>',
                            'before_title'  => '<h3 class="widget-title">',
                            'after_title'   => '</h3>'
                        )
                    ); ?>

				<section id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'themelia' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</section>

                <?php endif; ?>

            <?php endif; // End widgets check. ?>

		</div>
	</aside><!-- #sidebar-primary -->

<?php endif; // End layout check. ?>
