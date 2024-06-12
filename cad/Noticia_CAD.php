<?php

require_once("ConeccionDB.php");
require_once("./modelo/Noticia_MDL.php");

class NoticiaCAD
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


	public function saveNoticia($objNotic)
	{
		$this->sql =
			"INSERT INTO `noticia`(`titulo`, `portada`, `descripcion`, `id_categoria`, `id_persona`)
			VALUES (
					'{$objNotic->getTitulo()}',
					'{$objNotic->getPortada()}',
					'{$objNotic->getDescipcion()}',
					'{$objNotic->getId_categoria()}',
					'{$objNotic->getAutor()}'
					)";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();
		if ($con->query($this->sql)) {
			$this->mensaje = "CAD dice: La noticia fue publicada";
			$con->close();
			return true;
		} else {
			$this->mensaje = "Error en CAD" . mysqli_error($con);
			$con->close();
			return false;
		}
	}

	public function yaExiste($titulo_noticia)
	{
		$this->sql =
			"SELECT * FROM `noticia` WHERE `titulo` = '$titulo_noticia'";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();
		$resultado = $con->query($this->sql);
		if ($resultado->num_rows > 0) {
			$this->mensaje = "CAD dice: La noticia ya existe";

			$con->close();
			return true;
		} else {
			$this->mensaje = "CAD dice: La noticia no existe" . mysqli_error($con);
			$con->close();
			return false;
		}
	}

	public function listarNoticias()
	{
		$this->sql = "SELECT * FROM `noticia` ORDER BY `noticia`.`fecha_hora` DESC";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();
		$resultado = $con->query($this->sql);
		$lista = array();

		while ($datos = $resultado->fetch_object()) {
			$objNotic = new Noticia();
			$objNotic->setId_noticia($datos->id);
			$objNotic->setPortada($datos->portada);
			$objNotic->setTitulo($datos->titulo);
			$objNotic->setDescipcion($datos->descripcion);
			$objNotic->setId_categoria($datos->id_categoria);
			$objNotic->setAutor($datos->id_persona);
			$objNotic->setFecha($datos->fecha_hora);
			$lista[] = $objNotic;
		}
		$con->Close();
		return $lista;
	}

	public function listarNoticias_x_Titulo($titulo)
	{
		$this->sql = "SELECT N.id, N.titulo,N.portada,N.descripcion,C.nombre categoria,CONCAT(P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2) autor, N.fecha_hora fecha 
		FROM noticia N
		INNER JOIN categoria_noticia C ON N.id_categoria=C.id_categoria
		INNER JOIN persona P ON N.id_persona=P.id_persona
		WHERE N.titulo = '$titulo'";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();

		$resultado = $con->query($this->sql);
		if ($resultado->num_rows > 0) {
			$datos = $resultado->fetch_object();
			$noti = new Noticia();
			$noti->setId_noticia($datos->id);
			$noti->setTitulo($datos->titulo);
			$noti->setPortada($datos->portada);
			$noti->setDescipcion($datos->descripcion);
			$noti->setId_categoria($datos->categoria);
			$noti->setAutor($datos->autor);
			$noti->setFecha($datos->fecha);
			$con->close();
			return $noti;
		} else {
			$this->mensaje = "CAD dice: La noticia {$titulo} no existe" . mysqli_error($con);
			$con->close();
			return null;
		}
	}

	public function listarNoticias_x_Id_noticia($id)
	{
		$this->sql = "SELECT n.*, cn.nombre as nombre_categoria FROM noticia n INNER JOIN categoria_noticia cn ON n.id_categoria=cn.id_categoria WHERE id = '$id'";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();

		$resultado = $con->query($this->sql);
		if ($resultado->num_rows > 0) { 
			$datos = $resultado->fetch_object();
			$noti = new Noticia();
			$noti->setId_noticia($datos->id);
			$noti->setTitulo($datos->titulo);
			$noti->setPortada($datos->portada);
			$noti->setDescipcion($datos->descripcion);
			$noti->setId_categoria($datos->id_categoria);
			$noti->setAutor($datos->id_persona);
			$noti->setFecha($datos->fecha_hora);
			$noti->setNombre_categoria($datos->nombre_categoria);
			$con->close();
			return $noti;
		} else {
			$this->mensaje = "CAD dice: La noticia {$id} no existe" . mysqli_error($con);
			$con->close();
			return null;
		}
	}

	public function listarNoticias_x_Categoria()
	{
		$this->sql = "SELECT N.id, N.titulo,N.portada,N.descripcion,C.nombre categoria,CONCAT(P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2) autor, N.fecha_hora fecha FROM noticia N INNER JOIN categoria_noticia C ON N.id_categoria=C.id_categoria INNER JOIN persona P ON N.id_persona=P.id_persona WHERE N.id_categoria = 3 ORDER BY `fecha_hora` DESC LIMIT 4";
		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();
		$resultado = $con->query($this->sql);
		$lista = array();

		while ($datos = $resultado->fetch_object()) {
			$noti = new Noticia();
			$noti->setId_noticia($datos->id);
			$noti->setTitulo($datos->titulo);
			$noti->setPortada($datos->portada);
			$noti->setDescipcion($datos->descripcion);
			$noti->setId_categoria($datos->categoria);
			$noti->setAutor($datos->autor);
			$noti->setFecha($datos->fecha);
			$lista[] = $noti;
		}
		$con->close();
		return $lista;
	}
public function updateNoticia($objNotic)
	{
		$this->sql =
			"UPDATE `noticia` SET `titulo`='{$objNotic->getTitulo()}',`descripcion`='{$objNotic->getDescipcion()}', `id_categoria`='{$objNotic->getId_categoria()}', `id_persona`='{$objNotic->getAutor()}' WHERE `id`='{$objNotic->getId_noticia()}' ";

		$objCon = new ConeccionDB();
		$con = $objCon->conectarMysql();
		if ($con->query($this->sql)) {
			$this->mensaje = "La noticia fue actualizada";
			$con->close();
			return true;
		} else {
			$this->mensaje = "Error en CAD" . mysqli_error($con);
			$con->close();
			return false;
		}
	}


 public function delete($id_noticia)
    {

        $this->sql = "DELETE FROM `noticia` WHERE `id` = '$id_noticia' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "La Noticia con el ID $id_noticia fue eliminado.";
            $con->close();

            return true;
        } else {
            $this->mensaje = "La Noticia con el ID $id_noticia no se pudo eliminar." . mysqli_error($con);
            $con->close();
            return false;
        }

        return true;
    }


}
