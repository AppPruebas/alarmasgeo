<?php
	if(count($_POST)>0 && Session::getUID() != "")
	{
		$user = new UserData();	
		$user->nombres = $_POST["nombres"];
	    $user->apellidos = $_POST["apellidos"];
	    $user->username = $_POST["username"];
	    $user->pass = $_POST["password"];
	    $user->cargo = $_POST["id_tipo"];
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