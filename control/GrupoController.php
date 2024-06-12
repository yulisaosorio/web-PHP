<?php

require_once '../modelo/Combox.php';
require_once '../cad/GrupoCAD.php';

$id_ficha_grupo = "";
$nom_grupo = "";
$id_instructor = "";
$id_jornada = "";


$mensaje = "";
$consultado = false;



// trim es para borrar espacios 
//strtoupper es para poner todo mayuscula
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == "Guardar") {




        $nom_grupo = ucfirst(trim(htmlspecialchars($_POST["nom_grupo"])));
        $id_instructor = trim(htmlspecialchars($_POST["id_instructor"]));
        $id_jornada = trim(htmlspecialchars($_POST["id_jornada"]));


        //validar datos

        if (empty($nom_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el nombre del grupo.
                     </div>";
        } else if (strlen($nom_grupo) < 5) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El nombre debe tener 5 caracteres al menos.
                     </div>";
        }
        if ($id_instructor == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar un Instructor.
                     </div>";
        }
        if ($id_jornada == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar una Jornada.
                     </div>";
        }


        if ($mensaje == "") {

            $objP = new Combox();
            $objP->setNom_grupo($nom_grupo);
            $objP->setId_instructor($id_instructor);
            $objP->setId_jornada($id_jornada);


            $objCAD = new GrupoCAD(); // validamos si existe el correo y la cedula


            if ($objCAD->save($objP)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $nom_grupo = "";
                $id_instructor = "";
                $id_jornada = "";
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }

    //modificar
    if ($_POST['accion'] == "Modificar") {


        $id_ficha_grupo = trim(htmlspecialchars($_POST["id_ficha_grupo"])); // es necesario el id para saber cual se modificara
        $nom_grupo = ucfirst(trim(htmlspecialchars($_POST["nom_grupo"])));
        $id_instructor = trim(htmlspecialchars($_POST["id_instructor"]));
        $id_jornada = trim(htmlspecialchars($_POST["id_jornada"]));


        //validar datos

        if (empty($nom_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                     Debe ingresar el nombre del grupo.
                     </div>";
        } else if (strlen($nom_grupo) < 5) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      El nombre debe tener 5 caracteres al menos.
                     </div>";
        }
        if ($id_instructor == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar un Instructor.
                     </div>";
        }
        if ($id_jornada == 0) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe seleccionar una Jornada.
                     </div>";
        }


        if ($mensaje == "") {

            $objP = new Combox();
            $objP->setId_ficha_grupo($id_ficha_grupo);
            $objP->setNom_grupo($nom_grupo);
            $objP->setId_instructor($id_instructor);
            $objP->setId_jornada($id_jornada);


            $objCAD = new GrupoCAD(); // validamos si existe el correo y la cedula


            if ($objCAD->update($objP)) {
                $mensaje = "<div class=' alert alert-success' role='alert'>
                        {$objCAD->getMensaje()}
                            </div>";
                //para que queden vacios los campos.
                $id_ficha_grupo = "";
                $nom_grupo = "";
                $id_instructor = "";
                $id_jornada = "";
            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                            {$objCAD->getMensaje()}
                                </div>";
            }
        }
    }

    //eliminar 
    else if ($_POST['accion'] == "Eliminar") {

        $id_ficha_grupo = trim(htmlspecialchars($_POST["id_ficha_grupo"]));

        //validar datos
        if (empty($id_ficha_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar el id para eliminar.
                     </div>";
        } else {

            $objCAD = new GrupoCAD();

            if ($objCAD->delete($id_ficha_grupo)) {


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

        $objCAD = new GrupoCAD();
        $id_ficha_grupo = trim(htmlspecialchars($_POST["id_ficha_grupo"]));

        //validar datos
        if (empty($id_ficha_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar la id para consultar
                     </div>";
        } else if ($id_ficha_grupo == $objCAD->find($id_ficha_grupo)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Esa id no esta registrada.
                     </div>";
        } else {


            if ($objCAD->yaExiste($id_ficha_grupo)) { //llamamos la funcion si existe la cedula
                $consultado = true;

                $objP = $objCAD->find($id_ficha_grupo); //llamamos la funcion buscar

                // obtenemos los datos
                $id_ficha_grupo = $objP->getId_ficha_grupo();
                $nom_grupo = $objP->getNom_grupo();
                $id_instructor = $objP->getId_instructor();
                $id_jornada = $objP->getId_jornada();

                //print_r($nombreArchivo);


            } else {
                $mensaje = "<div class=' alert alert-danger' role='alert'>
                    {$objCAD->getMensaje()}
                        </div>";
            }
        }
    }
}

$objCAD = new GrupoCAD();
$lista = $objCAD->listar();
$grupos = $objCAD->listarGrupo();

if (isset($_REQUEST['id_grup'])) {
    $id_ficha_grupo = htmlspecialchars($_REQUEST['id_grup']);
    $consultado = true;
}
$objP = $objCAD->find($id_ficha_grupo); //llamamos la funcion buscar

// obtenemos los datos
$id_ficha_grupo = $objP->getId_ficha_grupo();
$nom_grupo = $objP->getNom_grupo();
$id_instructor = $objP->getId_instructor();
$id_jornada = $objP->getId_jornada();
