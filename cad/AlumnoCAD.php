<?php


require_once 'Conexion.php';
require_once '../modelo/Alumno.php';


class AlumnoCAD
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
        $this->sql = "INSERT INTO `alumno`(`id_alumno`, `identificacion`, `nombre_1`, `nombre_2`, `apellido_1`, `apellido_2`,"
            . " `fecha_nac`, `id_padre`, `id_madre`, `estado`, `foto`,`id_ficha_grupo`)"
            . "VALUES (null,'{$p->getIdentificacion()}','{$p->getNombre_1()}','{$p->getNombre_2()}','{$p->getApellido_1()}',"
            . "'{$p->getApellido_2()}','{$p->getFecha_nac()}','{$p->getId_padre()}',"
            . "'{$p->getId_madre()}','{$p->getId_estado()}','{$p->getFoto()}','{$p->getId_ficha_grupo()}')";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        if ($con->query($this->sql) === true) {

            $this->mensaje = "Se registro correctamente el Alumno.";
            $con->close();
            return true;
        } else {

            $this->mensaje = "No se pudo hacer el registro.".mysqli_error($con);
            $con->close();
            return true;
        }
    }

    public function yaExiste($identificacion)
    {
        $this->sql = "SELECT * FROM `alumno` WHERE `identificacion` = '$identificacion' ";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        if ($resultado->num_rows == 1) {
            $this->mensaje = "La identificacion $identificacion ya esta registrada.";
            $con->close();
            return true;
        }
    }


    //modificar 

    public function update($p)
    {
       $this->sql = "UPDATE `alumno` SET `identificacion` = '{$p->getIdentificacion()}',
       `nombre_1` = '{$p->getNombre_1()}',
       `nombre_2` = '{$p->getNombre_2()}',
       `apellido_1` = '{$p->getApellido_1()}',
       `apellido_2` = '{$p->getApellido_2()}',
       `fecha_nac` = '{$p->getFecha_nac()}',
       `id_padre` = '{$p->getId_padre()}',
       `id_madre` = '{$p->getId_madre()}',
       `estado` = '{$p->getId_estado()}',
       `foto` = '{$p->getFoto()}',
       `id_ficha_grupo` = '{$p->getId_ficha_grupo()}'
       WHERE id_alumno = '{$p->getId_alumno()}' ";


        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "La identificacion {$p->getIdentificacion()} se actualizo correctamente.";
            $con->close();
            return true;
        } else {
            $this->mensaje = "La identificación {$p->getIdentificacion()} no se actualizo " .mysqli_error($con);
            $con->close();
            return false;
        }
    }

    //eliminar

    public function deleteImg($identificacion)
    {
        $this->sql = "SELECT `foto`  FROM `alumno` WHERE `identificacion` = $identificacion";
        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $fun = $con->query($this->sql)->fetch_object();
        print_r($fun);
        if (file_exists("../fotosAlum/" . $fun->foto)) {
            unlink("../fotosAlum/" . $fun->foto);
            $this->mensaje = "El Alumno con la identificación $identificacion  fue eliminado.";
            return true;
        }
    }


    public function delete($identificacion)
    {

        $this->sql = "DELETE FROM `alumno` WHERE `identificacion` = '$identificacion' ";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();
        if ($con->query($this->sql) === true) {
            $this->mensaje = "El Alumno con la identificación $identificacion fue eliminado.";
            $con->close();

            return true;
        } else {
            $this->mensaje = "El Alumno con la identificación $identificacion  no esta registrado.";
            $con->close();
            return false;
        }

        return true;
    }

    //eliminar img




    //consultar
    public function find($identificacion)
    {

        $this->sql = "SELECT * FROM `alumno` WHERE `identificacion` = '$identificacion' ";
        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);
        $p = new Alumno();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_object();

            //enviamos los datos como los tenemos en la base de datos

            $p->setId_alumno($datos->id_alumno);
            $p->setIdentificacion($datos->identificacion);
            $p->setNombre_1($datos->nombre_1);
            $p->setNombre_2($datos->nombre_2);
            $p->setApellido_1($datos->apellido_1);
            $p->setApellido_2($datos->apellido_2);
            $p->setFecha_nac($datos->fecha_nac);
            $p->setId_padre($datos->id_padre);
            $p->setId_madre($datos->id_madre);
            $p->setId_estado($datos->estado);
            $p->setFoto($datos->foto);
            $p->setId_ficha_grupo($datos->id_ficha_grupo);
        } else {
            $this->mensaje = "No existe una alumno con la identificación $identificacion ";
        }

        $con->close();
        return $p;
    }

    public function findAlumnComplete($identificacion)
    {

        $this->sql = "SELECT * FROM `alumno` WHERE `identificacion` = '$identificacion' ";
        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);
        $p = new Alumno();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_object();

            //enviamos los datos como los tenemos en la base de datos

            $p->setId_alumno($datos->id_alumno);
            $p->setIdentificacion($datos->identificacion);
            $p->setNombre_1($datos->nombre_1);
            $p->setNombre_2($datos->nombre_2);
            $p->setApellido_1($datos->apellido_1);
            $p->setApellido_2($datos->apellido_2);
            $p->setFecha_nac($datos->fecha_nac);
            $p->setId_padre($datos->id_padre);
            $p->setId_madre($datos->id_madre);
            $p->setId_estado($datos->estado);
            $p->setFoto($datos->foto);
            $p->setId_ficha_grupo($datos->id_ficha_grupo);
        } else {
            $this->mensaje = "No existe una alumno con la identificación $identificacion ";
        }

        $con->close();
        return $p;
    }


    //listar usuarios


    public function listar()
    {

        //siempre debe tener el mismo nombre el nombre como el campo
        //$this->sql = "select E.id_alumno, CONCAT (E.nombre_1, ' ',E.nombre_2, ' ', E.apellido_1, ' ', E.apellido_2) as 'Nombre Completo' from alumno E";
        //$this->sql = "SELECT ALU.*, CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2)"
        // . " AS id_padre FROM `alumno` ALU INNER JOIN persona PER ON ALU.id_padre = PER.id_persona";
        // 
        $this->sql = "SELECT ALU.*, CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2) AS id_padre, CONCAT (PE.nombre_1,' ', PE.nombre_2,' ', PE.apellido_1,' ', PE.apellido_2) as id_madre, EST.nombre as estado, FG.nom_grupo as id_ficha_grupo FROM `alumno` ALU INNER JOIN persona PER ON ALU.id_padre = PER.id_persona jOIN persona PE on ALU.id_madre = PE.id_persona INNER JOIN estado EST on ALU.estado = EST.id_estado INNER JOIN ficha_grupo FG on ALU.id_ficha_grupo = FG.id_ficha_grupo";



        //$this->sql = "SELECT ALU.*,EST.nombre AS estado FROM `alumno` ALU INNER JOIN estado EST ON ALU.estado = EST.id_estado ORDER BY ALU.nombre_1";



        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);





        $con->close();
        return $resultado;
    }


    public function getMensaje()
    {
        return $this->mensaje;
    }
}
