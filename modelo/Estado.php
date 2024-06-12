<?php


class Estado {
   
    private $id_estado;
    private $nombre;
    
    public function __construct() {
        $this->id_estado = "";
        $this->nombre = "";
    }
    
    function getId_estado() {
        return $this->id_estado;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId_estado($id_estado): void {
        $this->id_estado = $id_estado;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }



    
}
