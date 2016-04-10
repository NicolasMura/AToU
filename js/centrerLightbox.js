// Récupération de la largeur et hauteur de la fenêtre du navigateur
	function centrerLightbox(widthLB, heightLB, paddingsLB)
	{
		widthTotal = window.innerWidth;//$(window).width();
		heightTotal = window.innerHeight; //$(window).height();//$('body').height();
		//console.log("Largeur fenêtre : " + widthTotal);
		//console.log("Hauteur fenêtre : " + heightTotal);
		
		// Récupération des dimensions des éléments de la lightbox
		widthLightbox = widthLB;
		if(!heightLB)
		{
			heightLightbox = heightTotal;
		}
		else
		{
			heightLightbox = heightLB;
		}
		if(!paddingsLB)
		{
			paddingsLightbox = 48;
		}
		else
		{
			paddingsLightbox = paddingsLB;
		}
		
		widthTotalLightbox = widthLightbox + paddingsLightbox;
		heightLightboxTitle = parseInt($("#boxtitle").css('height'));
		heightTotalLightbox = heightLightbox + paddingsLightbox + heightLightboxTitle;
		
		// Dimmensionnement des élements de la lightbox
		paddingsLightboxCSS = paddingsLightbox + "px";
		widthLightboxCSS = widthLightbox + "px";
		//console.log("Largeur CSS de la lightbox : " + widthLightboxCSS);
		//widthLightboxTitle = widthLightbox + 2 * paddingsLightbox; // Ajout des paddings droite et gauche
		widthLightboxTitle = 100; 
		widthLightboxTitleCSS = widthLightboxTitle + "%";
		//console.log("Largeur CSS du titre de la lightbox : " + widthLightboxTitleCSS);
		if(heightTotalLightbox > heightTotal - 100)
		{
			//console.log("Lightbox trop grande !");
			heightTotalLightbox = heightTotal - 100;
			heightTotalLightboxCSS = heightTotalLightbox + "px"; // Pour debug (ne sert à rien)
			heightLightbox = heightTotalLightbox - paddingsLightbox - heightLightboxTitle;
			heightLightboxCSS = heightLightbox + "px";
			//console.log("Nouvelle hauteur totale CSS de la lightbox (avec le titlebox) : " + heightTotalLightboxCSS);
		}
		else
		{
			//console.log("Lightbox plus petite que la fenêtre = OK");
			heightTotalLightboxCSS = heightTotalLightbox + "px"; // Pour debug (ne sert à rien)
			heightLightboxCSS = heightLightbox + "px";
			//console.log("Hauteur totale CSS de la lightbox (avec le titlebox) : " + heightTotalLightboxCSS);
		}
	
		// Calcul en % du positionnement "fixed" de la ligthbox pour la centrer
		leftLightbox = ((widthTotal / 2 - (widthLightbox + 2 * paddingsLightbox)/ 2) / widthTotal) * 100;
		leftLightboxCSS = leftLightbox + "%";
		topLightbox = ((heightTotal / 2 - heightTotalLightbox / 2) / heightTotal) * 100;
		topLightboxCSS = topLightbox + "%";
		//console.log("Left CSS de la lightbox : " + leftLightboxCSS);
		//console.log("Top CSS de la lightbox : " + topLightboxCSS);
		
		// Modification des propriétés CSS
		$("#box").css('width', widthLightboxCSS);
		$("#box").css('height', heightLightboxCSS);
		$("#box").css('padding', paddingsLightboxCSS);
		$("#boxtitle").css('width', widthLightboxTitleCSS);
		$("#box").css('left', leftLightboxCSS);
		$("#box").css('top', topLightboxCSS);
		//$("#box p.titreFormulaire1").css('padding', 0);// rustine pour le titre du formulaire (stylé trop large)
		//$("#box p.titreFormulaire1").css('width', widthLightboxCSS);// rustine pour le titre du formulaire (stylé trop large)
		$("#box .cadreFormulaireRight").css('width', 200);// rustine pour le bloc de droite du formulaire (stylé trop large)
		//$("#box section").css('width', widthLightboxCSS);// rustine pour le bloc de droite du formulaire (stylé trop large)
	}

