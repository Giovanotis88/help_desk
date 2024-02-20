<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["id_usuario"])) {
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
    <?php require_once("../MainHead/head.php")?>
    <title>Helpdesk-Creación Caso</title>
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
                            <h3>Nuevo Caso</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="../home/index.php">Inicio</a></li>
                                <li class="active">Nuevo Caso</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="box-typical box-typical-padding">
            <h5 class="m-t-lg with-border">Creación de Casos</h5>    



                <form method="post" id="caso_form">
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION["id_usuario"] ?>">





                    <div class="form-group row">
						<label class="col-sm-2 form-control-label">Título (*)</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese El título" require>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Nombre Quien Solicita (*)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" placeholder="Nombre Completo del Solicitante" require>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estacionSelect" class="col-sm-2 form-control-label">Estación (*)</label>
                        <div class="col-sm-10">
                            <select id="id_estacion" name="id_estacion" class="form-control" require>
                                <!-- Opciones de la lista -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grupoSelect" class="col-sm-2 form-control-label">Grupo Asignado (*)</label>
                        <div class="col-sm-10">
                            <select id="id_grupo" name="id_grupo" class="form-control" require>
                                <!-- Opciones de la lista -->
                            </select>
                        </div>
                    </div>
                    
                                        
                    <div class="form-group row">
                        <label for="categoriaSelect" class="col-sm-2 form-control-label">Categoria</label>
                        <div class="col-sm-10">
                            <select id="id_categoria" name="id_categoria" class="form-control" data-placeholder="Seleccionar">
                            <option label='Seleccione un grupo para obtener las categorias'></option>"
								
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <fieldset class="form-group">
                            <label class="form-lable semibold" for="exampleInput">Agregar Archivos</label>
                            
                        </fieldset>

                    </div>
                    <div class="col-lg-8">
                        <fieldset class="form-group">
                           
                            <input type="file" name="fileelement" id="fileelement" class="form-control" multiple>
                        </fieldset>

                    </div>
                    <div class="col-lg-12">
                    <div class="form-group row">
                        <label for="exampleSelect" class="col-sm-2 form-control-label">Descripcion de la solicitud (*)</label>
                        <div class="col-sm-10">
                            <div class="summernote-theme-10" >
                                <textarea class="summernote" id="desc_solicitud" name="desc_solicitud"></textarea require>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" name="action" value="add" class="btn btn-inline btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--contenido-->
    <?php require_once("../mainjs/js.php")?>
    <script src="../Nuevo_Caso/N_caso.js"></script>

</body>

</html>

<?php
 }else{
	header("Location:".conectar::ruta()."index.php");
	exit();
}

 ?>
