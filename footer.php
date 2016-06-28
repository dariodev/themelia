			<?php hybrid_get_sidebar( themelia_primary_sidebar('primary') ); // Calls themelia_primary_sidebar() function and loads the sidebar/*.php template. ?>

			</div><!-- .grid-container -->
		</div><!-- #main -->

		<?php hybrid_get_sidebar( 'subsidiary' ); // Loads the sidebar/subsidiary.php template. ?>

		<?php do_action('themelia_before_footer_widgets'); ?>
		
		<?php get_template_part( 'content/footer-widgets' ); // Loads the content/footer-widgets.php template. ?>

        <?php do_action('themelia_after_footer_widgets'); ?>

		<footer <?php hybrid_attr( 'footer' ); ?>>
        
			<div class="grid-container">
				<div class="grid-50 tablet-grid-50">
                    <p class="credit">
                        <?php printf(
                            // Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
                            esc_html__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'themelia' ), 
                            date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
                        ); ?>
                    </p><!-- .credit -->
			 	</div><!-- .grid-50 -->
				<div class="grid-50 tablet-grid-50">
					<?php hybrid_get_menu( 'subsidiary' ); // Loads the menu/subsidiary.php template. ?>
			 	</div><!-- .grid-50 -->
			</div><!-- .grid-container -->
            
		</footer><!-- #footer -->

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>