/**
 * Functionality specific to Copernicus.
 *
 * Provides helper functions to enhance the theme experience.
 */(function(e){e(".foldable > h2, .foldable > h3").on("click.copernicus",function(){e(this).toggleClass("toggled-on");e(this).nextUntil("h2,h3").toggleClass("toggled-on");return!1})})(jQuery);