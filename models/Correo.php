<?php
/* librerias necesarias para que el proyecto pueda enviar emails */
require('class.phpmailer.php');
include("class.smtp.php");

/* llamada de las clases necesarias que se usaran en el envio del mail */
require_once("../config/conexion.php");
require_once("../controller/Caso.php");

class Email extends PHPMailer{

    //variable que contiene el correo del destinatario
    protected $gCorreo = 'mesalogistica@bomberosbogota.gov.co';
    protected $gContrasena = 'Bogotalog*';
    //variable que contiene la contraseña del destinatario

    public function ticket_abierto($id_caso){
        $ticket = new Caso();
        $datos = $ticket->listar_ticket_x_id($id_caso);
        foreach ($datos as $row){
            
            $id = $row["id_caso"];
            $usu = $row["nombre_usuario"];
            $titulo = $row["titulo"];
            $grupo= $row["nombre_grupo"];
            $estacion=$row["nombre_estacion"];
            $categoria = $row["nombre_categoria"];
            $correo1 = $row["correoj_1"];
            $correo2 = $row["correoj_2"];
            $correo3 = $row["correoj_3"];
            $correo4 = $row["correoj_4"];
            $correo5 = $row["correoj_5"];
            $correo6 = $row["correoj_6"];
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = '';
        $this->FromName =  "Caso Creado Número ".$id;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo1);
        $this->addAddress($correo2);
        $this->addAddress($correo3);
        $this->addAddress($correo4);
        $this->addAddress($correo5);
        $this->addAddress($correo6);
        $this->addAddress($usu);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Caso Abierto Por medio de Mesa Logística #".$id;
        //Igual//
        $cuerpo = file_get_contents('../public/NuevoTicket.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblestacion", $estacion, $cuerpo);
        $cuerpo = str_replace("lblgrupo", $grupo, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Caso Abierto");
        return $this->Send();
    }

    public function ticket_cerrado($id_caso){
        $ticket = new Caso();
        $datos = $ticket->asignacion_grupo($id_caso);
        foreach ($datos as $row){
            $id = $row["id_caso"];
            $usu = $row["nombre_usuario"];
            $titulo = $row["titulo"];
            $grupo= $row["nombre_grupo"];
            $estacion=$row["nombre_estacion"];
            $categoria = $row["nombre_categoria"];
            $desc=$row["desc_solicitud"];
            $docu=$row["det_nom"];
            $correo1 = $row["correoj_1"];
            $correo2 = $row["correoj_2"];
            $correo3 = $row["correoj_3"];
            $correo4 = $row["correoj_4"];
            $correo5 = $row["correoj_5"];
            $correo6 = $row["correoj_6"];
            $correo7 = $row["correo_1"];
            $correo8 = $row["correo_2"];
            $correo9 = $row["correo_3"];
            $correo10 = $row["correo_4"];
            $correo11 = $row["correo_5"];
            $correo12 = $row["correo_6"];
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName = "Caso Cerrado Numero  ".$id;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo1);
        $this->addAddress($correo2);
        $this->addAddress($correo3);
        $this->addAddress($correo4);
        $this->addAddress($correo5);
        $this->addAddress($correo6);
        $this->addAddress($correo7);
        $this->addAddress($correo8);
        $this->addAddress($correo9);
        $this->addAddress($correo10);
        $this->addAddress($correo11);
        $this->addAddress($correo12);
        
        $archivo_adjunto = '../public/Documentos_Cierre/'.$id.'/'.$docu;
        
        $this->addAttachment($archivo_adjunto); // Agregar archivo adjunto

        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Caso cerrado Mesa Logística";
        //Igual//
        $cuerpo = file_get_contents('../public/CerradoTicket.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xsolicitante", $estacion, $cuerpo);
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblgrup", $grupo, $cuerpo);        
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);        
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);
        $cuerpo = str_replace("lbldeta", $desc, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Cerrado");
        return $this->Send();
    }

    public function ticket_asignado($tick_id){
        $ticket = new Caso();
        $datos = $ticket->asignacion_grupo($tick_id);
        foreach ($datos as $row){
            $id = $row["id_caso"];
            $estacion=$row["nombre_estacion"];
            $grupo= $row["nombre_grupo"];
            $usu = $row["nombre_usuario"];
            $titulo = $row["titulo"];
            $estacion=$row["nombre_estacion"];
            $categoria = $row["nombre_categoria"];
            $desc=$row["desc_solicitud"];
            $docu=$row["nombre_documento"];
            
            $correo1 = $row["correo_1"];
            $correo2 = $row["correo_2"];
            $correo3 = $row["correo_3"];
            $correo4 = $row["correo_4"];
            $correo5 = $row["correo_5"];
            $correo6 = $row["correo_6"];
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName =  "Caso Asignado Número" ." ".$id ."  ".$grupo;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo1);
        $this->addAddress($correo2);
        $this->addAddress($correo3);
        $this->addAddress($correo4);
        $this->addAddress($correo5);
        $this->addAddress($correo6);
        $archivo_adjunto = '../public/Documentos/'.$id.'/'.$docu;
        
        $this->addAttachment($archivo_adjunto); // Agregar archivo adjunto
        
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Caso Asignado Mesa Logística # ".$id;
        //Igual//
        $cuerpo = file_get_contents('../public/AsignarTicket.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        
        $cuerpo = str_replace("xsolicitante", $estacion, $cuerpo);
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblgrup", $grupo, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);
        $cuerpo = str_replace("lbldeta", $desc, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Caso Asignado");
        return $this->Send();
    }

    // ____________________________________________________________________________________________________________________________________________


    public function ticket_abiertoalime($id_caso){
        $ticket = new Caso();
        $datos = $ticket->listar_ticket_ali($id_caso);
        foreach ($datos as $row){
            
            $id = $row["id_caso"];
            $usu = $row["correo_solicitante"];
            $area= $row["area_solicitante"];
            $evento=$row["tipo_evento"];
            $suministro = $row["id_suministro"];
            $cantidad = $row["cantidad"];
            $desc = $row["desc_solicitud"];
           
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = '';
        $this->FromName =  "Caso Alimentación Creado Número ".$id;
        $this->CharSet = 'UTF8';
        $this->addAddress($usu);
        
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Caso Abierto Por medio de Mesa Logística #".$id;
        //Igual//
        $cuerpo = file_get_contents('../public/NuevoTicketAlimen.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblestacion", $area, $cuerpo);
        $cuerpo = str_replace("lblgrupo", $evento, $cuerpo);
        $cuerpo = str_replace("lblTitu", $suministro, $cuerpo);
        $cuerpo = str_replace("lblCate", $cantidad, $cuerpo);
        $cuerpo = str_replace("lbldeta", $desc, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Caso Abierto");
        return $this->Send();
    }

    public function ticket_asignadoalime($tick_id){
        $ticket = new Caso();
        $datos = $ticket->asignacion_alimentacion($tick_id);
        foreach ($datos as $row){
            $id = $row["id_caso"];
            $estacion=$row["nombre_estacion"];
            $grupo= $row["nombre_grupo"];
            $usu = $row["nombre_usuario"];
            $titulo = $row["titulo"];
            $estacion=$row["nombre_estacion"];
            $categoria = $row["nombre_categoria"];
            $desc=$row["desc_solicitud"];
            $docu=$row["nombre_documento"];
            
            $correo1 = $row["correo_1"];
            $correo2 = $row["correo_2"];
            $correo3 = $row["correo_3"];
            $correo4 = $row["correo_4"];
            $correo5 = $row["correo_5"];
            $correo6 = $row["correo_6"];
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName =  "Caso Asignado Número" ." ".$id ."  ".$grupo;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo1);
        $this->addAddress($correo2);
        $this->addAddress($correo3);
        $this->addAddress($correo4);
        $this->addAddress($correo5);
        $this->addAddress($correo6);
        $archivo_adjunto = '../public/Documentos/'.$id.'/'.$docu;
        
        $this->addAttachment($archivo_adjunto); // Agregar archivo adjunto
        
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Caso Asignado Mesa Logística # ".$id;
        //Igual//
        $cuerpo = file_get_contents('../public/AsignarTicket.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        
        $cuerpo = str_replace("xsolicitante", $estacion, $cuerpo);
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblgrup", $grupo, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);
        $cuerpo = str_replace("lbldeta", $desc, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Caso Asignado");
        return $this->Send();
    }

}

?>