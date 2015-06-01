<?php
	include_once "php/conexion.php";
	session_start(); 
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "database_vehiculos";
	ini_set('date.timezone','America/Mexico_City'); 
	$fecha = date("Y/m/d"); 
	$hora = date("H:i");
	$ip = $_POST["ip"];
	if(isset($_POST['movil']))//Verifica si existe la variable movil para saber si recupera el imei.
	{
		$movil = $_POST['movil'];
		$imei = $_POST['imei'];
	}
	else
	{
		$movil = 'false';
	}
	
	//Bloque para determinar si la peticion viene desde una PC, tablet o movil.
	$tablet_browser = 0;
	$mobile_browser = 0;
	$body_class = 'desktop';
	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
		$body_class = "tablet";
	} 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
		$body_class = "mobile";
	}	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
		$body_class = "mobile";
	}	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');	 
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
		$mobile_browser++;
		//Check for tablets on opera mini alternative headers
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		  $tablet_browser++;
		}	}
	if ($tablet_browser > 0) {
	// Si es tablet has lo que necesites
	   $device = 'tablet';
	   $devicename = $_POST["devicename"];
	}
	else if ($mobile_browser > 0) {
	// Si es dispositivo mobil has lo que necesites
	   $device = 'movil';
	   $devicename = $_POST["devicename"];
	}
	else {
	// Si es ordenador de escritorio has lo que necesites
	   $device = 'computadora';
	   $devicename = $_POST["devicename"];
	} 
	//Fin del bloque que deternia tipo de dispositivo.

	//Seccion del login------------------------------
	//Se crea la conexion a la base de datos.
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	//Seccion que realiza la consulta para determinar si da acceso a un usuario.
	if(isset($_POST['user']) && isset($_POST['contrasena'])){
		$user=$_POST['user'];
		$contrasena=$_POST['contrasena'];
		if(isset($_POST['imei']))
		{
			if($user == "admin.root" && $contrasena=="admin")
			{
				$sql = "SELECT * FROM t_usuarios WHERE nombre_usuario = '$user' and contrasena = '$contrasena'";
			}else
			{
				$sql = "SELECT * FROM t_usuarios WHERE nombre_usuario = '$user' and contrasena = '$contrasena' and dispositivo = '$imei'";
			}
		}
		else
		{
			$sql = "SELECT * FROM t_usuarios WHERE nombre_usuario = '$user' and contrasena = '$contrasena'";
		}
		
		$rec = $conn->query($sql);
		$count = 0;
		if ($rec->num_rows > 0) {
			// output data of each row
			while($row = $rec->fetch_assoc()) {
				$count++;
				$result=$row;
				$nombre = $result["nombres"];
			}
		} else {
			echo "0 results";
		}
		$conn->close();   
				if($count == 1)
				{	
					$_SESSION['userid']=$result['id'];
					$resp = 'true';
					echo $resp;
					if($resp == 'true')//Si existe el usuario ingresado, se almacena en un log, los datos de acceso al sistema.
					{
						$conn2 = new Conexion();
						$conn2->conectar();		
						if($device == "movil")
						{
							$query = "INSERT INTO t_log_accesos (usuario, nombre, fecha_acceso, hora_acceso, dir_ip, imei, dispositivo) VALUES ('$user', '$nombre', '$fecha', '$hora', '$ip', '$devicename', '$device');";
						}
						else if($device == "tablet")
						{
							$query = "INSERT INTO t_log_accesos (usuario, nombre, fecha_acceso, hora_acceso, dir_ip, imei, dispositivo) VALUES ('$user', '$nombre', '$fecha', '$hora', '$ip', '$devicename', '$device');";
						}
						else if($movil == 'true')
						{
							$query = "INSERT INTO t_log_accesos (usuario, nombre, fecha_acceso, hora_acceso, dir_ip, imei, dispositivo) VALUES ('$user', '$nombre', '$fecha', '$hora', '$ip', '$imei', 'movil');";
						}
						else
						{
							$query = "INSERT INTO t_log_accesos (usuario, nombre, fecha_acceso, hora_acceso, dir_ip, imei, dispositivo) VALUES ('$user', '$nombre', '$fecha', '$hora', '$ip', '$devicename', '$device');";
						}
						$result = $conn2->consulta($query);
						$conn2->cerrar();
					}				
				}
				else
				{
					echo 'false';
				}
	}
	else{
		echo 'sin datos';
	}
?>