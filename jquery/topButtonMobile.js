$(document).ready(function(e){
	
// TOP BUTTON
	// RECUP HAUTEUR DE LA FENETRE
	 var hauteurFenetre = $(window).height();
            var newhauteur = $('body').height();
            var topPosition = $('.topTop').position();
            var positionFromTop = topPosition.top;
            
            console.log(hauteurFenetre);
            
            $('.topTop').hide();
            
            $(window).scroll(function() {
				
                if($(this).scrollTop() >= hauteurFenetre) {
                  
					 $(".topTop").show().css("bottom",0);
                } else {
                    $('.topTop').hide();
					
                }
				
				
            });
			
			 
	
			$(".topTop").click( function() { // Au clic sur un élément
	
				var speed = 750; // Durée de l'animation (en ms)
				
				$('html, body').animate( { scrollTop: 0 }, speed ); // Go
				return false;
		
		 });
		
	 });

