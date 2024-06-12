<?php

require_once '../modelo/Alumno.php';
require_once '../cad/AlumnoCAD.php';

$id_alumno = "";
$identificacion = "";
$nombre_1 = "";
$nombre_2 = "";
$apellido_1 = "";
$apellido_2 = "";
$fecha_nac = "";
// $edad = "";
$id_padre = "";
$id_madre = "";
$foto = "";
$id_estado = "";
$id_ficha_grupo = "";


$mensaje = "";
$consultado = false;



// trim es para borrar espacios 
//strtoupper es para poner todo mayuscula
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == "Guardar") {
        $identificacion = trim(htmlspecialchars($_POST["identificacion"]));
        $nombre_1 = trim(htmlspecialchars($_POST["nombre_1"]));
        $nombre_2 = trim(htmlspecialchars($_POST["nombre_2"]));
        $apellido_1 = trim(htmlspecialchars($_POST["apellido_1"]));
        $apellido_2 = trim(htmlspecialchars($_POST["apellido_2"]));
        $fecha_nac = trim(htmlspecialchars($_POST["fecha_nac"]));
        // $edad = trim(htmlspecialchars($_POST["edad"]));
        $id_padre = trim(htmlspecialchars($_POST["id_padre"]));
        $id_madre = trim(htmlspecialchars($_POST["id_madre"]));
        $foto = ($_FILES['foto']["name"]) ? $_FILES['foto']["name"] : "";
        $id_estado = trim(htmlspecialchars($_POST["estados"]));
        $id_ficha_grupo = trim(htmlspecialchars($_POST["id_ficha_grupo"]));


        //validar datos
        if (empty($identificacion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la cedula.
                     </div>";
        } else if (strlen($identificacion) < 8) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      La identificación debe tener al menos 8 digitos.
                     </div>";
        }

        if (empty($nombre_1)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un nombre.
                     </div>";
        } else if (strlen($nombre_1) < 3) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El nombre debe tener 3 caracteres al menos.
                     </div>";
        }
        if (empty($apellido_1)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un apellido.
                     </div>";
        } else if (strlen($apellido_1) < 3) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El apellido debe tener 3 caracteres al menos.
                     </div>";
        }

        if (empty($fecha_nac)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar la fecha de nacimiento.
                     </div>";
        }
        // if (empty($edad)) {
        //     $mensaje .= "<div class=' alert alert-danger' role ='alert'>
        //              Debe ingresar su edad.
        //              </div>";
        // }
        if (empty($id_padre)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el id del padre.
                     </div>";
        }

        if (empty($id_madre)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el id de la madre.
                     </div>";
        }
        if (empty($id_estado)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe seleccionar un estado.
                     </div>";
        }
        if (empty($id_ficha_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar, a que grupo pertenece el alumno.
                     </div>";
        }





        if ($mensaje == "") {

            $fecha = new DateTime(); // para la imgen pueda tener el mismo nombre
            $nombreArchivo = ($foto != "") ? $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"] : "Floor.png";
            $tmpFoto = $_FILES["foto"]["tmp_name"];

            if ($tmpFoto != "") {
                move_uploaded_file($tmpFoto, "../fotosAlum/" . $nombreArchivo);
            }

            $objP = new Alumno();
            $objP->setIdentificacion($identificacion);
            $objP->setNombre_1($nombre_1);
            $objP->setNombre_2($nombre_2);
            $objP->setApellido_1($apellido_1);
            $objP->setApellido_2($apellido_2);
            $objP->setFecha_nac($fecha_nac);
            // $objP->setEdad($edad);
            $objP->setId_padre($id_padre);
            $objP->setId_madre($id_madre);
            $objP->setFoto($nombreArchivo);
            $objP->setId_estado($id_estado);
            $objP->setId_ficha_grupo($id_ficha_grupo);


            $objCAD = new AlumnoCAD(); // validamos si existe el correo y la cedula
            if ($objCAD->yaExiste($identificacion)) {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            } else {


                if ($objCAD->save($objP)) {
                    $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                    //para que queden vacios los campos.
                    $cedula = " ";
                    $nombre_1 = " ";
                    $nombre_2 = " ";
                    $apellido_1 = " ";
                    $apellido_2 = " ";
                    $clave = " ";
                    $telefono = " ";
                    $direccion = " ";
                    $fecha_nac = " ";
                    $correo = " ";
                    $profesion = " ";
                    $id_rol = " ";
                    $id_estado = " ";
                } else {
                    $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
                }
            }
        }
    }

    //modificar
    if ($_POST['accion'] == "Modificar") {

        $id_alumno = trim(htmlspecialchars($_POST["id_alumno"])); // es necesario el id para saber cual se modificara
        $identificacion = trim(htmlspecialchars($_POST["identificacion"]));
        $nombre_1 = trim(htmlspecialchars($_POST["nombre_1"]));
        $nombre_2 = trim(htmlspecialchars($_POST["nombre_2"]));
        $apellido_1 = trim(htmlspecialchars($_POST["apellido_1"]));
        $apellido_2 = trim(htmlspecialchars($_POST["apellido_2"]));
        $fecha_nac = trim(htmlspecialchars($_POST["fecha_nac"]));
        // $edad = trim(htmlspecialchars($_POST["edad"]));
        $id_padre = trim(htmlspecialchars($_POST["id_padre"]));
        $id_madre = trim(htmlspecialchars($_POST["id_madre"]));
        $foto = ($_FILES['foto']["name"]) ? $_FILES['foto']["name"] : "";
        $id_estado = trim(htmlspecialchars($_POST["estados"]));
        $id_ficha_grupo = trim(htmlspecialchars($_POST["id_ficha_grupo"]));


        //validar datos
        if (empty($identificacion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la cedula.
                     </div>";
        } else if (strlen($identificacion) < 8) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      La identificación debe tener al menos 8 digitos.
                     </div>";
        }

        if (empty($nombre_1)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un nombre.
                     </div>";
        } else if (strlen($nombre_1) < 3) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El nombre debe tener 3 caracteres al menos.
                     </div>";
        }
        if (empty($apellido_1)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un apellido.
                     </div>";
        } else if (strlen($apellido_1) < 3) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El apellido debe tener 3 caracteres al menos.
                     </div>";
        }

        if (empty($fecha_nac)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar la fecha de nacimiento.
                     </div>";
        }
        // if (empty($edad)) {
        //     $mensaje .= "<div class=' alert alert-danger' role ='alert'>
        //              Debe ingresar su edad.
        //              </div>";
        // }
        if (empty($id_padre)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el id del padre.
                     </div>";
        }

        if (empty($id_madre)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el id de la madre.
                     </div>";
        }
        if (empty($id_estado)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe seleccionar un estado.
                     </div>";
        }
        if (empty($id_ficha_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar, a que grupo pertenece el alumno.
                     </div>";
        }

        if ($mensaje == "") {

            $fecha = new DateTime(); // para la imgen pueda tener el mismo nombre
            $nombreArchivo = ($foto != "") ? $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"] : "Floor.png";
            $tmpFoto = $_FILES["foto"]["tmp_name"];

            if ($tmpFoto != "") {
                move_uploaded_file($tmpFoto, "../fotosAlum/" . $nombreArchivo);
            }
            $objP = new Alumno();
            $objP->setId_alumno($id_alumno);
            $objP->setIdentificacion($identificacion);
            $objP->setNombre_1($nombre_1);
            $objP->setNombre_2($nombre_2);
            $objP->setApellido_1($apellido_1);
            $objP->setApellido_2($apellido_2);
            $objP->setFecha_nac($fecha_nac);
            // $objP->setEdad($edad);
            $objP->setId_padre($id_padre);
            $objP->setId_madre($id_madre);
            $objP->setFoto($nombreArchivo);
            $objP->setId_estado($id_estado);
            $objP->setId_ficha_grupo($id_ficha_grupo);


            $objCAD = new AlumnoCAD(); // validamos si existe el correo y la cedula

            $objCAD->deleteImg($identificacion);
            if ($objCAD->update($objP)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $identificacion = "";
                $nombre_1 = "";
                $nombre_2 = "";
                $apellido_1 = "";
                $apellido_2 = "";
                $fecha_nac = "";
                // $edad = "";
                $id_padre = "";
                $id_madre = "";
                $id_ficha_grupo = "";
                $id_estado = "";
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }

    //eliminar 
    if ($_POST['accion'] == "Eliminar") {

        $identificacion = trim(htmlspecialchars($_POST["identificacion"]));

        //validar datos
        if (empty($identificacion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la identificacion.
                     </div>";
        } else {

            $objCAD = new AlumnoCAD();

            if ($objCAD->deleteImg($identificacion)) {

                $objCAD->delete($identificacion);

                $mensaje = "<div class=' alert alert-success' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            } else {

                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }

    //consultar
    if ($_POST['accion'] == "Consultar") {

        $objCAD = new AlumnoCAD();
        $identificacion = trim(htmlspecialchars($_POST["identificacion"]));

        //validar datos
        if (empty($identificacion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la identificación para consultar.
                     </div>";
        } else if ($identificacion == $objCAD->find($identificacion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Esa identificación no esta registrada.
                     </div>";
        } else {


            if ($objCAD->yaExiste($identificacion)) { //llamamos la funcion si existe la cedula
                $consultado = true;

                $objP = $objCAD->find($identificacion); //llamamos la funcion buscar

                // obtenemos los datos
                $id_alumno = $objP->getId_alumno();
                $identificacion = $objP->getIdentificacion();
                $nombre_1 = $objP->getNombre_1();
                $nombre_2 = $objP->getNombre_2();
                $apellido_1 = $objP->getApellido_1();
                $apellido_2 = $objP->getApellido_2();
                $fecha_nac = $objP->getFecha_nac();
                // $edad = $objP->getEdad();
                $id_padre = $objP->getId_padre();
                $id_madre = $objP->getId_madre();
                $nombreArchivo = $objP->getFoto(); //foto
                $id_estado = $objP->getId_estado();
                $id_ficha_grupo = $objP->getId_ficha_grupo();


                print_r($nombreArchivo);
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }

}

if (isset($_REQUEST['ident'])) {
    $identificacion = htmlspecialchars($_REQUEST['ident']);
    $consultado = true;
}
$objCAD = new AlumnoCAD();
$objP = $objCAD->findAlumnComplete($identificacion);

$id_alumno = $objP->getId_alumno();
$identificacion = $objP->getIdentificacion();
$nombre_1 = $objP->getNombre_1();
$nombre_2 = $objP->getNombre_2();
$apellido_1 = $objP->getApellido_1();
$apellido_2 = $objP->getApellido_2();
$fecha_nac = $objP->getFecha_nac();
$nombreArchivo = $objP->getFoto();
$id_estado = $objP->getId_estado();
$id_padre = $objP->getId_padre();
$id_madre = $objP->getId_madre();
$id_ficha_grupo = $objP->getId_ficha_grupo();
// $id_ficha_grupo = $objp->getId_ficha_grupo();

function edad($fechaNacimiento)
{
    $calcularEdad = date('Y') - $anio = substr($fechaNacimiento, 0, 4);
    echo $calcularEdad . ' años';
}
