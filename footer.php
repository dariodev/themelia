		<?php do_action('themelia_before_footer_widgets'); ?>

		<?php get_template_part( 'content/footer-widgets' ); // Loads the content/footer-widgets.php template. ?>

		<?php do_action('themelia_after_footer_widgets'); ?>

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<div class="grid-container site-footer-inner">
				<div class="site-footer-01">
					<?php hybrid_get_menu( 'subsidiary' ); // Loads the menu/subsidiary.php template. ?>
			 	</div><!-- .grid-50 -->
				<div class="site-footer-02">
					<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

					<?php if ( is_active_sidebar( 'colophon' ) ) : // If the sidebar has widgets. ?>

					<div <?php hybrid_attr( 'sidebarcustom', 'colophon' ); ?>>
						<?php dynamic_sidebar( 'colophon' ); // Displays the colophon sidebar. ?>
					</div>

					<?php else : // End widgets check. ?>

					<p class="credit">
						<?php printf(
						// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
						esc_html__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'themelia' ),
						date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
						);?>
					</p><!-- .credit -->
					<?php endif; // End widgets check. ?>

			 	</div><!-- .grid-50 -->
			</div><!-- .grid-container -->

		</footer><!-- #footer -->

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>
