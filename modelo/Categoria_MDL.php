<?php
class Categoria
{
    //atributos
    private $id;
    private $nombre;

    //constructor
    public function __construct()
    {
        $this->id = "";
        $this->nombre = "";
    }

    // Setter y getters (set / get)
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
}
