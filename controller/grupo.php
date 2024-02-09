<?php
require_once("../config/conexion.php");
require_once("../models/grupo.php");
$grupo= new Grupo();

switch($_GET["op"]){
    case "combo":
        $datos =$grupo->get_grupo();
        if(is_array($datos)==true and count($datos)>0){
            $html = "<option value='' selected disabled>Seleccione una grupo</option>";
            foreach($datos as $row) 
            {
                $html.="<option value='".$row['id_grupo']."'>".$row['nombre_grupo']."</option>";
            }
            echo $html;
        }

    break;    
}
