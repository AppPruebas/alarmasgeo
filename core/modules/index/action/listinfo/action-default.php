<?php
	if(isset($_GET["id"]) && Session::getUID() != "")
	{
	  $users = CargosData::getAllInfo($_GET["id"]);
	  if(count($users)>0)
	  {
		  echo '<div class="panel panel-primary">
				  <div class="panel-heading">    
				    <div class="row">
				      <div class="col-md-12 col-xs-12"> 
				       <h5>Datos de la red.</h5> 
				      </div>
				    </div>
				  </div>
				  <div class="panel-body">
		    		<div class="row">
		    		   <div id="datos" class="panel-body">
		    			<div class="table-responsive">
	    					<table id="listCargos" class="table table-striped table-hover AllDataTables">
	    					  <thead>
					            <tr>
					            <th>Apellidos y Nombres</th>	            
					            <th>Telefono</th>
					            <th>Direccion</th>
					            <th>Tipo</th>          
					            </tr>
					          </thead>
					          <tbody id="bodyTable">';
					          foreach($users  as $user)
					          {
					          	echo '<tr>';
						          	echo '<td >'.$user->apellidos.' '.$user->nombres.'</td>';
						          	echo '<td >'.$user->telefono.'</td>';
						          	echo '<td >'.$user->direccion.'</td>';
						          	if($user->tipo_vecino == 'VECINO COOPERANTE')
						          	{
						          		echo '<td >V.C</td>';
						          	}
						          	else
						          	{
						          		echo '<td >LIDER U.A.R</td>';
						          	}
						        echo '</tr>';
					          }
			echo		     '</tbody>
	    					</table>
	    			    </div>
	    			   </div
		    		</div>
				</div>';
	    }
	    else
	    {
	    	echo "<p class='alert alert-danger'>* Sin Datos </p>";
	    }
	}
	else
	{
		print "<script>window.location='./';</script>";
	}

?>