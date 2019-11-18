<?php
if(Session::getUID()!=""):
 $users = CargosData::getAll();
 if(count($users)>0){  
?>
<div class="table-responsive">
    <table id="listCargos" class="table table-striped table-hover AllDataTables">
	          <thead>
	            <tr>
	            <th>
	            	Cargo
	            </th>	            
	            <th>Acciones</th>	          
	            </tr>
	          </thead>
	          <tbody id="bodyTable">
               <?php
			     foreach($users  as $user){
			   ?>
				<tr>			
					<td >
						<?php echo $user->nombre; ?>						
					</td>
					
					<td  style="width:160px;">
					<a href="#" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs" onclick="myFunction(<?php echo $user->id;?>,'<?php echo $user->nombre;?>')" >Editar</a> 
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