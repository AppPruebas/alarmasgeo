<?php
 if(Session::getUID()!=""): 
 $cargos =  CargosData::getAll();
?>

<div class="row">
  <div class="col-md-12">
	<div class="panel panel-primary">
	  <div class="panel-heading">    
	    <div class="row">
	      <div class="col-md-11 col-xs-4"> 
	       <h4>Bandeja de Usuarios </h4> 
	      </div>
	      <div class="col-md-1">
	      <div class="btn-group pull-right">
		     <a id="new" name="new" href="#" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-default"><i class='glyphicon glyphicon-plus'></i>   New</a>
		  </div> 
	      </div>	      
	    </div>	    	    
	  </div>
	  <div class="panel-body">
	    <div class="row">
	      <div id="datos" class="panel-body">	          
	        
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
 <form class="form-horizontal" method="post" id="addusers" role="form">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header  ">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	        </button>
	        <div class="row">
	            <div class="col-md-12">
	                <h4 id="Title"> Registrar Usuarios </h4>
	            </div>
	        </div>
	      </div>	      
	      <div class="modal-body">
	      	<div class="container-fluid">
	      		<input type="hidden" name="id" id="id" required class="form-control" placeholder="id" >
		      	<div class="row">
		      	 	<div class="col-md-4">		      			      			
					    <h5 > Nombres : </h5>					    
					</div>
					<div class="col-md-7">		      			      			
					    <input type="text" name="nombres" required class="form-control" id="nombres" placeholder="nombres" >				    
					</div>
				</div>
				<br>
				<div class="row">
		      	 	<div class="col-md-4">		      			      			
					    <h5 > Apellidos : </h5>					    
					</div>
					<div class="col-md-7">		      			      			
					    <input type="text" name="apellidos" required class="form-control" id="apellidos" placeholder="Apellido" >				    
					</div>
				</div>
				<br>
		      	<div class="row">
		      	 	<div class="col-md-4">		      			      			
					    <h5 > Username : </h5>					    
					</div>
					<div class="col-md-7">		      			      			
					    <input type="text" name="username" required class="form-control" id="username" placeholder="Username" >				    
					</div>
				</div>
				<br>
		      	<div class="row">
		      	 	<div class="col-md-4">		      			      			
					    <h5 > Password : </h5>					    
					</div>
					<div class="col-md-7">		      			      			
					    <input type="text" name="password" required class="form-control" id="password" placeholder="Password" >				    
					</div>
				</div>
				<br>
		      	<div class="row">
		      	 	<div class="col-md-4">		      			      			
					    <h5 > Tipo de Usuario : </h5>					    
					</div>
					<div class="col-md-7">		      			      			
					    <select name="id_tipo" id="id_tipo" class="form-control " required>
		                    <option value="">-- Seleccione --</option>
		                    <?php foreach($cargos as $a):?>
		                    <option value="<?php echo $a->id; ?>"><?php echo $a->nombre; ?></option>
		                    <?php endforeach; ?>               
		                </select>			    
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
$("#datos").load("./?action=listuser");
	function updatetable()
	{
		$("#datos").load("./?action=listuser");
	}
	setInterval("updatetable()",60000);
function myFunction(id,nombres,apellidos,username,pass,cargo) 
{
  var idRow = id;
  document.getElementById("Title").innerHTML = "Editar Usuarios"; 
  document.getElementById("id").value = idRow;
  document.getElementById("username").value = username;
  document.getElementById("password").value = pass;
  document.getElementById("nombres").value = nombres;
  document.getElementById("apellidos").value = apellidos; 
  var element = document.getElementById("id_tipo"); element.value =cargo; 
}
function myFunctionDel(id) 
		{
		  var idRow = id;
		  alertify.confirm('Eliminar Registro', '¿Desea quitar el registro de la bandeja?', 
		  function()
		  { 	
		  	$.ajax({
		            type:"get",
		            url:"./?action=deluser",
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
		  $("#datos").load("./?action=listuser");       
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
	  	$('#Title').text('Registrar Usuarios');
	    $('input[type="text"]').val('');
	    $('input[type="hidden"]').val('');
	    document.getElementById("password").disabled = false;
	  });
	});
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#addusers').submit(function (e) {
                e.preventDefault();
                var datos=$(this).serialize();
                $.ajax({
                    type:"POST",
                    url:"./?action=addusers",
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
	