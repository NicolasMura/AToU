<section class="formulaire" >

    <p class="filAriane">Accueil &nbsp; > &nbsp; Compagnie</p>	
    <p class="titreFormulaire1">L'accès à cet espace est réservé <br /> aux adhérents</p> 


    <!--________________________ cadreFormulaireLeft ________________________-->	
    
    <div class="cadreFormulaireLeft">
    
        <!--________________________Formulaire 1________________________-->
        
        <div id="nm_bloc1" class="cadreFormulaire1">
            <p class="titreFormulaire5">Se connecter à l'espace adhérent.</p>
            <p class="erreur"><?php if(isset($erreurLogin)) echo $erreurLogin;?></p>
        
            
            <form action="../adherents/login#nm_bloc1" method="post">
            
                <!--________________________Formulaire Colonne 1________________________-->

                <div id="col1">
                    <ul>
                        <li class="entreesFormulaire">
                            <label for="identifiant">Identifiant<br />
                            </label>
                            <input type="text" id="identifiant" name="identifiant" placeholder="Votre identifiant" tabindex=1 required/>
                         </li>
                            
                         <p class="texteFormulaire3">
							*Si vous avez oublié votre mot de passe, <a id="nm_bloc1Lien" href="#nm_bloc1">cliquez ici</a>.
                         </p>
                    </ul>
                </div>
            
                <!--________________________Fin Formulaire Colonne 1________________________-->

            
                <!--________________________Formulaire Colonne 2________________________-->
            
                <div id="col2">
                    <ul>
                        <li class="entreesFormulaire">
                            <label for="pass">Mot de passe *<br />
                            </label>
                            <input type="password" id="pass" name="pass" placeholder="Votre mot de passe" tabindex=2 required/>
                        </li>
                        <li class="entreesFormulaire">
                            <input type="submit" value="Validez" id="env" name="env" class="callToAction4"/>
                            <!--<input type="button" name="cancel" value="Annuler" onclick="closebox()" class="nm_callToAction4"/>-->
                        </li>
                    </ul>
                </div>
            </form>
            <!--________________________Fin Formulaire Colonne 2________________________-->

        </div>
        
        <!--________________________Fin Formulaire 1________________________-->




        <!--________________________Formulaire 2________________________-->
    
        <div id="nm_bloc2" class="cadreFormulaire1">
            <p class="titreFormulaire5">
                Veuillez entrer votre adresse mail,
                vous recevrez par mail votre mot de passe.
            </p>
            
            <form action="index.php#nm_bloc2" method="post">

                <!--________________________Formulaire 2 Colonne 1________________________-->
            
                <div id="col1">
                    <ul>
                        <li class="entreesFormulaire">
                            <label for="mail">Mail<br /></label>
                            <input type="email" id="mail" name="mail" placeholder="Votre mail" required/>
                        </li>
                    </ul>                  
                </div>
            
                <!--________________________Fin Formulaire 2 Colonne 1________________________-->

            
                <!--________________________Formulaire 2 Colonne 2________________________-->
            
                <div id="col2">
                    <ul>
                        <li class="entreesFormulaire">
                            <input type="submit" value="Validez" name="env2" id="env2" class="callToAction4 callToActionPosition1"/>
                            <!--<input type="button" name="cancel" value="Annuler" onclick="closebox()" class="nm_callToAction4"/>-->
                        </li>
                    </ul>
                </div>
                
                <!--________________________Fin Formulaire 2 Colonne 2________________________-->

            </form>
        
        </div>
    
        <!--________________________Fin Formulaire 2________________________-->



        <!--________________________Message Formulaire 2________________________-->
    
        <p class="erreur"><?php if(isset($erreurMail)) echo $erreurMail;?></p>
		
		<?php
			if(isset($messageMailOK)) 
			{
		?>
        <div class="cadreFormulaire1">
            <p class="titreFormulaire5">
                <?php echo $messageMailOK;?>
            </p>
        </div>
    	<?php
			}
		?>
        
        <?php
			if(isset($erreurMailInconnu)) 
			{
		?>
        <div class="cadreFormulaire1">
            <p class="erreur">
                <?php echo $erreurMailInconnu;?>
            </p>
        </div>
    	<?php
			}
		?>
        <!--________________________Fin Message Formulaire 2________________________-->




        <!--________________________Formulaire 3________________________-->
    
        <div id="nm_bloc4" class="cadreFormulaire1">
        
            <!--________________________Formulaire 3 Colonne 1________________________-->

            <div id="col1">
                <p class="titreFormulaire5">
                    Vous souhaitez participer à un atelier de la compagnie
                    et vous n'êtes pas encore adhérent(e) ?
                </p>
            </div>
            
            <a id="nm_bloc1Lien" class="nm_boutonParticipez" href="#nm_bloc4">Participez</a>
            
            <!--________________________Fin Formulaire 3 Colonne 1________________________-->

            
            <!--________________________Formulaire 3 Colonne 2________________________-->
            
           <!-- <div id="col2">
                <form action="" method="post">
                    <ul>
                        <li class="entreesFormulairee">
                             <input type="submit" value="Participez" id="env" class="callToAction4" id="nm_bloc4Lien"/>
                        </li>
                    </ul>
                </form>
            </div>-->
            
            <!--________________________Fin Formulaire 3 Colonne 2________________________-->
            
        </div>
        
        <!--________________________Fin Formulaire 3________________________-->




        <!--________________________Formulaire 4________________________-->
        <?php
			if(isset($messageInscriptionOK)) 
			{
		?>
        <div class="cadreFormulaire1">
            <p class="titreFormulaire5">
                <?php echo $messageInscriptionOK;?>
            </p>
        </div>
    	<?php
			}
		?>
        
        <p class="erreur"><?php if(isset($erreurMailDejaPris)) echo $erreurMailDejaPris;?></p>
        <p class="erreur"><?php if(isset($erreurParticiper)) echo $erreurParticiper;?></p>
        <div id="nm_bloc5" class="cadreFormulaire1">
            <p class="titreFormulaire5">
                Vous souhaitez participer à un atelier de la compagnie
                et vous n'êtes pas encore adhérent(e) ?
                Merci de remplir ce formulaire.
            </p>
            
            <form action="index.php#nm_bloc4" method="post">

                <div>
                    <ul class="civiliteFormulaire">
                        <li>
                            <label for="mde">Madame</label>
                            <input type="radio" id="mde" name="civilite" value="Madame"/>
                        </li>
                        <li>
                            <label for="melle">Mademoiselle</label>
                            <input type="radio" id="melle" name="civilite" value="Mademoiselle"/>
                        </li>
                        <li>    
                            <label for="m">Monsieur</label>
                            <input type="radio" id="m" name="civilite" value="Monsieur"/>
                        </li>
                    </ul>
                </div>

                <!--________________________Formulaire 4 Colonne 1________________________-->

                <div id="col1">
                    <ul>
                        <li class="entreesFormulaire">
                            <label for="nom">Nom<br /></label>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom" tabindex=3 required/>
                        </li>                          
                        <li class="entreesFormulaire">
                            <label for="mail">Mail<br /></label>
                            <input type="email" id="mail" name="mail" placeholder="Votre mail" tabindex=5 required/>
                        </li>
                        <li class="entreesFormulaire">
                            <label for="anniv">Date de naissance<br /></label>
                            <input type="date" id="anniv" name="anniv" placeholder="Votre date de naissance" tabindex=7 required/>
                        </li>
                    </ul>
                </div>
        
                <!--________________________Fin Formulaire 4 Colonne 1________________________-->
        
                <!--________________________Formulaire 4 Colonne 2________________________-->
        
                <div id="col2">
                    <ul>
                        <li class="entreesFormulaire">
                            <label for="prenom">Prénom<br /></label>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" tabindex=4 required/>
                        </li>
                        <li class="entreesFormulaire">
                            <label for="tel">Téléphone<br /></label>
                            <input type="tel" id="tel" name="tel" placeholder="Votre téléphone" tabindex=6 />
                        </li>
                        <li class="entreesFormulaire">
                            <input type="submit" value="Validez" name="env3" id="env3" class="callToAction3 callToActionPosition2"/>
                            <!--<input type="button" name="cancel" value="Annuler" onclick="closebox()" class="nm_callToAction4 nm_marginTop"/>-->
                        </li>
                    </ul>
                </div>
        
                <!--________________________Fin Formulaire 4 Colonne 2________________________-->
                
            </form>
            
        </div>
   
        <!--________________________Fin Formulaire 4________________________-->
        
        
    </div>
   
        
    <!--________________________Fin cadreFormulaireLeft________________________-->


    <!--________________________Contact________________________-->

    <div class="cadreFormulaireRight">
        <ul id="firstBlockFormulaire">
            <li class="titreFormulaire3">Contactez-nous</li>
            
            <li class="texteFormulaire2">
                8 avenue Bataillon<br />
                Carmagnole-Liberté<br />
                69120 Vaulx-en-Velin<br />
             </li>

            <li class="titreFormulaire4">Administration</li>
            <li class="texteFormulaire2">
                Tél./ +33 (0)4 72 14 16 63<br />
                administration@atou.fr
            </li>
        </ul>
    </div>
     
    <br class="annule"/>
    
    <!--________________________Fin Contact________________________-->        

</section>