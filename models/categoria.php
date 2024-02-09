
<?php
    class categoria extends conectar{


        public function get_categoria($id_grupo){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tb_categoria WHERE id_grupo = ? AND estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_grupo);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
    }
?>

