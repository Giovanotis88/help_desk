<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/documentos.php");
    $documento = new Documento();

   
    switch($_GET["op"]){
        
        case "listar":
            $datos=$documento->get_doc_ticket($_POST["id_caso"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = '<a href="../../public/documentos/'.$_POST["id_caso"].'/'.$row["nombre_documento"].'" target="_blank">'.$row["nombre_documento"].'</a>';
                $sub_array[] = '<a type="button" href="../../public/documentos/'.$_POST["id_caso"].'/'.$row["nombre_documento"].'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></a>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
    }
?>
