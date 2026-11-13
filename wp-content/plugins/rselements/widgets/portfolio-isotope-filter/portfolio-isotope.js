(function ($) {
    "use strict";

    var isEditMode = false;
    var portfolio = function ($scope, $) {
        //Add your js code here
        var $grid = jQuery('.gridsd').isotope({
            // options
            itemSelector: '.grid-item',
            layoutMode: 'fitRows',
        });

        // change is-checked class on buttons
        var $buttonGroup = jQuery('.filters');
            $buttonGroup.on( 'click', 'li', function( event ) {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            var $button = jQuery( event.currentTarget );
            $button.addClass('is-checked');
            var filterValue = $button.attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
    };


    $(window).on('elementor/frontend/init', function () {
        if ( elementorFrontend.isEditMode() ) {
			isEditMode = true;
		}     
      elementorFrontend.hooks.addAction('frontend/element_ready/rsportfolio-isotope-filter-widget.default', portfolio);
       
    });
    
}(jQuery));