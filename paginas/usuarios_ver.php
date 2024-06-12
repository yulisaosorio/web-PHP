<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
require_once "../control/PersonController.php";
require_once "../control/RolController.php";
require_once '../control/EstadoController.php';
require_once '../control/ComboxController.php';
require_once '../cad/ConeccionDB.php';
// require_once '../cad/PersonaCAD.php';
session_start();
$usuario = $_SESSION['correo'];
$rol = $_SESSION['rol'];
if (isset($usuario) && $rol == 1) {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
        <title>YDJK</title>
        <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
        <link rel="stylesheet" href="../css/usuario_ver.css">
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
                                <img class="img-thumbnail" src="../fotos/<?php echo $objP->getFoto() ?> " width="150px" />
                            </div>

                            <div class="contact_wrap pb">
                                <div class="titulo">
                                    Datos
                                </div>

                                <div class="contact">
                                    <ul>

                                        <li>
                                            <div class="li_wrap">
                                                <span class="iconDatos cedula"><i class="fas fa-id-card"></i></span>
                                                <span class="contact_input"><?php echo $cedula ?></span>
                                                <!-- <input type="text" class="contact_input" id="cedula" name="cedula" value="<?php echo $cedula ?>" placeholder="Cedula"> -->
                                            </div>
                                        </li>

                                        <li>
                                            <div class="li_wrap">
                                                <span class="iconDatos nombre"><i class="fas fa-user"></i></span>
                                                <span class="contact_input"><?php echo $nombre_1 . ' ' . $nombre_2 . ' ' . $apellido_1 . ' ' . $apellido_2 ?></span>
                                            </div>

                                        </li>

                                        <li>
                                            <div class="li_wrap">
                                                <span class="iconDatos fecha_naci"><i class="fas fa-calendar-alt"></i></span>
                                                <span class="contact_input"><?php echo $fecha_nac ?></span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="li_wrap">
                                                <?php if ($genero == 'F' ||  $genero == 'f') { ?>

                                                    <span class="iconDatos "><i class="fas fa-female"></i></span>
                                                    <span class="contact_input"><?php echo "femenino" ?></span>
                                                <?php } else { ?>
                                                    <span class="iconDatos "><i class="fas fa-male"></i></span>
                                                    <span class="contact_input"><?php echo "masculino" ?></span>
                                                <?php } ?>
                                            </div>
                                        </li>


                                        <li>
                                            <div class="li_wrap">
                                                <span class="iconDatos profesion"><i class="fas fa-briefcase"></i></span>
                                                <span class="contact_input"><?php echo $profesion ?></span>
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
                                        Informacion de usuario
                                    </div>
                                    <hr>
                                </div>


                                <a href="#" class="btn_editar">
                                    <span class="icon_editar">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>

                            </div>

                            <div class="right_inner">
                                <div class="informacion_usuario">
                                    <div class="info_contacto">
                                        <div class="titulo">
                                            Contacto
                                        </div>

                                        <div class="campos_contactos">
                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <i class="fas fa-map-marked-alt"></i>
                                                </div>
                                                <span class="contact_input right"><?php echo $direccion ?></span>
                                            </div>

                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <i class="fas fa-mobile-alt"></i>
                                                </div>
                                                <span class="contact_input right"><?php echo $telefono ?></span>
                                            </div>

                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <span class="contact_input right"><?php echo $correo ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="info_adminstrativa">
                                        <div class="titulo">
                                            Administracion
                                        </div>

                                        <div class="campos_contactos">
                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                                <span class="contact_input right"><?php echo $clave ?></span>
                                            </div>

                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <?php
                                                    if ($objP->getId_estado() == 'Activo') {
                                                    ?>
                                                        <i class="fas fa-user-check"></i>

                                                    <?php   } else { ?>
                                                        <i style="color: red;" class="fas fa-user-times"></i>

                                                    <?php   } ?>
                                                </div>

                                                <span><?php echo $objP->getId_estado() ?> </span>
                                            </div>

                                            <div class="li_wrap">

                                                <div class="icon">
                                                    <i class="fas fa-user-shield"></i>
                                                </div>
                                                <span><?php echo $objP->getId_rol() ?> </span>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="informacion_hijo">
                                    <div class="titulo">
                                        Informacion de Hijos
                                    </div>

                                    <?php
                                    // conexion BD
                                    $objConexion = new ConeccionDB();
                                    $con = $objConexion->conectarMysql();

                                    $query = "SELECT a.foto, a.identificacion,CONCAT(a.nombre_1,' ',a.nombre_2,' ',a.apellido_1,' ',a.apellido_2) AS nombre
                                    from alumno a
                                    INNER JOIN persona p ON a.id_padre=p.id_persona OR a.id_madre=p.id_persona
                                    WHERE p.cedula = $cedula";
                                    $resultado = mysqli_query($con, $query);
                                    if ($resultado) {
                                        while ($fila = mysqli_fetch_assoc($resultado)) { 
                                            if ($fila==null) {
                                                echo 'no registra hijos';
                                            }
                                            
                                            
                                            ?>
                                            <div class="container_hijo">
                                                <div class="img_hijo">
                                                    <img src="../FotosAlum/<?php echo $fila['foto']  ?>" width="80" alt="">
                                                </div>

                                                <div class="info_hijo">
                                                    <a href="alumno_ver.php?ident=<?php echo $fila['identificacion']  ?>">
                                                        <span class="nombre_hijo"><?php echo $fila['nombre']  ?></span>
                                                    </a>
                                                </div>
                                            </div>



                                    <?php

                                        }
                                    }
                                    ?>







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
} else {
    header("location:../index.php");
}
?>