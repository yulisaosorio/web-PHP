<?php
require_once('./cad/Noticia_CAD.php');
// require_once('./modelo/Noticia_MDL.php');
$titulo = '';

if (isset($_REQUEST['titulo'])) {
  $titulo = $_REQUEST['titulo'];
}
$objNoticCAD = new NoticiaCAD();
$allData = $objNoticCAD->listarNoticias_x_Titulo($titulo);
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/ver_noticias.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
  <title></title>
</head>

<body>

  <div class="card">
    <div class="btn_back">
      <a href="index.php" onclick="ajax('contenido', 'tbl_noticias.php')">
        <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
        <span class="txt_back">Volver</span>
      </a>
    </div>

    <div class="cad_body_up">
      <div class="portada">
        <img src="<?php echo $allData->getPortada() ?>" alt="portada">
      </div>

      <div class="encabezado">
        <div class="titulo">
          <span class="categoria"><i class="fas fa-tags"></i> <?php echo $allData->getId_categoria() ?></span>
          <h5><?php echo $allData->getTitulo() ?></h5>
          <!-- <a href="editarN.php?id=<?php echo $allData->getId_noticia() ?>">editar</a> -->
        </div>

        <div class="informacion">
        <a href="#"><span class="autor"> Autor: <?php echo $allData->getAutor() ?></span></a>
          <span class="fecha"><i class="far fa-calendar-alt"></i> Fecha de publicacion: <?php echo $allData->getFecha() ?></span>
        </div>

      </div>
    </div>

    <div class="cad_body_down">
      <p class="descripcion">
        <?php echo $allData->getDescipcion() ?>
      </p>
    </div>

  </div>

</body>
<script src="js/ajax.js"></script>

</html>