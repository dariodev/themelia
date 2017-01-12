<?php
	// Get how many widgets to show
	$widgets = get_theme_mod( 'footer_widget_columns', 0 );

	if ( $widgets > 0 ) :

		// Set up the widget width
		$widget_width = '';
		if ( $widgets == 1 ) { $widget_width = '100'; $widget_width_tablet = '100'; $widget_width_mobile = '100'; };
		if ( $widgets == 2 ) { $widget_width = '50';  $widget_width_tablet = '50';  $widget_width_mobile = '100'; };
		if ( $widgets == 3 ) { $widget_width = '33';  $widget_width_tablet = '33';  $widget_width_mobile = '100'; };
		if ( $widgets == 4 ) { $widget_width = '25';  $widget_width_tablet = '25';  $widget_width_mobile = '50';  };
		?>
		<aside <?php hybrid_attr( 'sidebarcustom', 'footer-widgets' ); ?>>
			<div class="inside-footer-widgets grid-container">
				<?php if ( $widgets >= 1 && is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="footer-widget footer-widget-1 grid-<?php echo apply_filters( 'themelia_footer_widget_1_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_1_tablet_width', $widget_width_tablet ); ?> mobile-grid-<?php echo apply_filters( 'themelia_footer_widget_1_mobile_width', $widget_width_mobile ); ?>">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( $widgets >= 2 && is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="footer-widget footer-widget-2 grid-<?php echo apply_filters( 'themelia_footer_widget_2_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_2_tablet_width', $widget_width_tablet ); ?> mobile-grid-<?php echo apply_filters( 'themelia_footer_widget_2_mobile_width', $widget_width_mobile ); ?>">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( $widgets >= 3 && is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="footer-widget footer-widget-3 grid-<?php echo apply_filters( 'themelia_footer_widget_3_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_3_tablet_width', $widget_width_tablet ); ?> mobile-grid-<?php echo apply_filters( 'themelia_footer_widget_3_mobile_width', $widget_width_mobile ); ?>">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( $widgets >= 4 && is_active_sidebar( 'footer-4' ) ) : ?>
				<div class="footer-widget footer-widget-4 grid-<?php echo apply_filters( 'themelia_footer_widget_4_width', $widget_width ); ?>  tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_4_tablet_width', $widget_width_tablet ); ?> mobile-grid-<?php echo apply_filters( 'themelia_footer_widget_4_mobile_width', $widget_width_mobile ); ?>">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
				<?php endif;?>

			</div>
		</aside>
<?php
	endif;