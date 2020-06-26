var map = L.map('map').setView([0, 0], 13);


L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
  attribution: 'donn&eacute;es &copy; <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
  minZoom: 1,
  maxZoom: 20
}).addTo(map);

function readBlob(opt_startByte, opt_stopByte) {

  var files = document.getElementById('files').files;
  if (!files.length) {
    alert('Pouvez vous selectioner un fichier');
    return;
  }

  var file = files[0];
  var start = parseInt(opt_startByte) || 0;
  var stop = parseInt(opt_stopByte) || file.size - 1;

  var reader = new FileReader();

  var blob = file.slice(start, stop + 1);
  reader.readAsText(blob);
  reader.onloadend = function (evt) {
    if (evt.target.readyState == FileReader.DONE) { // DONE == 2
      // Chargement du contenu du fichier dans le bloc d'identifiant #byte_content
      $('#byte_content').html(evt.target.result);
      var xml = $('#byte_content').html();
      var xmlDoc = $.parseXML(xml);
      var $xml = $(xmlDoc);
      // Passage en gras des noms de lieux (balises placename) :
      $("placename[type=ville]").addClass("sur");
      /*  var net = $(".sur");
          var compter = 0;
          for (var i=1; i<net.length; i++) {
            compter = i;
            console.log(compter);
        } */
      $("placename[type=ville]").each(function (index) {
        $(this).attr('id', 'ville' + index);
      });
      //boucle pour faire un compter placename
      //ajouter id a chaque placename 
      //faire un appel api.php?action=addText
        $.ajax({
            url: "api.php", // URL de Nominatim
            type: 'get', // Requête de type GET
            data: "action=addText&text"+net
        }) 
      //faire des appels api.php?action=addPlacename a chaque placename trouvé
      /*     $.ajax({
            url: "api.php", // URL de Nominatim
            type: 'get', // Requête de type GET
            data: "action=addPlacename" 
        }) */
      $("teiheader").hide();
      var net = $(".sur");

      var lieux = {};

      for (var i = 0; i < net.length; i++) {

        var tab = net.eq(i).html();
        //voir la doc de in
        if (tab in lieux) {
          lieux[tab]++;
        } else {
          lieux[tab] = 1;
        }

        $('#subtype').on('click', function () {
          $("placename[type=ville]").removeClass("sur");
          $("placename[subtype=reference]").addClass("sur");
        });
        $('#subtype2').on('click', function () {
          $("placename[type=ville]").removeClass("sur");
          $("placename[subtype=reference]").removeClass("sur");
          $("placename[subtype=trip]").addClass("sur");
        });
        $('#type').on('click', function () {
          $("placename[type=ville]").addClass("sur");

        });

      }
      console.log(lieux);
      var selectElem = $("#fromCity");

      // Iterate over object and add options to select
      for (const property in lieux) {


        $("<option/>", {
          value: property,
          text: property
        }).appendTo(selectElem);
        $.get("http://api.ipapi.com/check?access_key=594c70b41fa4633610a7f80f14d28122&format=1").done(function (data) {
          map.setView([data.latitude, data.longitude], 6);
           var ville =property;
          //faire un appel ajx de la bdd "api.php?action=read&nom="+ville
                   $.ajax({
                       url: "https://nominatim.openstreetmap.org/search", // URL de Nominatim
                       type: 'get', // Requête de type GET
                       data: "q="+ville+"&format=json&addressdetails=1&limit=1&polygon_svg=1" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                   }).done(function (response) {
                     // boucle pour parcourir tous les resultats et ajouter un marqueur a tous les resultats voir la liste des lieux candidats
                          var lat = response[0]['lat'];
                           var lon = response[0]['lon'];
                  console.log(lat);
          console.log(lon); 
       
          //appelle ajax de api.php?action=write&nom=var1&lat=var2&lon=var3
        	$.ajax({
            
                                url: "api.php", // URL de Nominatim
                                type: 'get', // Requête de type GET
                                data: "action=write&name="+ville+"&lat="+lat+"&lon="+lon+"" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                            }) 


            })
        
        })
      }

      $('#byte_content').dblclick(function () { // Au click  dans la div qui a la class .cmd_details faire
        if (!$(this).children("textarea").length) { // Si il n'y a pas de textarea
          $(this).html(function () { // Un remplacement du contenue de ma div par
            return '<textarea cols="100" rows="50" class="sTextarea" >' + $(this).html() + '</textarea>'; // Un textarea qui aura par défaut le contenue de ma div (ex: du texte)
          });
          $(this).children("textarea").focus(); // Et ensuite met mon curseur dans le textarea pour que je puisse le modifier directement
        }
      });

      $('#byte_content').focusout(null, function () { // Maintenant, quand je clic à l'exterieur de ma div
        $(this).html(function () { // Remplace moi le textarea
          return $(this).children('textarea').val(); // Par uniquement son contenu sans textarea
        });
      });

      const regex = /<content>\s*{Nom_produit}\s*<\/content>/g;
      //commentaire
      function highlightText($textarea) {
        $textarea.focus();
        let match = regex.exec($textarea.value);
        if (match) {
          let j = regex.lastIndex;
          let i = j - match[0].length;
          $textarea.setSelectionRange(i, j);
          regex.lastIndex = 0;
        }
      }
      let $ta = document.querySelector("#byte_content");
      let $button = document.querySelector("button");

      $button = document.createElement("button");
      $button.textContent = "Enregistrer";

      document.body.append($button);

      $button.onclick = () => {
        let blob = new Blob([$ta.value], {
          type: "text/xml"
        });
        let blobUrl = URL.createObjectURL(blob);

        let $a = document.createElement("a");
        $a.download = file.name;
        $a.href = blobUrl;

        document.body.append($a);
        $a.click();
        $a.remove();
        URL.revokeObjectURL(blobUrl);
      };


      $ta.value = reader.result;
      highlightText($ta);
    }
  };

}

document.querySelector('.readBytesButtons').addEventListener('click', function (evt) {

  if (evt.target.tagName.toLowerCase() == 'button') {
    var startByte = evt.target.getAttribute('data-startbyte');
    var endByte = evt.target.getAttribute('data-endbyte');
    readBlob(startByte, endByte);
  }
}, false);