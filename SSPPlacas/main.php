<?php
	session_start();
	if(!isset($_SESSION['userid'])){
		header("location:index.php");
	}
	else{
		//header("location:admin.php");
		echo '<script>href.location="main.php"</script>';
	}
include_once "php/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<title>SSP Placas</title>

<!-- CSS  -->
<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<style>
#map-canvas {
	height: 30%;
	margin: 0px;
	padding: 0px;
}
</style>
</head>
<body>
<nav class="grey darken-4" role="navigation">
  <div class="nav-wrapper container"><a id="logo-container" href="main.php" class="brand-logo center"><img class="responsive-img" src="images/ssp.png"></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="logout.php">Salir</a></li>
    </ul>
    <ul id="nav-mobile" class="side-nav">
      <li><a href="logout.php">Salir</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a> </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
<div class="container"> <br>
  <br>
  <div class="row">
    <form id="target" action="" method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12"> <!--<i class="mdi-action-search prefix left"></i>-->
          <input id="icon_prefix" type="text" class=" col s9 offset-s1 validate">
          </input>
          <label for="icon_prefix">Buscar por placa</label>
          <button id="searchButton" class="col s2 btn card green darken-1 waves-effect waves-light" type="submit"> <i class="mdi-action-search left"></i> </button>
        </div>
      </div>
    </form>
    <div id="results" class='col s6 m6 modal-trigger' style='cursor: pointer; display: none' onclick='show(this)' href='#modal1'>
      <div class='card green darken-1'>
        <div class='card-content white-text'> <span class='card-title'>
          <h5></h5>
          </span>
          <div id='idplaca' class='col s12 m12'></div>
          <div id='placa' class='col s12 m12'><i class='right medium mdi-maps-directions-car'></i></div>
        </div>
        <div class='card-action'> <a>Detalles</a> </div>
      </div>
    </div>
    <?php
                $conn = new Conexion();
                $conn->conectar();
                $sql = "SELECT * FROM t_placas ORDER BY ID_PLACA ASC LIMIT 10 ";
                $result = $conn->obtDatos($sql);
                echo "<div id='content' class='row'>";
                foreach ($result as $dts) {
                    $placa = $dts["LETRAS"] . $dts["NUMEROS"];
                    $idPlaca = $dts["ID_PLACA"];
					
					$sql2 = "SELECT ID_VEHICULO FROM t_veh_placa WHERE ID_PLACA = $idPlaca";
					$result2 = $conn->obtDatos($sql2);
					foreach($result2 as $dts2)
					{
						$idVehiculo = $dts2["ID_VEHICULO"];
					}
					$sql3 = "SELECT * FROM t_vehiculo WHERE ID_VEH_CONSECUTIVO = $idVehiculo";
					$result3 = $conn->obtDatos($sql3);
					foreach($result3 as $dts3)
					{
						$idMarca = $dts3["MARCA"];
						$submarca = $dts3["SUBMARCA"];
					}
					$sql4 = "SELECT DESCRIP_MAR_VEHICULO FROM c_marca_vehiculos WHERE ID_MAR_VEH_CONSECUTIVO = $idMarca";
					$result4 = $conn->obtDatos($sql4);
					foreach($result4 as $dts4)
					{
						$marca = $dts4["DESCRIP_MAR_VEHICULO"];
					}
                    //echo $placa;

                    echo "<div class='col s6 m6 modal-trigger' style='cursor: pointer;' onclick='show(this)' href='#modal1'>
						<div class='card green darken-1'>
						  <div class='card-content white-text'> <span class='card-title'><h5>$placa</h5></span>
                			<div id='idplaca' style = 'display: none'>$idPlaca</div>	
                             <div id='placa' style = 'display: none'>$placa</div>
							 <div id='marca' class='col s12 m12'>$marca</div>
							 <div id='submarca' class='col s12 m12'>$submarca<i class='right medium mdi-maps-directions-car'></i></div>
						  </div>
						  <div class='card-action'> <a c' >Detalles</a> </div>
						</div>
					  </div>";
                }
                echo "</div>";
                $conn->cerrar();
                ?>
    <br>
    <br>
  </div>
