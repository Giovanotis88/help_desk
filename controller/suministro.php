<?php
require_once("../config/conexion.php");
require_once("../models/suministro.php");
$suministros= new Suministros();

switch($_GET["op"]){
    case "combo":
        $datos =$suministros->get_suministro();
        if(is_array($datos)==true and count($datos)>0){
            $html = "<option value='' selected disabled>Seleccione el Suministro</option>";
            foreach($datos as $row) 
            {
                $html.="<option value='".$row['id_suministro']."'>".$row['nom_suministro']."</option>";
            }
            echo $html;
        }

    break;    
}