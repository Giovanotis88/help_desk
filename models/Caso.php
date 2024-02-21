<?php
    class Caso extends conectar{

        public function crear_caso($titulo,$nombre_solicitante,$id_estacion,$id_grupo,$id_categoria,$desc_solicitud,$id_usuario){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tb_casos (id_caso,fecha_creacion,titulo, nombre_solicitante, id_estacion, id_grupo, id_categoria, desc_solicitud,estado_caso, estado, id_usuario) VALUES (NULL,now(), ?, ?, ?, ?, ?, ?,'Abierto', '1', ?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $titulo);
            $sql->bindValue(2, $nombre_solicitante);
            $sql->bindValue(3, $id_estacion);
            $sql->bindValue(4, $id_grupo);
            $sql->bindValue(5, $id_categoria);
            $sql->bindValue(6, $desc_solicitud);
            $sql->bindValue(7, $id_usuario);
            $sql->execute();

            $sql1="select last_insert_id() as 'id_caso'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(PDO::FETCH_ASSOC);

        }

        public function crear_casoalim($area_solicitante,$correo_solicitante,$tipo_evento,$id_suministro,$cantidad,$desc_solicitud,$id_usuario){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO casos_alimentacion (id_caso, area_solicitante, correo_solicitante, tipo_evento, id_suministro, cantidad, desc_solicitud, fecha_creacion, estado_caso, estado, id_usuario) VALUES (NULL, ?, ?, ?, ?, ?, ?, now(), 'Abierto', '1', ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_solicitante);
            $sql->bindValue(2, $correo_solicitante);
            $sql->bindValue(3, $tipo_evento);
            $sql->bindValue(4, $id_suministro);
            $sql->bindValue(5, $cantidad);
            $sql->bindValue(6, $desc_solicitud);
            $sql->bindValue(7, $id_usuario);
            $sql->execute();

            $sql1="select last_insert_id() as 'id_caso'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(PDO::FETCH_ASSOC);

        }

        public function consulta_caso($id_usuario){

                $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria, tb_grupos.nombre_grupo  FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario INNER JOIN tb_grupos ON tb_casos.id_grupo=tb_grupos.id_grupo  WHERE tb_casos.estado = 1 AND tb_usuarios.id_usuario=?";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $id_usuario);
                $sql->execute();
                return $resultado=$sql->fetchAll();
           
    }
        public function consulta(){

            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria, tb_grupos.nombre_grupo FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario INNER JOIN tb_grupos ON tb_casos.id_grupo=tb_grupos.id_grupo WHERE tb_casos.estado = 1 ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
    }
        public function detalle_x_caso($id_caso){

            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_detallecaso.id_casodesc,tb_detallecaso.desc_detalle,tb_detallecaso.fecha_creacion,tb_usuarios.nombre_usuario,tb_usuarios.apellido_usuario, tb_usuarios.id_rol FROM tb_detallecaso INNER JOIN tb_usuarios ON tb_detallecaso.id_usuario = tb_usuarios.id_usuario WHERE tb_detallecaso.id_caso =? ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function listar_ticket_x_id($id_caso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            tb_casos.id_caso, 
            tb_casos.id_usuario, 
            tb_casos.id_categoria, 
            tb_casos.titulo, 
            tb_casos.desc_solicitud, 
            tb_casos.estado_caso, 
            tb_casos.fecha_creacion, 
            tb_usuarios.nombre_usuario, 
            tb_usuarios.apellido_usuario, 
            tb_usuarios.usuario_correo, 
            tb_categoria.nombre_categoria, 
            tb_grupos.id_grupo, 
            tb_grupos.nombre_grupo, 
            tb_estaciones.id_estacion,
            tb_estaciones.nombre_estacion, 
            tb_estaciones.correoj_1,
            tb_estaciones.correoj_2,
            tb_estaciones.correoj_3,
            tb_estaciones.correoj_4,
            tb_estaciones.correoj_5,
            tb_estaciones.correoj_6 
            FROM 
            tb_casos 
            INNER JOIN 
            tb_estaciones ON tb_casos.id_estacion = tb_estaciones.id_estacion  
            INNER JOIN 
            tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria 
            INNER JOIN 
            tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario 
            INNER JOIN 
            tb_grupos ON tb_casos.id_grupo = tb_grupos.id_grupo 
            WHERE 
            tb_casos.estado = 1 
            AND tb_casos.id_caso = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function asignacion_grupo($id_caso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            tb_casos.id_caso, 
            tb_casos.id_usuario, 
            tb_casos.id_categoria, 
            tb_casos.titulo, 
            tb_casos.desc_solicitud, 
            tb_casos.estado_caso, 
            tb_casos.fecha_creacion, 
            tb_usuarios.nombre_usuario, 
            tb_usuarios.apellido_usuario, 
            tb_usuarios.usuario_correo, 
            tb_categoria.nombre_categoria, 
            tb_grupos.id_grupo, 
            tb_grupos.nombre_grupo, 
            tb_estaciones.id_estacion,
            tb_estaciones.nombre_estacion, 
            tb_grupos.correo_1,
            tb_grupos.correo_2,
            tb_grupos.correo_3,
            tb_grupos.correo_4,
            tb_grupos.correo_5,
            tb_grupos.correo_6,
            tb_documentos.nombre_documento,
            tb_documentos.id_caso,
            tb_documento_detalle.det_nom,
            tb_documento_detalle.id_caso
            
            FROM 
            tb_casos 
            INNER JOIN 
            tb_estaciones ON tb_casos.id_estacion = tb_estaciones.id_estacion  
            INNER JOIN 
            tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria 
            INNER JOIN 
            tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario 
            INNER JOIN 
            tb_grupos ON tb_casos.id_grupo = tb_grupos.id_grupo 
            INNER JOIN 
            tb_documentos ON tb_casos.id_caso =tb_documentos.id_caso
            INNER JOIN 
            tb_documento_detalle ON tb_casos.id_caso =tb_documento_detalle.id_caso
            WHERE 
            tb_casos.estado = 1 
            AND tb_casos.id_caso = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function detalle_caso($id_caso,$id_usuario,$desc_detalle){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tb_detallecaso (id_casodesc,id_caso,id_usuario, desc_detalle, fecha_creacion, estado) VALUES (NULL, ?, ?, ?,now(), '1')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->bindValue(2, $id_usuario);
            $sql->bindValue(3, $desc_detalle);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function actualizar($id_caso){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tb_casos SET estado_caso='Cerrado' WHERE id_caso=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function cerrar($id_caso,$id_usuario,$desc_detalle){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tb_detallecaso (id_casodesc,id_caso,id_usuario, desc_detalle, fecha_creacion, estado) VALUES (NULL, ?, ?, ?,now(), '2')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->bindValue(2, $id_usuario);
            $sql->bindValue(3, $desc_detalle);
            $sql->execute();
            // return $resultado=$sql->fetchAll();
            $sql1="select last_insert_id() as 'id_caso'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(PDO::FETCH_ASSOC);


        }

        public function get_casos() {
            $conectar = parent::conexion();
            parent::set_names();
            
            $sql = "SELECT COUNT(*) as TOTAL FROM tb_casos ";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_casos_abierto(){
            $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT COUNT(*) as TOTAL FROM tb_casos WHERE  estado_caso='Abierto'";
                $sql=$conectar->prepare($sql);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }

        public function get_casos_cerrado(){
            $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT COUNT(*) as TOTAL FROM tb_casos WHERE  estado_caso='Cerrado'";
                $sql=$conectar->prepare($sql);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }

        public function get_casos_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tb_categoria.nombre_categoria as nom, COUNT(*) AS total FROM tb_casos JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria WHERE tb_casos.estado = 1 GROUP BY tb_categoria.nombre_categoria ORDER BY total DESC;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

         public function get_casos_estacion() {
             $conectar = parent::conexion();
             parent::set_names();
             $sql = "SELECT tb_estaciones.nombre_estacion as nom, COUNT(*) AS total 
                         FROM tb_casos 
                          JOIN tb_estaciones ON tb_casos.id_estacion = tb_estaciones.id_estacion 
                          WHERE tb_casos.estado = 1 
                          GROUP BY tb_estaciones.nombre_estacion 
                          ORDER BY total DESC";
             $sql = $conectar->prepare($sql);
             $sql->execute();
             return $resultado = $sql->fetchAll();
        
        
         }

         public function get_casos_grupo() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT tb_grupos.nombre_grupo as nom, COUNT(*) AS total 
                     FROM tb_casos 
                     JOIN tb_grupos ON tb_casos.id_grupo = tb_grupos.id_grupo 
                     WHERE tb_casos.estado = 1 
                     GROUP BY tb_grupos.nombre_grupo 
                    ORDER BY total DESC";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
       
       
        }
        
        public function get_abiertos(){
            $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT 
                tb_casos.id_caso, 
                tb_casos.fecha_creacion,
                tb_casos.id_usuario, 
                tb_casos.id_categoria, 
                tb_casos.titulo, 
                tb_casos.desc_solicitud,
                tb_casos.estado_caso,
                tb_casos.id_grupo,
                tb_usuarios.nombre_usuario, 
                tb_usuarios.apellido_usuario, 
                tb_categoria.nombre_categoria,
                tb_grupos.nombre_grupo
            FROM 
                tb_casos 
            INNER JOIN 
                tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria 
            INNER JOIN 
                tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario 
            INNER JOIN
                tb_grupos 	ON  tb_casos.id_grupo = tb_grupos.id_grupo
            WHERE 
                tb_casos.estado = 1 AND 
                tb_casos.estado_caso = 'Abierto';
            ";
                $sql=$conectar->prepare($sql);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }

        public function consulta_soporte($id_usuario){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario WHERE tb_casos.estado = 1 AND tb_usuarios.id_usuario=? AND tb_casos.estado_caso='Abierto';";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
       
}
        public function consulta_casosopo($id_usuario){

            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso,tb_casos.id_grupo, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria, tb_grupos.nombre_grupo FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario INNER JOIN tb_grupos ON tb_casos.id_grupo=tb_grupos.id_grupo WHERE tb_casos.estado = 1 AND tb_usuarios.id_usuario=? AND tb_casos.estado_caso='Abierto';";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

}
        public function consulta_casosopoc($id_usuario){

            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_casos.id_caso, tb_detallecaso.fecha_creacion, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud, tb_casos.estado_caso, tb_casos.id_grupo, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria, tb_grupos.nombre_grupo, tb_detallecaso.id_usuario, tb_detallecaso.desc_detalle FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario INNER JOIN tb_detallecaso ON tb_casos.id_caso = tb_detallecaso.id_caso INNER JOIN tb_grupos ON tb_casos.id_grupo = tb_grupos.id_grupo WHERE tb_casos.estado = 1 AND tb_detallecaso.id_usuario = ? AND tb_detallecaso.estado=2;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();     

        } 

        // __________________________________________________________________________________________________________________________________________
        // Consultas Alimentacion
        public function listar_ticket_ali($id_caso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT casos_alimentacion.id_caso,
            casos_alimentacion.correo_solicitante,
            casos_alimentacion.area_solicitante,
            casos_alimentacion.tipo_evento,
            casos_alimentacion.id_suministro,
            casos_alimentacion.cantidad,
            casos_alimentacion.desc_solicitud,
            casos_alimentacion.fecha_creacion,
            casos_alimentacion.estado_caso,
            casos_alimentacion.id_usuario,
            tb_suministros.nom_suministro,
            tb_suministros.id_suministro
            FROM
            casos_alimentacion
            INNER JOIN
            tb_suministros ON casos_alimentacion.id_suministro= tb_suministros.id_suministro
            WHERE
            casos_alimentacion.estado=1
            AND
            casos_alimentacion.id_caso=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }

?>