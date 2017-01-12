<aside <?php hybrid_attr( 'sidebar', 'special' ); ?>>

    <div class="sidebar-inner">
        <?php if ( is_active_sidebar( 'special' ) ) : // If the sidebar has widgets. ?>

            <?php dynamic_sidebar( 'special' ); // Displays the primary sidebar. ?>

        <?php endif; // End widgets check. ?>

    </div>
</aside><!-- #sidebar-primary -->
