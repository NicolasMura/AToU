	$(document).ready(function() {
		//$(".fancybox").fancybox();

/*------------------------------------------------------*/
/*------- Effets de transition entre chaque image-------*/
/*------------------------------------------------------*/

		
		(function ($, F) {
    F.transitions.resizeIn = function() {
        var previous = F.previous,
            current  = F.current,
            startPos = previous.wrap.stop(true).position(),
            endPos   = $.extend({opacity : 1}, current.pos);

        startPos.width  = previous.wrap.width();
        startPos.height = previous.wrap.height();

        previous.wrap.stop(true).trigger('onReset').remove();

        delete endPos.position;

        current.inner.hide();

        current.wrap.css(startPos).animate(endPos, {
            duration : current.nextSpeed,
            easing   : current.nextEasing,
            step     : F.transitions.step,
            complete : function() {
                F._afterZoomIn();

                current.inner.fadeIn("fast");
            }
        });
    };

}(jQuery, jQuery.fancybox));
/*------------------------------------------------------*/
/*-------------- Add title on mouse over ---------------*/
/*------------------------------------------------------*/
/*$(".fancybox").fancybox({
    afterShow: function() {
        $(".fancybox-title").wrapInner('<div />').show();
        
        $(".fancybox-wrap").hover(function() {
            $(".fancybox-title").show();
        }, function() {
            $(".fancybox-title").hide();
        });
    },
	

});*/
/*------------------------------------------------------*/
/*--------------------- custom  ------------------------*/
/*------------------------------------------------------*/

$(".fancybox")
    .attr('rel', 'gallery')
    .fancybox({
        nextMethod : 'resizeIn',
        nextSpeed  : 250,
        padding : 3, // taille de la bordure blanche
		margin      : [20, 60, 20, 60], // Increase left/right margin // arrows outside
        prevMethod : false,
        
        helpers : {
			
						overlay : {
		closeClick : true,  // if true, fancyBox will be closed when user clicks on the overlay
		speedOut   : 200,   // duration of fadeOut animation
		showEarly  : true,  // indicates if should be opened immediately or wait until the content is ready
		
		css        : {'background' : 'rgba(00, 00, 00, 0.84)'},    // custom CSS properties
		
		//css        : {'background' : 'rgba(153,77,120, 0.84)'},    // custom CSS properties
		
		//locked     : true   // if true, the content will be locked into overlay
	},
	title : {
		type : 'over' // 'float', 'inside', 'outside' or 'over'
	}
	
        		}
    });
	
	


			
		
	});
