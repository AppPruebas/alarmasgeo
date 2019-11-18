<?php
	class UserData 
	{
		public static $tablename = "usuarios_sjl";

		public function UserData()
		{
			$this->name = "";
			$this->lastname = "";
			$this->username = "";
			$this->password = "";
			$this->is_active = "0";
			$this->created_at = "NOW()";
		}

		public function add()
		{
			$sql = "insert into usuarios_sjl (nombres,apellidos,usuario,password,idcargo,estado) values (\"$this->nombres\",\"$this->apellidos\",\"$this->username\",\"$this->pass\",$this->cargo,1) ";
			Executor::doit($sql);
		}

		public static function del($id)
		{
			$sql = "update usuarios_sjl set estado = 0 where id=$id;";	
			Executor::doit($sql);
		}

		public function update()
		{
			$sql = "update usuarios_sjl set nombres = \"$this->nombres\",apellidos = \"$this->apellidos\",usuario = \"$this->username\",password = \"$this->pass\",idcargo = $this->cargo where id = $this->id ";
			Executor::doit($sql);
		}

		public static function getById($id)
		{
			$sql = "select id,
					CONCAT(nombres,' ',apellidos) as name FROM usuarios_sjl WHERE estado = 1 AND id=$id";
			$query = Executor::doit($sql);
			return Model::one($query[0],new UserData());
		}

		

		public static function getAll()
		{
			$sql = " select
						usuarios_sjl.id,
						usuarios_sjl.usuario,
						usuarios_sjl.`password`,
						usuarios_sjl.nombres,
						usuarios_sjl.apellidos,
						usuarios_sjl.idcargo,
						usuarios_sjl.estado,
						cargos_sjl.nombre as cargo
						FROM
						usuarios_sjl ,
						cargos_sjl
						WHERE
						cargos_sjl.id = usuarios_sjl.idcargo AND
						usuarios_sjl.estado = 1";			
			$query = Executor::doit($sql);
			return Model::many($query[0],new UserData());
		}
	}

?>