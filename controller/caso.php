<?php
require_once("../config/conexion.php");
require_once("../models/Caso.php");

require_once("../models/usuario.php");
$usuario= new Usuario();

require_once("../models/documentos.php");
$documento= new Documento();

$caso= new Caso();

switch($_GET["op"]){
    case "guardar":
        $datos=$caso->crear_caso($_POST["titulo"],$_POST["nombre_solicitante"],$_POST["id_estacion"],$_POST["id_grupo"],$_POST["id_categoria"],$_POST["desc_solicitud"],$_POST["id_usuario"]);
        if(is_array($datos) == true and count($datos)>0){
          foreach ($datos as $row) {
            $output["id_caso"] = $row["id_caso"];
            if (empty($_FILES['files']['name'])){

            }else{
                $countfiles =count($_FILES['files']['name']);
                $ruta ="../public/documentos/".$output["id_caso"]."/";
                $files_arr=array();

                if(!file_exists($ruta)){
                    mkdir($ruta,0777, true);
                }
                for($index =0; $index < $countfiles; $index++){
                    $doc1=$_FILES['files']['tmp_name'][$index];
                    $destino=$ruta.$_FILES['files']['name'][$index];

                    $documento->insert_document($output["id_caso"],$_FILES['files']['name'][$index]);

                    move_uploaded_file($doc1,$destino);

                }

            }

          }
        }
        echo json_encode($datos);
    break;    

    case "actualizar":
        $caso->actualizar($_POST["id_caso"]);
        $datos=$caso->cerrar($_POST["id_caso"],$_POST["id_usuario"],$_POST["desc_detalle"]);
        if(is_array($datos) == true and count($datos)>0){
            foreach ($datos as $row) {
                $output["id_caso"] = $row["id_caso"];
                if (empty($_FILES['files']['name'])){

                }else{
                    $countfiles =count($_FILES['files']['name']);
                    $ruta ="../public/Documentos_Cierre/".$output["id_caso"]."/";
                    $files_arr=array();
                    if(!file_exists($ruta)){
                        mkdir($ruta,0777, true);
                    }
                    for($index =0; $index < $countfiles; $index++){
                        $doc1=$_FILES['files']['tmp_name'][$index];
                        $destino=$ruta.$_FILES['files']['name'][$index];
    
                        $documento->insert_document_detalle($output["id_caso"],$_FILES['files']['name'][$index]);
    
                        move_uploaded_file($doc1,$destino);
    
                    }

                }
                }
        }
    break; 

    case "categoria":           
            $id_grupo -> consulta_categoria($_POST['id_grupo'] , $_POST['id_grupo']);                                  
             
        
    break;

    case "consultar_caso":
        $datos=$caso->consulta_caso($_POST["id_usuario"]);
        $data=Array();
        foreach($datos as $row){
            $sub_array=array();
            $sub_array[]=$row["id_caso"];
            $sub_array[] = $row["nombre_usuario"] . ' ' . $row["apellido_usuario"];
            $sub_array[]=$row["nombre_grupo"];
            $sub_array[]=$row["nombre_categoria"];
            $sub_array[]=$row["titulo"];
            
            $sub_array[]=date("d/m/y H:i",strtotime($row["fecha_creacion"]));
            if($row["estado_caso"]=="Abierto"){
                $sub_array[]='<span class="label label-pill label-success">Abierto</span>';
            }else{
                $sub_array[]='<span class="label label-pill label-danger">Cerrado</span>';
            }  
            $sub_array[] = '<button type="button" onClick="vista('.$row["id_caso"].');"  id="'.$row["id_caso"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
            $data[]=$sub_array;
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);    

    break;

    case "consultar":
        $datos=$caso->consulta();
        $data=Array();
        foreach($datos as $row){
            $sub_array=array();
            $sub_array[]=$row["id_caso"];
            $sub_array[] = $row["nombre_usuario"] . ' ' . $row["apellido_usuario"];
            $sub_array[]=$row["nombre_grupo"];
            $sub_array[]=$row["nombre_categoria"];
            $sub_array[]=$row["titulo"];
                       
            $sub_array[]=date("d/m/y H:i",strtotime($row["fecha_creacion"]));

            if($row["estado_caso"]=="Abierto"){
                $sub_array[]='<span class="label label-pill label-success">Abierto</span>';
            }else{
                $sub_array[]='<span class="label label-pill label-danger">Cerrado</span>';
            }            
            $sub_array[] = '<button type="button" onClick="vista('.$row["id_caso"].');"  id="'.$row["id_caso"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
            $data[]=$sub_array;
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);    

    break;

    case "detalle";
        $datos = $caso->detalle_x_caso($_POST["id_caso"]);
        ?>
          <?php
            foreach ($datos as $row){
                ?>
                <article class="activity-line-item box-typical">
                <div class="activity-line-date">
						<?php echo  date ("d/m/y ", strtotime($row["fecha_creacion"]));?>	
						</div>
						<header class="activity-line-item-header">
							<div class="activity-line-item-user">
								<div class="activity-line-item-user-photo">
									<a href="#">
										<img src="../../public/img/<?php echo $row['id_rol']?>.png" alt="">
									</a>
								</div>
								<div class="activity-line-item-user-name"><?php echo  $row['nombre_usuario'].' '.$row['apellido_usuario'] ;?>	</div>
								<div class="activity-line-item-user-status"><?php 
                                    if($row['id_rol']==1){
                                        echo 'Usuario Solicitante';

                                    }else{
                                        echo ' Usuario Mesa Logística';

                                    }
                                                               
                                ?>
                                </div>
							</div>
						</header>
						<div class="activity-line-action-list">
							<section class="activity-line-action">
								<div class="time"><?php echo  date ("H:i", strtotime($row["fecha_creacion"]));?></div>
								<div class="cont">
									<div class="cont-in">
										<p><?php echo  $row['desc_detalle'] ;?></p>
										<br>
                                        <?php
                                            $datos_det=$documento->get_doc_detalle_ticket($row["id_casodesc"]);
                                            if(is_array($datos_det)==true and count ($datos_det)>0){
                                                ?>
                                            <p><strong> Archivos de Cierre</strong></p>
                                            <p>
                                                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 60%;"> Nombre</th>
                                                                        <th style="width: 40%;"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <?php
                                                                            foreach ($datos_det as $row_det){ 
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $row_det["det_nom"]; ?></td>
                                                                                <td>
                                                                                    <a href="../../public/Documentos_Cierre/<?php echo $row_det["id_caso"]; ?>/<?php echo $row_det["det_nom"]; ?>" target="_blank" class="btn btn-inline btn-primary btn-sm">Ver</a>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                </tbody>
                                                            </table>

                                                            </p>
                                            <?php
                                            
                                            }
                                        ?>
									</div>
								</div>
							</section>
							
						</div>
					</article>



                <?php


          }

          ?>

            <?php
    break;

    case "mostrar";
        $datos=$caso->listar_ticket_x_id($_POST["id_caso"]);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row)
            {
                $output["id_caso"] = $row["id_caso"];
                $output["id_usuario"] = $row["id_usuario"];
                $output["id_categoria"] = $row["id_categoria"];
                $output["titulo"] = $row["titulo"];
                $output["desc_solicitud"] = $row["desc_solicitud"];
                $output["nombre_categoria"] = $row["nombre_categoria"];
                $output["nombre_grupo"] = $row["nombre_grupo"];
                if($row["estado_caso"] == "Abierto"){
                    $output["estado_caso"] = '<span class="label label-pill label-success" style="font-size: 20px;">ABIERTO</span>';

                }else{
                    $output["estado_caso"] = '<span class="label label-pill label-danger" style="font-size: 20px;">CERRADO</span>';


                }
                $output["estado_caso_texto"] = $row["estado_caso"];
                $output["fecha_creacion"] =  date ("d/m/Y", strtotime($row["fecha_creacion"]));
                
                
            }
            echo json_encode($output);
            }
    break;
    
    case "insertdetalle":
            $caso->detalle_caso($_POST["id_caso"], $_POST["id_usuario"], $_POST["desc_detalle"]);
    break;

    case "total";
        $datos=$caso->get_casos();  
        if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                    
                }
                echo json_encode($output);
            }   
    break;
            
    case "total_abierto";
                $datos=$caso->get_casos_abierto();  
                if(is_array($datos)==true and count($datos)>0){
                    foreach($datos as $row)
                    {
                        $output["TOTAL"] = $row["TOTAL"];
                        
                    }
                    echo json_encode($output);
                }   
    break;
    
    case "total_cerrado";
                $datos=$caso->get_casos_cerrado();  
                if(is_array($datos)==true and count($datos)>0){
                    foreach($datos as $row)
                    {
                        $output["TOTAL"] = $row["TOTAL"];
                        
                    }
                    echo json_encode($output);
                }   
    break;
    
    case "grafico";
        $datos=$caso->get_casos_grafico();  
        echo json_encode($datos);
    break;

    case "graficoestacion";
        $datos=$caso->get_casos_estacion();  
        echo json_encode($datos);
    break;
    
    case "graficogrupo";
        $datos=$caso->get_casos_grupo();  
        echo json_encode($datos);
    break;
    
    case "consultarhome":
                $datos=$caso->get_abiertos();
                $data=Array();
                foreach($datos as $row){
                    $sub_array=array();
                    $sub_array[]=$row["id_caso"];
                    $sub_array[] = $row["nombre_usuario"] . ' ' . $row["apellido_usuario"];
                    $sub_array[]=$row["nombre_grupo"];
                    $sub_array[]=$row["nombre_categoria"];
                    $sub_array[]=$row["titulo"];
                               
                    $sub_array[]=date("d/m/y ",strtotime($row["fecha_creacion"]));
                    
                    if($row["estado_caso"]=="Abierto"){
                        $sub_array[]='<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $sub_array[]='<span class="label label-pill label-danger">Cerrado</span>';
                        
                    }            
                    // $sub_array[] = '<button type="button" onClick="vista('.$row["id_caso"].');"  id="'.$row["id_caso"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                    $data[]=$sub_array;
                }
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);    
        
    break;
        
    case "consultar_casosopo":
                $datos=$caso->consulta_casosopo($_POST["id_usuario"]);
                $data=Array();
          foreach($datos as $row){
                    $sub_array=array();
                    $sub_array[]=$row["id_caso"];
                    $sub_array[] = $row["nombre_usuario"] . ' ' . $row["apellido_usuario"];
                    $sub_array[]=$row["nombre_grupo"];
                    $sub_array[]=$row["nombre_categoria"];
                    $sub_array[]=$row["titulo"];
                    
                    $sub_array[]=date("d/m/y ",strtotime($row["fecha_creacion"]));
                    
                    if($row["estado_caso"]=="Abierto"){
                        $sub_array[]='<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        // $sub_array[]='<span class="label label-pill label-danger">Cerrado</span>';
                    }  
                    $sub_array[] = '<button type="button" onClick="vista('.$row["id_caso"].');"  id="'.$row["id_caso"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                    $data[]=$sub_array;
                }
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);    
        
    break;

    case "consultar_casosopoc":
                $datos=$caso->consulta_casosopoc($_POST["id_usuario"]);
                $data=Array();
                foreach($datos as $row){
                    $sub_array=array();
                    $sub_array[]=$row["id_caso"];
                    $sub_array[] = $row["nombre_usuario"] . ' ' . $row["apellido_usuario"];
                    $sub_array[]=$row["nombre_grupo"];
                    $sub_array[]=$row["nombre_categoria"];
                    $sub_array[]=$row["titulo"];
                    
                    $sub_array[]=date("d/m/y ",strtotime($row["fecha_creacion"]));
                    
                    if($row["estado_caso"]=="Cerrado"){
                        $sub_array[]='<span class="label label-pill label-danger">Cerrado</span>';
                    }else{
                        
                    }  
                    //$sub_array[] = '<button type="button" onClick="vista('.$row["id_caso"].');"  id="'.$row["id_caso"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                    $data[]=$sub_array;
                }
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);    
        
    break;
        
    case "guardaralimentos":
        $datos=$caso->crear_casoalim($_POST["id_area"],$_POST["c_solicitante"],$_POST["id_evento"],$_POST["id_sumi"],$_POST["cantidad"],$_POST["desc_solicitud"],$_POST["id_usuario"]);
        
        if(is_array($datos) == true and count($datos)>0){
          foreach ($datos as $row) {
            $output["id_caso"] = $row["id_caso"];
            if (empty($_FILES['files']['name'])){

            }else{
                $countfiles =count($_FILES['files']['name']);
                $ruta ="../public/documentos_alimentacion/".$output["id_caso"]."/";
                $files_arr=array();

                if(!file_exists($ruta)){
                    mkdir($ruta,0777, true);
                }
                for($index =0; $index < $countfiles; $index++){
                    $doc1=$_FILES['files']['tmp_name'][$index];
                    $destino=$ruta.$_FILES['files']['name'][$index];

                    $documento->insert_document($output["id_caso"],$_FILES['files']['name'][$index]);

                    move_uploaded_file($doc1,$destino);

                }

            }

          }
        }
        echo json_encode($datos);
    break;    
    
    
    
    
    
    
    }
?>