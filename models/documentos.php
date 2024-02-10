<?php

class Documento extends conectar{
    public function insert_document($id_caso,$nombre_documento){
        $conectar=parent::conexion();
        $sql="INSERT INTO tb_documentos (doc_id,id_caso,nombre_documento,fecha_creacion,estado)VALUES(null,?,?,now(),1)";
        $sql=$conectar->prepare($sql);
        $sql->bindParam(1,$id_caso);
        $sql->bindParam(2,$nombre_documento);
        $sql->execute();

    }

    public function get_doc_ticket ($id_caso){
        $conectar=parent::conexion();
        $sql="SELECT * FROM tb_documentos WHERE id_caso=?";
        $sql =$conectar->prepare($sql);
        $sql->bindParam(1,$id_caso);
        $sql->execute();
        return $resultado =$sql->fetchAll(PDO::FETCH_ASSOC);



    }

}


?>