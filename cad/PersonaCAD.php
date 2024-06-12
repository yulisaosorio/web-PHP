<?php


require_once 'ConeccionDB.php';
require_once '../modelo/Persona.php';


class PersonaCAD
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

        $this->sql = "INSERT INTO `persona`(`id_persona`, `cedula`, `nombre_1`, `nombre_2`, `apellido_1`, `apellido_2`,"
            . " `clave`, `telefono`, `direccion`, `fecha_nac`, `genero`, `correo`, `profesion`, `foto`,`estado`,`rol`)"
            . "VALUES (null,'{$p->getCedula()}','{$p->getNombre_1()}','{$p->getNombre_2()}','{$p->getApellido_1()}',"
            . "'{$p->getApellido_2()}','{$p->getClave()}','{$p->getTelefono()}','{$p->getdireccion()}','{$p->getFecha_nac()}',"
            . "'{$p->getGenero()}','{$p->getCorreo()}','{$p->getProfesion()}','{$p->getFoto()}','{$p->getId_estado()}','{$p->getId_rol()}')";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {

            if ($p->getId_rol() == 1) {

                $this->mensaje = "Se registro correctamente el Administrador.";
                $con->close();
                return true;
            } else if ($p->getId_rol() == 2) {

                $this->mensaje = "Se registro correctamente el Instructor.";
                $con->close();
                return true;
            } else if ($p->getId_rol() == 3) {

                $this->mensaje = "Se registro correctamente el Padre de familia.";
                $con->close();
                return true;
            }
        } else {

            $this->mensaje = "No se pudo hacer el registro. " . mysqli_error($con);
            $con->close();
            return true;
        }
    }

    public function yaExiste($cedula)
    {
        $this->sql = "SELECT * FROM `persona` WHERE `cedula` = '$cedula' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);

        if ($resultado->num_rows == 1) {
            $this->mensaje = "La cedula $cedula ya esta registrada.";
            $con->close();
            return true;
        }
    }

    public function yaExisteCorreo($correo)
    {
        $this->sql = "SELECT * FROM `persona` WHERE `correo` = '$correo' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);

        if ($resultado->num_rows == 1) {
            $this->mensaje = "El correo $correo ya esta registrado.";
            $con->close();
            return true;
        }
    }

    //modificar 

    public function update($p)
    {
        $this->sql = "UPDATE `persona` SET `cedula` = '{$p->getCedula()}' , "
            . " `nombre_1` = '{$p->getNombre_1()}' , "
            . " `nombre_2` = '{$p->getNombre_2()}',"
            . "`apellido_1` = '{$p->getApellido_1()}',"
            . " `apellido_2` = '{$p->getApellido_2()}',"
            . " `clave` = '{$p->getClave()}' , "
            . " `telefono` = '{$p->getTelefono()}',"
            . "`direccion` = '{$p->getDireccion()}',"
            . " `fecha_nac` = '{$p->getFecha_nac()}',"
            . " `genero` = '{$p->getGenero()}', "
            . " `correo` = '{$p->getCorreo()}',"
            . "`profesion` = '{$p->getProfesion()}',"
            . " `rol` = '{$p->getId_rol()}',"
            . " `estado` = '{$p->getId_estado()}'"
            . " WHERE id_persona = '{$p->getId_persona()}' ";
            


        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "La cedula {$p->getCedula()} se actualizo correctamente.";
            $con->close();
            return true;
        } else {
            $this->mensaje = "La cedula {$p->getCedula()} no se actualizo correctamente. ";
            $con->close();
            return false;
        }
    }


     //modificar 

    public function updateimg($p)
    {
         $this->sql = "UPDATE `persona` SET `foto` = '{$p->getFoto()}' WHERE id_persona = '{$p->getId_persona()}' ";
            
        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "La cedula {$p->getCedula()} se actualizo correctamente.";
            $con->close();
            return true;
        } else {
            $this->mensaje = "La cedula {$p->getCedula()} no se actualizo correctamente. ";
            $con->close();
            return false;
        }
    }

    //eliminar

    public function delete($cedula)
    {

        $this->sql = "DELETE FROM `persona` WHERE `cedula` = '$cedula' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        if ($con->query($this->sql) === true) {
            $this->mensaje = "El usuario con la cedula $cedula fue eliminado.";
            $con->close();

            return true;
        } else {
            $this->mensaje = "El usuario con la cedula $cedula no se pudo eliminar." . mysqli_error($con);
            $con->close();
            return false;
        }

        return true;
    }





    //consultar
    public function find($cedula)
    {
        $this->sql = "SELECT *, r.nombre_rol as rolName, es.nombre as estadoName FROM `persona` p 
        INNER JOIN rol r on p.rol=r.id_rol
        INNER JOIN estado es on p.estado=es.id_estado
        WHERE `cedula` = '$cedula' ";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();

        $resultado = $con->query($this->sql);
        $p = new Persona();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_object();

            //enviamos los datos como los tenemos en la base de datos

            $p->setId_persona($datos->id_persona);
            $p->setCedula($datos->cedula);
            $p->setNombre_1($datos->nombre_1);
            $p->setNombre_2($datos->nombre_2);
            $p->setApellido_1($datos->apellido_1);
            $p->setApellido_2($datos->apellido_2);
            $p->setClave($datos->clave);
            $p->setTelefono($datos->telefono);
            $p->setDireccion($datos->direccion);
            $p->setFecha_nac($datos->fecha_nac);
            $p->setGenero($datos->genero);
            $p->setCorreo($datos->correo);
            $p->setProfesion($datos->profesion);
            $p->setId_rol($datos->rolName);
            $p->setFoto($datos->foto);
            $p->setId_estado($datos->estadoName);
        } else {
            $this->mensaje = "No existe una persona con la cedula $cedula ";
        }

        $con->close();
        return $p;
    }


    //listar usuarios


    public function listar()
    {
        $this->sql = "SELECT PER.*,ROL.nombre_rol AS rol, EST.nombre AS estado FROM `persona` PER INNER JOIN rol ROL ON PER.rol = ROL.id_rol
              INNER JOIN estado EST ON PER.estado = EST.id_estado ORDER BY PER.nombre_1";

        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();
        $resultado = $con->query($this->sql);
        $con->close();
        return $resultado;
    }

    public function listar_x_instructor()
    {
        $this->sql = "SELECT PER.*,ROL.nombre_rol AS rol, EST.nombre AS estado FROM `persona` PER INNER JOIN rol ROL ON PER.rol = ROL.id_rol
              INNER JOIN estado EST ON PER.estado = EST.id_estado WHERE ROL.id_rol = 2 ORDER BY PER.nombre_1";
        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();
        $resultado = $con->query($this->sql);

        $con->close();
        return $resultado;
    }

    public function listar_x_padres()
    {
        $this->sql = "SELECT PER.*,ROL.nombre_rol AS rol, EST.nombre AS estado FROM `persona` PER INNER JOIN rol ROL ON PER.rol = ROL.id_rol
              INNER JOIN estado EST ON PER.estado = EST.id_estado WHERE ROL.id_rol = 3 ORDER BY PER.nombre_1";
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
