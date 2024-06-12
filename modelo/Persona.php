<?php

class Persona {
   
    //Campos de la db
    
    private $id_persona;
    private $cedula;
    private $nombre_1;
    private $nombre_2;
    private $apellido_1;
    private $apellido_2;
    private $clave;
    private $telefono;
    private $direccion;
    private $fecha_nac;
    private $genero;
    private $correo;
    private $profesion;
    private $foto;
    private $id_rol;
    private $id_estado;


    public function __construct(){
        
        $this->id_persona = "";   
        $this->cedula = ""; 
        $this->nombre_1 = ""; 
        $this->nombre_2 = ""; 
        $this->apellido_1 = ""; 
        $this->apellido_2 = ""; 
        $this->clave = ""; 
        $this->telefono = ""; 
        $this->direccion = ""; 
        $this->fecha_nac = ""; 
        $this->genero = ""; 
        $this->correo = ""; 
        $this->profesion = ""; 
        $this->foto = ""; 
        $this->id_rol = ""; 
        $this->id_estado = ""; 
    }
    
    function getId_persona() {
        return $this->id_persona;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getNombre_1() {
        return $this->nombre_1;
    }

    function getNombre_2() {
        return $this->nombre_2;
    }

    function getApellido_1() {
        return $this->apellido_1;
    }

    function getApellido_2() {
        return $this->apellido_2;
    }

    function getClave() {
        return $this->clave;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getFecha_nac() {
        return $this->fecha_nac;
    }
    function getGenero() {
        return $this->genero;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getProfesion() {
        return $this->profesion;
    }

    function getFoto() {
        return $this->foto;
    }

    function getId_rol() {
        return $this->id_rol;
    }
      function getId_estado() {
        return $this->id_estado;
    }

    function setId_persona($id_persona): void {
        $this->id_persona = $id_persona;
    }

    function setCedula($cedula): void {
        $this->cedula = $cedula;
    }

    function setNombre_1($nombre_1): void {
        $this->nombre_1 = $nombre_1;
    }

    function setNombre_2($nombre_2): void {
        $this->nombre_2 = $nombre_2;
    }

    function setApellido_1($apellido_1): void {
        $this->apellido_1 = $apellido_1;
    }

    function setApellido_2($apellido_2): void {
        $this->apellido_2 = $apellido_2;
    }

    function setClave($clave): void {
        $this->clave = $clave;
    }

    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

    function setFecha_nac($fecha_nac): void {
        $this->fecha_nac = $fecha_nac;
    }
    
    function setGenero($genero): void {
        $this->genero = $genero;
    }

    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    function setProfesion($profesion): void {
        $this->profesion = $profesion;
    }

    function setFoto($foto): void {
        $this->foto = $foto;
    }

    function setId_rol($id_rol): void {
        $this->id_rol = $id_rol;
    }
    
    function setId_estado($id_estado): void {
        $this->id_estado = $id_estado;
    }


    
}
