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
    <link rel="stylesheet" href="../css/usuario.css">
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
                            <?php } else { ?>
                            <?php } ?>
                        </div>

                        <div class="contact_wrap pb">
                            <div class="titulo">
                                Datos
                            </div>

                            <div class="contact">
                                <ul>

                                    <li>
                                        <div style="display: none;" class="li_wrap">
                                            <input type="number" readonly class="contact_input" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>">
                                        </div>
                                    </li>


                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="cedula" name="cedula" value="<?php echo $cedula ?>" placeholder="Cedula">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="nombre_1" name="nombre_1" value="<?php echo $nombre_1 ?>" placeholder="Primer Nombre">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="nombre_2" name="nombre_2" value="<?php echo $nombre_2 ?>" placeholder="Segundo Nombre">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="apellido_1" name="apellido_1" value="<?php echo $apellido_1 ?>" placeholder="Primer Apellido">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="apellido_2" name="apellido_2" value="<?php echo $apellido_2 ?>" placeholder="Segundo Apellido">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="fecha_nac" name="fecha_nac" value="<?php echo $fecha_nac ?>" placeholder="fecha de nacimiento">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="genero" name="genero" value="<?php echo $genero ?>" placeholder="Genero ('M' - 'F')">
                                        </div>
                                    </li>

                                    <li>
                                        <div class="li_wrap">
                                            <input type="text" class="contact_input" id="profesion" name="profesion" value="<?php echo $profesion ?>" placeholder="profesion">
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
                                    editar usuario
                                </div>
                                <hr>
                            </div>

                            <div class="mensaje"><?php echo @$mensaje; ?></div>

                            <div class="btn_user">
                                <?php if ($consultado == true) { ?>
                                    <button type="submit" name="accion" value="Modificar" class="boton boton_guardar">Modificar</button>
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

                        <div class="right_inner">

                            <div class="titulo">
                                informacion de contacto

                            </div>


                            <div class="campos_contactos">
                                <div class="li_wrap">
                                    <div class="icon">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <input type="text" class="contact_input right" id="direccion" name="direccion" value="<?php echo $direccion ?>" placeholder="Dirección ">
                                </div>

                                <div class="li_wrap">
                                    <div class="icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <input type="text" class="contact_input right" id="telefono" name="telefono" value="<?php echo $telefono ?>" placeholder="telefono">
                                </div>

                                <div class="li_wrap">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <input type="email" class="contact_input right" id="correo" name="correo" value="<?php echo $correo ?>" placeholder="Correo">
                                </div>
                            </div>

                            <div class="titulo">
                                administrativo
                            </div>

                            <div class="campos_contactos">
                                <div class="li_wrap">
                                    <div class="icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <input type="password" class="contact_input right" id="clave" name="clave" value="<?php echo $clave ?>" placeholder="Clave">
                                </div>

                                <div class="li_wrap">
                                    <select class="selecionar " name="estados" id="estados">
                                        <option value="1">Seleccione un estado</option>
                                        <?php
                                        foreach ($estado as $objEstado) {
                                            if ($objEstado->getId_estado() != 1)
                                        ?>
                                            <option <?php if ($id_estado == $objEstado->getNombre()) echo " selected"; ?> value="<?php echo $objEstado->getId_estado(); ?>"><?php echo $objEstado->getNombre(); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="li_wrap">
                                    <select class="selecionar " name="rols" id="rols">
                                        <option value="1">Seleccione un rol</option>
                                        <?php
                                        foreach ($rolUser as $objRol) {
                                            if ($objRol->getId_rol() != 1)
                                        ?>
                                            <option <?php if ($id_rol == $objRol->getNombre_rol()) echo " selected"; ?> value="<?php echo $objRol->getId_rol(); ?>"><?php echo $objRol->getNombre_rol(); ?> </option>
                                        <?php } ?>
                                    </select>

                                </div>
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