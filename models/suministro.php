<?php
    class Suministros extends conectar{

        public function get_suministro(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tb_suministros WHERE estado=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
    }
?>