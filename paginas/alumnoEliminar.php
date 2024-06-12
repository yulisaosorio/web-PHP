<?php
require_once '../control/AlumnoController.php';
require_once '../control/EstadoController.php';
require_once '../control/ComboxController.php';
// require_once '../control/GrupoController.php';
// require_once '../control/PersonController.php';
// var_dump($_POST);
session_start();
$usuario= $_SESSION['correo'];
$rol= $_SESSION['rol'];
if(isset($usuario) && $rol==1){
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/alumnoEliminar.css">
    <title>YDJK</title>
</head>

<body>

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
                        <div class="img_foto">
                            <?php if ($consultado == true) { ?>
                                <img class="img-thumbnail" src="../fotosAlum/<?php echo $nombreArchivo ?> " id="img" width="150" />
                            <?php } else { ?>
                                <img src="../img/sinFoto_Alumnos.jpg" alt="">
                                <input type="file" accept="image/*" class="foto" id="foto" name="foto">
                            <?php }  ?>
                            <!-- <input type="file" src="img/foto_perfil.jpg" class="foto" name="foto" id="" value=""> -->
                            <!-- <input type="file" accept="image/*" class="foto" id="foto" name="foto"> -->
                        </div>

                        <div class="datos_contacto pb">
                            <div class="contacto">
                                <ul>
                                    <li>
                                        <div class="datos_li">
                                            <input readonly type="number" class="input_contact" placeholder="Identificacion" id="identificacion" name="identificacion" value="<?php echo $identificacion ?>">
                                        </div>
                                    </li>
                                    <li style="display: none;">

                                        <div class="datos_li">
                                            <input type="number" readonly class="input_contact" id="id_alumno" name="id_alumno" value="<?php echo $id_alumno ?>">
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
                                    ¿Elimimnar al usuario?
                                </div>
                                <hr>
                            </div>

                            <div class="mensaje">
                                <?php echo @$mensaje; ?>
                            </div>

                            <div class="boton">
                                <?php if ($consultado == true) { ?>
                                    <!-- <button type="submit" name="accion" value="Modificar" class="btn btn_guardar">Modificar</button> -->
                                    <button type="submit" name="accion" value="Eliminar" class="btn btn_guardar">Eliminar</button>
                                <?php } ?>

                                <?php if ($consultado != true) { ?>
                                    <button type="submit" name="accion" value="Guardar" class="btn btn_guardar">Guardar</button>
                                    <button type="submit" name="accion" value="Consultar" class="btn btn_guardar">Consultar</button>
                                <?php } ?>
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

</body>
</html>
<?php
}else{
header("location:../index.php");
}
?>