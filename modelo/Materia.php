<?php

class Materia {
 
    private $id_materia;
    private $id_alumno;
    private $id_nota;
    private $nota_1;
    private $nota_2;
    private $nombre_materia;
    private  $id_instructor;


    public function __construct() {
        
        $this->id_materia = "";
        $this->nombre_materia = "";
        $this->id_instructor = "";
        $this->id_alumno = "";
        $this->nota_1= "";
        $this->nota_2= "";
        $this->id_nota= "";
        
    }
    
    function getId_materia() {
        return $this->id_materia;
    }

    function getNombre_materia() {
        return $this->nombre_materia;
    }

    function getId_instructor() {
        return $this->id_instructor;
    }

    function setId_materia($id_materia): void {
        $this->id_materia = $id_materia;
    }

    function setNombre_materia($nombre_materia): void {
        $this->nombre_materia = $nombre_materia;
    }

    function setId_instructor($id_instructor): void {
        $this->id_instructor = $id_instructor;
    }

    function getId_alumno() {
        return $this->id_alumno;
    }

    function getId_nota() {
        return $this->id_nota;
    }

    function getNota_1() {
        return $this->nota_1;
    }

    function getNota_2() {
        return $this->nota_2;
    }

    function setId_alumno($id_alumno): void {
        $this->id_alumno = $id_alumno;
    }

    function setId_nota($id_nota): void {
        $this->id_nota = $id_nota;
    }

    function setNota_1($nota_1): void {
        $this->nota_1 = $nota_1;
    }

    function setNota_2($nota_2): void {
        $this->nota_2 = $nota_2;
    }


    
}