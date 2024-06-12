<?php

require_once("ConeccionDB.php");
require_once("./modelo/Categoria_MDL.php");

class CategoriaCAD
{
	private $mensaje;
	private $sql;

	public function __construct()
	{
		$this->mensaje = "";
		$this->sql = "";
	}
	public function getMensaje()
	{
		return $this->mensaje;
	}


	public function listarCategorias()
	{
		$this->sql = "SELECT * FROM `categoria_noticia`";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();
		$resultado = $con->query($this->sql);
		$lista = array();
		while ($datos = $resultado->fetch_object()) {
			$objCateg = new Categoria();
			$objCateg->setId($datos->id_categoria);
			$objCateg->setNombre($datos->nombre);
			$lista[] = $objCateg;
		}
		$con->Close();
		return $lista;
	}
}
