<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["id_usuario"])) {
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
    <?php require_once("../MainHead/head.php")?>
    <title>Helpdesk-Configuracion Usuario</title>
</head>

<body class="with-side-menu">

    <?php require_once("../mainheader/header.php")?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../mainnav/nav.php")?>
<!--contenido-->
    <div class="page-content">
        <div class="container-fluid">
            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Configuracion Usuarios</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="../home/index.php">Inicio</a></li>
                                <li class="active">Configuracion Usuario</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>

            <div class="box-typical box-typical-padding">
                
                <button type="button" id="crearusuario" class="btn btn-inline btn-primary-outline" >Crear Usuario</button>
                <table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Nombre</th>
                            <th style="width: 10%;">Apellido</th>
                            <th class="d-none d-sm-table-cell"style="width: 25%;">Usuario LOG</th>
                            <th class="d-none d-sm-table-cell"style="width: 15%;">Contraseña</th>
                            <th class="d-none d-sm-table-cell"style="width: 15%;">Fecha Creación</th>
                            <th class="d-none d-sm-table-cell"style="width: 8%;">Rol</th>
                            <th class="text-center"style="width: 5%;">Editar</th>   
                            <th class="text-center"style="width: 5%;">Eliminar</th>   
                        </tr>
                    </thead>
                </table>

                    </div>
                </form>
            </div>
        </div>
    </div>
<!--contenido-->

    <?php require_once("Nuevousuario.php")?>
    <?php require_once("../mainjs/js.php")?>
    <script type="text/javascript" src="conf_usuario.js"></script>

</body>

</html>

<?php
 }else{
	header("Location:".conectar::ruta()."index.php");
	exit();
}

 ?>
