// Initialisation : langue active = français
$("[id$='-en']").hide();
$("div.jqte:nth-child(2n+1)").hide();
$('a[name="FR"]').css({
  fontWeight: 'bold'
});

// Si on choisit le français
$('a[name="FR"]').click(function()
  {
    $("#drapeau-france").attr("src", "../img/drapeau-france.png"); // on charge le drapeau français
    $("#drapeau-angleterre").attr("src", "../img/drapeau-angleterre-nb.png"); // on charge le drapeau anglais en N&B
    $('a[name="FR"]').css({
      fontWeight: 'bold'
    });
    $('a[name="EN"]').css({
      fontWeight: 'normal'
    });

    $("[id$='-en']").hide(); // On cache tous les champs anglais du formulaire
    $("div.jqte:nth-child(2n+1)").hide(); // Idem (rustine pour les textarea en rich text)
    $("[id$='-fr']").fadeIn(500);
    $("[id$='-fr']").show(); // On affiche tous les champs français du formulaire
    $("div.jqte:nth-child(2n)").show(); // Idem (rustine pour les textarea en rich text)
  }
);

// Si on choisit l'anglais
$('a[name="EN"]').click(function()
  {
    $("#drapeau-france").attr("src", "../img/drapeau-france-nb.png"); // on charge le drapeau français N&B
    $("#drapeau-angleterre").attr("src", "../img/drapeau-angleterre.png"); // on charge le drapeau anglais
    $('a[name="FR"]').css({
      fontWeight: 'normal'
    });
    $('a[name="EN"]').css({
      fontWeight: 'bold'
    });

    $("[id$='-fr']").hide(); // On cache tous les champs français du formulaire
    $("div.jqte:nth-child(2n)").hide(); // Idem (rustine pour les textarea en rich text)
    $("[id$='-en']").fadeIn(500);
    $("[id$='-en']").show(); // On affiche tous les champs anglais du formulaire
    $("div.jqte:nth-child(2n+1)").show(); // Idem (rustine pour les textarea en rich text)
  }
);