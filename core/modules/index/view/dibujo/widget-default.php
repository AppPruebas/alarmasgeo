<?php
 if(Session::getUID()!=""):
 $sectores = CargosData::getAllSectores(); 
 $cuadrantes = CargosData::getAllCuadrantes(); 
 $unidades = CargosData::getAllUnidades(); 
 $geounidades = CargosData::getAllInfouar();
 $geocuadrantes = CargosData::getAllInfoCUADRANTES();
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
	      <div class="col-md-11 col-xs-8"> 
	       <h4>Mapa Sectorizado de San Juan de Lurigancho </h4> 
	      </div>
	      <div class="col-md-1 col-xs-4">
	       <div class="btn-group pull-right">
		     <a id="new" name="new" href="#" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-default"><i class='glyphicon glyphicon-screenshot'></i>   Puntos</a>
		   </div> 
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
<div class="modal fade"  id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <form class="form-horizontal" method="post" id="addcargo" role="form">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header  ">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	        </button>
	        <div class="row">
	            <div class="col-md-12">
	                <center><h4 id="Title" > Copiar Latitudes y Longitudes </h4></center>
	            </div>
	        </div>
	      </div>
	      <div class="modal-body">
	      	<div class="container-fluid">
	      		<input type="hidden" name="id" id="id" required class="form-control" placeholder="id" >
	      		<div class="row">
    					<div class="col-md-12">
    						<textarea name="textarea" rows="5" id="info" class="form-control"></textarea>
    					</div> 	      			
	      		</div>
            </br>
            <div class="row">
              <div class="col-md-12">
                <textarea name="textarea" rows="1" id="lat" class="form-control"></textarea>
              </div>              
            </div>				   
		    </div>			
	      </div>
	      <div  class="modal-footer">
	        <button type="button" class="btn btn-success"  data-dismiss="modal">Aceptar</button>
	      </div>
	    </div>
	  </div>
  </form>
</div>
<script type="text/javascript">
function initMap() {
  var myLatLng = new google.maps.LatLng(-12.0195, -77.0271);
  var mapOptions = {
    zoom: 14,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.RoadMap
  };
  var map = new google.maps.Map(document.getElementById('map'),mapOptions);
  var triangleCoords = [{ lat : -12.022,lng : -77.02722 },{ lat : -12.0212,lng : -77.02991 },{ lat : -12.01481,lng : -77.0277 },{ lat : -12.01666,lng : -77.02454 },];

	myPolygon = new google.maps.Polygon({
	    paths: triangleCoords,
	    draggable: true, 
	    editable: true,
	    strokeColor: '#F50A98',
	    strokeOpacity: 0.8,
	    strokeWeight: 2,
	    fillColor: '#F50A98',
	    fillOpacity: 0.35
	  });

  myPolygon.setMap(map);
  google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);
  google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);

  var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });
    google.maps.event.addListener(marker, 'dragend', function(a) {
        console.log(a);
        var re = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        document.getElementById('lat').innerHTML = re;
    });

  <?php foreach($sectores  as $user)
    { 
  ?>
 	    var sectoresCoordinates = [ <?php echo $user->puntosGeo; ?> ];

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

          var nombrecua = [ ];
          var puntoscua = [ ];

          <?php foreach($geocuadrantes  as $user)
           { 
          ?>
            nombrecua.push('<?php echo $user->ref2 ?>');
            puntoscua.push(<?php echo $user->limite2 ?>);
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

    for (var n = 0; n < '<?php echo count($geocuadrantes); ?>'; n++)
              {
              var cuaInfo = new google.maps.InfoWindow();
              cuaInfo.setContent('<span style="background-color:#1081E0;border-radius:25px;margin:auto;display:table;color:white;"><b>'+'&nbsp;&nbsp;'+nombrecua[n]+'&nbsp;&nbsp;</b>'+'</span>');
              cuaInfo.setPosition(puntoscua[n]);
              cuaInfo.open(map); 
              }

}

function getPolygonCoords() {
  var len = myPolygon.getPath().getLength();
  var htmlStr = "";  
  for (var i = 0; i < len; i++) {
    var datos = myPolygon.getPath().getAt(i).toUrlValue(5);
    var todos = datos.split(",");
    htmlStr += "{ lat : "+todos[0]+",lng : "+todos[1]+" },";
  }
  document.getElementById('info').innerHTML = htmlStr;
}
</script>
<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgQ6yoXCPKv4tbW6118IrXFidH0YZ4JUs&callback=initMap">
</script>

<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>