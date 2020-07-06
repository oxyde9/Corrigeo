<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
</head>
<style>
  body {
    background-color: rgb(56, 9, 56);
    color: white;

  }

  .back {
    background-color: rgba(211, 168, 211, 0.658);
    padding: 2%;
  }

  .sur {
    font-weight: bold;
    text-decoration: underline;
    font-size: 1.2rem;
  }
</style>

<body>
  <?php session_start();?>

  <?php include("config.php");?>
  <div class="container">
    <h1>Corrigéo</h1>
    <?php	if (isset($_SESSION["iduser"]))
{ 
echo "Bonjour {$_SESSION["iduser"]}"; }
?>
    <form>
      <div class="form-group">
        <label for="exampleFormControlFile1">Merci de charger un fichier : </label>
        <input type="file" class="form-control-file" id="files">
      </div>
      <input type="checkbox" id="type">Ville
      <input type="checkbox" id="subtype">Refer
      <input type="checkbox" id="subtype2">Trip
      <select name="" id="fromCity">
        <option value="">Les villes</option>
      </select>

    </form>
    <span class="readBytesButtons">

      <button>Lire le fichier</button>
    </span>
    <br>

    <div id="map" class="map map-home" style="margin:50px;padding:0px;height: 50vh"></div>
    <div class="row">
      <section class="col col-3">
        <label class="input">
          <input id="Latitude" placeholder="Latitude" name="Location.Latitude" />
          <!-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) -->
        </label>
      </section>
      <section class="col col-3">
        <label class="input">
          <input id="Longitude" placeholder="Longitude" name="Location.Longitude" />
          <!-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) -->
        </label>
      </section>
    </div>
    <div class="back" id="byte_content"></div>

  </div>
  

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script>
  $(document).ready(function(){
  console.log("debut du js");
    var map = L.map('map').setView([0, 0], 13);


    L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
      attribution: 'donn&eacute;es &copy; <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
      minZoom: 1,
      maxZoom: 20
    }).addTo(map);

    $.get("http://api.ipapi.com/check?access_key=594c70b41fa4633610a7f80f14d28122&format=1").done(function (
          data) {
            console.log("debut du js 2");
          map.setView([data.latitude, data.longitude], 6);

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
                var te = new XMLSerializer().serializeToString(xmlDoc);
             /*    console.log("api.php?action=addText&text=" + te);
                console.log(te); */
                //boucle pour faire un compter placename
                //ajouter id a chaque placename 
                //faire un appel api.php?action=addText
                /* $.get("api.php?action=addText&text=" + encodeURI(te))  */

                //enregistrement du texte en base de données
                //probleme avec cette partie 
            /*     $.ajax({
                  url: "api.php", // URL de l'api text
                  type: 'post', // Requête de type post
                  data: "action=addText&text=" + te
                })
 */
                
                //faire des appels api.php?action=addPlacename a chaque placename trouvé
                /*     $.ajax({
                      url: "api.php", // URL de Nominatim
                      type: 'get', // Requête de type GET
                      data: "action=addPlacename" 
                  }) */
                $("teiheader").hide();
                var net = $(".sur");

                var lieux = {};
//liste des lieux sans doublon
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
                console.log("lieux:");
                console.log(lieux);
                var selectElem = $("#fromCity");
             
                // Iterate over object and add options to select
                for (const property in lieux) {


                  $("<option/>", {
                    value: property,
                    text: property
                  }).appendTo(selectElem);
                }
                  var ville = lieux[0];
                  var numVille = 0;

                  function treatNextCity() {
                    if(numVille < Object.keys(lieux).length){

                  
                    var ville = Object.keys(lieux)[numVille];
console.log(ville);
console.log(lieux);
                     
                    $.ajax({
                        url: "application.php",
                        type: 'get', // Requête de type GET
                        data: { name: ville }
                      }).done(function (response) {
                        if (response.length > 0 && response[0]['lat'] != undefined ) {
                          console.log(response);
                          lat = response[0]['lat'];
                          lon = response[0]['lon'];
                          console.log(lat);
                          console.log(lon);
                        } else {
                          console.log("nominatim" + ville);

                          $.ajax({
                            url: "https://nominatim.openstreetmap.org/search", // URL de Nominatim
                            type: 'get', // Requête de type GET
                            data: "q=" + ville +"&format=json&addressdetails=1&limit=1&polygon_svg=1" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                          }).done(function (response) {

                            console.log(response);
                            // boucle pour parcourir tous les resultats et ajouter un marqueur a tous les resultats voir la liste des lieux candidats
                           lat = response[0]['lat'];
                             lon = response[0]['lon'];
                            console.log(lat);
                            console.log(lon);

                            //appelle ajax de api.php?action=write&nom=var1&lat=var2&lon=var3
                            $.ajax({

                              url: "api.php", // URL de Nominatim
                              type: 'get', // Requête de type GET
                              data: "action=write&name=" + ville + "&lat=" + lat + "&lon=" + lon +"" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                            })
                           

                          })

                        }
                        //On place des marqueures 
                        //mettre les marqueures dragrables
                        var marker = new L.marker([lat,lon], {draggable: 'true'});
                        
                        //recuperer la position du marqueur
  marker.on('dragend', function(event) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    $("#Latitude").val(position.lat);
    $("#Longitude").val(position.lng).keyup();
  });

  //montrer dans les input les changements de deplacement des marqueurs
  $("#Latitude, #Longitude").change(function() {
    var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    map.panTo(position);
  });

                          map.addLayer(marker);
                      /*   L.marker([lat,lon]).addTo(map).bindPopup('<strong><span style="font-size:2em;">'+ville+'</span></strong>').openPopup(); */
                      })
                      //verifier si la ville existe deja en base local
                      //faire un appel ajx de la bdd "api.php?action=read&nom="+ville
                      /*  console.log("local:"+ville);
                       $.ajax({

                         url: "api.php", // 
                         type: 'get', // Requête de type GET
                         data: "action=read&name=" + ville 
                       }).done(function (response){ 
                         
                         if (response.length>0){
                           console.log(response);
                         var lat = response[0]['lat'];
                           var lon = response[0]['lon'];
                           console.log(lat);
                           console.log(lon);
                       }else{
                         console.log("nominatim"+ville);
                         */
                      /*            $.ajax({
                  url: "https://nominatim.openstreetmap.org/search", // URL de Nominatim
                  type: 'get', // Requête de type GET
                  data: "q=" + ville +"&format=json&addressdetails=1&limit=1&polygon_svg=1" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                }).done(function (response) {
                
                  console.log(response);
                  // boucle pour parcourir tous les resultats et ajouter un marqueur a tous les resultats voir la liste des lieux candidats
                  var lat = response[0]['lat'];
                  var lon = response[0]['lon'];
                  console.log(lat);
                  console.log(lon);

                  //appelle ajax de api.php?action=write&nom=var1&lat=var2&lon=var3
                  $.ajax({

                    url: "api.php", // URL de Nominatim
                    type: 'get', // Requête de type GET
                    data: "action=write&name=" + ville + "&lat=" + lat + "&lon=" + lon +"" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                  })
 

                 }) */
                 
                  numVille++;
                  
                  setTimeout(() => {
                    treatNextCity()
                  }, 2000);
                } 
              }
                treatNextCity();            
                         


                     


               

                  $('#byte_content').dblclick(function () { // Au click  dans la div qui a la class .cmd_details faire
                    if (!$(this).children("textarea").length) { // Si il n'y a pas de textarea
                      $(this).html(function () { // Un remplacement du contenue de ma div par
                        return '<textarea cols="140" rows="50" ' + $(this).html() +
                          '</textarea>'; // Un textarea qui aura par défaut le contenue de ma div (ex: du texte)
                      });
                      $(this).children("textarea")
                        .focus(); // Et ensuite met mon curseur dans le textarea pour que je puisse le modifier directement
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
          });
        })
  </script>

</body>

</html>