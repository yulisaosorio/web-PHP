<?php


class Rol {
 
    private $id_rol;
    private $nombre_rol;
   
    
    
    public function __construct() {
        $this->id_rol = "";
        $this->nombre_rol = "";
               
        
    }
    
    function getId_rol() {
        return $this->id_rol;
    }

    function getNombre_rol() {
        return $this->nombre_rol;
    }

    function setId_rol($id_rol): void {
        $this->id_rol = $id_rol;
    }

    function setNombre_rol($nombre_rol): void {
        $this->nombre_rol = $nombre_rol;
    }

      
}
