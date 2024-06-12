<?php
require_once 'ConeccionDB.php';
require_once '../modelo/Rol.php';
class RolCAD {
   
    private $mensaje;
    private $sql;
    
    public function __construct() {
        $this->mensaje ="";
        $this->sql = "";
    }
    

    
     public function listar(){ 
     $this->sql = "SELECT * FROM `rol`";    
             
             $objConexion = new ConeccionDB();
             $con = $objConexion->conectarMysql();
             
             $resultado = $con->query($this->sql);
             
             $lista = array();
             
             while ($datos = $resultado->fetch_object()){
                 $objRol = new Rol();
                 $objRol->setId_rol($datos->id_rol);
                 $objRol->setNombre_rol($datos->nombre_rol);
                 
                 
                 $lista[] = $objRol;
             }
            
               $con->close();
               return $lista;
            
    }
    
    public  function getMensaje(){
    return $this->mensaje;
    }
}
