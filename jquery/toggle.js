$(document).ready(function(e){
				
			$('.deroule').hide();
			
			$('.toggle').click(function(){
				//init();
				$('.deroule').slideUp("slow");
				$('.toggle').addClass('toggleUp');
				$('.toggle').removeClass('toggleDown');
				
				if(!$(this).hasClass('accordeonActive')){
						$('.toggle').removeClass('accordeonActive');	
						$(this).next().slideToggle().siblings(".deroule:visible").slideUp("slow");
						$(this).addClass('accordeonActive');
						$(this).addClass('toggleDown');
						$(this).removeClass('toggleUp');
				}
				else {
					$('.toggle').removeClass('accordeonActive');	
					//$(this).removeClass('accordeonActive');	
					
				}
				return false;
			})
		});
		
		
$(document).ready(function(e){
				
			$('.deroule2').hide();
			
			$('.toggle2').click(function(){
				//init();
				$('.deroule2').slideUp("slow");
				$('.toggle2').addClass('toggleUp');
				$('.toggle2').removeClass('toggleDown2');
				
				if(!$(this).hasClass('accordeonActive')){
						$('.toggle2').removeClass('accordeonActive');	
						$(this).next().slideToggle().siblings(".deroule:visible").slideUp("slow");
						$(this).addClass('accordeonActive');
						$(this).addClass('toggleDown2');
						$(this).removeClass('toggleUp');
				}
				else {
					$('.toggle2').removeClass('accordeonActive');	
					//$(this).removeClass('accordeonActive');	
					
				}
				return false;
			})
		});