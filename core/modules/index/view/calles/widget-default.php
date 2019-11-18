<?php
 if(Session::getUID()!=""):
 $sectores = CargosData::getAllSectores(); 
 $cuadrantes = CargosData::getAllCuadrantes(); 
 $unidades = CargosData::getAllUnidades(); 
 $geounidades = CargosData::getAllInfouar();
?>
    

<style>
     #geomap {
          width: 100%;
          height: 650px; 
          }  

</style>
<form>
  <div class="row">
    <div class="col-md-6">
     <div class="form-group input-group">  
      <input type="text" id="search_location" class="form-control" placeholder="Search location">
      <div class="input-group-btn">
          <button class="btn btn-default get_map" type="submit">
              Locate
          </button>
      </div>
    </div>    
  </div>  
  <div class="col-md-6">
    <input type="text" id="search_location" class="form-control search_addr" placeholder="Search location">
  </div>  
</div>
</form>

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
            <div id="geomap" >
                
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
                <textarea name="textarea" rows="1" id="lat" class="form-control coordenadas"></textarea>
              </div>              
            </div>           
        </div>      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success"  data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
  var geocoder;
var map;
var marker;
      function initMap() {
        map = new google.maps.Map(document.getElementById('geomap'), {
          zoom: 14,
          center: { lat : -12.0134568,lng : -77.0030713 },
          });

      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng( -11.994903014727065,-77.02933549067382 );
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: latlng
    });
    google.maps.event.addListener(marker, "dragend", function () {
        var point = marker.getPosition();
        map.panTo(point);
        geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $('.search_addr').val(results[0].formatted_address);
                $('.search_latitude').val(marker.getPosition().lat());
                $('.search_longitude').val(marker.getPosition().lng());
                $('.coordenadas').val(marker.getPosition().lat()+','+marker.getPosition().lng());
            }
        });
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
          

       






      }
      
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
      $(document).ready(function () {
    initMap();
    

    var PostCodeid = '#search_location';
    
    
    
    $('.get_map').click(function (e) {
        var address = $(PostCodeid).val();
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $('.search_addr').val(results[0].formatted_address);
                $('.search_latitude').val(marker.getPosition().lat());
                $('.search_longitude').val(marker.getPosition().lng());
                $('.coordenadas').val(marker.getPosition().lat()+','+marker.getPosition().lng());
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
        e.preventDefault();
    });

    
    google.maps.event.addListener(marker, 'drag', function () {
        geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('.search_addr').val(results[0].formatted_address);
                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                    $('.coordenadas').val(marker.getPosition().lat()+','+marker.getPosition().lng());
                }
            }
        });
    });
});
      
    </script>
    
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2B-IlhmNGsjNEnafcADX3xdTTQI_mcHQ"></script>  
    
<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>
    