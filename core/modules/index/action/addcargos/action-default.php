<?php
	if(count($_POST)>0 && Session::getUID() != "")
	{
		$user = new CargosData();	
	    $user->name = $_POST["name"];
		if($_POST["id"] == '')
		{
	        $user->add();
		}
		else 
		{	   	
			$user->id = $_POST["id"];
			$user->update();
		}
	}
	else 
	{
		print "<script>window.location='./';</script>";
	}
?>