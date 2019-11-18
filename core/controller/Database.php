<?php
class Database {
    public static $db;
	public static $con;
	function Database(){		
		$this->user="u5bb7vqqswse2tdr";$this->pass="8Y7dPD9PBYiHOGhk8ysb";$this->host="bpwmzbt2jcl1h45oiun5-mysql.services.clever-cloud.com";$this->ddbb="bpwmzbt2jcl1h45oiun5";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
