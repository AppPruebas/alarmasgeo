<?php


class Session{
	public static function setUID($uid){
		$_SESSION['user_idcronoosaccess'] = $uid;
	}

	public static function unsetUID(){
		if(isset($_SESSION['user_idcronoosaccess']))
			unset($_SESSION['user_idcronoosaccess']);
	}

	public static function issetUID(){
		if(isset($_SESSION['user_idcronoosaccess']))
			return true;
		else return false;
	}

	public static function getUID(){
		if(isset($_SESSION['user_idcronoosaccess']))
			return $_SESSION['user_idcronoosaccess'];
		else return false;
	}

}

?>