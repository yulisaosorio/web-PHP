<?php


require_once 'ConeccionDB.php';
require_once '../modelo/Combox.php';


class GrupoCAD
{

    private $mensaje;
    private $sql;


    public function __construct()
    {

        $this->mensaje = "";
        $this->sql = "";
    }

    public function save($p)
    {

        $this->sql = "INSERT INTO `ficha_grupo`(`id_ficha_grupo`, `nom_grupo`, `id_instructor`, `id_jornada`)"
            . "VALUES (null,'{$p->getNom_grupo()}','{$p->getId_instructor()}','{$p->getId_jornada()}')";

        $objConexion = new ConeccionDB;
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {

            $this->mensaje = "Se registro correctamente el grupo {$p->getNom_grupo()} .";
            $con->close();
            return true;
        } else {

            $this->mensaje = "No se pudo hacer el registro.";
            $con->close();
            return false;
        }
    }

    public function yaExiste($id_ficha_grupo)
    {
        $this->sql = "SELECT * FROM `ficha_grupo` WHERE `id_ficha_grupo` = '$id_ficha_grupo' ";

        $objConexion = new ConeccionDB;
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);

        if ($resultado->num_rows == 1) {
            $this->mensaje = "La id $id_ficha_grupo ya esta registrada.";
            $con->close();
            return true;
        }
    }



    //modificar 

    public function update($p)
    {



        $this->sql = "UPDATE `ficha_grupo` SET `nom_grupo` = '{$p->getNom_grupo()}' , "
            . " `id_instructor` = '{$p->getId_instructor()}' , "
            . " `id_jornada` = '{$p->getId_jornada()}'"
            . " WHERE `id_ficha_grupo` = '{$p->getId_ficha_grupo()}' ";


        $objConexion = new ConeccionDB;
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "El grupo con el id {$p->getId_ficha_grupo()} se actualizo correctamente.";
            $con->close();
            return true;
        } else {
            $this->mensaje = "El grupo con el id {$p->getId_ficha_grupo()}no se actualizo correctamente. ";
            $con->close();
            return false;
        }
    }

    //eliminar


    public function delete($id_ficha_grupo)
    {

        $this->sql = "DELETE FROM `ficha_grupo` WHERE `id_ficha_grupo` = '$id_ficha_grupo' ";

        $objConexion = new ConeccionDB;
        $con = $objConexion->conectarMysql();


        if ($con->query($this->sql) === true) {
            $this->mensaje = "El Grupo con el id $id_ficha_grupo fue eliminado.";
            $con->close();

            return true;
        } else {
            $this->mensaje = "El Grupo con el id $id_ficha_grupo no esta registrado.";
            $con->close();
            return false;
        }

        return true;
    }

    //eliminar img




    //consultar
    public function find($id_ficha_grupo)
    {
        $this->sql = "SELECT * FROM `ficha_grupo` WHERE `id_ficha_grupo` = '$id_ficha_grupo' ";

        $objConexion = new ConeccionDB;
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);
        $p = new Combox();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_object();

            //enviamos los datos como los tenemos en la base de datos

            $p->setId_ficha_grupo($datos->id_ficha_grupo);
            $p->setNom_grupo($datos->nom_grupo);
            $p->setId_instructor($datos->id_instructor);
            $p->setId_jornada($datos->id_jornada);
        } else {
            $this->mensaje = "No existe el grupo con el id $id_ficha_grupo ";
        }

        $con->close();
        return $p;
    }


    //listar usuarios


    public function listar()
    {
        $this->sql = "SELECT FG.*,CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2) AS id_instructor, JO.nombre AS jornada"
            . "   FROM `ficha_grupo` FG INNER JOIN persona PER ON PER.id_persona = FG.id_instructor "
            . "   INNER JOIN jornada JO ON FG.id_jornada = JO.id_jornada ORDER BY FG.id_ficha_grupo ";

        //$this->sql = "SELECT PER.*,ROL.nombre_rol AS rol FROM `persona` PER INNER JOIN rol ROL ON PER.rol = ROL.id_rol ORDER BY PER.nombre_1
        //";    

        $objConexion = new ConeccionDB;
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);





        $con->close();
        return $resultado;
    }


    public function listarGrupo()
    {
        $this->sql = "SELECT * FROM `ficha_grupo`";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objEstado = new Combox();
            $objEstado->setId_ficha_grupo($datos->id_ficha_grupo);
            $objEstado->setNombre_grupo($datos->nom_grupo);
            $objEstado->setId_instructor($datos->id_instructor);
            $objEstado->setId_jornada($datos->id_jornada);
            $lista[] = $objEstado;
        }

        $con->close();
        return $lista;
    }


    public function getMensaje()
    {
        return $this->mensaje;
    }
}
