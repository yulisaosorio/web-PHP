<?php
require_once('./cad/Noticia_CAD.php');
require_once('./modelo/Noticia_MDL.php');
//require_once('login_control.php');
require_once("./cad/ConeccionDB.php");

// var_dump($_POST);

// atributos para recibir los datos del formulario

session_start();
$title = "";
$portada = "";
$descip = "";
$id_cat = "";
$aut = $_SESSION['id'];
$mensaje = "";

// Buscador
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $objCon = new ConeccionDB();
        $con = $objCon->conectarMysql();
        $query = "SELECT * FROM `noticia` WHERE titulo LIKE '$search%'";
        $result = mysqli_query($con, $query);
        if (!$result) {
            die('Error de consulta' . mysqli_error($con));
        }
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'descripcion' => $row['descripcion'],
                'id_categoria' => $row['id_categoria'],
                'fecha_hora' => $row['fecha_hora'],
                'autor' => $row['id_persona']
            );
        }
        $json_string = json_encode($json);
        echo $json_string;
    }
}

// si existe algo en el campo Titulo
if (isset($_POST['titulo'])) {
    $title = trim($_POST['titulo']);
    $descip = $_POST['descripcion'];
    $id_cat = $_POST['categoria'];
    $aut;

    if (is_array($_FILES) && count($_FILES) > 0) {
        move_uploaded_file($_FILES['portada']['tmp_name'], 'imgDB/' . $_FILES['portada']['name']);
        $portada = 'imgDB/' . $_FILES['portada']['name'];
    }
    // enviar datos
    $objNotic = new Noticia();
    $objNotic->setTitulo($title);
    $objNotic->setPortada($portada);
    $objNotic->setDescipcion($descip);
    $objNotic->setId_categoria($id_cat);
    $objNotic->setAutor($aut);

    // validar
    if (empty($title)) {
        echo  $mensaje .= "El titulo esta vacio\n";
    } else if (strlen($title) > 255) {
        echo $mensaje .= "El titulo supera los 255 caracteres\n";
    }

    if (empty($descip)) {
        echo $mensaje = "La descripcion no debe estar vacia\n";
    }

    // si todo es correcto
    else {
        if ($mensaje == "") {
            // CAD NOTICIAS
            $objNoticCAD = new NoticiaCAD();
            // consultar si el titulo existe
            if ($objNoticCAD->yaExiste($title)) {
                echo $mensaje = "Mensaje: {$objNoticCAD->getMensaje()}";
            } else {
                // si no existe el tituolo proceder a guardarlo
                if ($objNoticCAD->saveNoticia($objNotic)) {
                    echo $mensaje = "Mensaje: {$objNoticCAD->getMensaje()}";
                    $mensaje = "";
                    // header('Location: index.php');
                } else {
                    echo $mensaje = "Mensaje: {$objNoticCAD->getMensaje()}";
                }
            }
        }
    }
}


else if (isset($_POST['accion'])) {
    if ($_POST['accion'] == "Modificar") {
        $title = trim($_POST['titulo']);
        $portada = $_FILES['portada'] = ['Subir foto'];
        $descip = $_POST['descripcion'];
        $id_cat = $_POST['categoria'];
        $aut;

        $objN = new Noticia();
        $objN->setTitulo($title);
        $objN->setPortada($portada);
        $objN->setDescipcion($descip);
        $objN->setId_categoria($id_cat);

        $objCAD = new NoticiaCAD();
        if ($objCAD->updateNoticia($objN)) {
            echo $mensaje = 'Se actualizo correctamente!!!';
        }
        

        
        
    }
}

?>
<?php
$objNoticCAD = new NoticiaCAD();
$allData = $objNoticCAD->listarNoticias();
?>

<?php
$objNoticCAD = new NoticiaCAD();
$datos = $objNoticCAD->listarNoticias_x_Categoria();

?>