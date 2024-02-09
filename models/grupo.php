<?php
    class Grupo extends conectar{

        public function get_grupo(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tb_grupos WHERE estado_grupo=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
    }
?>
