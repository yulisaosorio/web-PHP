<?php
// incluir setter y getter y el fichero CAD con los metodos
require_once('./modelo/Noticia_MDL.php');
require_once('./cad/Noticia_CAD.php');
//require_once('./login_control.php');

// atributos para recibir los datos del formulario
$id_noticia="";
$title = "";
$descip = "";
$id_cat = "";
$aut = "";
$fecha="";
$mensaje = "";
$consultado= false;

// consultar si se dio click en algun boton con name='accion'
if (isset($_POST['accion'])) {
    // identificar el boton con value='???'
    if ($_POST['accion'] == "publicar_noticia") {
        // asignar los valores de los campos a los atributos
        $title = trim($_POST['titulo']);
        $descip = $_POST['descripcion'];
        $id_cat = $_POST['categoria'];
        $aut = $usuario;
        // validar campo vacio
        if (empty($title)) {
           echo $mensaje =
                '<div class="mensaje">
                    <span class="warning"><i class="fas fa-exclamation-triangle"></i></span>
                    <span class="txt">El titulo no puede estar vacio</span>
                </div>';
        } else if (strlen($title) > 255) {
            $mensaje =
                'El titulo supera los 255 caracteres</span>
                </div>';
        }
        if (empty($descip)) {
            $mensaje .=
                '<div class="mensaje">
                    <span class="warning"><i class="fas fa-exclamation-triangle"></i></span>
                    <span class="txt">La descripcion no debe estar vacia</span>
                </div>';
        }
        // si $mensaje esta vacio (no hay errores)
        if ($mensaje == "") {
            // instanciar la clase modelo
            $objNotic = new Noticia();
            // eviar la informacion con el setter
            $objNotic->setTitulo($title);
            $objNotic->setDescipcion($descip);
            $objNotic->setId_categoria($id_cat);
            $objNotic->setAutor($aut);

            // instanciar la clase acceso a datos
            $objNoticCAD = new NoticiaCAD();
            // llamar el metodo de validacion de datos existentes
            if ($objNoticCAD->yaExiste($title)) {
                $mensaje =
                    "<div class='mensaje'>
                        <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                        <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                    </div>";
            } else {
                // si no existe el tituolo proceder a guardarlo
                if ($objNoticCAD->saveNoticia($objNotic)) {
                    $mensaje =
                        "<div class='mensaje correcto'>
                            <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                            <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                        </div>";
                    // resetear los campos a vacios
                    $title = "";
                    $descip = "";
                    $id_cat = "";
                    $aut = "";  
                    // header('Location: index.php');
                } else {
                    $mensaje =
                        "<div class='mensaje'>
                            <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                            <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                         </div>";
                }
            }
        }
    } else if ($_POST['accion'] == "Modificar") {
        session_start();        
        // asignar los valores de los campos a los atributos
        $id_noticia = trim(htmlspecialchars($_POST["id_noticia"])); // es necesario el id para saber cual se modificara
        $title = trim($_POST['titulo']);
        $descip = $_POST['descripcion'];
        $id_cat = $_POST['categoria'];
        $aut = $_SESSION['id'];
        // validar campo vacio
        if (empty($title)) {
           echo $mensaje =
                '<div class="mensaje">
                    <span class="warning"><i class="fas fa-exclamation-triangle"></i></span>
                    <span class="txt">El titulo no puede estar vacio</span>
                </div>';
        } else if (strlen($title) > 255) {
            $mensaje =
                'El titulo supera los 255 caracteres</span>
                </div>';
        }
        if (empty($descip)) {
            $mensaje .=
                '<div class="mensaje">
                    <span class="warning"><i class="fas fa-exclamation-triangle"></i></span>
                    <span class="txt">La descripcion no debe estar vacia</span>
                </div>';
        }
        // si $mensaje esta vacio (no hay errores)
        if ($mensaje == "") {
            // instanciar la clase modelo
            $consultado= true;
            $objNotic = new Noticia();
            // eviar la informacion con el setter
            $objNotic->setId_noticia($id_noticia);
            $objNotic->setTitulo($title);
            $objNotic->setDescipcion($descip);
            $objNotic->setId_categoria($id_cat);
            $objNotic->setAutor($aut);

            // instanciar la clase acceso a datos
            $objNoticCAD = new NoticiaCAD();
            // llamar el metodo de validacion de datos existentes
           
                // si no existe el tituolo proceder a guardarlo
                if ($objNoticCAD->updateNoticia($objNotic)) {
                    $mensaje =
                        "<div class='mensaje correcto'>
                            <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                            <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                        </div>";
                    // resetear los campos a vacios
                    $title = "";
                    $descip = "";
                    $id_cat = "";
                    $aut = "";  
                    // header('Location: index.php');
                } else {
                    $mensaje =
                        "<div class='mensaje'>
                            <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                            <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                         </div>";
                }            
        }
    }//eliminar 
    else if ($_POST['accion'] == "Eliminar") {
        $id_noticia = trim(htmlspecialchars($_POST["id_noticia"]));

        //validar datos
        if (empty($id_noticia)) {
            $mensaje .= "<div class=' alert alert-danger' role ='alert'>
                      Debe ingresar el ID de la noticia.
                     </div>";
        } else {
            $objNoticCAD = new NoticiaCAD();
            if ($objNoticCAD->delete($id_noticia)) {
                $mensaje =
                        "<div class='mensaje correcto'>
                            <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                            <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                        </div>";
            } else {

                $mensaje =
                        "<div class='mensaje'>
                            <span class='warning'><i class='fas fa-exclamation-triangle'></i></span>
                            <span class='txt'>{$objNoticCAD->getMensaje()}</span>
                         </div>";
            }
        }
    }



}



?>
<!-- Cotrol de listar noticias -->
 <?php $objNoticCAD = new NoticiaCAD();
    $allData = $objNoticCAD->listarNoticias();
?>

