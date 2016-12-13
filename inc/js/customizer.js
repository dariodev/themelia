/**
 * Handles the customizer live preview settings.
 */
jQuery( document ).ready( function() {

	/*
	 * Shows a live preview of changing the site title.
	 */
	wp.customize( 'blogname', function( value ) {

		value.bind( function( to ) {

			jQuery( '#site-title' ).html( to );

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Shows a live preview of changing the site description.
	 */
	wp.customize( 'blogdescription', function( value ) {

		value.bind( function( to ) {

			jQuery( '#site-description' ).html( to );

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Handles the header textcolor.  This code also accounts for the possibility that the header text color
	 * may be set to 'blank', in which case, any text in the header is hidden.
	 */
	wp.customize( 'header_textcolor', function( value ) {

		value.bind( function( to ) {

			/* If set to 'blank', hide the branding section and secondary menu. */
			if ( 'blank' === to ) {

				/* Hides branding and menu-secondary. */
				jQuery( '#branding' ).
					css( 'display', 'none' ).
					addClass( 'hidden').removeClass( 'visible');

				/* Removes the 'display-header-text' <body> class. */
				jQuery( 'body' ).
					removeClass( 'display-header-text' );
			}

			/* Change the header and secondary menu colors. */
			else {

				/* Adds the 'display-header-text' <body> class. */
				jQuery( 'body' ).
					addClass( 'display-header-text' );

				/* Makes sures both branding and menu-secondary display. */
				jQuery( '#branding' ).
					css( 'display', 'block' ).
					addClass( 'visible').removeClass( 'hidden');

				/* Changes the color of the site title link. */
				jQuery( '#site-title a' ).
					css( 'color', to );
			} // endif

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Handes the header image.  This code replaces the "src" attribute for the image.
	 */
	wp.customize( 'header_image', function( value ) {

		value.bind( function( to ) {

			/* If removing the header image, make sure to hide it so there's not an error image. */
			if ( 'remove-header' === to ) {
				jQuery( '.header-image' ).hide();
			}

			/* Else, make sure to show the image and change the source. */
			else {
				jQuery( '.header-image' ).show();
				jQuery( '.header-image' ).attr( 'src', to );
			}

		} ); // value.bind

	} ); // wp.customize

} ); // jQuery( document ).ready

