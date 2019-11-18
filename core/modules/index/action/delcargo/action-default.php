<?php
	if(isset($_GET["id"]) && Session::getUID() != "")
	{
	  $cargo = CargosData::del($_GET["id"]);
	}
	else
	{
		print "<script>window.location='./';</script>";
	}

?>