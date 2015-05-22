<?php
session_start();	


//session_start() crea una sesión para ser usada mediante una petición GET o POST, o pasado por una cookie 

/*Función verificar_login() --> Vamos a crear una función llamada verificar_login, esta se encargara de hacer una consulta a la base de datos para saber si el usuario ingresado es correcto o no.*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ssp_vehicular";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['idplaca'])){
$idpl=$_POST['idplaca'];

$sql = "SELECT * FROM vehiculos";



$rec = $conn->query($sql);
$count = 0;

foreach ($rec as $dts) {
if(strcmp($dts['placa'], $idpl) == 0){
$found=$dts;
$count=1;
}
}
$conn->close();   
        if($count == 1)
        {	
			echo "<div class='row'>";
                    $placa = $found["placa"];
					$marca = $found["marca"];
					$modelo = $found["modelo"];
                    $idPlaca = $found["id"];
                    //echo $placa;

                    echo "<div class='col s6 m6 modal-trigger' style='cursor: pointer;' onclick='show(this,1)' href='#modal1'>
						<div class='card amber accent-4'>
						  <div class='card-content white-text'> <span class='card-title'><h5 id=1>$placa</h5></span>
						  <div class='col s12 m12' style='display: none;'>$idPlaca</div>
                				  <div id='idplaca' class='col s12 m12'>$marca</div>	
                                  <div id='placa' class='col s12 m12'>$modelo <i class='right medium mdi-maps-directions-car'></i></div>
						  </div>
						  <div class='card-action'> <a c' >Detalles</a> </div>
						</div>
					  </div>";
                
                echo "</div>";

        }
        else
        {
			echo 'false';

        }
}else{
	echo 'sin datos';
}

?>