<?php
	include_once "php/conexion.php";
    $detalles = new detalles();
    $conn = new Conexion();
    $conn->conectar();
	$idplaca = $_POST['idplaca'];
	$placa = $_POST['placa'];
    if(isset($_POST['idplaca']) && isset($_POST['placa']))
    {
    	$sql = "SELECT * FROM t_veh_placa WHERE ID_PLACA = $idplaca"; //Se obtiene los id del vehiculo y del dueño del vehiculo
        $result = $conn->obtDatos($sql);
        foreach ($result as $dts)
        {
        	$idVehiculo = $dts["ID_VEHICULO"];
            $idPersona = $dts["ID_PERSONA"];
        }
        $queryVehiculo = "SELECT * FROM t_vehiculo WHERE ID_VEH_CONSECUTIVO = $idVehiculo"; //se obtiene el id de la marca y la submarca del vehiculo
        $result2 = $conn->obtDatos($queryVehiculo);
        foreach ($result2 as $dts2)
        {
            $idMarca = $dts2["MARCA"];
            $submarca = $dts2["SUBMARCA"];
        }
        $queryMarca = "SELECT * FROM c_marca_vehiculos WHERE ID_MAR_VEH_CONSECUTIVO = $idMarca";//se obtiene el nombre de la marca del vehiculo
        $result3 = $conn->obtDatos($queryMarca);
        foreach($result3 as $dts3)
        {
            $marca = $dts3["DESCRIP_MAR_VEHICULO"];
        }
        $queryPersona = "SELECT * FROM t_personas WHERE ID_PER_CONSECUTIVO = $idPersona";//Se obtiene los datos del dueño
        $result4 = $conn->obtDatos($queryPersona);
        foreach($result4 as $dts4)
        {
            $idDomicilio = $dts4["ID_DOMICILIO"];
            $nombre = $dts4["NOMBRE_PER"];
            $apeP=$dts4["APE_PATERNO_PER"];
        	$apeM=$dts4["APE_MATERNO_PER"];
        }
        $queryDireccion = "SELECT * FROM t_domicilio WHERE ID_DOMICILIO = $idDomicilio";//se obtiene la direccion del dueño del vehiculo
        $result5 = $conn->obtDatos($queryDireccion);
        foreach($result5 as $dts5)
        {
        	$idEstado = $dts5["ESTADO_DOM"];
            $municipio = $dts5["MUNICIPIO_DOM"];
            $calle = $dts5["CALLE_DOM"];
            $numero = $dts5["NO_EXT"];
            $cruzamientos = $dts5["CRUZAMIENTO_DOM"];
            $colonia = $dts5["COLONIA_DOM"];
            $codigoPostal = $dts5["CP_DOM"];
        }
        $queryEstado = "SELECT DESCRIPCION_EDO FROM c_estado WHERE ID_EDO_CONSECUTIVO = $idEstado";//Se obtiene el nombre del estado al que pertenece.
        $result6 = $conn->obtDatos($queryEstado);
        foreach ($result6 as $dts6)
        {
            $estado = $dts6["DESCRIPCION_EDO"];
        }
        $conn->cerrar();
        $detalles->placaProp = $placa;
        $detalles->marcaProp = $marca;
        $detalles->submarcaProp = $submarca;
        $detalles->nombreProp = $nombre;
        $detalles->apePProp = $apeP;
        $detalles->apeMProp = $apeM;
        $detalles->calleProp = $calle;
        $detalles->numeroProp = $numero;
        $detalles->cruzamientoProp = $cruzamientos;
        $detalles->coloniaProp = $colonia;
        $detalles->codPostalProp = $codigoPostal;
        $detalles->estadoProp = $estado;
        echo json_encode($detalles);
	}
    else
    {
        echo "Sin resultados";
    }
    class detalles
    {
        public $placaProp;
        public $marcaProp;
        public $submarcaProp;
        public $nombreProp;
        public $apePProp;
        public $apeMProp;
        public $calleProp;
        public $numeroProp;
        public $cruzamientoProp;
        public $coloniaProp;
        public $codPostalProp;
        public $estadoProp;
        public function detallesProp()
      	{
         	$this->placaProp = "";
            $this->marcaProp = "";
            $this->submarcaProp="";
            $this->nombreProp="";
            $this->apePProp="";
            $this->apeMProp="";
            $this->calleProp="";
            $this->numeroProp="";
            $this->cruzamientoProp="";
            $this->coloniaProp="";
            $this->codPostalProp="";
            $this->estadoProp="";
         }
            
    }
?>