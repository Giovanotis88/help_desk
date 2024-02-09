<?php
require_once("../config/conexion.php");
require_once("../models/usuario.php");

$usuario = new Usuario();

switch ($_GET["op"]) {
    case "guardar":
        if(empty($_POST["id_usuario"])){       
            $usuario->crear_usuario($_POST["nombre_usuario"],$_POST["apellido_usuario"],$_POST["usuario_correo"],$_POST["usuario_password"],$_POST["id_rol"]);     
        }
        else {
            $usuario->actualizar_usuario($_POST["id_usuario"],$_POST["nombre_usuario"],$_POST["apellido_usuario"],$_POST["usuario_correo"],$_POST["usuario_password"],$_POST["id_rol"]);
        }
        
        break;

        case "listar":
            $datos=$usuario->get_usuario();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["nombre_usuario"];
                $sub_array[] = $row["apellido_usuario"];
                $sub_array[] = $row["usuario_correo"];
                $sub_array[] = $row["usuario_password"];
                $sub_array[] = date('d-m-Y', strtotime($row["fecha_creacion"]));

                if ($row["id_rol"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-primary">Usuario</span>';
                }elseif ($row["id_rol"]=="2"){
                    $sub_array[] = '<span class="label label-pill label-success">Soporte</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Adminisrador</span>';
                }

                $sub_array[] = '<button type="button" onClick="editar('.$row["id_usuario"].');"  id="'.$row["id_usuario"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_usuario"].');"  id="'.$row["id_rol"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "eliminar":
            $usuario->eliminar_usuario($_POST["id_usuario"]);
        break;

        case "mostrar";
            $datos=$usuario->get_usuario_x_id($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["id_usuario"] = $row["id_usuario"];
                    $output["nombre_usuario"] = $row["nombre_usuario"];
                    $output["apellido_usuario"] = $row["apellido_usuario"];
                    $output["usuario_correo"] = $row["usuario_correo"];
                    $output["usuario_password"] = $row["usuario_password"];
                    $output["id_rol"] = $row["id_rol"];
                }
                echo json_encode($output);
            }   
        break;

        case "total";
        $datos=$usuario->get_usuario_x_casos($_POST["id_usuario"]);  
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row)
            {
                $output["TOTAL"] = $row["TOTAL"];
                
            }
            echo json_encode($output);
        }   
        break;
        
        case "total_abierto";
            $datos=$usuario->get_usuario_x_casos_abierto($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                    
                }
                echo json_encode($output);
            }   
        break;

        case "total_cerrado";
            $datos=$usuario->get_usuario_x_casos_cerrado($_POST["id_usuario"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                    
                }
                echo json_encode($output);
            }   
        break;
        
        case "grafico";
            $datos=$usuario->get_usuario_grafico($_POST["id_usuario"]);  
            echo json_encode($datos);
        break;
    
      
        
    
    }

?>