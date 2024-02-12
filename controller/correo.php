<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Correo.php");
    $email = new Email();

    /* opciones del controlador */
    switch ($_GET["op"]) {
        /*  enviar ticket abierto con el ID */
        case "ticket_abierto":
            $email->ticket_abierto($_POST["id_caso"]);
            break;

        case "ticket_cerrado":
            $email->ticket_cerrado($_POST["id_caso"]);
            break;

        case "ticket_asignado":
            $email->ticket_asignado($_POST["id_caso"]);
            break;
    }
?>