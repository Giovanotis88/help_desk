<?php
require_once("../config/conexion.php");
require_once("../models/estaciones.php");
$estaciones= new Estaciones();

switch($_GET["op"]){
    case "combo":
        $datos =$estaciones->get_estaciones();
        if(is_array($datos)==true and count($datos)>0){
            $html = "<option value='' selected disabled>Seleccione una estación</option>";
            foreach($datos as $row) 
            {
                $html.="<option value='".$row['id_estacion']."'>".$row['nombre_estacion']."</option>";
            }
            echo $html;
        }

    break;    
}
