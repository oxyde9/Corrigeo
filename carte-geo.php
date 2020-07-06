
<html>
	<SCRIPT TYPE="text/javascript" SRC="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></SCRIPT>

	
	<head>
	   <title>Corrigeo</title>
	   <meta http-equiv="Content-Type" content="text/html; charset=UTF8" />
	
	   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	  crossorigin=""></script>
	   <!-- Chargement de la feuille de style de Leaflet -->
	   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	  crossorigin=""/>
	
	</head>
	
	<body style="background-color:white;font-size:12pt;font-family:Calibri;margin:0px;padding:0px">
<!-- Emplacement de la carte  -->
	<div id="map" class="map map-home" style="margin:0px;padding:0px;height: 100vh"></div>

	<SCRIPT TYPE="text/javascript">
	<?php include("config.php");?>
//Création de la carte Leaflet
	var map = L.map('map').setView([0,0], 13);
	

	L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
		attribution: 'donn&eacute;es &copy; <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
		minZoom: 1,
		maxZoom: 20
	}).addTo(map);
	
	//Appel de l'API d'ipapi.com pour récupérer la latitude et la longitude
	$.get("http://api.ipapi.com/check?access_key=594c70b41fa4633610a7f80f14d28122&format=1").done(function(data){
	   
	//Afficher dans la console la latitude et la longitude récupérées 
	 

	
	  // Centrer la carte sur le point ciblé 
	   map.setView([data.latitude,data.longitude],6);
	   

                
                var ville = "Lyon";
           //faire un appel ajx de la bdd "api.php?action=read&nom="+ville
                    $.ajax({
                        url: "https://nominatim.openstreetmap.org/search", // URL de Nominatim
                        type: 'get', // Requête de type GET
                        data: "q="+ville+"&format=json&addressdetails=1&limit=1&polygon_svg=1" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                    }).done(function (response) {
						
                      // boucle pour parcourir tous les resultats et ajouter un marqueur a tous les resultats voir la liste des lieux candidats
                           lat = response[0]['lat'];
                             lon = response[0]['lon'];
                   console.log(lat);
				   console.log(lon);
				 
		//appelle ajax de api.php?action=write&nom=var1&lat=var2&lon=var3
		
		$.ajax({
		
		url: "api.php", // URL de Nominatim
		type: 'get', // Requête de type GET
		data: "action=write&name="+ville+"&lat="+lat+"&lon="+lon+"" // Données envoyées
	}) 
		
					}) 

		

<?php
	$requete = "SELECT * FROM geoloc";
$stmt = $db->query($requete);
$result=$stmt->fetchall(PDO::FETCH_ASSOC);

foreach ($result as $row){
    echo " var marker = new L.marker([".$row["lat"].",".$row["lon"]."], {draggable: 'true'}); marker.on('dragend', function(event) {var position = marker.getLatLng();marker.setLatLng(position, {draggable: 'true'}).bindPopup(position).update();});map.addLayer(marker);";
}
?>
   var marker = new L.marker(curLocation, {
    draggable: 'true'
  });

  marker.on('dragend', function(event) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    $("#Latitude").val(position.lat);
    $("#Longitude").val(position.lng).keyup();
  });

  $("#Latitude, #Longitude").change(function() {
    var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    map.panTo(position);
  });

  map.addLayer(marker);
//Placer le marqueur sur le point ciblé 
	  /* 
		L.marker([48.859116,2.331839]).addTo(map)
		.bindPopup('<strong><span style="font-size:2em;">Paris</span></strong>')
		.openPopup();

	   L.marker([46.383257,5.868854]).addTo(map)
		.bindPopup('<strong><span style="font-size:2em;">Saint-Claude</span></strong>')
		.openPopup();

		L.marker([50.490204,5.867943]).addTo(map)
		.bindPopup('<strong><span style="font-size:2em;">Spa</span></strong>')
		.openPopup(); */
	
	})
	</SCRIPT>
	</body>