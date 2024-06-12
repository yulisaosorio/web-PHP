<?php

$accion = "";
$mensaje = "";
$estado = 1;
session_start();

include_once"cad/ConeccionDB.php";

$cn = new ConeccionDB();
$c = $cn->conectarMysql();
if (!empty($_SESSION['active'])) {
    header("location:paginaPrincipal.php");
} else {


    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == "Ingresar") {
            $correo = mysqli_real_escape_string($c, $_POST['correo']);
            $clave = mysqli_real_escape_string($c, $_POST['clave']);
// COUNT(*) AS contar poner despues de select

            $q = mysqli_query($c, "SELECT p.*, r.nombre_rol from persona p INNER JOIN rol r ON p.rol=r.id_rol "
                    . "WHERE p.correo='$correo' and clave='$clave' and estado = 1");
            $array = mysqli_num_rows($q);

            if ($array > 0) {
                $data = mysqli_fetch_array($q);
                $_SESSION['active'] = true;
                $_SESSION['id'] = $data['id_persona'];
                $_SESSION['cedula'] = $data['cedula'];
                $_SESSION['nombre_1'] = $data['nombre_1'];
                $_SESSION['nombre_2'] = $data['nombre_2'];
                $_SESSION['apellido_1'] = $data['apellido_1'];
                $_SESSION['apellido_2'] = $data['apellido_2'];
                $_SESSION['fecha_nac'] = $data['fecha_nac'];
                $_SESSION['clave'] = $data['clave'];
                $_SESSION['telefono'] = $data['telefono'];
                $_SESSION['direccion'] = $data['direccion'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['profesion'] = $data['profesion'];
                $_SESSION['foto'] = $data['foto'];
                $_SESSION['rol'] = $data['rol'];
                $_SESSION['nombre_rol'] = $data['nombre_rol'];
                $_SESSION['estado'] = $data['estado'];

                header("location:paginaPrincipal.php");
                //$_SESSION['username'] = $correo;
                //header("location:../paginaprincipal.php");
            } else {
                if (empty($_POST['correo']) || empty($_POST['clave'])) {
                    $mensaje = "usuario y clave estan vacios ";
                } else {
                    $mensaje = "usuario no valido o inactivo";
                }
            }
        }
    }
}

//Comprobamos si esta definida la sesión 'tiempo'1800.
if(isset($_SESSION['tiempo']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 1800;//30min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($vida_session > $inactivo)
        {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();              
            //Redirigimos pagina.
            header("Location: index.php");

            exit();
        }
} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
