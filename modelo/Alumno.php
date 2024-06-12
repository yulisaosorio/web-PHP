<?php

class Alumno {
   
    //Campos de la db
    
    private $id_alumno;
    private $identificacion;
    private $nombre_1;
    private $nombre_2;
    private $apellido_1;
    private $apellido_2;
    private $fecha_nac;
    private $edad;
    private $id_padre;
    private $id_madre;
    private $id_estado;
    private $foto;
    private $id_ficha_grupo;
    private $id_persona;

    private $foto_padres;
    


    public function __construct(){
        
        $this->id_persona = "";
        $this->id_alumno = "";   
        $this->identificacion = ""; 
        $this->nombre_1 = ""; 
        $this->nombre_2 = ""; 
        $this->apellido_1 = ""; 
        $this->apellido_2 = ""; 
        $this->fecha_nac = ""; 
        $this->edad = ""; 
        $this->id_padre = ""; 
        $this->id_madre = ""; 
        $this->id_estado = ""; 
        $this->foto = ""; 
        $this->id_ficha_grupo = ""; 
       
    }
    
    function getId_alumno() {
        return $this->id_alumno;
    }

    function getIdentificacion() {
        return $this->identificacion;
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

    function getFecha_nac() {
        return $this->fecha_nac;
    }

    function getEdad() {
        return $this->edad;
    }

    function getId_padre() {
        return $this->id_padre;
    }

    function getId_madre() {
        return $this->id_madre;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function getFoto() {
        return $this->foto;
    }

    function getId_ficha_grupo() {
        return $this->id_ficha_grupo;
    }

    function setId_alumno($id_alumno): void {
        $this->id_alumno = $id_alumno;
    }

    function setIdentificacion($identificacion): void {
        $this->identificacion = $identificacion;
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

    function setFecha_nac($fecha_nac): void {
        $this->fecha_nac = $fecha_nac;
    }

    function setEdad($edad): void {
        $this->edad = $edad;
    }

    function setId_padre($id_padre): void {
        $this->id_padre = $id_padre;
    }

    function setId_madre($id_madre): void {
        $this->id_madre = $id_madre;
    }

    function setId_estado($id_estado): void {
        $this->id_estado = $id_estado;  
    }

    function setFoto($foto): void {
        $this->foto = $foto;
    }

    function setId_ficha_grupo($id_ficha_grupo): void {
        $this->id_ficha_grupo = $id_ficha_grupo;
    }
    function getId_persona() {
        return $this->id_persona;
    }

    function setId_persona($id_persona): void {
        $this->id_persona = $id_persona;
    }



    
}
