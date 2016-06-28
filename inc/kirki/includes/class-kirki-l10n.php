<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'themelia';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'themelia' ),
				'background-image'      => esc_attr__( 'Background Image', 'themelia' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'themelia' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'themelia' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'themelia' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'themelia' ),
				'inherit'               => esc_attr__( 'Inherit', 'themelia' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'themelia' ),
				'cover'                 => esc_attr__( 'Cover', 'themelia' ),
				'contain'               => esc_attr__( 'Contain', 'themelia' ),
				'background-size'       => esc_attr__( 'Background Size', 'themelia' ),
				'fixed'                 => esc_attr__( 'Fixed', 'themelia' ),
				'scroll'                => esc_attr__( 'Scroll', 'themelia' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'themelia' ),
				'left-top'              => esc_attr__( 'Left Top', 'themelia' ),
				'left-center'           => esc_attr__( 'Left Center', 'themelia' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'themelia' ),
				'right-top'             => esc_attr__( 'Right Top', 'themelia' ),
				'right-center'          => esc_attr__( 'Right Center', 'themelia' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'themelia' ),
				'center-top'            => esc_attr__( 'Center Top', 'themelia' ),
				'center-center'         => esc_attr__( 'Center Center', 'themelia' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'themelia' ),
				'background-position'   => esc_attr__( 'Background Position', 'themelia' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'themelia' ),
				'on'                    => esc_attr__( 'ON', 'themelia' ),
				'off'                   => esc_attr__( 'OFF', 'themelia' ),
				'all'                   => esc_attr__( 'All', 'themelia' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'themelia' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'themelia' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'themelia' ),
				'greek'                 => esc_attr__( 'Greek', 'themelia' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'themelia' ),
				'khmer'                 => esc_attr__( 'Khmer', 'themelia' ),
				'latin'                 => esc_attr__( 'Latin', 'themelia' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'themelia' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'themelia' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'themelia' ),
				'arabic'                => esc_attr__( 'Arabic', 'themelia' ),
				'bengali'               => esc_attr__( 'Bengali', 'themelia' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'themelia' ),
				'tamil'                 => esc_attr__( 'Tamil', 'themelia' ),
				'telugu'                => esc_attr__( 'Telugu', 'themelia' ),
				'thai'                  => esc_attr__( 'Thai', 'themelia' ),
				'serif'                 => _x( 'Serif', 'font style', 'themelia' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'themelia' ),
				'monospace'             => _x( 'Monospace', 'font style', 'themelia' ),
				'font-family'           => esc_attr__( 'Font Family', 'themelia' ),
				'font-size'             => esc_attr__( 'Font Size', 'themelia' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'themelia' ),
				'line-height'           => esc_attr__( 'Line Height', 'themelia' ),
				'font-style'            => esc_attr__( 'Font Style', 'themelia' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'themelia' ),
				'top'                   => esc_attr__( 'Top', 'themelia' ),
				'bottom'                => esc_attr__( 'Bottom', 'themelia' ),
				'left'                  => esc_attr__( 'Left', 'themelia' ),
				'right'                 => esc_attr__( 'Right', 'themelia' ),
				'center'                => esc_attr__( 'Center', 'themelia' ),
				'justify'               => esc_attr__( 'Justify', 'themelia' ),
				'color'                 => esc_attr__( 'Color', 'themelia' ),
				'add-image'             => esc_attr__( 'Add Image', 'themelia' ),
				'change-image'          => esc_attr__( 'Change Image', 'themelia' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'themelia' ),
				'add-file'              => esc_attr__( 'Add File', 'themelia' ),
				'change-file'           => esc_attr__( 'Change File', 'themelia' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'themelia' ),
				'remove'                => esc_attr__( 'Remove', 'themelia' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'themelia' ),
				'variant'               => esc_attr__( 'Variant', 'themelia' ),
				'subsets'               => esc_attr__( 'Subset', 'themelia' ),
				'size'                  => esc_attr__( 'Size', 'themelia' ),
				'height'                => esc_attr__( 'Height', 'themelia' ),
				'spacing'               => esc_attr__( 'Spacing', 'themelia' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'themelia' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'themelia' ),
				'light'                 => esc_attr__( 'Light 200', 'themelia' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'themelia' ),
				'book'                  => esc_attr__( 'Book 300', 'themelia' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'themelia' ),
				'regular'               => esc_attr__( 'Normal 400', 'themelia' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'themelia' ),
				'medium'                => esc_attr__( 'Medium 500', 'themelia' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'themelia' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'themelia' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'themelia' ),
				'bold'                  => esc_attr__( 'Bold 700', 'themelia' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'themelia' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'themelia' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'themelia' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'themelia' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'themelia' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'themelia' ),
				'add-new'           	=> esc_attr__( 'Add new', 'themelia' ),
				'row'           		=> esc_attr__( 'row', 'themelia' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'themelia' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'themelia' ),
				'back'                  => esc_attr__( 'Back', 'themelia' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'themelia' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'themelia' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'themelia' ),
				'none'                  => esc_attr__( 'None', 'themelia' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'themelia' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'themelia' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'themelia' ),
				'initial'               => esc_attr__( 'Initial', 'themelia' ),
				'select-page'           => esc_attr__( 'Select a Page', 'themelia' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'themelia' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'themelia' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'themelia' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'themelia' ),
			);

			// Apply global changes from the kirki/config filter.
			// This is generally to be avoided.
			// It is ONLY provided here for backwards-compatibility reasons.
			// Please use the kirki/{$config_id}/l10n filter instead.
			$config = apply_filters( 'kirki/config', array() );
			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			// Apply l10n changes using the kirki/{$config_id}/l10n filter.
			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
