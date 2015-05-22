<?php
	include_once "php/otherconexion.php";
        $detalles = new detalles();
        $conn = new Conexion();
        $conn->conectar();
	$idPlaca = $_POST['idplaca'];
	
        if(isset($_POST['idplaca']))
        {
            $sql = "SELECT * FROM vehiculos WHERE id = $idPlaca"; //Se obtiene los id del vehiculo y del dueño del vehiculo
            $result = $conn->obtDatos($sql);
            foreach ($result as $dts)
            {
				$placa = $dts["placa"];
                $idVehiculo = $dts["id"];
                $marca = $dts["marca"];
                $submarca = $dts["modelo"];
            }
            $queryVehiculo = "SELECT * FROM asignaciones WHERE id_vehiculo = $idVehiculo"; //se obtiene el id de la marca y la submarca del vehiculo
            $result2 = $conn->obtDatos($queryVehiculo);
			if($result2 == null){
				$direccion = "";
				$sexo = "";
                $nombre = "";
                $apeP="";
                $apeM="";
				$numCobro="";
				$numLicencia="";
				$foto="";
				$nombreDepto="";
				$area="";
			}else{
            foreach ($result2 as $dts2)
            {
				$idPersona = $dts2["id_persona"];
            }
			$queryPersona = "SELECT * FROM personal WHERE id = $idPersona";//Se obtiene los datos del dueño
            $result4 = $conn->obtDatos($queryPersona);
			
            foreach($result4 as $dts4)
            {
                $direccion = $dts4["direccion"];
				$sexo = $dts4["sexo"];
                $nombre = $dts4["nombre"] . $dts4["segundo_nombre"];
                $apeP=$dts4["ap_paterno"];
                $apeM=$dts4["ap_materno"];
				$numCobro=$dts4["no_cobro"];
				$numLicencia=$dts4["no_licencia"];
				$foto=$dts4["foto"];
				$idDepto=$dts4["id_departamento"];
            }
            $queryDireccion = "SELECT * FROM departamentos WHERE id = $idDepto";//se obtiene la direccion del dueño del vehiculo
            $result5 = $conn->obtDatos($queryDireccion);
            foreach($result5 as $dts5)
            {
                $nombreDepto = $dts5["Nombre"];
                $area = $dts5["Area"];
            }
			
			}
			
            $conn->cerrar();
        
            
			$detalles->nombre = $nombre;
            $detalles->placaProp = $placa;
            $detalles->marcaProp = $marca;
			$detalles->sexo = $sexo;
			$detalles->numCobro = $numCobro;
			$detalles->numLicencia = $numLicencia;
            $detalles->submarcaProp = $submarca;
			$detalles->foto = $foto;
			$detalles->nombreDepto = $nombreDepto;
            $detalles->area = $area;
            $detalles->apePProp = $apeP;
            $detalles->apeMProp = $apeM;
            $detalles->direccion= $direccion;
            echo json_encode($detalles);
        }
        else
        {
            echo "";
        }
        class detalles
        {
			public $nombre;
            public $placaProp;
            public $marcaProp;
			public $sexo;
			public $numCobro;
			public $numLicencia;
            public $submarcaProp;
			public $foto;
			public $nombreDepto;
			public $area;
            public $apePProp;
            public $apeMProp;
            public $direccion;
            public function detallesProp()
            {
				$this->nombre = "";
                $this->placaProp = "";
                $this->marcaProp = "";
				$this->sexo = "";
				$this->numCobro = "";
				$this->numLicencia = "";
                $this->submarcaProp="";
				$this->foto = "";
				$this->nombreDepto = "";
                $this->area="";
                $this->apePProp="";
                $this->apeMProp="";
                $this->direccion="";
            }
            
        }
?>