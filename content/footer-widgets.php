<?php 
	// Get how many widgets to show
	$widgets = get_theme_mod( 'get_footer_widgets', 0 );
	
	if ( !empty( $widgets ) && 0 !== $widgets ) : 
	
		// Set up the widget width
		$widget_width = '';
		if ( $widgets == 1 ) $widget_width = '100';
		if ( $widgets == 2 ) $widget_width = '50';
		if ( $widgets == 3 ) $widget_width = '33';
		if ( $widgets == 4 ) $widget_width = '25';
		?>
		<div id="footer-widgets" class="footer-widgets sidebar">
			<div class="inside-footer-widgets grid-container">
				<?php if ( $widgets >= 1 ) : ?>
				<div class="footer-widget-1 grid-<?php echo apply_filters( 'themelia_footer_widget_1_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_1_tablet_width', '50' ); ?>">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1')): ?>
						<aside <?php hybrid_attr( 'sidebarcustom', 'footer-1' ); ?>>
							<h3 class="widget-title"><?php _e('Footer Widget 1','themelia');?></h3>			
							<div class="textwidget">
								<p><?php printf( __( 'This is an example widget to show how the footer widgets looks by default. You can add custom widgets from the %swidgets screen%s in the admin area.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
								<p><?php printf( __( 'You can choose the number of columns or remove this area entirely. Go to %stheme customizer%s in the admin screen Appearance / Customize / Layout / Footer Widgets.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'customize.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				
				if ( $widgets >= 2 ) : ?>
				<div class="footer-widget-2 grid-<?php echo apply_filters( 'themelia_footer_widget_2_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_2_tablet_width', '50' ); ?>">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2')): ?>
						<aside <?php hybrid_attr( 'sidebarcustom', 'footer-2' ); ?>>
							<h3 class="widget-title"><?php _e('Footer Widget 2','themelia');?></h3>			
							<div class="textwidget">
								<p><?php printf( __( 'This is an example widget to show how the footer widgets looks by default. You can add custom widgets from the %swidgets screen%s in the admin area.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
								<p><?php printf( __( 'You can choose the number of columns or remove this area entirely. Go to %stheme customizer%s in the admin screen Appearance / Customize / Layout / Footer Widgets.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'customize.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				
				if ( $widgets >= 3 ) : ?>
				<div class="footer-widget-3 grid-<?php echo apply_filters( 'themelia_footer_widget_3_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_3_tablet_width', '50' ); ?>">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3')): ?>
						<aside <?php hybrid_attr( 'sidebarcustom', 'footer-3' ); ?>>
							<h3 class="widget-title"><?php _e('Footer Widget 3','themelia');?></h3>			
							<div class="textwidget">
								<p><?php printf( __( 'This is an example widget to show how the footer widgets looks by default. You can add custom widgets from the %swidgets screen%s in the admin area.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
								<p><?php printf( __( 'You can choose the number of columns or remove this area entirely. Go to %stheme customizer%s in the admin screen Appearance / Customize / Layout / Footer Widgets.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'customize.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				
				if ( $widgets >= 4 ) : ?>
				<div class="footer-widget-4 grid-<?php echo apply_filters( 'themelia_footer_widget_4_width', $widget_width ); ?> tablet-grid-<?php echo apply_filters( 'themelia_footer_widget_4_tablet_width', '50' ); ?>">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4')): ?>
						<aside <?php hybrid_attr( 'sidebarcustom', 'footer-4' ); ?>>
							<h3 class="widget-title"><?php _e('Footer Widget 4','themelia');?></h3>			
							<div class="textwidget">
								<p><?php printf( __( 'This is an example widget to show how the footer widgets looks by default. You can add custom widgets from the %swidgets screen%s in the admin area.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
								<p><?php printf( __( 'You can choose the number of columns or remove this area entirely. Go to %stheme customizer%s in the admin screen Appearance / Customize / Layout / Footer Widgets.', 'themelia' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'customize.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ); ?></p>
							</div>
						</aside>
					<?php endif; ?>
				</div>
				<?php endif;
				?>

			</div>
		</div>
<?php
	endif;