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
                            <h3>Nuevo Caso Alimentación</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="../home/index.php">Inicio</a></li>
                                <li class="active">Nuevo Caso Alimentación</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="box-typical box-typical-padding">
            <h5 class="m-t-lg with-border">Creación de Casos de Alimentación</h5>    



                <form method="post" id="caso_form">
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION["id_usuario"] ?>">





                    <!-- <div class="form-group row">
						<label class="col-sm-2 form-control-label">Título (*)</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese El título" required>
                    </div>
                    </div> -->
                    
                    <div class="form-group row">
                        <label for="estacionSelect" class="col-sm-2 form-control-label">Area Solicitante</label>
                        <div class="col-sm-10">
                            <select id="id_area" name="id_area" class="form-control" required>
                            <option disabled selected></option>    
                            <option>Central de Comunicaciones</option>
                            <option >Area Administrativa </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Correo Solicitante</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="c_solicitante" name="c_solicitante" placeholder="Ingrese el Correo de Quien Solicita" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="estacionSelect" class="col-sm-2 form-control-label">Tipo de Evento</label>
                        <div class="col-sm-10">
                            <select id="id_evento" name="id_evento" class="form-control" required>
                            <option disabled selected></option> 
                            <option>Emergencia</option>
                            <option >Puestos Fijos</option>
                            <option >Mesas de Trabajo /PMU</option>
                            <option >Evento Administrativo (Con Uniformados)</option>
                            <option >Academia </option>
                            <option >Plan Exodo</option>
                            <option >Plan Retorno </option>
                            <option >Semana Santa </option>
                            

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="grupoSelect" class="col-sm-2 form-control-label">Suministro</label>
                        <div class="col-sm-10">
                            <select id="id_sumi" name="id_sumi" class="form-control" required>
                                <!-- Opciones de la lista -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="grupoSelect" class="col-sm-2 form-control-label">Cantidad</label>
                        <div class="col-sm-10">
                            <select id="cantidad" name="cantidad" class="form-control" required>
                            <?php
                                for ($i = 1; $i <= 100; $i++) {
                                 echo "<option value='$i'>$i</option>";
                                 }
                            ?>
                        </select>
                        </div>
                    </div>

                    
                    <div class="col-lg-12">
                    <div class="form-group row">
                        <label for="exampleSelect" class="col-sm-2 form-control-label">Descripcion de la solicitud (*)</label>
                        <div class="col-sm-10">
                            <div class="summernote-theme-10" >
                                <textarea class="summernote" id="desc_solicitud" name="desc_solicitud"></textarea required>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-2">
                        <fieldset class="form-group">
                            <label class="form-lable semibold" for="exampleInput">Agregar Archivos</label>
                            
                        </fieldset>

                    </div>
                    <div class="col-lg-10 "> <!-- Añade la clase 'text-center' para centrar el contenido -->
                        <fieldset class="form-group">
                        <input type="file" name="fileelement" id="fileelement" class="form-control" multiple>
                        </fieldset>
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
    <script src="../Alimentacion/alimentacion.js"></script>

</body>

</html>

<?php
 }else{
	header("Location:".conectar::ruta()."index.php");
	exit();
}

 ?>
