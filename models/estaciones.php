<?php
    class Estaciones extends conectar{

        public function get_estaciones(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tb_estaciones WHERE estado_estacion=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
    }
?>

