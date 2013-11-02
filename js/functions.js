/**
 * Functionality specific to Copernicus.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {

	$('.foldable > h2, .foldable > h3').on( 'click.copernicus', function() {
		$(this).toggleClass('toggled-on');
		$(this).nextUntil('h2,h3').toggleClass('toggled-on');

		return false;
	});

} )( jQuery );