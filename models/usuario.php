<?php
    
    class usuario extends conectar{
        public function login(){
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usuario_correo"];
                $password = $_POST["usuario_password"];
                $rol = $_POST["id_rol"];
                 if(empty($correo) and empty($password)){
                    header("Location:".conectar::ruta()."index.php?m=2");
					exit();
                }else{
                    $sql="SELECT * FROM tb_usuarios WHERE usuario_correo=? and usuario_password=? and id_rol=? and estado=1;";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    $stmt->bindValue(2, $password);
                    $stmt->bindValue(3, $rol);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if(is_array($resultado)and count($resultado)>0){
                        $_SESSION["id_usuario"]=$resultado["id_usuario"];
                        $_SESSION["nombre_usuario"]=$resultado["nombre_usuario"];
                        $_SESSION["apellido_usuario"]=$resultado["apellido_usuario"];
                        $_SESSION["id_rol"]=$resultado["id_rol"];
                        header("location:".conectar::ruta()."view/home/");
                        exit();
                    }else{
                        header("location:".conectar::ruta()."index.php?m=1");
                        exit();

                    }



                }


            }
        }

    public function crear_usuario($nombre_usuario,$apellido_usuario,$usuario_correo,$usuario_password,$id_rol){
        $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tb_usuarios (id_usuario, nombre_usuario, apellido_usuario, usuario_correo, usuario_password, id_rol, fecha_creacion, fecha_modificacion, fecha_eliminacion, estado) VALUES (NULL, ?, ?, ?, ?, ?, now(), NULL, NULL, '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombre_usuario);
            $sql->bindValue(2, $apellido_usuario);
            $sql->bindValue(3, $usuario_correo);
            $sql->bindValue(4, $usuario_password);
            $sql->bindValue(5, $id_rol);
            $sql->execute();
            return $resultado = $sql->fetchAll();

    }
    public function actualizar_usuario($id_usuario,$nombre_usuario,$apellido_usuario,$usuario_correo,$usuario_password,$id_rol){
        $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tb_usuarios set nombre_usuario=?,apellido_usuario=?,usuario_correo=?,usuario_password=?,id_rol=? where id_usuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombre_usuario);
            $sql->bindValue(2, $apellido_usuario);
            $sql->bindValue(3, $usuario_correo);
            $sql->bindValue(4, $usuario_password);
            $sql->bindValue(5, $id_rol);
            $sql->bindValue(6, $id_usuario);
            $success = $sql->execute();

    
             return $success;




    }
    public function eliminar_usuario($id_usuario){
        $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tb_usuarios SET estado='0', fecha_eliminacion=now() where id_usuario=? ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
           
        }

        public function get_usuario(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tb_usuarios where estado='1' ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuario_x_id($id_usuario){
            $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT * FROM tb_usuarios where id_usuario=?";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $id_usuario);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }

        public function get_usuario_x_casos($id_usuario) {
            $conectar = parent::conexion();
            parent::set_names();
            
            $sql = "SELECT COUNT(*) as TOTAL FROM tb_casos WHERE id_usuario=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        
        

        public function get_usuario_x_casos_abierto($id_usuario){
            $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT COUNT(*) as TOTAL FROM tb_casos WHERE id_usuario=? and estado_caso='Abierto'";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $id_usuario);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }

        public function get_usuario_x_casos_cerrado($id_usuario){
            $conectar=parent::conexion();
                parent::set_names();
                $sql="SELECT COUNT(*) as TOTAL FROM tb_detallecaso WHERE id_usuario=? and desc_detalle= 'Caso Cerrado';";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $id_usuario);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }

        public function get_usuario_grafico($id_usuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tb_categoria.nombre_categoria as nom, COUNT(*) AS total FROM tb_casos JOIN tb_categoria ON tb_casos.id_categoria = tb_categoria.id_categoria WHERE tb_casos.estado = 1 AND tb_casos.id_usuario =? GROUP BY tb_categoria.nombre_categoria ORDER BY total DESC;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

    }
?>