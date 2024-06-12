<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
// require_once "../control/PersonController.php";
// require_once "../control/RolController.php";
require_once '../control/GrupoController.php';
// require_once '../control/EstadoController.php';
// require_once '../control/Loguear_CTRL.php';

session_start();
$usuario = $_SESSION['correo'];
$foto_user = $_SESSION['foto'];
$rol = $_SESSION['nombre_rol'];
$nombre_usuario = $_SESSION['nombre_1'];
$cedulaSess = $_SESSION['cedula'];


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
        <?php

        // conexion BD
        $objConexion = new ConeccionDB();
        $con = $objConexion->conectarMysql();


        // cantidad de registro por pagina
        $por_pagina = 8;

        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }

        // la Pgina inicia en 0
        $empieza = ($pagina - 1) * $por_pagina;
        // seleccionar los registros de la tabla persona con limit
        $query = "SELECT FG.*,CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2) AS id_instructor, JO.nombre AS jornada
        FROM `ficha_grupo` FG INNER JOIN persona PER ON PER.id_persona = FG.id_instructor 
        INNER JOIN jornada JO ON FG.id_jornada = JO.id_jornada ORDER BY FG.id_ficha_grupo LIMIT $empieza,$por_pagina";

        $query2 = "SELECT FG.*,CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2) AS id_instructor, JO.nombre AS jornada
        FROM `ficha_grupo` FG INNER JOIN persona PER ON PER.id_persona = FG.id_instructor 
        INNER JOIN jornada JO ON FG.id_jornada = JO.id_jornada
        WHERE PER.cedula ='$cedulaSess'";


        if ($_SESSION['rol'] !=1) {
            $resultado = mysqli_query($con, $query2);
        } else {
            
            $resultado = mysqli_query($con, $query);
        }



        ?>



        <div class="datatable-container">
            <div class="header-tools">
                <div class="tools">
                    <ul>
                        <li>
                            <span class="icon_tituloTabla"><i class="fas fa-layer-group"></i></span>
                            <span class="tituloTabla">Grupos</span>
                        </li>
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
                        <th scope="col">Id Grupo</th>
                        <th scope="col">Nombre del Grupo</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Jornada</th>
                        <?php
                        if ($_SESSION['rol'] == 1) {
                        ?>
                            <th scope="col">Administrar</th>
                        <?php } ?>

                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                        <tr>
                            <td data-titulo="Codigo Grupo"><?php echo $fila['id_ficha_grupo'] ?></td>
                            <td data-titulo="Nombre Grupo"><?php echo $fila['nom_grupo'] ?></td>
                            <td data-titulo="Codigo Instructor"><?php echo $fila['id_instructor'] ?></td>
                            <td data-titulo="Jornada"><?php echo $fila['jornada'] ?></td>
                            <?php
                            if ($_SESSION['rol'] == 1) {
                            ?>
                                <td class="administrar">

                                    <!-- <a class="ver" href="paginas/grupoVer.php?id_grup=<?php echo $fila['id_ficha_grupo'] ?>">
                                        <span class="icon_ver"><i class="fas fa-info-circle"></i></span>
                                    </a> -->
                                    <a class="editar" href="paginas/grupoEditar.php?id_grup=<?php echo $fila['id_ficha_grupo'] ?>">
                                        <span class="icon_ver"><i class="fas fa-edit"></i></span>
                                    </a>
                                    <a class="eliminar" href="paginas/grupoEliminar.php?id_grup=<?php echo $fila['id_ficha_grupo'] ?>">
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
                    $query = "SELECT FG.*,CONCAT (PER.nombre_1,' ', PER.nombre_2,' ', PER.apellido_1,' ', PER.apellido_2) AS id_instructor, JO.nombre AS jornada
                    FROM `ficha_grupo` FG INNER JOIN persona PER ON PER.id_persona = FG.id_instructor 
                    INNER JOIN jornada JO ON FG.id_jornada = JO.id_jornada ORDER BY FG.id_ficha_grupo";
                    $resultado = mysqli_query($con, $query);
                    // contar el total de registros
                    $total_registros = mysqli_num_rows($resultado);
                    //ceil() para redonder el numero total de registros
                    $total_paginas = ceil($total_registros / $por_pagina);
                    ?>


                    <!-- aqui -->
                    <ul>
                        <li><a class="activePrimera" href="#" onclick="ajax('contenido', 'paginas/tablaGrupos.php?pagina=1')">Primera</a></li>
                        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                            <li><a class="active2" href="#" onclick="ajax('contenido', 'paginas/tablaGrupos.php?pagina=<?php echo $i ?>')"><?php echo $i ?></a></li>
                        <?php } ?>
                        <li><a class="activeUltima" href="#" onclick="ajax('contenido','paginas/tablaGrupos.php?pagina=<?php echo $total_paginas ?>')">Ultima</a></li>
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
// ?>