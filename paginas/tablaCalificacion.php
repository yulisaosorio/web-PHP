<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
// require_once "../control/PersonController.php";
// require_once "../control/RolController.php";
require_once '../control/CalificarController.php';
// require_once '../control/EstadoController.php';
// require_once '../control/Loguear_CTRL.php';

session_start();
$usuario = $_SESSION['correo'];
$foto_user = $_SESSION['foto'];
$rol = $_SESSION['nombre_rol'];
$nombre_usuario = $_SESSION['nombre_1'];

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
    $query = "SELECT n.*, a.foto, a.identificacion,concat(a.nombre_1,' ',a.nombre_2,' ',a.apellido_1,' ',a.apellido_2) as nombreAlunmo,m.nombre_materia
    FROM `nota` n 
    INNER JOIN alumno a ON n.id_alumno=a.id_alumno
    INNER JOIN materia m ON n.id_materia=m.id_materia LIMIT $empieza,$por_pagina";
    $resultado = mysqli_query($con, $query);


    ?>



    <div class="datatable-container">
        <div class="header-tools">
            <div class="tools">
                <ul>
                    <li>
                        <span class="icon_tituloTabla"><i class="fas fa-star-half-alt"></i></span>
                        <span class="tituloTabla">Calificaciones</span>
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
                    <th>foto</th>
                    <th>identificacion</th>
                    <th>Nombre Del Alumno</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Materia</th>
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
                        <td><img src="FotosAlum/<?php echo $fila['foto'] ?>" width="50px" height="50px" /></td>
                        <td data-titulo="Identificación"><?php echo $fila['identificacion'] ?></td>
                        <td  data-titulo="Nombre" style="text-transform: capitalize;"><?php echo $fila['nombreAlunmo'] ?></td>
                        <td data-titulo="Nota 1"><?php echo $fila['nota1'] ?></td>
                        <td data-titulo="Nota 2"><?php echo $fila['nota2'] ?></td>
                        <td data-titulo="Materia"><?php echo $fila['nombre_materia'] ?></td>
                        <?php
                        if ($_SESSION['rol'] != 3) {
                        ?>
                            <td class="administrar">
                                <a class="editar" href="paginas/calificarAlumEditar.php?id_calif=<?php echo $fila['id_nota'] ?>">
                                    <span class="icon_ver"><i class="fas fa-edit"></i></span>
                                </a>
                                <a class="eliminar" href="paginas/calificarAlumEliminar.php?id_calif=<?php echo $fila['id_nota'] ?>">
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
                $query = "SELECT n.*, a.foto, a.identificacion,concat(a.nombre_1,' ',a.nombre_2,' ',a.apellido_1,' ',a.apellido_2) as nombreAlunmo,m.nombre_materia
                FROM `nota` n 
                INNER JOIN alumno a ON n.id_alumno=a.id_alumno
                INNER JOIN materia m ON n.id_materia=m.id_materia";
                $resultado = mysqli_query($con, $query);
                // contar el total de registros
                $total_registros = mysqli_num_rows($resultado);
                //ceil() para redonder el numero total de registros
                $total_paginas = ceil($total_registros / $por_pagina);
                ?>

                <ul>
                    <li><a class="activePrimera" href="#" onclick="ajax('contenido', 'paginas/tablaCalificacion.php?pagina=1')">Primera</a></li>
                    <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                        <li><a class="active2" href="#" onclick="ajax('contenido', 'paginas/tablaCalificacion.php?pagina=<?php echo $i ?>')"><?php echo $i ?></a></li>
                    <?php } ?>
                    <li><a class="activeUltima" href="#" onclick="ajax('contenido','paginas/tablaCalificacion.php?pagina=<?php echo $total_paginas ?>')">Ultima</a></li>
                </ul>
            </div>
        </div>

    </div>

    <script src="js/tabla.js"></script>

</body>

</html>