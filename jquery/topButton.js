$(document).ready(function(e){
	
	// TOP BUTTON
	// RECUP HAUTEUR DE LA FENETRE
	
		 var hauteurFenetre = $(window).height();
            var newhauteur = $('body').height();
            var topPosition = $('#top').position();
            var positionFromTop = topPosition.top;
            
            console.log(hauteurFenetre);
            
            $('#top').hide();
            
            $(window).scroll(function() {
				
                if($(this).scrollTop() >= hauteurFenetre) {
                  
					 $("#top").show().css("bottom",300);
                } else {
                    $('#top').hide();
					
                }
				
				
            });
			
			 
			  
			 $("#top").click( function() { // Au clic sur un élément
                   	var page = $(this).attr('href'); // Page cible
                        var speed = 750; // Durée de l'animation (en ms)
                        $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
                        return false;
				
				 });
				
		});
		