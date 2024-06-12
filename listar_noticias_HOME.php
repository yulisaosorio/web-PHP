<?php
// require_once('./cad/Noticia_CAD.php');
// require_once('./modelo/Noticia_MDL.php');
require_once('./insertarNoticia.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tbl_listarNoticia.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <title>Document</title>
</head>

<body>

    <div class="wrapper_noticias">

    
        <?php 
            if(!$allData){ ?>
                <h1><?php echo 'No hay noticias'; ?></h1>
         <?php    }else{

            

        foreach ($allData as $objData) { ?>
            <div class="news_wrap">

                <div class="portada">
                    <img src="<?php echo $objData->getPortada(); ?>" width="80" alt="portada_noticia">
                </div>

                <div class="content">
                    <div class="items titulo">
                        <span><?php echo substr($objData->getTitulo(), 0, 20); ?></span>
                    </div>

                    <div class="items descripcion">
                        <span><?php echo substr($objData->getDescipcion(), 0, 80).'...'  ?></span>
                    </div>

                    <div class="items categoria">
                        <span><?php echo $objData->getId_categoria(); ?></span>
                    </div>

                    <div class="items fecha">
                        <span class="icon_fecha"><i class="far fa-calendar-alt"></i></span>
                        <span><?php echo $objData->getFecha(); ?></span>
                    </div>

                    <div class="items autor">
                        <span class="icon_autor"><i class="fas fa-user-tie"></i></span>
                        <span><?php echo $objData->getAutor(); ?></span>
                    </div>
                    <div class="btn_container">
                        <a class="btn_delete" href="#" onclick="ajax('contenido','ver_noticia.php?titulo=<?php echo $objData->getTitulo(); ?>')">
                            <span>Ver mas</span>
                        </a>
                    </div>
                </div>

            </div>

        <?php } }?>
    </div>
</body>

</html>