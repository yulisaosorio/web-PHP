<?php
require_once('./cad/Noticia_CAD.php');
require_once('./modelo/Noticia_MDL.php');
// require_once('control/Categoria_CTRL.php');
$id = '';

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$objNoticCAD = new NoticiaCAD();
$porID = $objNoticCAD->listarNoticias_x_Id_noticia($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
</head>

<body>
    <!-- <p><?php echo $porID->getTitulo() ?></p> -->
    <p><?php echo $porID->getDescipcion() ?></p>
    <p><?php echo $porID->getId_categoria() ?></p>

    <div class="modal-container">
        <form method="POST" id="formulario_noticias" class="modal modal-close" enctype="multipart/form-data">
            <div class="ventana-modal">
                <span class="icono"><i class="far fa-plus-square"></i></span>
                <span class="titulo">Editar noticia</span>
                <span class="close"><i class="fas fa-times-circle"></i></span>
            </div>

            <div class="ventana">
                <div id="contenido" class="contenido-ventana">


                    <div class="contenido encabezado">
                        <!-- <label>titulo</label> -->
                        <input type="text" id="titulo" name="titulo" class="input_encabezado" placeholder="TITULO NOTICIA" value="">
                    </div>

                    <div class="contenido portada">
                        <input type="file" id="portada" name="portada" class="input_portada">
                        <input type="button" value="Subir foto" class="btn_subir_portada" onclick="document.getElementById('portada').click();">
                        <img src="img/foto_noticia.png" width="80" class="previsualizar_portada" id="previsualizar_portada">
                    </div>

                    <div class="contenido descripcion">
                        <!-- <label>descripciòn</label> -->
                        <textarea id="descripcion" name="descripcion" class="txadescripcion" placeholder="DESCRIPCIÒN"></textarea>
                    </div>

                    <div class="contenido categoria">
                        <label class="lbl_categoria" for="categoria">categoria</label>
                        <select id="categoria" name="categoria" class="selecionar">
                            <option value="1">Seleccione una categoria</option>
                            <?php foreach ($categorias as $datosCateg) { ?>
                                <option class="opCategoria" value="<?php echo $datosCateg->getId(); ?>"><?php echo $datosCateg->getNombre(); ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- <span id="error_mensaje"></span> -->
            <span id="succsess_mensaje"></span>
            <div id="respuesta"></div>
            <div class="btn">
                <button name="accion" value="publicar_noticia" id="publicar_noticia" class="botones btn_publicar" >publicar</button>
                <button name="cancelar_noticia" value="cancelar_noticia" id="cancelar_noticia" class="botones btn_cancelar">cancelar</button>
            </div>


        </form>
    </div>
</body>

</html>