</div>
<div class="container">
  <div class="section"> 
    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Detalles</h4>
        <div class="row">
          <label>Placa: </label>
          <div id="placa-modal"></div>
        </div>
        <div class="row">
          <label>Marca: </label>
          <div id="marca-modal"></div>
        </div>
        <div class="row">
          <label>Submarca: </label>
          <div id="submarca-modal"></div>
        </div>
        <div class="row">
          <label>Nombre: </label>
          <div id="nombre-modal"></div>
        </div>
        <div class="row">
          <label>Direccion: </label>
          <div id="direccion-modal"></div>
        </div>
        <div class="row">
          <label>Estado: </label>
          <div id="estado-modal"></div>
        </div>
        <div id="map-canvas"></div>
      </div>
      <div class="modal-footer"> <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CERRAR</a> </div>
    </div>
  </div>
  <br>
  <br>
  <div class="section"> </div>
</div>
<footer class="page-footer grey darken-4">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text"></h5>
        <p class="grey-text text-lighten-4">Secretaría de Seguridad Pública
          Km. 45 Periférico Poniente, Tablaje Catastral 12648
          Polígono Caucel Susulá, Mérida, Yucatán<br/>
          Gobierno del Estado de Yucatán 2012-2018, México</p>
      </div>
      <div class="col l3 s12">
        <h5 class="white-text"></h5>
        <!--<ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>--> 
      </div>
      <div class="col l3 s12">
        <h5 class="white-text"></h5>
        <!-- <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>--> 
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">Copyright. Derechos Reservados.</div>
  </div>
</footer>

<!--  Scripts--> 
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
<script src="js/materialize.js"></script> 
<script src="js/init.js"></script> 
<script src="js/global.js"></script> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
<script>
            function show(element)
            {
                if (element !== "") {
                    var x = element.innerHTML;
                    var x1 = x.split(">");
                    var x2 = x1[7];
                    var x3 = x2.split("<");
                    var idplaca = x3[0];
                    var x4 = x1[9];
                    var x5 = x4.split(" ");
                    var placa = x5[0];
                }
                var dataString = 'idplaca=' + idplaca + '&placa=' + placa;
                $.ajax({
                    type: "POST",
                    url: "buscar.php",
                    data: dataString,
                    datatype: JSON,
                    cache: false,
                    success: function (data) {
                        if (data !== '')
                        {
                            lista = JSON.parse(data);
                            divPlaca = document.getElementById("placa-modal");
                            divMarca = document.getElementById("marca-modal");
                            divSubmarca = document.getElementById("submarca-modal");
                            divNombre = document.getElementById("nombre-modal");
                            divDireccion = document.getElementById("direccion-modal");
                            divEstado = document.getElementById("estado-modal");
                            divPlaca.innerHTML = lista.placaProp;
                            divMarca.innerHTML = lista.marcaProp;
                            divSubmarca.innerHTML = lista.submarcaProp;
                            divNombre.innerHTML = lista.nombreProp + " " + lista.apePProp + " " + lista.apeMProp;
                            divDireccion.innerHTML = lista.calleProp + " " + lista.numeroProp + " " + lista.cruzamientoProp + ", " + lista.coloniaProp + ", " + lista.codPostalProp;
                            divEstado.innerHTML = lista.estadoProp;

                        }
                        else {
                            Materialize.toast('Error.', 4000) // 4000 is the duration of the toast
                        }
                    }
                });
            }
			
			$("#searchButton").click(function(){
			var datos = 'idplaca=' + $("#icon_prefix").val().toUpperCase();
			$.ajax({
                    type: "POST",
                    url: "buscar_boton.php",
                    data: datos,
                    cache: false,
					beforeSend: function () {
					$("#content").hide();
                            },
                    success: function (response) {
                        if (response == 'false')
                        {
						$("#results").html('No se encontraron resultados');
						$("#results").css("display","inline");
                        }
                        else {
						$("#results").html(response);
						$("#results").css("display","inline");
                        }
                    }
                });
				return false;
			});
        </script> 
<script>
		var map;
		function initialize() {
		  var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		  };
		  map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>
</html>
