<?php
if(Session::getUID()!=""):
?>

<div class="row">
  <div class="col-md-12">
	<div class="panel panel-primary">
	  <div class="panel-heading">    
	    <div class="row">
	      <div class="col-md-11 col-xs-8"> 
	       <h4>Bandeja de Cargos </h4> 
	      </div>
	      <!--<div class="col-md-4 pull-right"> 
	       <input type="text" name="filtrar" required class="form-control" id="filtrar" placeholder="Filtrar">
	      </div>-->
	      <div class="col-md-1 col-xs-4">
	       <div class="btn-group pull-right">
		     <a id="new" name="new" href="#" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-default"><i class='glyphicon glyphicon-plus'></i>   New</a>
		   </div> 
	      </div>
	    </div>	    	    
	  </div>
	  <div class="panel-body">
	    <div class="row">
	      <div id="datos" class="panel-body">
	        
	        <!--<center>
	        <nav aria-label="...">
			  <ul class="pagination">			  	
			  	<?php 
			  	//if($_GET['pagina'] > $pages ){Core::redir("./index.php?view=cargo&pagina=1");} 		  	 
			  	?>
			    <li class="page-item <?php //echo  $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
			      <a class="page-link" href="index.php?view=cargo&pagina=<?php //echo $_GET['pagina']-1 ?>" tabindex="-1">Anterior</a>
			    </li>
			    <?php //for($i = 0 ; $i < $pages; $i ++) { ?>
			    <li class="page-item <?php //echo  $_GET['pagina'] == $i+1 ? 'active' : '' ?>" >
			    	<a class="page-link" href="index.php?view=cargo&pagina=<?php //echo $i+1; ?>"><?php //echo $i+1; ?></a>
			    </li>
			    <?php// } ?>
			    <li class="page-item <?php //echo  $_GET['pagina'] >= $pages ? 'disabled' : '' ?>">
			      <a class="page-link" href="index.php?view=cargo&pagina=<?php //echo $_GET['pagina']+1 ?>">Siguiente</a>
			    </li>
			  </ul>
			</nav> 
			</center>-->

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
	                <center><h4 id="Title" > Registrar Cargos </h4></center>
	            </div>
	        </div>
	      </div>
	      <div class="modal-body">
	      	<div class="container-fluid">
	      		<input type="hidden" name="id" id="id" required class="form-control" placeholder="id" >
	      		<div class="row">
	      			<div class="col-md-3">	      			      			
						<h5 class="pull-right"> Ingrese Cargo : </h5>
					</div>
					<div class="col-md-8">
						<input type="text" name="name" required class="form-control" id="name" placeholder="Nombre" >
					</div> 	      			
	      		</div>				   
		    </div>			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="cancel()" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success " >Save changes</button>
	      </div>
	    </div>
	  </div>
  </form>
</div>
<script>
$("#datos").load("./?action=listcargos");
	function updatetable()
	{
		$("#datos").load("./?action=listcargos");
	}
	setInterval("updatetable()",60000);
	function myFunction(id,cargo) {
	  var idRow = id;
	  var cargonew = cargo;
	  document.getElementById("Title").innerHTML = "Editar Cargos"; 
	  document.getElementById("id").value = idRow;
	  document.getElementById("name").value = cargonew;
	}
	function myFunctionDel(id) 
		{
		  var idRow = id;
		  alertify.confirm('Eliminar Registro', '¿Desea quitar el registro de la bandeja?', 
		  function()
		  { 	
		  	$.ajax({
		            type:"get",
		            url:"./?action=delcargo",
		            data:"id="+idRow,
		            success:function(data)
		                {	                	
		                    swal({        
									type: 'success',
									title: 'Accion Exitosa',
									showConfirmButton: false,
									timer: 1500
								});
		                    }
		                }); 
		    $("#datos").load("./?action=listcargos");      
		  }
		  , function()
		  { 
		  	    swal({        
					type: 'error',
					title: 'Accion Cancelada',
					showConfirmButton: false,
					timer: 1500
					});
		  })  
		}
</script>
<script >
	$(document).ready(function() {
	  $('#new').click(function() {
	  	$('#Title').text('Registar Cargo');
	    $('input[type="text"]').val('');
	    $('input[type="hidden"]').val('');
	  });
	});
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#addcargo').submit(function (e) {
                e.preventDefault();
                var datos=$(this).serialize();
                $.ajax({
                    type:"POST",
                    url:"./?action=addcargos",
                    data:datos,
                    success:function(data)
                    {
                    	$('#myModal').modal('hide');
                    	updatetable();
                        swal({        
							  type: 'success',
							  title: 'Accion Exitosa',
							  showConfirmButton: false,
							  timer: 1500
						     });
                    }
                });
            } 
            );
        });
</script>
<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>