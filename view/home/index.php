<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["id_usuario"])) {

if($_SESSION["id_rol"]==1){
?>
<!DOCTYPE html>
<html>
	<head lang="es">
    <?php require_once("../MainHead/head.php")?>
	<link rel="stylesheet" href="../../public/css/morris.css">
	<link rel="stylesheet" href="../../public/css/lib/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="../../public/css/separate/pages/calendar.min.css">

	
    
    <title>Helpdesk-Inicio</title>

</head>
<body class="with-side-menu">

<?php require_once("../mainheader/header.php")?>


	<div class="mobile-menu-left-overlay"></div>

	<?php require_once("../mainnav/nav.php")?>
			
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-13">
					<div class="row"><header class="card-header">
					<b>Total de Casos Generados </b>
				</header>
						<div class="col-sm-4">
						
							<article class="statistic-box yellow">
								
								<div>
									<div class="number" id="lbltotal" name="lbltotal"></div>
									<div class="caption"><div>Total Casos Generados</div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box green">
								<div>
									<div class="number" id="lblabiertos"></div>
									<div class="caption"><div>Total Casos Abiertos </div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box red">
								<div>
									<div class="number" id="lblcerrados"></div>
									<div class="caption"><div>Total Casos Cerrados </div></div>
								</div>
							</article>
						</div>
					</div>
				</div>
				
			</div>
	
		</div>
		
			
	</div>
	
	
	<?php require_once("../mainjs/js.php")?>
	<script src="../../public/js/morris.min.js"></script>
	<script src="../../public/js/raphael-min.js"></script>
     
	
	<script type="text/javascript" src="home.js"></script>
	
</body>
</html>
<?php
}else if ($_SESSION["id_rol"]==2){
    ?>
<!DOCTYPE html>
<html>
	<head lang="es">
    <?php require_once("../MainHead/head.php")?>
	<link rel="stylesheet" href="../../public/css/morris.css">

	
    
    <title>Helpdesk-Inicio</title>

</head>
<body class="with-side-menu">

<?php require_once("../mainheader/header.php")?>


	<div class="mobile-menu-left-overlay"></div>

	<?php require_once("../mainnav/nav.php")?>
			
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-13">
					<div class="row"><header class="card-header">
					<b>Total de Casos Generados </b>
				</header>
						<div class="col-sm-4">
						
							<article class="statistic-box yellow">
								
								<div>
									<div class="number" id="lbltotal" name="lbltotal"></div>
									<div class="caption"><div>Total Casos Generados</div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box green">
								<div>
									<div class="number" id="lblabiertos"></div>
									<div class="caption"><div>Total Casos Abiertos </div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box red">
								<div>
									<div class="number" id="lblcerrados"></div>
									<div class="caption"><div>Total Casos Cerrados </div></div>
								</div>
							</article>
						</div>
					</div>
				</div>
				
			</div>
	
		</div>
		<section class="card">
				<header class="card-header">
					Grafico Total Casos
				</header>
				<div class="card-block">
					<div id="divgrafico" style="height: 250px;"></div>
				</div>
			</section>
			
			<div class="box-typical box-typical-padding">
			<td><b>Casos Abiertos</b></td> 
                <table id="casos_sopo" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 5%;">N° de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Agente Responsable</th>
							<th style="width: 25%;">Grupo Asignado</th>
                            <th style="width: 25%;">Categoria de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Titulo</th>                            
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Fecha Creacion</th>
                            <th class="d-none d-sm-table-cell"style="width: 5%;">Estado Caso</th>
                                
                        </tr>
                    </thead>
                </table>

                    </div>
					<div class="box-typical box-typical-padding">
					<td><b>Casos Cerrados</b></td> 
                <table id="casos_sopoc" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                   
				<thead>
						
                        <tr>
                            <th style="width: 5%;">N° de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Agente Responsable Cierre</th>
							<th style="width: 25%;">Grupo Asignado</th>
                            <th style="width: 25%;">Categoria de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Titulo</th>                            
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Fecha Cierre</th>
                            <th class="d-none d-sm-table-cell"style="width: 5%;">Estado Caso</th>
                                
                        </tr>
                    </thead>
                </table>

                    </div>
			
	</div>
	
	
	<?php require_once("../mainjs/js.php")?>
	<script src="../../public/js/morris.min.js"></script>
	<script src="../../public/js/raphael-min.js"></script>
     
	
	<script type="text/javascript" src="home.js"></script>
	
</body>
</html>
<?php
}else{
    ?>
<!DOCTYPE html>
<html>
	<head lang="es">
    <?php require_once("../MainHead/head.php")?>
	<link rel="stylesheet" href="../../public/css/morris.css">

	
    
    <title>Helpdesk-Inicio</title>

</head>
<body class="with-side-menu">

<?php require_once("../mainheader/header.php")?>


	<div class="mobile-menu-left-overlay"></div>

	<?php require_once("../mainnav/nav.php")?>
		
	
	
	<div class="page-content">
	<div class="container-fluid">
	

		
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-13">
					<div class="row"><header class="card-header">
					<b>Total de Casos Generados </b>
				</header>				
						<div class="col-sm-4">
						
							<article class="statistic-box yellow">
							
								<div>
									<div class="number" id="lbltotal" name="lbltotal"></div>
									<div class="caption"><div>Total Casos Generados</div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box green">
								<div>
									<div class="number" id="lblabiertos"></div>
									<div class="caption"><div>Total Casos Abiertos </div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box red">
								<div>
									<div class="number" id="lblcerrados"></div>
									<div class="caption"><div>Total Casos Cerrados </div></div>
								</div>
							</article>
						</div>
					</div>
				</div>
				<section class="card">
					<header class="card-header">
						Grafico Total Casos Por Estación
					</header>
					<div class="card-block">
						<div id="divestacion" style="height: 250px;"></div>
					</div>
			</div>
		</div>
		</section>
				
			<section class="card">
				<header class="card-header">
					Grafico Total Casos Por Grupo.
				</header>
				<div class="card-block">
					<div id="divgrupo" style="height: 250px;"></div>
				</div>
			</section>
			<section class="card">
					<header class="card-header">
						Grafico Casos Por Categoria.
					</header>
					<div class="card-block">
						<div id="divgrafico" style="height: 250px;"></div>
					</div>
			</section>
				

			<div class="box-typical box-typical-padding">
                <table id="casos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 5%;">N° de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Agente Responsable</th>
							<th style="width: 25%;">Grupo Asignado</th>
                            <th style="width: 25%;">Categoria de Caso</th>
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Titulo</th>                            
                            <th class="d-none d-sm-table-cell"style="width: 20%;">Fecha Creacion</th>
                            <th class="d-none d-sm-table-cell"style="width: 5%;">Estado Caso</th>
                                
                        </tr>
                    </thead>
                </table>

                    </div>
	</div>
	
	
	<?php require_once("../mainjs/js.php")?>
	<script src="../../public/js/morris.min.js"></script>
	<script src="../../public/js/raphael-min.js"></script>
     
	<script type="text/javascript" src="home.js"></script>

	<script type="text/javascript" src="../notificacion.js"></script>
	
</body>
</html>
<?php

}

 }else{
	header("Location:".conectar::ruta()."index.php");
	exit();
}

 ?>
