<?php
session_start();
if(isset($_SESSION['user_idcronoosaccess'])){
	unset($_SESSION['user_idcronoosaccess']);
}

session_destroy();
if(empty($_SESSION)) 
{ 
 header("location: ./");    
 exit(); 
} 
//print "<script>window.location='./';</script>";
?>