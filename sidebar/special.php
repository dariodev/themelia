<?php if ( '1c' !== hybrid_get_theme_layout() && is_active_sidebar( 'special' )  ) : // If not a one-column layout. ?>

	<aside <?php hybrid_attr( 'sidebar', 'special' ); ?>>
    
		<div class="sidebar-inner">
			<?php if ( is_active_sidebar( 'special' ) ) : // If the sidebar has widgets. ?>
    
                <?php dynamic_sidebar( 'special' ); // Displays the primary sidebar. ?>
    
            <?php else : // If the sidebar has no widgets. ?>
    
                <?php the_widget(
                    'WP_Widget_Text',
                    array(
                        'title'  => __( 'Example Widget', 'themelia' ),
                        // Translators: The %s are placeholders for HTML, so the order can't be changed.
                        'text'   => sprintf( __( 'This is an example widget to show how the E-Commerce sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
                        'filter' => true,
                    ),
                    array(
                        'before_widget' => '<section class="widget widget_text">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>'
                    )
                ); ?>
    
            <?php endif; // End widgets check. ?>
            
		</div>
	</aside><!-- #sidebar-primary -->

<?php endif; // End layout check. ?>