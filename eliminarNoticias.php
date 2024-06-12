<?php
require_once('./cad/Noticia_CAD.php');
require_once('./control/Categoria_CTRL.php');
require_once('./control/Noticia_CTRLOO.php');
//require_once('./insertarNoticia.php');
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
  <link rel="stylesheet" href="css/actualizar_noticia.css">
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
      <form class="container" action="" method="POST" enctype="multipart/form-data">
        <div class="portada">
          <img src="<?php echo $allData->getPortada() ?>" alt="portada">
        </div>

        <div class="encabezado">
          <div class="titulo">       
            <input  type="text" class="encabezado_input" id="titulo" name="titulo" value="<?php echo 
            $allData->getTitulo() ?>" placeholder="Titulo">

            <div style="display: none;" class="li_wrap">
              <input type="number" readonly class="contact_input" id="id_noticia" name="id_noticia" value="<?php echo $allData->getId_noticia() ?>">
            </div>

            <div style="display: none;" class="li_wrap">
               <input type="number" readonly class="contact_input" id="aut" name="aut" value="<?php echo $aut ?>">
            </div>                             

            <!-- <a href="editarN.php?id=<?php echo $allData->getId_noticia() ?>">editar</a> -->
            <div class="categoria">
              <select id="categoria" name="categoria" class="selecionar">
                <option value="1">Seleccione una categoria</option>
                  <?php 
                  foreach ($categorias as $datosCateg) { 
                  if($datosCateg->getId()!= 1)
                  ?>
                <option <?php if($id_cat == $datosCateg->getNombre()) ?> <?php echo " selected"; ?> value="<?php echo $datosCateg->getId(); ?>"><?php echo $datosCateg->getNombre(); ?></option>
                  <?php }; ?>
              </select> 
            </div>
            <div class="mensaje"><?php echo @$mensaje; ?></div>

            <div class="btn_user">
              <button type="submit" name="accion" value="Eliminar" class="boton boton_eliminar">Eliminar</button>
              
            </div>       
          </div>


        <div class="informacion">
          <a href="#"><span class="autor"> Autor: <?php echo $allData->getAutor() ?></span></a>
            <span class="fecha"><i class="far fa-calendar-alt"></i> Fecha de publicacion: <?php echo $allData->getFecha() ?></span>
        </div>


        </div>

        <div class="cad_body_down">
          <p>
           <textarea class="descripcion" name="descripcion" id="descripcion"> <?php echo $allData->getDescipcion() ?></textarea>
          </p>
        </div>

         
      </form>
    </div>


  </div>
</body>
<script src="js/ajax.js"></script>

</html>