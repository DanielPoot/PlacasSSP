<?php
	class Conexion 
	{
		private $servidor;
		private $baseDatos;
		private $usuario;
		private $password;
		var $filasModificadas;
		var $filasConsultadas;
		
		public function __construct()
		{
			$this->servidor = "localhost";
			$this->usuario = "root";
			$this->password = "123456";
			$this->baseDatos = "database_vehiculos";
		}
		
		public function __get($name)
		{
			return $this->$name;
		}
		public function __set($name, $value)
		{
			$this->$name = $value;
		}
		
		private $linkId;
		
		/** Conectar con la base de datos */
		public function conectar()
		{
			//Establecer conexion con el servidor
			$this->linkId = @mysql_connect($this->servidor, $this->usuario, $this->password);
			//Asignar la conexion a la base de datos
			if (!mysql_select_db($this->baseDatos)) 
			{
				throw new Exception(mysql_error(), mysql_errno());
			}
		}
		//Cerrar la conexion a la base de datos
		public function cerrar()
		{
			@mysql_close($this->link_id);
		}
		/**
		Ejecutar una consulta en la base de datos para insertar, modificar o eliminar registros
		@return boolean TRUE si la consulta se ejecuto con exito, FALSE en caso contrario.
		**/
		public function consulta($query)
		{
			$result = mysql_query($query, $this->linkId);
			if(!$result)
			{
				throw new Exception(mysql_error(), mysql_errno());
			}
			$this->filasModificadas = mysql_affected_rows($this->linkId);
			return $result;
		}
		
		/**
		* Consultar la base de datos y guardar el resultado en una matriz.
		* @return array Una matriz con los datos devueltos por la consulta.
	 	*/
		public function obtDatos($query) 
		{
			$matriz = array();
			// Realizar una consulta a la base de datos
			$result = mysql_query($query, $this->linkId);
			if (!$result) 
			{
				throw new Exception(mysql_error(), mysql_errno());
			}
			// Recorrer cada registro de la tabla y guardarlo en la matriz
			while ($registro = mysql_fetch_array($result, MYSQL_ASSOC)) 
			{
				$matriz[] = $registro;
			}
			$this->filasConsultadas = mysql_num_rows($result);
			// Liberar los recursos de la consulta
			@mysql_free_result($result);
			// Devolver la matriz
			return $matriz;
		}
	}
?>
