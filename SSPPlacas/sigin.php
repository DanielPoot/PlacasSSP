<?php

session_start(); //session_start() crea una sesión para ser usada mediante una petición GET o POST, o pasado por una cookie 

/*Función verificar_login() --> Vamos a crear una función llamada verificar_login, esta se encargara de hacer una consulta a la base de datos para saber si el usuario ingresado es correcto o no.*/

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "usuarios_vehicular";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['user']) && isset($_POST['contrasena'])){
$user=$_POST['user'];
$contrasena=$_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$user' and contrasena = '$contrasena'";

$rec = $conn->query($sql);
$count = 0;
if ($rec->num_rows > 0) {
    // output data of each row
    while($row = $rec->fetch_assoc()) {
        $count++;
		$result=$row;
    }
} else {
    echo "0 results";
}
$conn->close();   
        if($count == 1)

        {	
			$_SESSION['userid']=$result['id'];
			echo 'true';

        }
        else
        {
			echo 'false';

        }
}else{
	echo 'sin datos';
}

?>