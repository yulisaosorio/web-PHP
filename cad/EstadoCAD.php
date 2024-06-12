<?php
require_once 'ConeccionDB.php';
require_once '../modelo/Estado.php';
class EstadoCAD {
   
    private $mensaje;
    private $sql;
    
    public function __construct() {
        $this->mensaje ="";
        $this->sql = "";
    }
    

    
     public function listar(){ 
     $this->sql = "SELECT * FROM `estado`";    
             
             $objConexion = new ConeccionDB();
             $con = $objConexion->conectarMysql();
             
             $resultado = $con->query($this->sql);
             
             $lista = array();
             
             while ($datos = $resultado->fetch_object()){
                 $objEstado = new Estado();
                 $objEstado->setId_estado($datos->id_estado);
                 $objEstado->setNombre($datos->nombre);
                 
                 
                 $lista[] = $objEstado;
             }
            
               $con->close();
               return $lista;
            
    }
    
    public  function getMensaje(){
    return $this->mensaje;
    }
}
