<?php
   if(isset($_GET["id"]) && Session::getUID() != "")
   {
	$tipo = UserData::del($_GET["id"]);
   }
   else
   {
		print "<script>window.location='./';</script>";
   }
?>