<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
// require_once "../control/PersonController.php";
// require_once "../control/RolController.php";
require_once('./insertarNoticia.php');

session_start();
$usuario = $_SESSION['correo'];
$foto_user = $_SESSION['foto'];
$rol = $_SESSION['nombre_rol'];
$nombre_usuario = $_SESSION['nombre_1'];
$cedulaSess =$_SESSION['cedula'];

// $usuario = $_SESSION['correo'];
// $rol = $_SESSION['rol'];
// if (isset($usuario) && $rol == 1) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
        <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/tabla.css">
        <link href="https://fonts.googleapis.com/icon?family=">
        <title>YDJK</title>
    </head>

    <body>
       
        <div class="datatable-container">
            <div class="header-tools">
                <div class="tools">
                    <ul>
                        <span class="icon_tituloTabla"><i class="fas fa-user-graduate"></i></span>
                        <span class="tituloTabla">Noticias </span>
                    </ul>
                </div>

                <div class="search">
                    <div class="icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" name="" id="" class="search-input">
                </div>
            </div>

            <table id="datatable" class="datatable">
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th>Foto</th>
                        <th>Identificacion</th>
                        <th>Nombre Del Alumno</th>
                        <th>Edad</th>
                        <th>Grupo</th>
                        <?php
                        if ($_SESSION['rol'] == 1) {
                        ?>
                            <th>Estado</th>
                            <th></th>


                            <th scope="col">Administrar</th>
                        <?php } ?>

                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                        <tr>
                            <!-- <td class="table-choeckbox"><input type="checkbox" name="" id=""></td> -->
                            <td><img src="imgDB/<?php echo $fila['portada']; ?>" width="80" alt="portada_noticia">
                                </td>
                            <td data-titulo="Identificación"><?php echo $fila['titulo'] ?></td>
                            <td data-titulo="Nombre"><?php echo $fila['direccion'] ?></td>
                            <td data-titulo="Edad"><?php edad($fila['categoria']) ?></td>
                            <td data-titulo="Grupo"><?php echo $fila['autor'] ?></td>
                            <td data-titulo="Grupo"><?php echo $fila['fecha_hora'] ?></td>
                            <?php
                            if ($_SESSION['rol'] == 1) {
                            ?>
                                <td data-titulo="Estado"><?php echo $fila['estado']  ?></td>
                                <td>
                                    <?php if ($fila['estado'] == 'Activo') { ?><span class="away"></span>
                                    <?php } else { ?><span class="offline"></span><?php  } ?>
                                </td>


                                <td class="administrar">

                                    <!-- aqui -->
                                    <a class="ver" href="paginas/alumno_ver.php?ident=<?php echo $fila['identificacion'] ?>">
                                        <span class="icon_ver"><i class="fas fa-info-circle"></i></span>
                                    </a>
                                    <a class="editar" href="paginas/alumnoEditar.php?ident=<?php echo $fila['identificacion'] ?>">
                                        <span class="icon_ver"><i class="fas fa-edit"></i></span>
                                    </a>
                                    <a class="eliminar" href="paginas/alumnoEliminar.php?ident=<?php echo $fila['identificacion'] ?>">
                                        <span class="icon_ver"><i class="fas fa-trash-alt"></i></span>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="footer-tools">

                <div class="pages">
                    <?php
                    // seleccionar todo de la tabla usuarios
                    $query = "SELECT a.foto, a.identificacion,CONCAT(a.nombre_1,' ',a.nombre_2,' ',a.apellido_1,' ',a.apellido_2) AS nombre,a.fecha_nac,e.nombre as estado,fg.nom_grupo AS grupo
                from alumno a
                INNER JOIN estado e ON a.estado=e.id_estado
                INNER JOIN ficha_grupo fg ON a.id_ficha_grupo=fg.id_ficha_grupo  
                ORDER BY `a`.`identificacion`";
                    $resultado = mysqli_query($con, $query);
                    // contar el total de registros
                    $total_registros = mysqli_num_rows($resultado);
                    //ceil() para redonder el numero total de registros
                    $total_paginas = ceil($total_registros / $por_pagina);
                    ?>


                    <!-- aqui -->
                    <ul>
                        <li><a class="activePrimera" href="#" onclick="ajax('contenido', 'paginas/tablaAlumnos.php?pagina=1')">Primera</a></li>
                        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                            <li><a class="active2" href="#" onclick="ajax('contenido', 'paginas/tablaAlumnos.php?pagina=<?php echo $i ?>')"><?php echo $i ?></a></li>
                        <?php } ?>
                        <li><a class="activeUltima" href="#" onclick="ajax('contenido','paginas/tablaAlumnos.php?pagina=<?php echo $total_paginas ?>')">Ultima</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- <script src="js/tabla.js"></script> -->
    </body>

    </html>
<?php
// } else {
//     header("location:../index.php");
// }
?>