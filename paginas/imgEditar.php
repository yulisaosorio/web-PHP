<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
require_once "../control/PersonController.php";
require_once "../control/RolController.php";
require_once '../control/EstadoController.php';
/* if(isset($_FILES["foto"]["name"])){ //con esto se verifica si se envio la informacion
  echo "si";
  } */

//var_dump($_POST);
session_start();
$usuario= $_SESSION['correo'];
$rol1= $_SESSION['rol'];
if(isset($usuario) && $rol1==1){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>YDJK</title>
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="../css/img.css">
    <script src="js/jquery-3.5.1.js"></script>
</head>

<body>

    <!-- contenedor principal -->

    <div class="wrapper">
        <!-- contenedor de logo e informacion -->
        <div class="head_info">
            <div class="logo"><img src="../img/ydjk.png" alt="logo"></div>
            <h5>administrador educativo</h5>
        </div>

        <div class="wrapper_inner" id="wrapper_inner">

            <!-- boton atras -->
            <div class="btn_back">
                <a href="../index.php">
                    <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
                    <span class="txt_back">Volver</span>
                </a>
            </div>


            <form class="container" action="" method="POST" enctype="multipart/form-data">
                <div class="resume">
                    <div class="left">

                        <div class="img_holder">
                            <?php if ($consultado == true) { ?>
                                <img class="img-thumbnail" src="../fotos/<?php echo $nombreArchivo ?>" id="img" alt="foto"><br>
                                <input type="file" accept="image/*" id="foto" name="foto" class="fotoUsuario foto">
                            <?php } else { ?>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="right">
                        <div class="header">
                            <div class="name_role">
                                <div class="name">
                                    editar Foto
                                </div>
                                <hr>
                                <li>
                                        <div style="display: none;" class="li_wrap">
                                            <input type="number" readonly class="contact_input" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>">
                                        </div>
                                    </li>

                            </div>

                            <div class="mensaje"><?php echo @$mensaje; ?></div>

                            <div class="btn_user">
                                <button type="submit" name="accion" value="Modificarimg" class="boton boton_guardar">Modificar</button>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>



    <script>
        // Previsualizar portada noticias
        document.getElementById("foto").addEventListener("change", () => {
            var archivoseleccionado = document.querySelector("#foto");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#img");
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

    <script src="js/java.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/App_JQuery.js"></script>
    <script type="text/javascript" src="js/listar_Sin_recargar.js"></script>
    <script src="js/ajax.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>
<?php
}else{
header("location:../index.php");
}
?>