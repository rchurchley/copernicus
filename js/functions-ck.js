/**
 * Functionality specific to Copernicus.
 *
 * Provides helper functions to enhance the theme experience.
 */(function(e){(function(){var t=e(".site-navigation"),n,r;if(!t)return;n=t.find(".menu-toggle");if(!n)return;r=t.find("a");if(!r){n.hide();return}e(".menu-toggle").on("click.copernicus",function(){t.toggleClass("toggled-on")})})()})(jQuery);