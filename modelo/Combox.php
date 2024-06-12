<?php


class Combox {
 
    private $id_ficha_grupo;
    private $nombre_grupo;
    private $id_padre;
    private $id_madre;
    private $foto_madre;
    private $foto_padre;
    private $foto_alumno;

    private $id_instructor;
    private $id_alumno;
    private $id_materia;
    private $id_jornada;
    private $nombre_completo;
    private $materia;
    private $nom_grupo;
    Private $jornada;
    Private $cedula;




    public function __construct() {
        $this->id_ficha_grupo= "";
        $this->nombre_grupo = "";
        $this->id_padre ="";
        $this->id_madre ="";
        $this->id_instructor ="";
        $this->nombre_completo = "";
        $this->id_alumno = "";
        $this->id_materia = "";
        $this->materia = "";
        $this->nom_grupo = "";
        $this->id_jornada = "";
        $this->jornada = "";
        $this->cedula = "";
        $this->foto_alumno = "";
               
        
    }
    
    function getId_ficha_grupo() {
        return $this->id_ficha_grupo;
    }
    function getFotoAlum() {
        return $this->foto_alumno;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getNombre_grupo() {
        return $this->nombre_grupo;
    }

    function setIdCedula($cedula): void {
        $this->cedula = $cedula;
    }
    function setFotoAlm($foto_alumno): void {
        $this->foto_alumno = $foto_alumno;
    }
    function setId_ficha_grupo($id_ficha_grupo): void {
        $this->id_ficha_grupo = $id_ficha_grupo;
    }

    function setNombre_grupo($nombre_grupo): void {
        $this->nombre_grupo = $nombre_grupo;
    }
    
    function getId_padre() {
        return $this->id_padre;
    }

    function getNombre_completo() {
        return $this->nombre_completo;
    }
    
     function getId_madre() {
        return $this->id_madre;
    }
    
    function setId_madre($id_madre): void {
        $this->id_madre = $id_madre;
    }

    function setId_padre($id_padre): void {
        $this->id_padre = $id_padre;
    }

    function setNombre_completo($nombre_completo): void {
        $this->nombre_completo = $nombre_completo;
    }

    function setFotoMadre($foto_madre): void {
        $this->foto_madre = $foto_madre;
    }
    function getFotoMadre() {
        return $this->foto_madre;
    }
    
    function setFotoPadre($foto_padre): void {
        $this->foto_padre = $foto_padre;
    }
    function getFotoPadre() {
        return $this->foto_padre;
    }


    function getId_instructor() {
        return $this->id_instructor;
    }

    function setId_instructor($id_instructor): void {
        $this->id_instructor = $id_instructor;
    }

    function getId_alumno() {
        return $this->id_alumno;
    }

    function setId_alumno($id_alumno): void {
        $this->id_alumno = $id_alumno;
    }


    function getId_materia() {
        return $this->id_materia;
    }

    function getMateria() {
        return $this->materia;
    }

    function setId_materia($id_materia): void {
        $this->id_materia = $id_materia;
    }

    function setMateria($materia): void {
        $this->materia = $materia;
    }
    
    function getNom_grupo() {
        return $this->nom_grupo;
    }

    function setNom_grupo($nom_grupo): void {
        $this->nom_grupo = $nom_grupo;
    }

    function getId_jornada() {
        return $this->id_jornada;
    }

    function setId_jornada($id_jornada): void {
        $this->id_jornada = $id_jornada;
    }


    function getJornada() {
        return $this->jornada;
    }

    function setJornada($jornada): void {
        $this->jornada = $jornada;
    }


}
