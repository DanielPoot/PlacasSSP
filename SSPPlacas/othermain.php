<?php
include_once "php/otherconexion.php";
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
            <div class="nav-wrapper container"><a id="logo-container" href="main.php" class="brand-logo"><img class="responsive-img" src="images/ssp.png"></a>
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
                    <form id="target" action="" method="post" class="col s12">
                        <div class="row">
                            <div class="input-field col s12"> <i class="mdi-action-search prefix left"></i>
                                <input id="icon_prefix" type="text" class=" col s9 offset-s1 validate"></input>
                                <label for="icon_prefix">Buscar por placa</label>
								<button id="searchButton" class="col s2 btn card amber accent-4 waves-effect waves-light" type="submit">Submit
								<i class="mdi-action-search left"></i>
								</button>
                            </div>
						</div>
                    </form>
					<div id="results" class='col s6 m6 modal-trigger' style='cursor: pointer; display: none' onclick='show(this)' href='#modal1'>
						<div class='card green darken-1'>
						  <div class='card-content white-text'> <span class='card-title'><h5></h5></span>
                				  <div id='idplaca' class='col s12 m12'></div>	
                                  <div id='placa' class='col s12 m12'><i class='right medium mdi-maps-directions-car'></i></div>
						  </div>
						  <div class='card-action'> <a c' >Detalles</a> </div>
						</div>
					  </div>
                
                <?php
                $conn = new Conexion();
                $conn->conectar();
                $sql = "SELECT * FROM vehiculos ORDER BY placa ";
                $result = $conn->obtDatos($sql);
				$countDivs = 1;
                echo "<div id='content' class='row'>";
                foreach ($result as $dts) {
                    $placa = $dts["placa"];
                    $idPlaca = $dts["id"];
					$marca = $dts["marca"];
					$modelo = $dts["modelo"];
                    //echo $placa;

                    echo "<div class='col s6 m6 modal-trigger' style='cursor: pointer;' onclick='show(this,$countDivs)' href='#modal1'>
						<div class='card amber accent-4'>
						  <div class='card-content white-text'> <span class='card-title'><h5 id='$countDivs'>$placa</h5></span>
						  <div class='col s12 m12' style='display: none;'>$idPlaca</div>
                			<div class='col s12 m12'>$marca</div>	
                             <div id='placa' class='col s12 m12'>$modelo<i class='right medium mdi-maps-directions-car'></i></div>
						  </div>
						  <div class='card-action'> <a c' >Detalles</a> </div>
						</div>
					  </div>";
					  $countDivs++;
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
                            <label>Placa: </label><div id="placa-modal"></div>
                        </div>
                        <div class="row">
                            <label>Marca: </label><div id="marca-modal"></div>
                        </div>
                        <div class="row">
                            <label>Submarca: </label><div id="submarca-modal"></div>
                        </div>
                        <div class="row">
                            <label>Nombre: </label><div id="nombre-modal"></div>
                        </div>
                        <div class="row">
                            <label>Direccion: </label><div id="direccion-modal"></div>
                        </div>
                        <div class="row">
                            <label>Sexo: </label><div id="sexo-modal"></div>
                        </div>
						<div class="row">
                            <label>Numero de cobro: </label><div id="numcobro-modal"></div>
                        </div>
						<div class="row">
                            <label>Numero de licencia: </label><div id="numlicencia-modal"></div>
                        </div>
						<div class="row">
                            <label>Foto: </label><div id="foto-modal"></div>
                        </div>
						<div class="row">
                            <label>Departamento: </label><div id="depto-modal"></div>
                        </div>
						<div class="row">
                            <label>Area: </label><div id="area-modal"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
						
						<div class="row">
							<a class="btn btn-primary view-pdf left" href="http://www.bodossaki.gr/userfiles/file/dummy.pdf">View PDF</a> 
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CERRAR</a>
						</div>
						
                        
                    </div>
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
            function show(element,element2)
            {
                if (element !== "") {
                    var x = element.innerHTML;
                    var x1 = x.split(">");
                    var x2 = x1[7];
                    var x3 = x2.split("<");
                    var idplaca = x3[0];
                    var iddiv= element2.toString();
					var divplaca = document.getElementById(iddiv);
					var placa = divplaca.innerHTML;
					
                }
                var dataString = 'idplaca=' + idplaca + '&placa=' + placa;
                $.ajax({
                    type: "POST",
                    url: "otherbuscar.php",
                    data: dataString,
                    datatype: JSON,
                    cache: false,
                    success: function (data) {
                        if (data !== '')
                        {
                            // Materialize.toast(message, displayLength, className, completeCallback);
                            //Materialize.toast(data, 4000) // 4000 is the duration of the toast
                            lista = JSON.parse(data);
                            divPlaca = document.getElementById("placa-modal");
                            divMarca = document.getElementById("marca-modal");
                            divSubmarca = document.getElementById("submarca-modal");
                            divNombre = document.getElementById("nombre-modal");
                            divDireccion = document.getElementById("direccion-modal");
                            divSexo = document.getElementById("sexo-modal");
							divNumCobro = document.getElementById("numcobro-modal");
							divNumLicencia = document.getElementById("numlicencia-modal");
							divFoto = document.getElementById("foto-modal");
							divDepto = document.getElementById("depto-modal");
							divArea = document.getElementById("area-modal");
                            divPlaca.innerHTML = lista.placaProp;
                            divMarca.innerHTML = lista.marcaProp;
                            divSubmarca.innerHTML = lista.submarcaProp;
                            divNombre.innerHTML = lista.nombre + " " + lista.apePProp + " " + lista.apeMProp;
                            divDireccion.innerHTML = lista.direccion;
                            divNumCobro.innerHTML = lista.numCobro;
							divNumLicencia.innerHTML = lista.numLicencia;
							divFoto.innerHTML = lista.foto;
							divDepto.innerHTML = lista.nombreDepto;
							divArea.innerHTML = lista.area;

                        }
                        else {
                        }
                    }
                });
            }
			
			(function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);
			
			$(function(){    
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
        var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        $.createModal({
        title:'My Title',
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        return false;        
    });    
})
			
			$("#searchButton").click(function(){
			var datos = 'idplaca=' + $("#icon_prefix").val().toUpperCase();
			$.ajax({
                    type: "POST",
                    url: "otherbuscar_boton.php",
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
    </body>
</html>

