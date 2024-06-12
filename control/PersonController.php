<?php

require_once '../modelo/Persona.php';
require_once '../cad/PersonaCAD.php';
require_once '../cad/ConeccionDB.php';

$id_persona = "";
$cedula = "";
$nombre_1 = "";
$nombre_2 = "";
$apellido_1 = "";
$apellido_2 = "";
$clave = "";
$telefono = "";
$direccion = "";
$fecha_nac = "";
$genero = "";
$correo = "";
$profesion = "";
$foto = "";
$id_rol = "";
$id_estado = "";

$mensaje = "";
$consultado = false;



// trim es para borrar espacios 
//strtoupper es para poner todo mayuscula
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == "Guardar") {

        $cedula = trim(htmlspecialchars($_POST["cedula"]));
        $nombre_1 = trim(htmlspecialchars($_POST["nombre_1"]));
        $nombre_2 = trim(htmlspecialchars($_POST["nombre_2"]));
        $apellido_1 = trim(htmlspecialchars($_POST["apellido_1"]));
        $apellido_2 = trim(htmlspecialchars($_POST["apellido_2"]));
        $clave = trim(htmlspecialchars($_POST["clave"]));
        $telefono = trim(htmlspecialchars($_POST["telefono"]));
        $direccion = trim(htmlspecialchars($_POST["direccion"]));
        $fecha_nac = trim(htmlspecialchars($_POST["fecha_nac"]));
        $genero = trim(htmlspecialchars($_POST["genero"]));
        $correo = trim(htmlspecialchars($_POST["correo"]));
        $profesion = trim(htmlspecialchars($_POST["profesion"]));
        $foto = (isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]: "";
        $id_rol = trim(htmlspecialchars($_POST["rols"]));
        $id_estado = trim(htmlspecialchars($_POST["estados"]));

        //validar datos
        if (empty($cedula)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la cedula.
                     </div>";
        } else if (strlen($cedula) < 8) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      La cedula debe tener al menos 8 digitos.
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
        if (empty($clave)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe crear una clave.
                     </div>";
        } else if (strlen($clave) < 6) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      La clave debe tener al menos 6 caracteres
                     </div>";
        }

        if (empty($telefono)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un telefono.
                     </div>";
        } else if (strlen($telefono) < 7) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El telefono debe tener mas de 7 numeros
                     </div>";
        }
        if (empty($direccion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar su direccion.
                     </div>";
        }

        if (empty($fecha_nac)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar la fecha de nacimiento.
                     </div>";
        }
        if (empty($genero)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el genero.
                     </div>";
        }
        if (empty($correo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un correo.
                     </div>";
        }

        if (empty($profesion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresas su profesion.
                     </div>";
        }
        if (empty($id_rol)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe seleccionar un rol.
                     </div>";
        }



        if ($mensaje == "") {

            $fecha = new DateTime(); // para la imgen pueda tener el mismo nombre
            $nombreArchivo = ($foto!="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"Floor.png";
            $tmpFoto = $_FILES["foto"]["tmp_name"];

            if ($tmpFoto != "") {
                move_uploaded_file($tmpFoto, "../fotos/".$nombreArchivo);
            }

            $objP = new Persona();
            $objP->setCedula($cedula);
            $objP->setNombre_1($nombre_1);
            $objP->setNombre_2($nombre_2);
            $objP->setApellido_1($apellido_1);
            $objP->setApellido_2($apellido_2);
            $objP->setClave($clave);
            $objP->setTelefono($telefono);
            $objP->setDireccion($direccion);
            $objP->setFecha_nac($fecha_nac);
            $objP->setGenero($genero);
            $objP->setCorreo($correo);
            $objP->setProfesion($profesion);
            $objP->setFoto($nombreArchivo);
            $objP->setId_rol($id_rol);
            $objP->setId_estado($id_estado);

            $objCAD = new PersonaCAD(); // validamos si existe el correo y la cedula
            if ($objCAD->yaExiste($cedula) || $objCAD->yaExisteCorreo($correo)) {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            } else {

                if ($objCAD->save($objP)) {
                    $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                    //para que queden vacios los campos.
                    $cedula = "";
                    $nombre_1 = "";
                    $nombre_2 = "";
                    $apellido_1 = "";
                    $apellido_2 = "";
                    $clave = "";
                    $telefono = "";
                    $direccion = "";
                    $fecha_nac = "";
                    $genero = "";
                    $correo = "";
                    $profesion = "";
                    $id_rol = "";
                    $id_estado = "";
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

        $id_persona = trim(htmlspecialchars($_POST["id_persona"])); // es necesario el id para saber cual se modificara
        $cedula = trim(htmlspecialchars($_POST["cedula"]));
        $nombre_1 = trim(htmlspecialchars($_POST["nombre_1"]));
        $nombre_2 = trim(htmlspecialchars($_POST["nombre_2"]));
        $apellido_1 = trim(htmlspecialchars($_POST["apellido_1"]));
        $apellido_2 = trim(htmlspecialchars($_POST["apellido_2"]));
        $clave = trim(htmlspecialchars($_POST["clave"]));
        $telefono = trim(htmlspecialchars($_POST["telefono"]));
        $direccion = trim(htmlspecialchars($_POST["direccion"]));
        $fecha_nac = trim(htmlspecialchars($_POST["fecha_nac"]));
        $genero = trim(htmlspecialchars($_POST["genero"]));
        $correo = trim(htmlspecialchars($_POST["correo"]));
        $profesion = trim(htmlspecialchars($_POST["profesion"]));        
        $id_rol = trim(htmlspecialchars($_POST["rols"]));
        $id_estado = trim(htmlspecialchars($_POST["estados"]));



        //validar datos
        if (empty($cedula)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la cedula.
                     </div>";
        } else if (strlen($cedula) < 8) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      La cedula debe tener al menos 8 digitos.
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
        if (empty($clave)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe crear una clave.
                     </div>";
        } else if (strlen($clave) < 6) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      La clave debe tener al menos 6 caracteres
                     </div>";
        }

        if (empty($telefono)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un telefono.
                     </div>";
        } else if (strlen($telefono) < 7) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El telefono debe tener mas de 7 numeros
                     </div>";
        }
        if (empty($direccion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar su direccion.
                     </div>";
        }

        if (empty($fecha_nac)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar la fecha de nacimiento.
                     </div>";
        }
        if (empty($genero)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar su genero.
                     </div>";
        }
        if (empty($correo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar un correo.
                     </div>";
        }

        if (empty($profesion)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresas su profesion.
                     </div>";
        }
        if (empty($id_rol)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe seleccionar un rol.
                     </div>";
        }


        if ($mensaje==="") {

                $objP = new Persona();
                $objP->setId_persona($id_persona);
                $objP->setCedula($cedula);
                $objP->setNombre_1($nombre_1);
                $objP->setNombre_2($nombre_2);
                $objP->setApellido_1($apellido_1);
                $objP->setApellido_2($apellido_2);
                $objP->setClave($clave);
                $objP->setTelefono($telefono);
                $objP->setDireccion($direccion);
                $objP->setFecha_nac($fecha_nac);
                $objP->setGenero($genero);
                $objP->setCorreo($correo);
                $objP->setProfesion($profesion);
                $objP->setId_rol($id_rol);
                $objP->setId_estado($id_estado);


                $objCAD = new PersonaCAD();


                // $objCAD->deleteImg($cedula);

                if ($objCAD->update($objP)) {
                    $mensaje = "<div class=' alert alert-success' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
                    //para que queden vacios los campos.
                    $cedula = "";
                    $nombre_1 = "";
                    $nombre_2 = "";
                    $apellido_1 = "";
                    $apellido_2 = "";
                    $clave = "";
                    $telefono = "";
                    $direccion = "";
                    $fecha_nac = "";
                    $genero = "";
                    $correo = "";
                    $profesion = "";
                    $id_rol = "";
                    $id_estado = "";
                } else {
                    $mensaje = "<div class=' alert alert-danger' role='alert'>
                                {$objCAD->getMensaje()}
                                    </div>";
           }           
        }
    }
    //modificar img
    if ($_POST['accion'] == "Modificarimg") {          
        $id_persona = trim(htmlspecialchars($_POST["id_persona"])); // es necesario el id para saber cual se modificara     
        $foto = (isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]: "";


        if ($mensaje=="") {

            $fecha = new DateTime(); // para la imagen pueda tener el mismo nombre
            $nombreArchivo =($foto != "")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"Floor.png";
            $tmpFoto =$_FILES["foto"]["tmp_name"];

                
            if ($tmpFoto != "") {
                move_uploaded_file($tmpFoto,"../fotos/".$nombreArchivo); 
            } 
                $objP = new Persona();
                $objP->setId_persona($id_persona);
                $objP->setFoto($nombreArchivo);


                $objCAD = new PersonaCAD();


                // $objCAD->deleteImg($cedula);

                if ($objCAD->updateimg($objP)) {
                    $mensaje = "<div class=' alert alert-success' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
                    //para que queden vacios los campos.
                    $cedula = "";
                } else {
                    $mensaje = "<div class=' alert alert-danger' role='alert'>
                                {$objCAD->getMensaje()}
                                    </div>";
           }           
        }
    }


    //eliminar 
    else if ($_POST['accion'] == "Eliminar") {

        $cedula = trim(htmlspecialchars($_POST["cedula"]));

        //validar datos
        if (empty($cedula)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la cedula.
                     </div>";
        } else {

            $objCAD = new PersonaCAD();

            if ($objCAD->delete($cedula)) {
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
    else if ($_POST['accion'] == "Consultar") {

        $objCAD = new PersonaCAD();
        $cedula = trim(htmlspecialchars($_POST["cedula"]));

        //validar datos
        if (empty($cedula)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la cedula para consultar.
                     </div>";
        } else if ($cedula == $objCAD->find($cedula)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Esa cedula no esta registrada.
                     </div>";
        } else {


            if ($objCAD->yaExiste($cedula)) { //llamamos la funcion si existe la cedula
                $consultado = true;

                $objP = $objCAD->find($cedula); //llamamos la funcion buscar

                // obtenemos los datos
                $id_persona = $objP->getId_persona();
                $cedula = $objP->getCedula();
                $nombre_1 = $objP->getNombre_1();
                $nombre_2 = $objP->getNombre_2();
                $apellido_1 = $objP->getApellido_1();
                $apellido_2 = $objP->getApellido_2();
                $clave = $objP->getClave();
                $telefono = $objP->getTelefono();
                $direccion = $objP->getDireccion();
                $fecha_nac = $objP->getFecha_nac();
                $genero = $objP->getGenero();
                $correo = $objP->getCorreo();
                $profesion = $objP->getProfesion();
                $nombreArchivo = $objP->getFoto();
                $id_rol = $objP->getId_rol();
                $id_estado = $objP->getId_estado();


                //print_r($nombreArchivo);


            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }
}

if (isset($_REQUEST['cedu'])) {
    $cedula = htmlspecialchars($_REQUEST['cedu']);
    $consultado = true;
}
$objCAD = new PersonaCAD();
$objP = $objCAD->find($cedula);

$id_persona = $objP->getId_persona();
$cedula = $objP->getCedula();
$nombre_1 = $objP->getNombre_1();
$nombre_2 = $objP->getNombre_2();
$apellido_1 = $objP->getApellido_1();
$apellido_2 = $objP->getApellido_2();
$clave = $objP->getClave();
$telefono = $objP->getTelefono();
$direccion = $objP->getDireccion();
$fecha_nac = $objP->getFecha_nac();
$genero = $objP->getGenero();
$correo = $objP->getCorreo();
$profesion = $objP->getProfesion();
$nombreArchivo = $objP->getFoto();
$id_rol = $objP->getId_rol();
$id_estado = $objP->getId_estado();

 
?>

<?php

$objCAD = new PersonaCAD();
$lista = $objCAD->listar();
$objCAD = new PersonaCAD();
$listar_x_instrucror = $objCAD->listar_x_instructor();

function edad($fechaNacimiento)
{
    $calcularEdad = date('Y') - $anio = substr($fechaNacimiento, 0, 4);
    echo $calcularEdad . ' años';
}

?>