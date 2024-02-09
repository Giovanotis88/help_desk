<header class="site-header">
    <div class="container-fluid">

        

    <a href="#" class="site-logo">
        <img class="hidden-md-down" src="../../public/img/logo-2.png" alt="">
        <img class="hidden-lg-up" src="../../public/img/logo-2-mob.png" alt="">
    </a>

        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            <span>Menu Help Desk</span>
        </button>

        <button class="hamburger hamburger--htla">
            <span>Menu Help Desk</span>
        </button>

        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <div class="dropdown dropdown-notification notif">
                        <a href="../MntNotificacion/" class="header-alarm">
                            <i class="font-icon-alarm"></i>
                        </a>
                    </div>
                    
                    <div class="dropdown user-menu">                        
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../../public/img/<?php echo $_SESSION["id_rol"] ?>.png" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="../MntPerfil/"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
                

                <div class="mobile-menu-right-overlay"></div>

                <input type="hidden" id="id_usuario" value="<?php echo $_SESSION["id_usuario"] ?>">
                <input type="hidden" id="id_rol" value="<?php echo $_SESSION["id_rol"] ?>">
               
                <div class="dropdown dropdown-typical">
                    <a href="#" class="dropdown-toggle no-arr">
                        <span class="font-icon font-icon-user"></span>
                        <span class="lblcontactonomx"><?php echo $_SESSION["nombre_usuario"] ?> <?php echo $_SESSION["apellido_usuario"] ?></span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>