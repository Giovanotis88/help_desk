<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["id_usuario"])) {
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
    <?php require_once("../MainHead/head.php")?>
    <title>Helpdesk-Consultar Caso</title>
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
                            <h3>Consulta de Casos</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Consulta de Casos</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>

            <div class="box-typical box-typical-padding">
                <table id="casos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 5%;">N° de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Agente Responsable Creación</th>
                            <th style="width: 25%;">Grupo Asignado</th>
                            <th style="width: 25%;">Categoria de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Titulo</th>                            
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Fecha Creación</th>
                            <th class="d-none d-sm-table-cell"style="width: 5%;">Estado Caso</th>
                            <th class="text-center"style="width: 5%;"></th>     
                        </tr>
                    </thead>
                </table>

                    </div>
                </form>
            </div>
        </div>
    </div>
<!--contenido-->
    <?php require_once("../mainjs/js.php")?>
    <script type="text/javascript" src="../Consul_Caso/consultarticket.js"></script>

</body>

</html>

<?php
 }else{
	header("Location:".conectar::ruta()."index.php");
	exit();
}

 ?>
