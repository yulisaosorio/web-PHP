<?php
require_once('login_control.php');

if (isset($_POST['titulo'])) {
    $title = $_POST['titulo'];
    // $portada = $_POST['p'];
    $descip = $_POST['descripcion'];
    $id_cat = $_POST['categoria'];
    $aut = $usuario;

    if (is_array($_FILES) && count($_FILES) > 0) {
        move_uploaded_file($_FILES['p']['tmp_name'], 'imgDB/' . $_FILES['p']['name']);
    }
}
