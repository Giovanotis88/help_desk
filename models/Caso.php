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
            return $resultado=$sql->fetchAll();

        }
        public function consulta_caso($id_usuario){

                $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario WHERE tb_casos.estado = 1 AND tb_usuarios.id_usuario=?";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $id_usuario);
                $sql->execute();
                return $resultado=$sql->fetchAll();
           
    }
        public function consulta(){

            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario WHERE tb_casos.estado = 1 ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
    }
        public function detalle_x_caso($id_caso){

            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tb_detallecaso.id_casodesc,tb_detallecaso.desc_detalle,tb_detallecaso.fecha_creacion,tb_usuarios.nombre_usuario,tb_usuarios.apellido_usuario, tb_usuarios.id_rol FROM tb_detallecaso INNER JOIN tb_usuarios ON tb_detallecaso.id_usuario = tb_usuarios.id_usuario WHERE tb_detallecaso.id_caso =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function listar_ticket_x_id($id_caso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tb_casos.id_caso, tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud, tb_casos.estado_caso, tb_casos.fecha_creacion, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_usuarios.usuario_correo, tb_categoria.nombre_categoria, tb_grupos.id_grupo, tb_grupos.nombre_grupo FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario INNER JOIN tb_grupos ON tb_casos.id_grupo = tb_grupos.id_grupo WHERE tb_casos.estado = 1 AND tb_casos.id_caso = ?;";
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
        public function cerrar($id_caso,$id_usuario){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tb_detallecaso (id_casodesc,id_caso,id_usuario, desc_detalle, fecha_creacion, estado) VALUES (NULL, ?, ?, 'Caso Cerrado',now(), '1')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_caso);
            $sql->bindValue(2, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();



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
                $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario WHERE tb_casos.estado = 1 and tb_casos.estado_caso='Abierto'";
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
            $sql="SELECT tb_casos.id_caso, tb_casos.fecha_creacion,tb_casos.id_usuario, tb_casos.id_categoria, tb_casos.titulo, tb_casos.desc_solicitud,tb_casos.estado_caso, tb_usuarios.nombre_usuario, tb_usuarios.apellido_usuario, tb_categoria.nombre_categoria FROM tb_casos INNER JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria INNER JOIN tb_usuarios ON tb_casos.id_usuario = tb_usuarios.id_usuario WHERE tb_casos.estado = ? AND tb_usuarios.id_usuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

}


        
        
    }

?>