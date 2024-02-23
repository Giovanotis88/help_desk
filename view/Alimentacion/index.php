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





                    <div class="form-group row">
						<label class="col-sm-2 form-control-label"># Orden Operativa </label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="numorden" name="numorden" placeholder="Ingrese el numero de la Orden" required>
                    </div>
                    </div> 
                    
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
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Lugar de Entrega</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="l_entrega" name="l_entrega" placeholder="Ingrese el lugar de Entrega" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Persona Quien Recibe</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="p_encargada" name="p_encargada" placeholder="Persona Encargada del Servicio" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Telefono Quien Recibe</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="t_recibe" name="t_recibe" placeholder="Telefono Persona Encargada del Servicio" required >
                        </div>
                    </div>

                    
                    <!-- <div class="col-lg-11.5">
                    <div class="form-group row">
                        <label for="exampleSelect" class="col-sm-2 form-control-label">Descripción de la Orden Operativa</label>
                        <div class="col-sm-10">
                            <div class="summernote-theme-10" >
                                <textarea class="summernote" id="desc_solicitud" name="desc_solicitud"></textarea required>
                            </div>
                        </div>
                    </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="grupoSelect" class="col-sm-2 form-control-label">¿Desea Agregar más?</label>
                        <div class="col-sm-1">
                            <select id="id_mas" name="id_mas" class="form-control" required>
                                <option></option>
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    

                    <div class="form-group row" style="display: none;" id="opciones-adicionales">
                    <center>
                        <div>
                        <p><b>Segundo Servicio</b></p>
                        </div>
                    </center>
                    <label for="grupoSelect" class="col-sm-2 form-control-label">Suministro 2</label>
                        <div class="col-sm-10">
                            <select id="id_sumi2" name="id_sumi2" class="form-control" required>
                                <!-- Opciones de la lista -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="opciones-adicionales2">
                    <label for="grupoSelect" class="col-sm-2 form-control-label">Cantidad 2 </label>
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
                    <div class="form-group row" style="display: none;" id="opciones-adicionales3">
                        <label class="col-sm-2 form-control-label">Lugar de Entrega 2</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="l_entrega2" name="l_entrega2" placeholder="Ingrese el Correo de Quien Solicita" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="opciones-adicionales4">
                    <label class="col-sm-2 form-control-label">Persona Quien recibe 2 Servicio </label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="persona2" name="persona2" placeholder="Persona Encargada del Servicio 2" required>
                    </div>
                    </div> 
                    <div class="form-group row" style="display: none;" id="opciones-adicionales5">
                    <label class="col-sm-2 form-control-label">Telefono Quien Recibe 2 </label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="persona2" name="persona2" placeholder="Telefono Persona Encargada del Servicio 2" required>
                    </div>
                    </div>   
                    <div class="form-group row" style="display: none;" id="opciones-adicionales6">
                        <label for="grupoSelect" class="col-sm-2 form-control-label" >¿Desea Agregar más?</label>
                        <div class="col-sm-1">
                            <select id="id_mas2" name="id_mas2" class="form-control"  required>
                                <option></option>
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div> 
  <!-- servicio 3---------------------------------------------------------------------------------------------------------------------------------------                   -->
                    <div class="form-group row" style="display: none;" id="opciones-adicionales7">
                    <center>
                        <div>
                        <p><b>Tercer Servicio</b></p>
                        </div>
                    </center>
                    <label for="grupoSelect" class="col-sm-2 form-control-label">Suministro 3</label>
                        <div class="col-sm-10">
                            <select id="id_sumi3" name="id_sumi3" class="form-control" required>
                                <!-- Opciones de la lista -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="opciones-adicionales8">
                    <label for="grupoSelect" class="col-sm-2 form-control-label">Cantidad 3 </label>
                        <div class="col-sm-10">
                            <select id="cantidad3" name="cantidad3" class="form-control" required>
                            <?php
                                for ($i = 1; $i <= 100; $i++) {
                                 echo "<option value='$i'>$i</option>";
                                 }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="opciones-adicionales9">
                        <label class="col-sm-2 form-control-label">Lugar de Entrega 3</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="l_entrega3" name="l_entrega3" placeholder="Ingrese el Correo de Quien Solicita" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;" id="opciones-adicionales10">
                    <label class="col-sm-2 form-control-label">Persona Quien recibe 2 Servicio </label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="persona2" name="persona2" placeholder="Persona Encargada del Servicio 2" required>
                    </div>
                    </div> 
                    <div class="form-group row" style="display: none;" id="opciones-adicionales11">
                    <label class="col-sm-2 form-control-label">Telefono Quien Recibe 3 </label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="persona2" name="persona2" placeholder="Telefono Persona Encargada del Servicio 2" required>
                    </div>
                    </div>   
                    <div class="form-group row" style="display: none;" id="opciones-adicionales12" >
                        <label for="grupoSelect" class="col-sm-2 form-control-label" style="display: none;">¿Desea Agregar más?</label>
                        <div class="col-sm-1">
                            <select id="id_mas3" name="id_mas3" class="form-control" style="display: none;" required>
                                <option></option>
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>          
         


                    <div class="col-lg-2">
                        <fieldset class="form-group">
                            <label class="form-lable semibold" for="exampleInput">Agregar Archivos</label>
                        </fieldset>
                    </div>

                    
                    <div class="col-lg-10 "> 
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
