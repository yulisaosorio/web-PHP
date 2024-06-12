<?php


require_once 'ConeccionDB.php';
require_once '../modelo/Materia.php';


class CalificarCAD
{

    private $mensaje;
    private $sql;


    public function __construct()
    {

        $this->mensaje = "";
        $this->sql = "";
    }

    public function save($n)
    {

        $this->sql = "INSERT INTO `nota`(`id_nota`, `nota1`, `nota2`, `id_materia`, `id_alumno`)"
            . "VALUES (null,'{$n->getNota_1()}','{$n->getNota_2()}','{$n->getId_materia()}','{$n->getId_alumno()}')";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {

            $this->mensaje = "Se registro correctamente la nota.";
            $con->close();
            return true;
        } else {

            $this->mensaje = "No se pudo hacer el registro." . mysqli_error($con);
            $con->close();
            return false;
        }
    }

    public function yaExiste($id_nota)
    {
        $this->sql = "SELECT * FROM `nota` WHERE `id_nota` = '$id_nota' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);

        if ($resultado->num_rows == 1) {
            $this->mensaje = "La id $id_nota ya esta registrada.";
            $con->close();
            return true;
        }
    }



    //modificar 

    public function update($m)
    {



        $this->sql = "UPDATE `nota` SET `nota1` = '{$m->getNota_1()}' , "
            . " `nota2` = '{$m->getNota_2()}' , "
            . " `id_materia` = '{$m->getId_materia()}',"
            . " `id_alumno` = '{$m->getId_alumno()}'"
            . " WHERE `id_nota` = '{$m->getId_nota()}' ";


        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "La calificación con el id {$m->getId_nota()} se actualizo correctamente.";
            $con->close();
            return true;
        } else {
            $this->mensaje = "La calificación con el id {$m->getId_nota()}no se actualizo correctamente. ";
            $con->close();
            return false;
        }
    }

    //eliminar


    public function delete($id_nota)
    {

        $this->sql = "DELETE FROM `nota` WHERE `id_nota` = '$id_nota' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();


        if ($con->query($this->sql) === true) {
            $this->mensaje = "La calificación con el id $id_nota se eliminado.";
            $con->close();

            return true;
        } else {
            $this->mensaje = "La calificación con el id $id_nota no esta registrado.";
            $con->close();
            return false;
        }

        return true;
    }

    //eliminar img




    //consultar
    public function find($id_nota)
    {
        $this->sql = "SELECT * FROM `nota` WHERE `id_nota` = '$id_nota' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);
        $m = new Materia();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_object();

            //enviamos los datos como los tenemos en la base de datos

            $m->setId_nota($datos->id_nota);
            $m->setNota_1($datos->nota1);
            $m->setNota_2($datos->nota2);
            $m->setId_materia($datos->id_materia);
            $m->setId_alumno($datos->id_alumno);
        } else {
            $this->mensaje = "No existe la calificacion con el id $id_nota ";
        }

        $con->close();
        return $m;
    }


    //listar usuarios


    public function listar()
    {
        $this->sql = "SELECT NT.*,CONCAT (ALU.nombre_1,' ', ALU.nombre_2,' ', ALU.apellido_1,' ', ALU.apellido_2) AS id_alumno, MA.nombre_materia AS id_materia
                     FROM `nota` NT INNER JOIN alumno ALU ON ALU.id_alumno = NT.id_alumno
                     INNER JOIN materia MA ON NT.id_materia = MA.id_materia ORDER BY NT.id_nota";

        //$this->sql = "SELECT PER.*,ROL.nombre_rol AS rol FROM `persona` PER INNER JOIN rol ROL ON PER.rol = ROL.id_rol ORDER BY PER.nombre_1
        //";    

        $objConexion = new ConeccionDB;
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
