jQuery( document ).ready( function() {

	/*
	 * Adding style on some elements.
	 */
	jQuery('.site-title-wrap').imagesLoaded( function() {
		jQuery('.main-menu-btn').css('top', jQuery('.site-title-wrap').outerHeight() / 2 );
	});

	/* Recalculating height on window resize. */
	jQuery(window).resize(function(){
		jQuery('.main-menu-btn').css('top', jQuery('.site-title-wrap').outerHeight() / 2 );
	});

	/*
	 * Initialize fitVids for make videos responsive.
	 */

	jQuery("#main").fitVids();

	/*
	 * Theme fonts handler.  This is so that child themes can make sure to style for future changes.  If
	 * they add styles for `.font-primary`, `.font-secondary`, and `.font-headlines`, users will always
	 * get the correct styles, even if the parent theme adds extra items.
	 *
	 * Child theme should still incorporate the normal selectors in their `style.css`. This is just for
	 * additional future-proofing.
	 */

	var font_primary = 'body, input, textarea, .label-checkbox, .label-radio, .required, #site-description, #reply-title small';

	var font_secondary = 'dt, th, legend, label, input[type="submit"], input[type="reset"], input[type="button"], button, select, option, .wp-caption-text, .gallery-caption, .mejs-controls, .wp-playlist-item-meta, .entry-byline, .entry-footer, .chat-author cite, .chat-author, .comment-meta, .breadcrumb-trail, .menu, .media-info .prep, .comment-reply-link, .comment-reply-login, .clean-my-archives .day, .whistle-title';

	var font_headlines = 'h1, h2, h3, h4, h5, h6';

	jQuery( font_primary ).addClass( 'font-primary' );
	jQuery( font_secondary ).addClass( 'font-secondary' );
	jQuery( font_headlines ).not( '#site-title' ).addClass( 'font-headlines' );

	/*
	 * Adding special HTML on some elements.
	 */

	/* Adds a `<span class="wrap">` around some elements. */
	jQuery(
		'.widget-title, #comments-number, #reply-title, .attachment-meta-title'
	).wrapInner( '<span class="wrap" />' );

	/* Adds <span class="screen-reader-text"> on some elements. */
	jQuery( '.widget-widget_rss .widget-title img' ).wrap( '<span class="screen-reader-text" />' );

	/*
	 * Adds classes to the `<label>` element based on the type of form element the label belongs
	 * to. This allows theme devs to style specifically for certain labels (think, icons).
	 */

	jQuery( '#container input, #container textarea, #container select' ).each(

		function() {
			var sg_input_type = 'input';
			var sg_input_id   = jQuery( this ).attr( 'id' );
			var sg_label      = '';

			if ( jQuery( this ).is( 'input' ) )
				sg_input_type = jQuery( this ).attr( 'type' );

			else if ( jQuery( this ).is( 'textarea' ) )
				sg_input_type = 'textarea';

			else if ( jQuery( this ).is( 'select' ) )
				sg_input_type = 'select';

			jQuery( this ).parent( 'label' ).addClass( 'label-' + sg_input_type );

			if ( sg_input_id )
				jQuery( 'label[for="' + sg_input_id + '"]' ).addClass( 'label-' + sg_input_type );

			if ( 'checkbox' === sg_input_type || 'radio' === sg_input_type ) {
				jQuery( this ).parent( 'label' ).removeClass( 'font-secondary' ).addClass( 'font-primary' );

				if ( sg_input_id )
					jQuery( 'label[for="' + sg_input_id + '"]' ).removeClass( 'font-secondary' ).addClass( 'font-primary' );

			}
		}
	);

	/* Focus labels for form elements. */
	jQuery( 'input, select, textarea' ).on( 'focus blur',
		function() {
			var sg_focus_id   = jQuery( this ).attr( 'id' );

			if ( sg_focus_id )
				jQuery( 'label[for="' + sg_focus_id + '"]' ).toggleClass( 'focus' );
			else
				jQuery( this ).parents( 'label' ).toggleClass( 'focus' );
		}
	);

	/*
	 * Handles situations in which CSS `:contain()` would be extremely useful. Since that doesn't actually
	 * exist or is not supported by browsers, we have the following.
	 */

	/* Adds the 'has-cite' class to the parent element in a blockquote that wraps <cite>, such as a <p>. */
	jQuery( 'blockquote p' ).has( 'cite' ).addClass( 'has-cite' );

	/*
	 * Adds the `.has-cite-only` if the last `<p>` in the `<blockquote>` only has the `<cite>` element.
	 * Adds the `.is-last-child` class to the previous `<p>`.  This is so that we can style correctly
	 * for blockquotes in English, in which only the last paragraph should have a closing quote.
	 */
	jQuery( 'blockquote p:has( cite )' ).filter(
		function() {
			if ( 1 === jQuery( this ).contents().length ) {
				jQuery( this ).addClass( 'has-cite-only' );
				jQuery( this ).prev( 'p' ).addClass( 'is-last-child' );
			}
		}
	);

	/* Add class to links with an image. */
	jQuery( 'a' ).has( 'img' ).addClass( 'img-hyperlink' );

	/* Adds 'has-posts' to any <td> element in the calendar that has posts for that day. */
	jQuery( '.wp-calendar tbody td' ).has( 'a' ).addClass( 'has-posts' );

	/* Fix Webkit focus bug. */
	jQuery( '#content' ).attr( 'tabindex', '-1' );

	jQuery('#menu-primary-items').smartmenus({
		mainMenuSubOffsetX: 1,
		subMenusSubOffsetX: 10,
		subMenusSubOffsetY: 0,
		subMenusMaxWidth: '16em',
		subIndicatorsPos: 'append',
		subIndicatorsText: '',
	});

	jQuery('#menu-primary-items').smartmenus('keyboardSetHotkey', '123', 'shiftKey');

	jQuery(".hamburger").on("click", function(e) {
		jQuery(this).toggleClass("is-not-active is-active");
		// Do something else, like open/close menu
		jQuery("#header").toggleClass("primary-menu-is-active");
		jQuery("#menu-primary-items").toggleClass("menu-is-active");
		jQuery(this).attr('aria-expanded', function (i, attr) {
		    return attr == 'true' ? 'false' : 'true'
		});
        jQuery("#menu-primary-items").attr('aria-expanded', function (i, attr) {
		    return attr == 'true' ? 'false' : 'true'
		});
	});

} );
