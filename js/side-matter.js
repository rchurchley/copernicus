/*
side-matter.js
Version 0.6
*/

jQuery(document).ready(function($) { // Allow use of $ shortcut
	var isResponsive = true; // If true, reposition notes on resize/zoom
	var noteSpace = 5; // Buffer spacing to add between tightly positioned notes, in px
	var noteAdjust = 0; // Distance to arbitrarily adjust note position upward (positive) or downward (negative), in px
	function placeNotes() {
		if ($(window).width() < 1024) {
			$( ".side-matter" ).each(function(i) {
				var note = '#' + $(this).attr( "id" );
				$(note).css('marginTop', noteSpace); // Position note
			});
		} else {
			$( ".side-matter" ).each(function(i) {
				var note = '#' + $(this).attr( "id" );
				var ref = '#link-' + $(this).attr( "id" );
				var refPosition = $(ref).position().top; // Position of reference anchor
				var notePosition = $(note).position().top; // Position of annotation item
				var noteOffset = refPosition - notePosition - noteAdjust; // Get offset from reference to note, minus noteAdjust
				var finalNoteOffset = (noteOffset < 0 ? noteSpace : noteOffset); // If negative offset, apply noteSpace
				$(note).css('marginTop', finalNoteOffset); // Position note
			});
		}
	}
	placeNotes();  // Run placeNotes() loop on load
	$(window).load(function(){
		placeNotes(); // And again once all the sidefigures have been loaded
	});
	$(window).resize(function() { // Reposition notes in the event of viewport resize/zoom
		if (isResponsive) {
			var isResizing;
			var timeoutInterval = 500; // Time (in ms) to delay reposition
			function doneResizing() {
				placeNotes();
			}
			clearTimeout(isResizing);
			isResizing = setTimeout(doneResizing, timeoutInterval);
		}
	});
});