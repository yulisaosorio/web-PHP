<?php

require_once '../modelo/Materia.php';
require_once '../cad/CalificarCAD.php';

$id_nota = "";
$nota_1 = "";
$nota_2 = "";
$id_materia = "";
$id_alumno = "";


$mensaje = "";
$consultado = false;



// trim es para borrar espacios 
//strtoupper es para poner todo mayuscula
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == "Guardar") {
        $id_alumno = trim(htmlspecialchars($_POST["id_alumno"]));
        $id_materia = trim(htmlspecialchars($_POST["id_materia"]));
        $nota_1 = trim(htmlspecialchars($_POST["nota_1"]));
        $nota_2 = trim(htmlspecialchars($_POST["nota_2"]));


        //validar datos

        if (empty($nota_1)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar la nota
                     </div>";
        }
        if ($id_materia == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar una Materia.
                     </div>";
        }
        if ($id_alumno == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar un Estudiante.
                     </div>";
        }


        if ($mensaje == "") {

            $objM = new Materia();
            $objM->setId_alumno($id_alumno);
            $objM->setId_materia($id_materia);
            $objM->setNota_1($nota_1);
            $objM->setNota_2($nota_2);


            $objCAD = new CalificarCAD(); // validamos si existe el correo y la cedula


            if ($objCAD->save($objM)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $nota_1 = "";
                $nota_2 = "";
                $id_materia = "";
                $id_alumno = "";
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }

    //modificar
    if ($_POST['accion'] == "Modificar") {

        $id_nota = trim(htmlspecialchars($_POST["id_nota"]));
        $id_alumno = trim(htmlspecialchars($_POST["id_alumno"]));
        $id_materia = trim(htmlspecialchars($_POST["id_materia"]));
        $nota_1 = trim(htmlspecialchars($_POST["nota_1"]));
        $nota_2 = trim(htmlspecialchars($_POST["nota_2"]));


        //validar datos

        if (empty($nota_1)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar la nota
                     </div>";
        }
        if ($id_materia == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar una Materia.
                     </div>";
        }
        if ($id_alumno == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar un Estudiante.
                     </div>";
        }


        if ($mensaje == "") {

            $objM = new Materia();
            $objM->setId_nota($id_nota);
            $objM->setId_alumno($id_alumno);
            $objM->setId_materia($id_materia);
            $objM->setNota_1($nota_1);
            $objM->setNota_2($nota_2);


            $objCAD = new CalificarCAD(); // validamos si existe el correo y la cedula


            if ($objCAD->update($objM)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $id_nota = "";
                $nota_1 = "";
                $nota_2 = "";
                $id_materia = "";
                $id_alumno = "";
            } else {

                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }

    //eliminar 
    else if ($_POST['accion'] == "Eliminar") {

        $id_nota = trim(htmlspecialchars($_POST["id_nota"]));

        //validar datos
        if (empty($id_nota)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar el id para eliminar.
                     </div>";
        } else {

            $objCAD = new CalificarCAD();

            if ($objCAD->delete($id_nota)) {


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

        $objCAD = new CalificarCAD();
        $id_nota = trim(htmlspecialchars($_POST["id_nota"]));

        //validar datos
        if (empty($id_nota)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la id para consultar
                     </div>";
        } else if ($id_nota == $objCAD->find($id_nota)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Esa id no esta registrada.
                     </div>";
        } else {


            if ($objCAD->yaExiste($id_nota)) { //llamamos la funcion si existe la cedula
                $consultado = true;

                $objM = $objCAD->find($id_nota); //llamamos la funcion buscar

                // obtenemos los datos
                $id_nota = $objM->getId_nota();
                $id_alumno = $objM->getId_alumno();
                $id_materia = $objM->getId_materia();
                $nota_1 = $objM->getNota_1();
                $nota_2 = $objM->getNota_2();

                //print_r($nombreArchivo);


            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }
}

$objCAD = new CalificarCAD();
$lista = $objCAD->listar();

if (isset($_REQUEST['id_calif'])) {
    $id_nota = htmlspecialchars($_REQUEST['id_calif']);
    $consultado = true;
}
$objM = $objCAD->find($id_nota); //llamamos la funcion buscar

// obtenemos los datos
$id_nota = $objM->getId_nota();
$id_alumno = $objM->getId_alumno();
$id_materia = $objM->getId_materia();
$nota_1 = $objM->getNota_1();
$nota_2 = $objM->getNota_2();
