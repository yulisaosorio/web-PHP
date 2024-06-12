<?php 
class Noticia{
    //atributos
	private $id_noticia;
	private $titulo;
	private $descipcion;
	private $id_categoria;
	private $autor;
	private $portada;
	private $fecha;
	private $hora;
	private $nombre_categoria;


    
    //constructor
    public function __construct(){
        $this->id_noticia = "";
        $this->titulo = "";
        $this->portada = "";
        $this->descipcion = "";
        $this->id_categoria = "";
        $this->autor = "";
        $this->fecha = "";
        $this->hora = "";
        $this->nombre_categoria = "";
    }

    // Setter y getters (set / get)
    public function setId_noticia($id_noticia){
		$this->id_noticia = $id_noticia;
	}
	public function getId_noticia(){
		return $this->id_noticia;
	}

    public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function getTitulo(){
		return $this->titulo;
	}
    public function setPortada($portada){
		$this->portada = $portada;
	}
	public function getPortada(){
		return $this->portada;
	}

    public function setDescipcion($descipcion){
		$this->descipcion = $descipcion;
	}
	public function getDescipcion(){
		return $this->descipcion;
	}

    public function setId_categoria($id_categoria){
		$this->id_categoria = $id_categoria;
	}
	public function getId_categoria(){
		return $this->id_categoria;
	}

    public function setAutor($autor){
		$this->autor = $autor;
	}
	public function getAutor(){
		return $this->autor;
	}

    public function setFecha($fecha){
		$this->fecha = $fecha;
	}
	public function getFecha(){
		return $this->fecha;
	}

    public function setHora($hora){
		$this->hora = $hora;
	}
	public function getHora(){
		return $this->hora;
	}
	
    public function setNombre_categoria($nombre_categoria){
		$this->nombre_categoria = $nombre_categoria;
	}
	public function getNombre_categoria(){
		return $this->nombre_categoria;
	}










}
