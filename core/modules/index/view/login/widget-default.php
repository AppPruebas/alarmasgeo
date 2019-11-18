<?php
if(Session::getUID()!="")
{
		print "<script>window.location='./?view=home';</script>";
}
else 
{
    define('CRONOOSACCESS_KEY', '6LelXcMUAAAAAGIDvouW-nCBVgegq-1aSu0WclFN');
?>
<head>
    <title>Cronoos</title>
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/iconcronos.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/fontsindex.css">
    <link rel="stylesheet" href="css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>   
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style type="text/css">
      #gwd-reCAPTCHA_2, #rc-imageselect {
                            -webkit-transform: scale(0.84);
                            -moz-transform:    scale(0.84);
                            -ms-transform:     scale(0.84);
                            -o-transform:      scale(0.84);
                            transform:         scale(0.84);

                            -webkit-transform-origin: 0 0;
                            -moz-transform-origin: 0 0;
                            -ms-transform-origin: 0 0;
                            -o-transform-origin: 0 0;
                            transform-origin: 0 0;
        }
    </style>
</head>
<body>

  <br>
  <br>
  <br>
  <br>
  <br>
  <CENTER><div class="rd-navbar-element"><a class="button button-sm button-primary-outline button-winona" href="#" data-toggle="modal" data-target="#myModal">Iniciar Sessión</a>
  </div><div><h1>BIENVENIDO </h1></div><div><h3>EL EXITO ESTA EN TUS PENSAMIENTOS </h3></div></CENTER>
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-hidden="true">
    <form class="form-horizontal" accept-charset="UTF-8" role="form" method="post" action="./?action=proccesslogin">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header ">
          <h4>Inicio de Session</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
           <div class="container-fluid">
            <div class="col-md-12">
              <input type="text" name="user" required class="form-control" id="user" placeholder="Usuario" >
            </div>
            <br>
            <div class="col-md-12">
              <input type="password" name="password" required class="form-control" id="password" placeholder="Contraseña" >
            </div> 
            <br>
              <div id="gwd-reCAPTCHA_2" class="g-recaptcha" data-sitekey="<?php echo CRONOOSACCESS_KEY; ?>"></div>
           </div>
        </div>        
        <div class="modal-footer ">          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>   
          <button type="submit" class="btn button-primary-outline " >Ingresar</button>
          
        </div>        
      </div>   
    </div>
    </form>
  </div>
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>
<?php } ?>