<?php
require_once("../config/conexion.php");
require_once("../models/categoria.php");

$categoria = new Categoria();

switch ($_GET["op"]) {
    case "combo":
        $datos = $categoria->get_categoria($_POST["id_grupo"]);
        $html="";
        //$html.="<option label='Seleccionar'></option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                
                $html.= "<option value='".$row['id_categoria']."'>".$row['nombre_categoria']."</option>";
                
            }
            echo $html;
        }
        break;
}

?>

