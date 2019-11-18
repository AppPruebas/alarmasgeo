<?php
 if(Session::getUID()!=""):
 $sectores = CargosData::getAllSectores(); 
 $cuadrantes = CargosData::getAllCuadrantes(); 
 $unidades = CargosData::getAllUnidades(); 
 $vecinos = CargosData::getAllVecinos(); 
 $geounidades = CargosData::getAllInfouar();
?>
<style>
     #map {
          width: 100%;
          height: 650px; 
          }  

</style>

<div class="row">
  <div class="col-md-12">
	<div class="panel panel-primary">
	  <div class="panel-heading">    
	    <div class="row">
	      <div class="col-md-12 col-xs-12"> 
	       <h4>Mapa Sectorizado de San Juan de Lurigancho </h4> 
	      </div>	      
	    </div>	    	    
	  </div>
	  <div class="panel-body">
	    <div class="row">
	      <div class="panel-body">	          
	        <div id="map" >
	        	
	        </div>
	      </div>	      	       
	    </div>
	  </div>	  
	  <div class="panel-footer">
	  	  <p class="text-center">Ibso Technology <?php echo date("Y");?> &#169; Derechos Reservados</p>
	  </div>
	</div>
  </div>
</div>

<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: -11.9579121,lng: -76.9990685},
          });



        <?php foreach($sectores  as $user)
        { 
        ?>
 	        var sectoresCoordinates = 
              [
                  <?php echo $user->puntosGeo; ?>
              ];

            var sectoresPath = new google.maps.Polygon
              ({
                  path: sectoresCoordinates,
                  geodesic: true,
                  strokeColor: '#186A3B',
                  strokeOpacity: 0.8,
                  strokeWeight: 4,
                  fillColor: '#186A3B',
                  fillOpacity: 0.09           
              });
              sectoresPath.setMap(map);

         <?php 
     	 } 
         ?>

      
        
        <?php foreach($cuadrantes  as $user)
        { 
        ?>
 	        var cuadrantesCoordinates = 
              [
                  <?php echo $user->coordenadas; ?>
              ];

            var cuadrantesPath = new google.maps.Polygon
              ({
                  path: cuadrantesCoordinates,
                  geodesic: true,
                  strokeColor: '#1081E0',
                  strokeOpacity: 0.5,
                  strokeWeight: 3,
                  fillColor: '#1081E0',
                  fillOpacity: 0.06          
              });
              cuadrantesPath.setMap(map);

         <?php 
     	 } 
         ?>
        
        <?php foreach($unidades  as $user)
        { 
        ?>
 	        var unidadesCoordinates = 
              [
                  <?php echo $user->coordenadas; ?>
              ];

            var unidadesPath = new google.maps.Polygon
              ({
                  path: unidadesCoordinates,
                  geodesic: true,
                  strokeColor: '#C0392B',
                  strokeOpacity: 0.5,
                  strokeWeight: 2,
                  fillColor: '#C0392B',
                  fillOpacity: 0.06           
              });
              unidadesPath.setMap(map);

         <?php 
     	 } 
         ?>   

          var nombreuar = [ ];
          var puntosuar = [ ];

          <?php foreach($geounidades  as $user)
           { 
          ?>
            nombreuar.push('<?php echo $user->ref2 ?>');
            puntosuar.push(<?php echo $user->limite2 ?>);
          <?php
           }
          ?>

          var nombre = [ ];
         var puntos = [ ];
          <?php foreach($sectores  as $user)
           { 
          ?>
            nombre.push('<?php echo $user->nombre ?>');
            puntos.push(<?php echo $user->puntodescripcion ?>);
          <?php
           }
          ?>

            var coorden = [[-11.97186,-77.01443],[-11.93391,-76.99186],[-11.94709,-76.97014],[-11.9544,-76.9934],[-11.97514,-76.97392 ],[-12.00192,-76.99847],[-12.02039,-77.01332],[-12.01779,-76.97761 ]];


        	for (var i = 0; i < 8; i++)
              {
              var sectorInfo = new google.maps.InfoWindow();
              sectorInfo.setContent('<span class="badge ">'+nombre[i]+'</span>');
              sectorInfo.setPosition(puntos[i]);
              sectorInfo.open(map); 
              }

          for (var j = 0; j < '<?php echo count($geounidades); ?>'; j++)
              {
              var uarInfo = new google.maps.InfoWindow();
              uarInfo.setContent('<span style="background-color:#b9b9b9;border-radius:25px;margin:auto;display:table;color:white;"><b>'+'&nbsp;&nbsp;'+nombreuar[j]+'&nbsp;&nbsp;</b>'+'</span>');
              uarInfo.setPosition(puntosuar[j]);
              uarInfo.open(map);  
              }

        var image = {
          url: 'images/blue.png',
          size: new google.maps.Size(52, 52),       
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(8, 8)
          };

          var labels = [];
          <?php foreach($vecinos  as $user)
           { 
          ?>
            labels.push('<?php echo $user->total; ?>');
          <?php  
           }
          ?> 

         var id = [ ];
          <?php foreach($vecinos  as $user)
           { 
          ?>
            id.push('<?php echo $user->coor ?>');
          <?php
           }
          ?>        
          
        var coor;
         var infowindow = new google.maps.InfoWindow();

        var markers = locations.map(function(location, i) {          
          var marker = new google.maps.Marker({
                position: location,
                label: {text: labels[i],color: "#000000",fontSize: "12px",fontWeight: "bold"},
                animation: google.maps.Animation.DROP,
                icon: image,
              });
          google.maps.event.addListener(marker, 'click', function() {
                 coor = i;                 
                 infowindow.close();
                 load_content(marker, id[coor]);
              });
            function load_content(marker, id){
            $.ajax({
                type:"get",
                url: './?action=listinfo',
                data:"id="+id,
                success: function(data){
                  infowindow.setContent(data);
                  infowindow.open(map, marker);
                }
              });
            }
              
              return marker;
        });



        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}); 
        google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {

        });

        



      }
      var locations = [
          <?php foreach($vecinos  as $user)
           { 
            echo $user->coordenadas1;
           }
          ?>        
      ];
      function createInfoSector(latLng,zoom,i) 
      {  
      	if(i == 0)
      	{
      		return ['Santa Elizabeth',].join('<br>');
      	}
        if(i == 1)
      	{
      		return ['10 de Octubre',].join('<br>');
      	}
      	if(i == 2)
      	{
      		return ['Mariscal Caceres',].join('<br>');
      	}
      	if(i == 3)
      	{
      		return ['Bayovar',].join('<br>');
      	}
      	if(i == 4)
      	{
      		return ['Canto Rey',].join('<br>');
      	}
      	if(i == 5)
      	{
      		return ['La Huayrona',].join('<br>');
      	}
      	if(i == 6)
      	{
      		return ['Caja de Agua',].join('<br>');
      	}
      	if(i == 7)
      	{
      		return ['Zarate',].join('<br>');
      	}
      }
      function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
    </script>
    <script src="js/markerclusterer.js">
    </script>
    <script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgQ6yoXCPKv4tbW6118IrXFidH0YZ4JUs&callback=initMap">
</script>
<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>
	