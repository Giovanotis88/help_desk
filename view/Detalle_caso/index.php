<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["id_usuario"])) {
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
    <?php require_once("../MainHead/head.php")?>
    <title>Helpdesk-Detalle Caso</title>
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
                            <span class="label label-pill label-primary" id="estado_caso"></span>
                            <h3>Detalle de Caso Numero -  <span id="numero_caso"style="font-weight: bold; "></span>  </h3>
                            
                            <span class="label label label-primary" id="fecha"style="font-size: 20px;"></span>

                            
                            
                            
                            <ol class="breadcrumb breadcrumb-simple">
                            
                                <li><a href="../home/index.php">Inicio</a></li>
                                <li class="active">Detalle de caso </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>
        

            <div class="box-typical box-typical-padding">
            <div class="row">
					<form method="post" id="ticket_form">
                    
						<div class="col-lg-12">
                        <div id="estado" ></div>
                        <div style="margin-top: 40px;"></div> 
							<fieldset class="form-group">
								<label class="form-label semibold" for="tick_titulo">Título</label>
								<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
							</fieldset>
						</div>
                        <div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Grupo</label>
								<input type="text" class="form-control" id="grupo" name="grupo" readonly>
							</fieldset>
						</div>
                        <div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Categoria</label>
								<input type="text" class="form-control" id="tick_subcategoria" name="tick_subcategoria" readonly>
							</fieldset>
						</div>

                        <div class="col-lg-12">
                                <fieldset class="form-group">
                                <label class="form-label semibold" for="tick_titulo">Documentos Adjuntos</label>
                                <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                     <tr>
                                        <th style="width: 90%;">Nombre</th>
                                        <th class="text-center" style="width: 10%;"></th>
                                     </tr>
                                    </thead>
                                 <tbody>

                                 </tbody>
                                </table>
                                </fieldset>
              </div>
                        
                        <div class="col-sm-12">
                        <label class="form-label semibold" for="exampleInput">Detalle Solicitúd</label>
                            <div class="summernote-theme-10" >
                                <textarea class="summernote" id="desc_solicitud" name="desc_solicitud"></textarea require>
                                
                            </div>
                        </div>
                    </div>
                        
                        
                   </div>
					</form>
			</div>

			
	        
        
        <section class="activity-line" id="contdetalle"></section>

        <div class="box-typical box-typical-padding" id="pndetalle">

            <p><b>Ingrese el Detalle del Caso </b></p>
            
            <div class="form-group row">
                        <label for="exampleSelect" class="col-sm-2 form-control-label">Descripción </label>
                        <div class="col-sm-10">
                            <div class="summernote-theme-10" >
                                <textarea class="summernote" id="respuesta" name="respuesta"></textarea require>
                                <div class="col-lg-8">
                        <fieldset class="form-group">
                           
                            <input type="file" name="fileelementd" id="fileelementd" class="form-control" multiple>
                        </fieldset>

                    </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="button" id="btncerrar" class="btn btn-inline btn-danger"style="float: right;">Cerrar caso</button>
                            <button type="button" id="btnenviar" class="btn btn-inline btn-primary"style="float: right;">Actualizar</button>
                            
                        </div>
                </div>
	    	</div>
        </div>				
	   
<!--contenido-->
    <?php require_once("../mainjs/js.php")?>
    <script type="text/javascript" src="../Detalle_caso/detalle.js"></script>

</body>

</html>

<?php
 }else{
	header("Location:".conectar::ruta()."index.php");
	exit();
}

 ?>
