<?php
	class CargosData 
	{
		public static $tablename = "cargos_sjl";

		public function CargosData()
		{

		}	

		public function add()
		{
			$sql = "insert into cargos_sjl(nombre,estado ) values (\"$this->name\" ,1)";		
			Executor::doit($sql);
		}
		
		public static function del($id)
		{
			$sql = "update ".self::$tablename." set estado = 0 where id = $id";	
			Executor::doit($sql);
		}

		public function update()
		{
			$sql = "update ".self::$tablename." set nombre=\"$this->name\" where id=$this->id";
			Executor::doit($sql);
		}

		public static function getAll()
		{
			$sql = "select * from cargos_sjl where estado = 1";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}		
	    
	    public static function getAllCuadrantes()
		{
			$sql = "select * from cuadrante_sjl where estado = 1 and coordenadas != '' ";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}

		public static function getAllUnidades()
		{
			$sql = "select * from uar_sjl where estado = 1 and coordenadas != '' ";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}
		public static function getAllSectores()
		{
			$sql = "select * from sector_sjl where estado = 1 ";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}
		public static function getAllVecinos()
		{
			$sql = "select
					vecinos_sjl.coordenadas as coor,
					COUNT(*) as total,
					CONCAT('{ lat : ',SUBSTRING(coordenadas,1,LOCATE(\",\",coordenadas) - 1),',lng : ',SUBSTRING(coordenadas,LOCATE(\",\",coordenadas) + 1),' },') as coordenadas1
					FROM
					vecinos_sjl
					WHERE
					estado = 1 and
					tipo_vecino = 'LIDER DE U.A.R'
					GROUP BY vecinos_sjl.coordenadas ";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}
		public static function getAllInfo($id)
		{
			$sql = " select * from vecinos_sjl WHERE coordenadas = \"$id\" and estado = 1";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}

		public static function getAllInfouar()
		{
			$sql = " select etiqueta as ref2 ,CONCAT('{ lat : ',SUBSTRING(punto,1,LOCATE(\",\",punto) - 1),',lng : ',SUBSTRING(punto,LOCATE(\",\",punto) + 1),' },') as limite2 from uar_sjl WHERE punto != '' and estado = 1 ";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}
	    

		public static function getAllInfoCUADRANTES()
		{
			$sql = " select etiqueta as ref2,CONCAT('{ lat : ',SUBSTRING(punto,1,LOCATE(\",\",punto) - 1),',lng : ',SUBSTRING(punto,LOCATE(\",\",punto) + 1),' },') as limite2 from cuadrante_sjl WHERE punto != '' and estado = 1  ";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new CargosData());
		}
	}
?>