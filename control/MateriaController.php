<?php

require_once '../modelo/Materia.php';
require_once '../cad/MateriaCAD.php';

$id_materia = "";
$nombre_materia = "";
$id_instructor = "";


$mensaje = "";
$consultado = false;



// trim es para borrar espacios 
//strtoupper es para poner todo mayuscula
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == "Guardar") {



        $nombre_materia = ucfirst(trim(htmlspecialchars($_POST["nombre_materia"])));
        $id_instructor = trim(htmlspecialchars($_POST["id_instructor"]));


        //validar datos
        if (empty($nombre_materia)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la Materia.
                     </div>";
        }
        if ($id_instructor == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar un instructor.
                     </div>";
        }
        if ($mensaje == "") {



            $objP = new Materia();

            $objP->setNombre_materia($nombre_materia);
            $objP->setId_instructor($id_instructor);

            $objCAD = new MateriaCAD();


            if ($objCAD->save($objP)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $id_materia = "";
                $nombre_materia = "";
                $id_instructor = "";
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }


    //modificar
    if ($_POST['accion'] == "Modificar") {


        $id_materia = trim(htmlspecialchars($_POST["id_materia"])); // es necesario el id para saber cual se modificara
        $nombre_materia = ucfirst(trim(htmlspecialchars($_POST["nombre_materia"])));
        $id_instructor = trim(htmlspecialchars($_POST["id_instructor"]));


        //validar datos
        if (empty($nombre_materia)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la Materia.
                     </div>";
        }
        if ($id_instructor == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar un instructor.
                     </div>";
        }
        if ($mensaje == "") {



            $objP = new Materia();
            $objP->setId_materia($id_materia);
            $objP->setNombre_materia($nombre_materia);
            $objP->setId_instructor($id_instructor);

            $objCAD = new MateriaCAD();


            if ($objCAD->updateMa($objP)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $id_materia = "";
                $nombre_materia = "";
                $id_instructor = "";
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }

    //eliminar 
    else if ($_POST['accion'] == "Eliminar") {

        $id_materia = trim(htmlspecialchars($_POST["id_materia"]));

        //validar datos
        if (empty($id_materia)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la id para eliminar.
                     </div>";
        } else {

            $objCAD = new MateriaCAD();

            if ($objCAD->delete($id_materia)) {

                $mensaje = "<div class=' alert alert-success' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
                $id_materia = "";
            } else {

                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }

    //consultar
    else if ($_POST['accion'] == "Consultar") {

        $objCAD = new MateriaCAD();
        $id_materia = trim(htmlspecialchars($_POST["id_materia"]));

        //validar datos
        if (empty($id_materia)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar el id de la materia que desea consultar.
                     </div>";
        } else if ($id_materia == $objCAD->findMateria($id_materia)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Esa id no esta registrada.
                     </div>";
        } else {


            if ($objCAD->yaExiste($id_materia)) { //llamamos la funcion si existe la cedula
                $consultado = true;

                $objP = $objCAD->findMateria($id_materia); //llamamos la funcion buscar

                // obtenemos los datos
                $id_materia = $objP->getId_materia();
                $nombre_materia = $objP->getNombre_materia();
                $id_instructor = $objP->getId_instructor();


                //print_r($nombreArchivo);


            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }
}


$objCAD = new MateriaCAD();
$lista = $objCAD->listar();
if (isset($_REQUEST['mate'])) {
    $id_materia = htmlspecialchars($_REQUEST['mate']);
    $consultado = true;
}
$objP = $objCAD->findMateria($id_materia); //llamamos la funcion buscar

$id_materia = $objP->getId_materia();
$nombre_materia = $objP->getNombre_materia();
$id_instructor = $objP->getId_instructor();
