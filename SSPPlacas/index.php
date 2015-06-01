
<!DOCTYPE html>
<html>
    <head>
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--<link type="text/css" rel="stylesheet" href="css/style.css"/>-->

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
          <!--Import jQuery before materialize.js--> 
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script> 
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/global.js"></script>
        <script>
            $(document).ready(function ()
            {
				$('#login').click(function ()
                {		
					<?php
						$ipClient =  $_SERVER['REMOTE_ADDR'];
						$nameClient =  gethostbyaddr($_SERVER['REMOTE_ADDR']);
					?>		
                    var username = $("#username").val();
                    var password = $("#contrasena").val();
					var ip ='<?php echo $ipClient; ?>';
					var devicename = '<?php echo $nameClient;?>';
					var device = $("#device").val();
                    var dataString = 'user=' + username + '&contrasena=' + password + '&ip=' + ip + '&devicename=' + devicename;
                    if ($.trim(username).length > 0 && $.trim(password).length > 0)
                    {
                        $.ajax({
                            type: "POST",
                            url: "sigin.php",
                            data: dataString,
                            cache: false,
                            beforeSend: function () {
                                $("#login").html('Connecting...');
                                $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
                            },
                            success: function (data) {
                                $("#login").html(data);
                                if (data == 'true')
                                {
                                    window.location.href = "main.php";
                                }
                                else
                                {
                                    // Materialize.toast(message, displayLength, className, completeCallback);
                                    Materialize.toast('Usuario o contraseña incorrectos.', 4000) // 4000 is the duration of the toast
                                    //Shake animation effect.
                                    $("#login").html('Entrar')
                                    //$("#add_err").html("<img src='images/alert.png' /><span style='color:#cc0000'>Error:</span>Nombre de usuario o contrase&ntildea incorrectos. ");
                                }
                            }
                        });
                    }
                    else {
                        Materialize.toast('Ingrese usuario y contraseña', 4000) // 4000 is the duration of the toast
                        //Shake animation effect.
                        $("#login").html('Entrar')
                    }
                    return false;
                });

            });
        </script>
    </head>
    <body>      
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper grey darken-4"> <a href="index.php" class="brand-logo center"><img class="responsive-img"
                                                                                                           src="images/ssp.png"></a> </div>
            </nav>
        </div>
        <div class="row">
            <header>
                <br/>
				<br/>
            </header>
            <div class="box">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card grey lighten-5">
                            <div class="card-content white-text"> 
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="input-field col s6 offset-s3"> <i class="mdi-action-account-circle prefix"></i>
                                            <input id="username" name="username" type="text" class="validate">
                                            <label for="username">Usuario:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6 offset-s3"> <i class="mdi-action-lock prefix"></i>
                                            <input id="contrasena" name="contrasena" type="password" class="validate">
                                            <label for="contrasena">Contraseña:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s2 offset-s5">
                                            <button id="login" class="btn waves-effect waves-light" type="submit" name="login">Entrar <i class="mdi-content-send right"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </body>
</html>