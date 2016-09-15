<?php
if ( class_exists( 'Kirki' ) ) {
	
	Kirki::add_config( 'themelia_config', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
		'disable_output' => false,
	) );
	
	Kirki_Fonts_Google::$force_load_all_variants = true;
	
	/****
	 * -> START Site Identity
	 *    Section: title_tagline
	 */
	Kirki::add_field( 'themelia_config', array(
		'type'        => 'toggle',
		'settings'    => 'themelia_site_title',
		'label'       => __( 'Display Site Title', 'themelia' ),
		'description' => __( 'Uncheck to hide only visually, but have it available for screen readers.', 'themelia' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 2,
		'transport'   => 'auto',
	) );
	
	Kirki::add_field( 'themelia_config', array(
		'type'        => 'toggle',
		'settings'    => 'themelia_site_description',
		'label'       => __( 'Display Site Description', 'themelia' ),
		'description' => __( 'Uncheck to hide only visually, but have it available for screen readers.', 'themelia' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 4,
		'transport'   => 'auto',
	) );
	
	/* - END Site Identity
	 **/


	 /****
	 * -> START Layout
	 *    Section: layout
	 */
	Kirki::add_field( 'themelia_config', array(
		'type'        => 'number',
		'settings'    => 'themelia_content_width',
		'label'       => esc_attr__( 'Site width', 'themelia' ),
		'description' => 'Maximum width of main wrapper.',
		'section'     => 'layout',
		'default'     => 1344,
		'choices'     => array(
			'min'  => '640',
			'max'  => '2200',
			'step' => '10',
		),
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => '.grid-container',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
	) );

	Kirki::add_field( 'themelia_config', array(
		'type'        => 'select',
		'settings'    => 'themelia_footer_widgets',
		'label'       => __( 'Footer Widgets', 'themelia' ),
		'description' => __( 'Choose number of widget columns in footer widget area. Each column can have any number of widgets.', 'themelia' ),
		'section'     => 'layout',
		'default'     => 'none',
		'priority'    => 100,
		'choices'     => array(
			'0' => esc_attr__( '0 Widgets', 'themelia' ),
			'1' => esc_attr__( '1 Widget',  'themelia' ),
			'2' => esc_attr__( '2 Widgets', 'themelia' ),
			'3' => esc_attr__( '3 Widgets', 'themelia' ),
			'4' => esc_attr__( '4 Widgets', 'themelia' ),
		),
		'transport' => 'auto',
	) );
	
	/* - END Layout
	 **/


	/*
	 * -> SECTION Site Title & Header (themelia_header_settings)
	 *            
	 */
	Kirki::add_section( 'themelia_header_settings', array(
		'title'          => esc_attr__( 'Site Title &amp; Header', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Site Title & Header
		* Section: themelia_header_settings
		*/
				
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'themelia_header_layout',
			'label'       => __( 'Header Layout', 'themelia' ),
			'description' => __( 'Select layout for header elements (branding and main navigation).', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => 'header-i-l-mr',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'header-s-l' => esc_attr__( 'Stack: Left aligned', 'themelia' ),
				'header-s-r' => esc_attr__( 'Stack: Right aligned', 'themelia' ),
				'header-s-c' => esc_attr__( 'Stack: Centered', 'themelia' ),
				'header-i-l-mr' => esc_attr__( 'Inline: Logo (left) - Menu (right)', 'themelia' ),
				'header-i-l-ml' => esc_attr__( 'Inline: Logo (left) - Menu (left)', 'themelia' ),
				'header-i-m-lr' => esc_attr__( 'Inline: Menu (left) - Logo (right)', 'themelia' ),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'site_header_background',
			'label'       => esc_attr__( 'Site Header Background', 'themelia' ),
			'description' => esc_attr__( 'Background color for header area.', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => '#fff',
			'priority'    => 25,
			'alpha'       => true,
			'inline_css'  => false,
			'transport'   => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => '.site-header',
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'site_header_separator',
			'label'       => __( 'Site Header Separator', 'themelia' ),
			'description' => __( 'Thin border between Site Header and Content Area.', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => 'rgba(39, 55, 64, 0.09)',
			'priority'    => 25,
			'alpha'       => true,
			'inline_css'  => false,
			'transport'   => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => '.site-header:after',
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'site_title_settings',
			'label'       => esc_attr__( 'Site Title', 'themelia' ),
			'description' => esc_attr__( 'Site Title is shown according to settings in the Site Identity. (It is always available for screen readers.)', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => array(
				'font-family'    => 'Roboto',
				'variant'        => '700',
				'font-size'      => '1.778em',
				'line-height'    => '1.2',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin' ),
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output' => array(
				array(
				  'element'  => '#site-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'site_title_link_color',
			//'label'       => esc_attr__( 'Site Title', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default' => array(
				'link'    => '#121212',
				'hover'   => '#121212',
				'active'  => '#121212',
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '.site-title a, .site-title a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.site-title a:hover',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.site-title a:active',
				  'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'site_description_settings',
			'label'     => esc_attr__( 'Site Description', 'themelia' ),
			'description' => esc_attr__( 'Site Description is shown according to settings in the Site Identity. (It is always available for screen readers.)', 'themelia' ),
			'section'     => 'themelia_header_settings',
			'default'     => array(
				'variant'        => 'regular',
				'font-size'      => '0.889em',
				'letter-spacing' => '0',
				'color'          => '#383f49',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output' => array(
				array(
				  'element'  => '#branding .site-description',
				),
			),
		) );

	/* - END Site Title & Header
	 **/


	/*
	 * -> SECTION Main Navigation (themelia_menu_typography)
	 *            
	 */
	Kirki::add_section( 'themelia_menu_typography', array(
		'title'          => esc_attr__( 'Main Navigation', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Main Navigation
		*/
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_mainnav_typography',
			'label'       => esc_attr__( 'Typography', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'default'     => array(
				'font-family' => 'Roboto',
				'variant'     => 'regular',
				'subsets'     => array( 'latin' ),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '#menu-primary .menu-items > li',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_mainnav_typography_2',
			'label'       => '',
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'default'     => array(
				'font-size'      => '0.889em',
				'line-height'    => '1.4',
				'letter-spacing' => '0',
				'text-transform' => 'uppercase',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '#menu-primary .menu-items > li',
				),
			),
		) );


	/*
	 * -> SECTION Main Navigation Colors (themelia_menu_colors)
	 *            
	 */
	Kirki::add_section( 'themelia_menu_colors', array(
		'title'          => __( 'Main Navigation Colors', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Main Navigation Colors
		*/
		
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_link_color',
			'label'       => esc_attr__( 'Top level - Text', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#121212',
				'hover'   => '#121212',
				'active'  => '#121212',
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '#menu-primary .menu-items a, #menu-primary .menu-items a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '#menu-primary .menu-items a:hover, #menu-primary .menu-items .sfHover > a',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '#menu-primary .menu-items a:active',
				  'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_link_highlight',
			'label'       => esc_attr__( 'Top Links - Highlight Border', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'choices'     => array(
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'current' => esc_attr__( 'Current', 'themelia' ),
			),
			'default'     => array(
				'hover'   => '#0274BE',
				'current' => '#0274BE',
			),
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
				  'choice'   => 'hover',
				  'element'  => '#menu-primary .menu-items > li > a:before',
				  'property' => 'background',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '#menu-primary .menu-items > li.current-menu-item > a:before, #menu-primary .menu-items > li.current-menu-ancestor > a:before',
				  'property' => 'background',
				),
			),
		) );	

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_sub_link_color',
			'label'       => esc_attr__( 'Drop Down - Text', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'inline_css'  => false,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#121212',
				'hover'   => '#121212',
				'active'  => '#121212',
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '#menu-primary .menu-items .sub-menu a, #menu-primary .menu-items .sub-menu a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '#menu-primary .menu-items .sub-menu a:hover, #menu-primary .menu-items .sub-menu .sfHover > a',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '#menu-primary .menu-items .sub-menu a:active',
				  'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'nav_sub_link_bg',
			'label'       => esc_attr__( 'Drop Down - Background', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'inline_css' => false,
			'choices'     => array(
				'link'    => esc_attr__( 'BG Color', 'themelia' ),
				'hover'   => esc_attr__( 'BG Hover', 'themelia' ),
				'active'  => esc_attr__( 'BG Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#fff',
				'hover'   => '#fff',
				'active'  => '#fff',
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
				  'choice'   => 'link',
				  'element'  => '#menu-primary .menu-items .sub-menu li a',
				  'property' => 'background-color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '#menu-primary .menu-items .sub-menu li a:hover',
				  'property' => 'background-color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '#menu-primary .menu-items .sub-menu li a:active',
				  'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'link_sub_borders',
			'label'       => esc_attr__( 'Drop Down - Borders', 'themelia' ),
			'section'     => 'themelia_menu_typography',
			'priority'    => 25,
			'inline_css'  => false,
			'choices'     => array(
				'outline'   => esc_attr__( 'Outline', 'themelia' ),
				'separator' => esc_attr__( 'Separators', 'themelia' ),
			),
			'default' => array(
				'outline'   => 'rgba(39, 55, 64, 0.09)',
				'separator' => 'rgba(39, 55, 64, 0.09)',
			),
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
				  'choice'   => 'outline',
				  'element'  => '#menu-primary .menu-items .sub-menu, #menu-primary .menu-items .children',
				  'property' => 'border-color',
				),
				array(
				  'choice'   => 'separator',
				  'element'  => '#menu-primary .menu-items .sub-menu li a, #menu-primary .menu-items .children li a',
				  'property' => 'border-color',
				),
				array(
				  'choice'   => 'outline',
				  'element'  => '#menu-primary .menu-items .sub-menu ul, #menu-primary .menu-items .children ul',
				  'property' => 'border-top-color',
				),
				array(
				  'choice'   => 'separator',
				  'element'  => '.slicknav_arrow',
				  'property' => 'border-left-color',
				),
			),
		) );
		/* - END Main Navigation Colors
		 **/
 

   /*
	* -> SECTION Base Typography
	*            
	*/
	Kirki::add_section( 'themelia_base_typography', array(
		'title'          => __( 'Body Text and Links', 'themelia' ), 
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Base Typography
		*/
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_body_typography',
			'label'       => esc_attr__( 'Body Text', 'themelia' ),
			'description' => esc_attr__( 'Base typography settings.', 'themelia' ),
			'section'     => 'themelia_base_typography',
			'default'     => array(
				'font-family'    => 'Roboto',
				'variant'        => 'regular',
				//'font-size'      => '18px',
				'line-height'    => '1.45',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin' ),
				'color'          => '#333333',
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => 'body',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'body_link',
			'label'       => esc_attr__( 'Body Links', 'themelia' ),
			'description' => esc_attr__( 'Colors for regular links.', 'themelia' ),
			'section'     => 'themelia_base_typography',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#0274be',
				'hover'   => '#2f85bf',
				'active'  => '#3f8bbf',
			),
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
				  'choice'   => 'link',
				  'element'  => 'a',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => 'a:hover',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => 'a:active',
				  'property' => 'color',
				),
			),
		) );


   /*
	* -> SECTION Modular Scale
	*            
	*/
	Kirki::add_section( 'themelia_modular_scale', array(
		'title'          => __( 'Text Size - Modular Scale', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Modular Scale
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'number',
			'settings'    => 'base_typography_large',
			'label'       => esc_attr__( 'Large screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size in pixels for large screens (Desktops and most of the Laptops).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 18,
			'priority'    => 25,
			'choices'     => array(
				'min'  => 15,
				'max'  => 30,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_desktop',
			//'label'       => esc_attr__( 'Large screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for large screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'major-third',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'number',
			'settings'    => 'base_typography_medium',
			'label'       => esc_attr__( 'Mediums screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size in pixels for Mediums screens (Tablets and other medium size devices).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 17,
			'priority'    => 25,
			'choices'     => array(
				'min'  => 14,
				'max'  => 26,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_tablet',
			//'label'       => esc_attr__( 'Medium screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for medium screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'major-second',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );
		
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'number',
			'settings'    => 'base_typography_small',
			'label'       => esc_attr__( 'Small screens', 'themelia' ),
			'description' => esc_attr__( 'Base font size in pixels for Small screens (Smartphones and other small devices).', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 16,
			'priority'    => 25,
			'choices'     => array(
				'min'  => 14,
				'max'  => 24,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'select',
			'settings'    => 'modular_scale_mobile',
			//'label'       => esc_attr__( 'Small screens', 'themelia' ),
			'description' => esc_attr__( 'Modular Scale for small screens.', 'themelia' ),
			'section'     => 'themelia_modular_scale',
			'default'     => 'minor-third',
			'priority'    => 25,
			'multiple'    => 1,
			'choices'     => array(
				'major-second'   => esc_attr__( '[1.125] - Major Second ', 'themelia' ),
				'minor-third'    => esc_attr__( '[1.200] - Minor Third ', 'themelia' ),
				'major-third'    => esc_attr__( '[1.250] - Major Third ', 'themelia' ),
				'perfect-fourth' => esc_attr__( '[1.333] - Perfect Fourth ', 'themelia' ),
			),
		) );


   /*
	* -> SECTION Headings & Entry Titles
	*            
	*/
	Kirki::add_section( 'themelia_headings_typography', array(
		'title'          => esc_attr__( 'Headings &amp; Entry Titles', 'themelia' ), 
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Headings
		*/
		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_content_headings_typography_2',
			'label'       => esc_attr__( 'Headings', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'font-family' => 'Roboto',
				'line-height' => '1.2',
				'subsets'     => array( 'latin' ),
			),
			'priority'  => 25,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => '#content h1, #content h2, #content h3, #content h4, #content h5, #content h6',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'entry_title_link',
			'label'       => esc_attr__( 'Entry Title Link (Loop)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'priority'    => 25,
			'choices'     => array(
				'link'    => esc_attr__( 'Color', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'link'    => '#121212',
				'hover'   => '#333',
				'active'  => '#444',
			),
			'transport'   => 'postMessage',
			'js_vars'     => array(
				array(
				  'choice'   => 'link',
				  'element'  => '.entry-title a, .entry-title a:visited',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '.entry-title a:hover',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '.entry-title a:active',
				  'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'		=> 'typography',
			'settings'	=> 'entry_title_link_2',
			//'label'	=> esc_attr__( '', 'themelia' ),
			'section'	=> 'themelia_headings_typography',
			'default'	=> array(
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'postMessage',
			'js_vars'	=> array(
				array(
					'element' => '.entry-title a',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'	   => 'typography',
			'settings' => 'entry_title_singular',
			'label'    => esc_attr__( 'Entry Title (Single Post)', 'themelia' ),
			'section'  => 'themelia_headings_typography',
			'default'  => array(
				'color'          => '#121212',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'postMessage',
			'js_vars'	=> array(
				array(
					'element' => '.singular #content .entry-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'     => 'typography',
			'settings' => 'entry_title_page',
			'label'    => esc_attr__( 'Page Title', 'themelia' ),
			'section'  => 'themelia_headings_typography',
			'default'  => array(
				'color'          => '#121212',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'priority'	=> 25,
			'transport' => 'postMessage',
			'js_vars'	=> array(
				array(
					'element' => '.singular-page #content .entry-title',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_headings_h1',
			'label'       => esc_attr__( 'Headings 1 (H1)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
					'element' => '#content h1',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_headings_h2',
			'label'       => esc_attr__( 'Headings 2 (H2)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
					'element' => '#content h2',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_headings_h3',
			'label'       => esc_attr__( 'Headings 3 (H3)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
					'element' => '#content h3',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_headings_h4',
			'label'       => esc_attr__( 'Headings 4 (H4)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'    => 25,
			'transport' => 'postMessage',
			'js_vars'      => array(
				array(
					'element' => '#content h4',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_headings_h5',
			'label'       => esc_attr__( 'Headings 5 (H5)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
					'element' => '#content h5',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'themelia_headings_h6',
			'label'       => esc_attr__( 'Headings 6 (H6)', 'themelia' ),
			'section'     => 'themelia_headings_typography',
			'default'     => array(
				'letter-spacing' => '0',
				'color'          => '#121212',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'transport' => 'postMessage',
			'js_vars'   => array(
				array(
					'element' => '#content h6',
				),
			),
		) );
		/* - END Headings
		 **/


   /*
	* -> SECTION Links & secondary
	*            
	*/
	Kirki::add_section( 'themelia_secondary_typography', array(
		'title'          => __( 'Breadcrumbs & Secondary Text', 'themelia' ),
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	) );

	   /*
		* -> START Links & secondary
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'secondary_font',
			'label'       => esc_attr__( 'Secondary Text', 'themelia' ),
			'description' => esc_attr__( 'Entry meta, date, time, Read More link.', 'themelia' ),
			'section'     => 'themelia_secondary_typography',
			'default'     => array(
				'font-size'      => '0.833em',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'alpha'     => true,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => '.entry-footer.font-secondary, .entry-more-link, .entry-byline',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'toggle',
			'settings'    => 'display_breadcrumbs',
			'label'       => __( 'Display Breadcrumbs', 'themelia' ),
			'description' => __( 'Check to display Breadcrumb navigation (below main menu).', 'themelia' ),
			'section'     => 'themelia_secondary_typography',
			'default'     => '0',
			'transport'   => 'auto',
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'typography',
			'settings'    => 'breadcrumb_font',
			'label'       => esc_attr__( 'Breadcrumbs Text', 'themelia' ),
			'section'     => 'themelia_secondary_typography',
			'default'     => array(
				'font-size'      => '0.889em',
				'text-transform' => 'none',
			),
			'priority'  => 25,
			'alpha'     => true,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => '#main .breadcrumb-trail',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'multicolor',
			'settings'    => 'secondary_font_link',
			'label'       => esc_attr__( 'Secondary Text Colors', 'themelia' ),
			'description' => esc_attr__( 'Colors for Secondary Text.', 'themelia' ),
			'section'     => 'themelia_secondary_typography',
			'priority'    => 25,
			'choices'     => array(
				'text'    => esc_attr__( 'Text', 'themelia' ),
				'link'    => esc_attr__( 'Link', 'themelia' ),
				'hover'   => esc_attr__( 'Hover', 'themelia' ),
				'active'  => esc_attr__( 'Active', 'themelia' ),
			),
			'default'     => array(
				'text'    => 'rgba(2,2,2,0.84)',
				'link'    => '#121212',
				'hover'   => '#2f85bf',
				'active'  => '#3f8bbf',
			),
			'transport'   => 'postMessage',
			'js_vars'     => array(
				array(
				  'choice'   => 'text',
				  'element'  => '#content .font-secondary, #main .breadcrumb-trail, #footer p',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'link',
				  'element'  => '#content .font-secondary a, #main .breadcrumb-trail a, .entry-more-link, .social-navigation a, #footer a',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'hover',
				  'element'  => '#content .font-secondary a:hover, #main .breadcrumb-trail a:hover, .entry-more-link:hover, .social-navigation a:hover, #footer a:hover',
				  'property' => 'color',
				),
				array(
				  'choice'   => 'active',
				  'element'  => '#content .font-secondary a:active, #main .breadcrumb-trail a:active, .entry-more-link:active, .social-navigation a:active, #footer a:active',
				  'property' => 'color',
				),
			),
		) );


   /*
	* -> SECTION Colors
	*    Add into the default WP section - Colors (along with bacgeound color)
	*            
	*/

	   /*
		* -> START General
		*/

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'posts_separator',
			'label'       => esc_attr__( 'Separators - Content', 'themelia' ),
			'description' => esc_attr__( 'Horizontal lines between posts.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '.archive .post, .blog .post, .search .entry',
				  'property' => 'border-bottom-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'hr_separator',
		  //'label'       => esc_attr__( 'Separators', 'themelia' ),
			'description' => esc_attr__( 'Horizontal lines - hr tag.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => 'hr',
				  'property' => 'border-bottom-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'meta_separator_primary',
		  //'label'       => esc_attr__( 'Separators', 'themelia' ),
			'description' => esc_attr__( 'Meta elements - primary.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.45)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '.author-info',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'meta_separator_secondary',
		  //'label'       => esc_attr__( 'Separators', 'themelia' ),
			'description' => esc_attr__( 'Meta elements - secondary.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.45)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '#reply-title',
				  'property' => 'border-top-color',
				),
				array(
				  'element'  => '.post-navigation .nav-links',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'sideli_separator',
			'label'       => esc_attr__( 'Separators - Sidebar', 'themelia' ),
			'description' => esc_attr__( 'Sidebar list elements - thin border.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '#main .sidebar li',
				  'property' => 'border-bottom-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'subsidiary_widget_area_separator',
			'label'       => esc_attr__( 'Separators - Sections', 'themelia' ),
			'description' => esc_attr__( 'Horizontal top border between subsidiary widget area and content.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '#sidebar-subsidiary',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'footer_widgets_area_separator',
		  //'label'       => esc_attr__( 'Separators - Sections', 'themelia' ),
			'description' => esc_attr__( 'Horizontal top border for footer widgets area.', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '#footer-widgets',
				  'property' => 'border-top-color',
				),
			),
		) );

		Kirki::add_field( 'themelia_config', array(
			'type'        => 'color',
			'settings'    => 'footer_copyright_separator',
		  //'label'       => esc_attr__( 'Separators - Sections', 'themelia' ),
			'description' => esc_attr__( 'Horizontal top border for footer (copyright area).', 'themelia' ),
			'section'     => 'colors',
			'priority'    => 20,
			'default'     => 'rgba(39, 55, 64, 0.1)',
			'alpha'       => true,
			'transport'   => 'auto',
			'output'      => array(
				array(
				  'element'  => '#footer',
				  'property' => 'border-top-color',
				),
			),
		) );

		/* - END General
		 **/
}