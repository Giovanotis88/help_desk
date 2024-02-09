<?php

session_start();
class conectar{
    protected $dbh;
    protected function conexion(){
        try{
            $conectar=$this->dbh=new PDO("mysql:host=localhost;dbname=helpdesk","root","");
            return $conectar;
        }catch(Exception $e){
            print "¡Error de conexión!:" .$e->getMessage()."<br/>";
            die();
    }
}

public function set_names(){
    return $this->dbh->query("SET NAMES 'utf8'") ;
}
public static function ruta(){

    return "http://localhost/help_desk/"; 
    
}

} 

?>