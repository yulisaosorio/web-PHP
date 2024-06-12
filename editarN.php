<?php
require_once('./cad/Noticia_CAD.php');
require_once('control/Categoria_CTRL.php');
require_once('insertarNoticia.php');
$id = '';


$objNoticCAD = new NoticiaCAD();
$porID = $objNoticCAD->listarNoticias_x_Id_noticia($id);

var_dump($_POST)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="css/editarN.css">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <!-- contenedor de logo e informacion -->
        <div class="head_info">
            <div class="logo"><img src="img/ydjk.png" alt="logo"></div>
            <h5>administrador educativo</h5>
        </div>

        <div class="wrapper_inner" id="wrapper_inner">

            <!-- boton atras -->
            <div class="btn_back">
                <a href="index.php">
                    <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
                    <span class="txt_back">Volver</span>
                </a>
            </div>


            <div class="container">
                <form class="contenedor_form" method="POST">
                    <div class="ventana_superior">
                        <span class="icono"><i class="fas fa-edit"></i></span>
                        <span class="tituloE">Editar noticia</span>
                        <div class="bton_cerrar">
                            <span class="closes"><i class="fas fa-times-circle"></i></span>
                        </div>
                    </div>

                    <div class="ventana_encabezado">
                        <div class="contenidos_ventana">
                            <div class="contenidos encabezado">
                                <input type=" text" class="input_encabezado" name="titulo" placeholder="TITULO NOTICIA" value="<?php echo $porID->getTitulo() ?>">
                            </div>

                            <div class="contenido portada">
                                <input type="file" id="portada" name="portada" class="input_portada" value="<?php echo $porID->getPortada()?>">
                                <input type="button" value="Subir foto" class="btn_subir_portada" onclick="document.getElementById('portada').click();">
                                <img src="<?php echo $porID->getPortada()?>" width="80" class="previsualizar_portada" id="previsualizar_portada">
                            </div>


                            <div class="contenidos descripcion">
                                <textarea class="txadescripcion" placeholder="DESCRIPCIÒN" name="descripcion"><?php echo $porID->getDescipcion() ?></textarea>

                            </div>

                            <div class="contenidos categoria">
                                <label>categoria</label>
                                <select class="selecionar" name="categoria">
                                    <option value="<?php echo $porID->getId_categoria() ?>" class="opCateg"><?php echo $porID->getNombre_categoria() ?></option>
                                    <?php foreach ($categorias as $datosCateg) {
                                        if ($porID->getId_categoria() != $datosCateg->getId()) {
                                    ?>
                                            <option class="opCategoria" value="<?php echo $datosCateg->getId(); ?>"><?php echo $datosCateg->getNombre(); ?></option>

                                    <?php }
                                    }; ?>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="bton">
                        <button class="botones bton_publicar" name="accion" value="modificar">modificar</button>
                        <a href="#" class="botones bton_cancelar">cancelar</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById("portada").addEventListener("change", () => {
            var archivoseleccionado = document.querySelector("#portada");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#previsualizar_portada");
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            var primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            var objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            imagenPrevisualizacion.src = objectURL;
        });
    </script>

</body>

</html>