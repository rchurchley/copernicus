/**
 * Functionality specific to Copernicus.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	/**
	 * Enables menu toggle for small screens.
	 */
	( function() {
		var nav = $( '.site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( 'a' );
		if ( ! menu ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.copernicus', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

} )( jQuery );