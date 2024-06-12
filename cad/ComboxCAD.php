<?php
require_once 'Conexion.php';
require_once '../modelo/Combox.php';
class ComboxCAD
{

    private $mensaje;
    private $sql;

    public function __construct()
    {
        $this->mensaje = "";
        $this->sql = "";
    }



    public function listarFicha_grupo()
    {
        $this->sql = "SELECT * FROM `ficha_grupo`";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objFichaGrupo = new Combox();
            $objFichaGrupo->setId_ficha_grupo($datos->id_ficha_grupo);
            $objFichaGrupo->setNombre_grupo($datos->nom_grupo);

            $lista[] = $objFichaGrupo;
        }

        $con->close();
        return $lista;
    }

    public function listarPadre()
    {
        $this->sql = "SELECT id_persona,CONCAT (nombre_1,' ',nombre_2,' ',apellido_1,' ', apellido_2) AS nombre_completo, foto
     FROM `persona` WHERE genero = 'M' AND rol = 3";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objPadre = new Combox();
            $objPadre->setId_padre($datos->id_persona);
            $objPadre->setNombre_completo($datos->nombre_completo);
            $objPadre->setFotoPadre($datos->foto);


            $lista[] = $objPadre;
        }

        $con->close();
        return $lista;
    }

    public function listarMadre()
    {
        $this->sql = "SELECT id_persona,CONCAT (nombre_1,' ',nombre_2,' ',apellido_1,' ', apellido_2) AS nombre_completo, foto
        FROM `persona` WHERE genero = 'F' AND rol = 3";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objMadre = new Combox();
            $objMadre->setId_madre($datos->id_persona);
            $objMadre->setNombre_completo($datos->nombre_completo);
            $objMadre->setFotoMadre($datos->foto);

            $lista[] = $objMadre;
        }

        $con->close();
        return $lista;
    }

    public function listarInstructor()
    {
        $this->sql = "SELECT id_persona,cedula,CONCAT (nombre_1,' ',nombre_2,' ',apellido_1,' ', apellido_2) AS nombre_completo FROM `persona`where rol = 2";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objInstructor = new Combox();
            $objInstructor->setId_instructor($datos->id_persona);
            $objInstructor->setNombre_completo($datos->nombre_completo);
            $objInstructor->setIdCedula($datos->cedula);

            $lista[] = $objInstructor;
        }

        $con->close();
        return $lista;
    }

    public function listarEstudiante()
    {
        $this->sql = "SELECT id_alumno,CONCAT (nombre_1,' ',nombre_2,' ',apellido_1,' ', apellido_2) AS nombre_completo
              FROM `alumno` ORDER BY nombre_1 ";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objAlu = new Combox();
            $objAlu->setId_alumno($datos->id_alumno);
            $objAlu->setNombre_completo($datos->nombre_completo);

            $lista[] = $objAlu;
        }

        $con->close();
        return $lista;
    }

    public function listarMaterias()
    {
        $this->sql = "SELECT id_materia,nombre_materia AS materia
              FROM `materia` ORDER BY nombre_materia ";

        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objMat = new Combox();
            $objMat->setId_materia($datos->id_materia);
            $objMat->setMateria($datos->materia);

            $lista[] = $objMat;
        }

        $con->close();
        return $lista;
    }

    public function listarJornadas()
    {
        $this->sql = "SELECT id_jornada,nombre AS jornada FROM `jornada`";


        $objConexion = new Conexion();
        $con = $objConexion->conectar();

        $resultado = $con->query($this->sql);

        $lista = array();

        while ($datos = $resultado->fetch_object()) {
            $objJor = new Combox();
            $objJor->setId_jornada($datos->id_jornada);
            $objJor->setJornada($datos->jornada);

            $lista[] = $objJor;
        }

        $con->close();
        return $lista;
    }





    public  function getMensaje()
    {
        return $this->mensaje;
    }
}
