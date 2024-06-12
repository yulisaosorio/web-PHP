<?php
// require_once('control/Noticia_CTRL.php');
require_once('insertarNoticia.php');
require_once('control/Categoria_CTRL.php');
// require_once('login_control.php');
// var_dump($_POST);
//session_start();
$mensaje = "";
$usuario = $_SESSION['correo'];
$foto_user = $_SESSION['foto'];
$rol = $_SESSION['nombre_rol'];
$nombre_usuario = $_SESSION['nombre_1'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>YDJK</title>
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="css/ver_noticias.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="css/tbl_listarNoticia.css">
    <link rel="stylesheet" href="css/estilos.css">
    <!-- <link rel="stylesheet" href="css/usuario.css"> -->
    <link rel="stylesheet" href="css/tabla.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="//code.tidio.co/fw7riqqu4f5wseb9albsdpxjtgo7wggw.js" async></script>
</head>

<body>

    <!-- contenedor principal -->

    <div class="wrapper">
        <!-- contenedor de logo e informacion -->
        <div class="head_info">
            <div class="logo"><img src="img/ydjk.png" alt="logo"></div>
            <h5>administrador educativo</h5>
        </div>
        <!-- contenedor interior de barra lateral y header/contenido -->
        <div class="wrapper_inner" id="wrapper_inner">
            <div class="vertical_wrap">
                <div class="backdrop"></div>
                <!-- contenedor interno de menus -->
                <div class="vertical_bar">
                    <!-- botones para expandir y colapsar barra de menus -->
                    <div class="collExpand">
                        <span class="expander"><i class="fas fa-expand"></i></span>
                        <span class="collapsed"><i class="fas fa-compress"></i></span>
                    </div>
                    <!-- contenedor de perfil de usuario -->
                    <div class="perfil">
                        <!-- Foto del usuario -->
                        <div class="foto">
                            <img src="fotos/<?php echo $foto_user; ?>" alt="">
                        </div>

                        <div class="info_user">
                            <div class="correo_container">
                                <?php if (!isset($usuario)) {
                                    header("location:index.php");
                                } else { ?>
                                    <p class="correo"><?php echo $usuario; ?></p>
                                    <p class="nombre_usuario"><?php echo $nombre_usuario; ?></p>
                                <?php } ?>
                            </div>
                            <!-- Rol de usuario -->
                            <div class="rol">
                                <div class="icon_rol">
                                    <?php if ($rol == 'Administrador') { ?>
                                        <span class="icon"><i class="fas fa-user-shield"></i></span>
                                    <?php   } elseif ($rol == 'Instructor') { ?>
                                        <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
                                    <?php } else { ?>
                                        <span class="icon"><i class="fas fa-user-friends"></i></span>
                                    <?php }
                                    ?>
                                </div>
                                <span class="rol_name"> <?php echo $rol; ?> </span>
                            </div>

                            <!-- Boton salir -->
                            <div class="btn_container">
                                <div class="btn_salir">
                                    <a href="control/salir.php">
                                        <span class="text_salir">Salir</span>
                                    </a>
                            </div>
                    </div>
                        </div>

                    </div>
                    <!-- Menus de navegacion -->
                    <ul class="menu">
                        <li class="items">
                            <a class="txt_menu" href="index.php">
                                <span class="icon"><i class="fas fa-house-user"></i></span>
                                <span class="text">Home</span>
                            </a>
                        </li>
                        <?php
                            if ($_SESSION['rol'] == 1 ) {
                                ?>
                        <li class="items">
                            <a class="txt_menu opction" href="#">
                                <span class="icon"><i class="fas fa-users"></i></span>
                                <span class="text">Usuarios</span>
                                <span class="arrow"><i class="fas fa-angle-down"></i></span>
                            </a>
                            <!-- submenus -->
                            <ul class="accordion_menu">
                                <li> <a href="paginas/usuarios.php">
                                        <span class="icon_submenu"><i class="fas fa-user-times"></i></span>
                                        <span class="text_submenu">Nuevo usuario</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" onclick="ajax('contenido','paginas/tablaUsuarios.php')">
                                        <span class="icon_submenu"><i class="fas fa-list-ul"></i></span>
                                        <span class="text_submenu">Ver todos</span>                                        
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <?php } ?>

                        <li class="items">
                            <a class="txt_menu opction" id="noticias" href="#">
                                <span class="icon"><i class="fas fa-newspaper"></i></span>
                                <span class="text">Noticias</span>
                                <span class="arrow"><i class="fas fa-angle-down"></i></span>
                            </a>
                            <!-- submenus -->
                          
                            <ul class="accordion_menu">
                            <?php
                            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
                                ?>
                                <li>
                                    <a href="#" class="cta">
                                        <span class="icon_submenu"><i class="far fa-plus-square"></i></span>
                                        <span class="text_submenu">Nueva noticia</span>
                                    </a>
                                </li>
                                <?php } ?>
                                 <li>
                                <a href="#" onclick="ajax('contenido','tablaNoticias.php')">
                                        <span class="icon_submenu"><i class="fas fa-list-ul"></i></span>
                                        <span class="text_submenu">Ver Noticias</span>
                                    </a>
                            </li>

                            </ul>

                        </li>

                        <li class="items">
                            <a class="txt_menu opction" href="#">
                                <span class="icon"><i class="fas fa-user-graduate"></i></span>
                                <span class="text">Alumnos</span>
                                <span class="arrow"><i class="fas fa-angle-down"></i></span>
                            </a>
                            <!-- submenus -->
                            <ul class="accordion_menu">
                            <?php
                            if ($_SESSION['rol'] == 1 ) {
                                ?>
                                <li><a href="paginas/alumno.php">
                                        <span class="icon_submenu"><i class="fas fa-user"></i></span>
                                        <span class="text_submenu">Nuevo alumno</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <li><a href="#" onclick="ajax('contenido','paginas/tablaAlumnos.php')">
                                        <span class="icon_submenu"><i class="fas fa-list-ul"></i></span>
                                        <span class="text_submenu">Ver todos</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span class="icon_submenu"><i class="fas fa-crown"></i></i></span>
                                        <span class="text_submenu">Destacados</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="items">
                            <a class="txt_menu opction" href="#">
                                <span class="icon"><i class="fas fa-book"></i></span>
                                <span class="text">Materias</span>
                                <span class="arrow"><i class="fas fa-angle-down"></i></span>
                            </a>
                            <!-- submenus -->
                            <ul class="accordion_menu">
                            <?php
                            if ($_SESSION['rol'] == 1 ) {
                                ?>
                                <li><a href="paginas/materias.php">
                                        <span class="icon_submenu"><i class="fas fa-book-medical"></i></span>
                                        <span class="text_submenu">Nueva materia</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <li><a href="#" onclick="ajax('contenido','paginas/tablaMateria.php')">
                                        <span class="icon_submenu"><i class="fas fa-list-ul"></i></span>
                                        <span class="text_submenu">Ver todas</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span class="icon_submenu"><i class="fas fa-crown"></i></i></span>
                                        <span class="text_submenu">Destacados</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="items">
                            <a class="txt_menu opction" href="#">
                                <span class="icon"><i class="fas fa-layer-group"></i></span>
                                <span class="text">Grupos</span>
                                <span class="arrow"><i class="fas fa-angle-down"></i></span>
                            </a>
                            <!-- submenus -->
                            <ul class="accordion_menu">
                            <?php
                            if ($_SESSION['rol'] == 1 ) {
                                ?>
                                <li>
                                    <a href="paginas/crear_grupo.php" class="cta">
                                        <span class="icon_submenu"><i class="far fa-plus-square"></i></span>
                                        <span class="text_submenu">Nuevo grupo</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <li>
                                    <a href="#" onclick="ajax('contenido','paginas/tablaGrupos.php')">
                                        <span class="icon_submenu"><i class="fas fa-list-ul"></i></span>
                                        <span class="text_submenu">Ver grupos</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="items">
                            <a class="txt_menu opction" href="#">
                                <span class="icon"><i class="fas fa-check-double"></i></span>
                                <span class="text">Calificaciones</span>
                                <span class="arrow"><i class="fas fa-angle-down"></i></span>
                            </a>
                            <!-- submenus -->
                            <ul class="accordion_menu">
                            <?php
                            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
                                ?>
                                <li>
                                    <a href="paginas/calificarAlum.php" class="cta">
                                        <span class="icon_submenu"><i class="fas fa-star-half-alt"></i></span>
                                        <span class="text_submenu">Calificar</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <li>
                                    <a href="#" class="" onclick="ajax('contenido','paginas/tablaCalificacion.php')">
                                        <span class="icon_submenu"><i class="fas fa-list-ul"></i></span>
                                        <span class="text_submenu">Ver Calificacion</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                       
                        
                         <li class="items">
                            <a class="txt_menu" href="http://192.168.1.65:4747/video" >
                                <span class="icon"><i class="fas fa-camera"></i></span>
                                <span class="text">Video</span>

                            </a>
                        </li>
                    </ul>

                    
                </div>
            </div>

            <!-- Contenedor de header y contenido -->
            <div class="head_main">
                <!-- Encabezado -->
                <header>
                    <div class="header_main">
                        <div class="btn_menu">
                            <div class="hamburger">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>

                    </div>
                </header>
                <!-- contenedor de contenido -->
                <div class="main_container">
                    <div class="content" id="contenido">

                        <div class="destacados" id="destacados">
                            <div class="container_slider">
                                <div class="slider" id="slider">
                                    <?php
                                    if ($datos == null) { ?>
                                        <div class="slider_section">
                                            <div class="slider_img">Imagen 1</div>
                                        </div>
                                        <div class="slider_section">
                                            <div class="slider_img">Imagen 2</div>
                                        </div>
                                        <div class="slider_section">
                                            <div class="slider_img">Imagen 3</div>
                                        </div>
                                        <div class="slider_section">
                                            <div class="slider_img">Imagen 4</div>
                                        </div>
                                        <?php } else {
                                        foreach ($datos as $objDatos) { ?>
                                            <div class="slider_section">
                                                <div class="slider_img">
                                                    <div class="img_portada">
                                                        <img src="<?php echo $objDatos->getPortada() ?>" alt="Portada">
                                                        <div class="slider_titulo">
                                                            <span class="titulo">
                                                                <?php echo $objDatos->getTitulo() ?>
                                                            </span>
                                                            <span class="descripcion">
                                                                <?php echo substr($objDatos->getDescipcion(), 0, 80) ?>

                                                            </span>
                                                            <span class="autor">
                                                                <?php echo $objDatos->getAutor() ?>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                    <?php }
                                    } ?>


                                </div>

                                <div class="slider_btn slider_right" id="btn_right">
                                    <span><i class="fas fa-angle-right"></i></span>
                                </div>
                                <div class="slider_btn slider_left" id="btn_left">
                                    <span><i class="fas fa-angle-left"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="news" id="news">

                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Ventana modal agregar noticias -->
    <div class="modal-container">
        <form method="POST" onsubmit="return false" id="formulario_noticias" class="modal modal-close" enctype="multipart/form-data">
            <div class="ventana-modal">
                <span class="icono"><i class="far fa-plus-square"></i></span>
                <span class="titulo">crear noticia</span>
                <span class="close"><i class="fas fa-times-circle"></i></span>
            </div>

            <div class="ventana">
                <div id="contenido" class="contenido-ventana">


                    <div class="contenido encabezado">
                        <!-- <label>titulo</label> -->
                        <input type="text" id="titulo" name="titulo" class="input_encabezado" placeholder="TITULO NOTICIA" value="<?php echo $title; ?>">
                    </div>

                    <div class="contenido portada">
                        <input type="file" id="portada" name="portada" class="input_portada">
                        <input type="button" value="Subir foto" class="btn_subir_portada" onclick="document.getElementById('portada').click();">
                        <img src="img/foto_noticia.png" width="80" class="previsualizar_portada" id="previsualizar_portada">
                    </div>

                    <div class="contenido descripcion">
                        <!-- <label>descripciòn</label> -->
                        <textarea id="descripcion" name="descripcion" class="txadescripcion" placeholder="DESCRIPCIÒN"><?php echo $descip; ?></textarea>
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
                <button name="accion" value="publicar_noticia" id="publicar_noticia" class="botones btn_publicar" onclick="registrar()">publicar</button>
                <button name="cancelar_noticia" value="cancelar_noticia" id="cancelar_noticia" class="botones btn_cancelar">cancelar</button>
            </div>



        </form>
    </div>

    <!-- Ventana emergente mensajes -->
    <!-- <div class="pop_container">
        <div class="pop">
            <div class="pop_header">

                <span class="icono_pop"><i class="fas fa-exclamation-triangle"></i></span>
                <span class="titulo_pop">Eliminar usuario</span>
                <span class="close_pop"><i class="fas fa-times-circle"></i></span>

            </div>
            <div class="pop_body"></div>
            <div class="pop_btn">
                <button name="accion" value="publicar_noticia" id="publicar_noticia" class="botones btn_publicar" onclick="registrar()">publicar</button>
                <button name="cancelar_noticia" value="cancelar_noticia" id="cancelar_noticia" class="botones btn_cancelar">cancelar</button>
            </div>
        </div>
    </div> -->



    <script src="js/java.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="js/App_JQuery.js"></script>
    <script type="text/javascript" src="js/listar_Sin_recargar.js"></script>
    <script src="js/ajax.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>

