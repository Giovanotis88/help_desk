<?php
    require_once("config/conexion.php");
    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
        require_once("models/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>HELPDESK-INICIO</title>

	<link href="public/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">
    

    <link rel="stylesheet" href="public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body style="background-color: #CFECFE;">

    <div class="page-center">
        <div class="page-center-in">
        <background-image url="public/img/avatar-sign1.png" alt="">
            <div class="container-fluid">
            
                <form class="sign-box" action="" method="post" id="login_form">
                <input type="hidden" id="id_rol" name="id_rol" value="1">
                <div class="sign-avatar">
                         <img src="public/img/1.png" alt="" id="imgacceso"> 
                    </div>
                    <header class="sign-title" id="titulo">Ingreso Usuarios</header>
                        <?php
                                if(isset($_GET["m"])){
                                    switch($_GET["m"]){
                                        case "1";
                                        ?>
                                    <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
							            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								        <span aria-hidden="true">×</span>
							            </button>
							            <i class="font-icon font-icon-warning"></i>
							            Usuario y/o Contraseña incorrectos, valide por favor!!
						            </div>
                                <?php
                                        break;
                                        case "2";
                                ?>
                                    <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
							            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								        <span aria-hidden="true">×</span>
							            </button>
							            <i class="font-icon font-icon-warning"></i>
							            Por favor digite el usuario y la contraseña!!
						            </div>
                                <?php
                                        break;
                                    }
                                }

                                ?>
 
                    <div class="form-group">
                        <input type="text" id="usuario_correo" name="usuario_correo" class="form-control" placeholder="Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="usuario_password" name="usuario_password"class="form-control" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        <div class="float-center reset">
                            <a href="reset-password.html">Restablecer Contraseña</a>
                        </div>
                        <div class="float-center reset">
                            <a href="#" id="soporte">Acceso Soporte</a>
                        </div>
                        <div class="float-center reset">
                            <a href="#" id="admin">Acceso Administrador</a>

                            
                        </div>
                    </div>
                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <button type="submit" class="btn btn-rounded">Ingresar</button>
                    <!--p class="sign-note">New to our website? <a href="sign-up.html">Sign up</a></p>-->
                </form>
            </div>
        </div>
    </div> 


<script src="public/js/lib/jquery/jquery.min.js"></script>
<script src="public/js/lib/tether/tether.min.js"></script>
<script src="public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="public/js/plugins.js"></script>
    <script type="text/javascript" src="public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="public/js/app.js"></script>

<script type="text/javascript" src="index.js"></script>
</body>
</html>