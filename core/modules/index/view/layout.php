<?php 
ob_start("compacts"); ?>
<!DOCTYPE html>
<?php if(Session::getUID()!=""){?>
<html lang="en">
  <head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/iconcronos.ico" type="image/x-icon">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Expires" content="0" /> 
    <meta http-equiv="Pragma" content="no-cache" />
    
    <title> Cronoos </title>

    <script src="js/jquery-1.12.3.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="res/bootstrap3/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link  href="css/bootstrap-timepicker.min.css" rel="stylesheet">
    
    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">     
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">  


    <link href="css/bootstrap-clockpicker.min.css" rel="stylesheet"> 
    <link href="css/jquery-clockpicker.min.css" rel="stylesheet"> 

    <script src="js/bootstrap-clockpicker.min.js"></script>
    <script src="js/jquery-clockpicker.min.js"></script>

    <link href="css/jquery.dateselect.css" rel="stylesheet"> 
    <script src="js/jquery.dateselect.min.js"></script>

    <script type="text/javascript" src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css" type="text/css">

    <script src="js/alertify.min.js"></script>
    <link  href="css/alertify.min.css" rel="stylesheet"> 
    <link  href="css/alertifydefault.min.css" rel="stylesheet"> 

    
    <script src="js/bootstrap-select.min.js"></script>
    <link  href="css/bootstrap-select.min.css" rel="stylesheet"> 
    <script src="js/bootstrap-timepicker.js"></script>
    <script src="js/bootstrap-timepicker.min.js"></script>
    
    <link  href="css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="js/bootstrap-toggle.min.js"></script>

    <script src="js/jspdf.debug.js"></script> 
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>

    <script src="res/bootstrap3/js/bootstrap.min.js"></script>



  </head>

  <body class="bg-dark"> 
     
    <div id="wrapper">
      <!-- Sidebar -->
  
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle " data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>         
          <a class="navbar-brand" href="./">CRONOOS
            <sup><small><span class="label label-info">IBSO</span></small></sup> 
          </a>
        </div> 
        </div>                   
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <?php 
          $u=null;
          if(Session::getUID()!=""):
          $u = UserData::getById(Session::getUID());
        ?>      

          <ul class="nav navbar-nav">          
            <li>
              <a >
                
              </a>
            </li> 
          </ul> 
       
          <ul class="nav navbar-nav side-nav">   

            <li >
              <a href="./?view=home" style="background-color: #33B3FF;color: #FFFFFF" >
                <i class="fa fa-home "></i>&nbsp;&nbsp;&nbsp;Inicio
              </a>
            </li> 
            <li >         
              <a href="./?view=users" >
                <i class="fa fa-male"></i>&nbsp;&nbsp;&nbsp; Usuarios
              </a>
            </li>
            <li >         
              <a href="./?view=cargo" >
                <i class="fa fa-list-alt"></i>&nbsp;&nbsp;&nbsp; Cargo
              </a>
            </li>
            <li >         
              <a href="./?view=Sectores" >
                <i class="glyphicon glyphicon-globe"></i>&nbsp;&nbsp;&nbsp; Geo Referencias
              </a>
            </li>
            <li >         
              <a href="./?view=dibujo" >
                <i class="fa fa-crosshairs"></i>&nbsp;&nbsp;&nbsp; Mapear
              </a>
            </li>
            <li >         
              <a href="./?view=calles" >
                <i class="glyphicon glyphicon-map-marker"></i>&nbsp;&nbsp;&nbsp; Direcciones
              </a>
            </li>
          </ul>
        <?php endif;?>

        <?php if(Session::getUID()!=""):?>
        <?php 
        $u=null;
        if(Session::getUID()!="")
        {
          $u = UserData::getById(Session::getUID());
          $user = $u->name;
          if($user=="")
          {
             print "<script>window.location='logout.php';</script>";
          }
        }?>
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $user; ?> 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="./?view=configuration">Configuracion</a></li>
                  <li><a href="logout.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        <?php else:?>
        <?php endif; ?>
        </div><!-- /.navbar-collapse -->
      </nav>
      <?php if(Session::getUID()!=""){echo '<div id="page-wrapper">';} else { echo '</div>';} ?>    
         <?php 
        // puedo cargar otras funciones iniciales
        // dentro de la funcion donde cargo la vista actual
        // como por ejemplo cargar el corte actual
        View::load("login");
        ?>
      <?php if(Session::getUID()!=""){echo '</div></div>';} ?>
    <!-- /#wrapper -->
      

    <!-- JavaScript -->
<!-- JavaScript -->

<script>
function cancel()
{
  swal({        
        type: 'error',
        title: 'Accion Cancelada',
        showConfirmButton: false,
        timer: 1500
        });
}
</script>
<script type="text/javascript">
  function validarLetras(e,solicitar){
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8) return true;
  patron =/[\D\s]/;
  te = String.fromCharCode(tecla);
  if (!patron.test(te)) return false;
  txt = solicitar.value;
  if(txt.length==0 && te==' ') return false;
  if (txt.length==0 || txt.substr(txt.length-1,1)==' ') {
    solicitar.value = txt+te.toUpperCase();
    return false;
  } 
}
</script>
<script>
$(document).ready(function(){
  $("#filtrar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#bodyTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function () {
        $('.AllDataTables').DataTable({
          language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar&nbsp;  _MENU_  &nbsp;Registros",
            "sZeroRecords":    "No se encontraron resultados.",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros.",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros.",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar : ",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
          }
        });
    } );
  </script>
  <script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false;
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>
<script type="text/javascript">
function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode;
  return (key >= 48 && key <= 57)
}
</script>



  </body>


</html>
<?php } else { View::load("login"); }?>
<?php ob_end_flush();
function compacts($buffer) {
 
    $search = array(
        '/\>[^\S ]+/s',     // elimina espacios en blanco después de las etiquetas, excepto el espacio
        '/[^\S ]+\</s',     // elimina en blanco antes de las etiquetas, excepto el espacio
        '/(\s)+/s',         // Acortar múltiples secuencias de espacios en blanco.
        '/<!--(.|\s)*?-->/' // Borrar comentarios html
    );
 
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
 
    $buffer = preg_replace($search, $replace, $buffer);
 
    return $buffer;
   }?>