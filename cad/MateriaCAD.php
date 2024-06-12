<?php


require_once 'ConeccionDB.php';
require_once '../modelo/Materia.php';


class MateriaCAD
{

    private $mensaje;
    private $sql;


    public function __construct()
    {

        $this->mensaje = "";
        $this->sql = "";
    }

    public function save($m)
    {

        $this->sql = "INSERT INTO `materia`(`id_materia`,`nombre_materia`,`id_instructor`)"
            . "VALUES (null,'{$m->getNombre_materia()}','{$m->getId_instructor()}')";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {

            $this->mensaje = "Se registro correctamente la materia {$m->getNombre_materia()} .";
            $con->close();
            return true;
        } else {

            $this->mensaje = "Debe seleccionar un instructor.";
            $con->close();
            return false;
        }
    }

    public function yaExiste($id_materia)
    {
        $this->sql = "SELECT * FROM `materia` WHERE `id_materia` = '$id_materia' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);

        if ($resultado->num_rows == 1) {
            $this->mensaje = "El id $id_materia ya esta registrada.";
            $con->close();
            return true;
        }
    }




    //modificar 

    public function updateMa($m)
    {



        $this->sql = "UPDATE `materia` SET `nombre_materia` = '{$m->getNombre_materia()}' , "
            . " `id_instructor` = '{$m->getId_instructor()}' "
            . " WHERE id_materia = '{$m->getId_materia()}' ";


        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "La materia {$m->getNombre_materia()} se actualizo correctamente.";
            $con->close();
            return true;
        } else {
            $this->mensaje = "La materia{$m->getNombre_materia()} no se actualizo correctamente. ";
            $con->close();
            return false;
        }
    }

    //eliminar



    public function delete($id_materia)
    {

        $this->sql = "DELETE FROM `materia` WHERE `id_materia` = '$id_materia' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();


        if ($con->query($this->sql) === true) {
            $this->mensaje = "La materia con el id $id_materia fue eliminado.";
            $con->close();

            return true;
        } else {
            $this->mensaje = "La materia con el id $id_materia  no esta registrado.";
            $con->close();
            return false;
        }

        return true;
    }

    //eliminar img




    //consultar
    public function findMateria($id_materia)
    {



        $this->sql = "SELECT * FROM `materia` WHERE `id_materia` = '$id_materia' ";
        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);
        $m = new Materia();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_object();

            //enviamos los datos como los tenemos en la base de datos

            $m->setId_materia($datos->id_materia);
            $m->setNombre_materia($datos->nombre_materia);
            $m->setId_instructor($datos->id_instructor);
        } else {
            $this->mensaje = "No existe la id $id_materia";
        }

        $con->close();
        return $m;
    }


    //listar usuarios


    public function listar()
    {

        $this->sql = "SELECT MA.*, CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2) AS nombre_completo FROM `materia` MA INNER JOIN persona PER ON MA.id_instructor = PER.id_persona";



        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);





        $con->close();
        return $resultado;
    }


    public function getMensaje()
    {
        return $this->mensaje;
    }
}
