<?php
if(Session::getUID()!=""):
 $users = UserData::getAll(); 
 if(count($users)>0){
?>
<div class="table-responsive"> 
	<table class="table table-striped table-hover AllDataTables">
	          <thead>
	            <tr>
	            <th>Nombre Usuario</th>
	            <th>Username</th>
	            <th>Contraseña</th>
	            <th>Cargo</th>    
	            <th>Acciones</th>      
	            </tr>
	          </thead>
	          <tbody id="bodyTable">
               <?php
			     foreach($users as $user){
			   ?>
				<tr>				
					<td >
						<?php echo $user->nombres.' '.$user->apellidos;?>
					</td>
					<td >
						<?php echo $user->usuario;?>
					</td>
					<td >
						<?php echo $user->password;?>
					</td>
					<td >
						<?php echo $user->cargo;?>
					</td>
					<td style="width:200px;">						 
						<a href="#" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs" onclick="myFunction(
						<?php echo $user->id;?>,
						'<?php echo $user->nombres;?>',
						'<?php echo $user->apellidos;?>',
						'<?php echo $user->usuario;?>',
						'<?php echo $user->password;?>',
						<?php echo $user->idcargo;?>							
						)" >Editar
						</a> 
						<a onclick="myFunctionDel(<?php echo $user->id;?>)"  class="btn btn-danger btn-xs">Deshabilitar</a>
					</td>
				</tr>
				<?php
			       }
			      }
			      else{
			           echo "<p class='alert alert-danger'>* Sin Registros </p>";
		              }
		        ?>
	          </tbody>
	        </table> 
</div>
<script src="js/cronos.js"> </script>
<?php else: print "<script>window.location='./';</script>"?>
<?php endif; ?>