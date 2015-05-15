<?php
include_once "php/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>Starter Template - Materialize</title>

        <!-- CSS  -->
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <nav class="grey darken-4" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img class="responsive-img" src="images/ssp.png"></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Buscar</a></li>
                    <li><a href="logout.php">Salir</a></li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li><a href="#">Buscar</a></li>
                    <li><a href="logout.php">Salir</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a> </div>
        </nav>
        <div class="section no-pad-bot" id="index-banner">
            <div class="container"> <br>
                <br>
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s12"> <i class="mdi-action-search prefix"></i>
                                <input id="icon_prefix" type="text" class="validate">
                                <label for="icon_prefix">Buscar por placa</label>
                            </div>
                    </form>
                </div>
                <?php
                $conn = new Conexion();
                $conn->conectar();
                $sql = "SELECT ID_PLACA, LETRAS, NUMEROS, ESTADO FROM t_placas ORDER BY ID_PLACA ASC LIMIT 10 ";
                $result = $conn->obtDatos($sql);
                echo "<div class='row'>";
                foreach ($result as $dts) {
                    $placa = $dts["LETRAS"] . $dts["NUMEROS"];
                    $idPlaca = $dts["ID_PLACA"];
                    //echo $placa;

                    echo "<div class='col s6 m6 modal-trigger' style='cursor: pointer;' onclick='show(this)' href='#modal1'>
						<div class='card green darken-1'>
						  <div class='card-content white-text'> <span class='card-title'><h5>PLACA</h5></span>
                				  <div class='col s12 m12'>$idPlaca</div>	
                                                  <div class='col s12 m12'>$placa <i class='right medium mdi-maps-directions-car'></i></div>
						  </div>
						  <div class='card-action'> <a c' >Detalles</a> </div>
						</div>
					  </div>";
                }
                echo "</div>";
                ?>
                <br>
                <br>
            </div>
        </div>
        <div class="container">
            <div class="section">     
                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Detalles</h4>
                        <p>A bunch of text</p>
                    </div>
                    <div class="modal-footer"> <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a> </div>
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
                        <h5 class="white-text">Company Bio</h5>
                        <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Settings</h5>
                        <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Connect</h5>
                        <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container"> Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a> </div>
            </div>
        </footer>

        <!--  Scripts--> 
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
        <script src="js/materialize.js"></script> 
        <script src="js/init.js"></script>
        <script src="js/global.js"></script>
        <script>
            function show(element)
            {
                if(element != "")
                {
                    alert(element.data);
                }
            }
            ;
        </script>
    </body>
</html>