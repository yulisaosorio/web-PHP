<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
require_once "../control/PersonController.php";
require_once "../control/RolController.php";
require_once '../control/EstadoController.php';

  session_start();
  $usuario= $_SESSION['correo'];
  $rol= $_SESSION['rol'];
  if(isset($usuario) && $rol==1){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>YDJK</title>
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="../css/usuarioEliminar.css">
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
                                <img src="../fotos/<?php echo $nombreArchivo ?>" id="img" alt=""><br>

                            <?php } ?>
                        </div>

                        <div class="contact_wrap pb">
                            <div class="contact">
                                <ul>
                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="cedula" name="cedula" value=" <?php echo $cedula ?>" readonly="Cedula">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="right">
                        <div class="header">
                            <div class="name_role">
                                <div class="name">
                                    ¿Eliminar al usuario?
                                </div>
                                <hr>
                            </div>

                            <div class="mensaje"><?php echo @$mensaje; ?></div>

                            <div class="btn_user">
                                <?php if ($consultado == true) { ?>
                                    <!-- <button type="submit" name="accion" value="Modificar" class="boton boton_guardar">Modificar</button> -->
                                    <button type="submit" name="accion" value="Eliminar" class="boton boton_guardar">Eliminar</button>
                                    <!-- <a href="#" class="boton boton_guardar">guardar</a> -->
                                    <a href="#" class="boton boton_cancelar">cancelar</a>
                                <?php } ?>
                                <?php if ($consultado != true) { ?>
                                    <button type="submit" name="accion" value="Guardar" class="boton boton_guardar">Guardar</button>
                                <?php } ?>
                                <!-- <button type="submit" name="accion" value="Consultar" class="boton boton_guardar">Consultar</button> -->
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