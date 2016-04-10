// Script pour détecter l'existence d'une deuxième photo en base de données pour une création ou une action actuelle 
photoAlt = $('#ficheCreationShinmu1').attr('alt');
if(photoAlt == "") 
  {
    $('#ficheCreationShinmu1').attr('alt', 'Avertissement : pour une création / action cuturelle dont le statut n\'est pas "présente", et en l\'absence de vidéo, il vous faut importer une deuxième photo dans l\'espace d\'administration !');
  }