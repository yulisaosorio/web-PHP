<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
// require_once "../control/PersonController.php";
// require_once "../control/RolController.php";
require_once '../control/MateriaController.php';
// require_once '../control/EstadoController.php';

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
    $query = "SELECT m.id_materia,m.nombre_materia,p.cedula,concat(p.nombre_1,' ',p.nombre_2,' ',p.apellido_1,' ',p.apellido_2) as instructor FROM `materia` m
    INNER JOIN persona p ON m.id_instructor=p.id_persona LIMIT $empieza,$por_pagina";
    $resultado = mysqli_query($con, $query);


    ?>



    <div class="datatable-container">
        <div class="header-tools">
            <div class="tools">
                <ul>
                    <li>
                        <a href="#" onclick="ajax('contenido','paginas/tablaUsuarios.php')">
                            <span class="icon_tituloTabla"><i class="fas fa-book"></i></span>
                            <span class="tituloTabla">Materias Registradas</span>
                        </a>
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
                    <th>Id Materia</th>
                    <th>Nombre de la materia</th>
                    <th>Cedula Instructor</th>
                    <th>Nombre del instructor</th>
                    <?php
                            if ($_SESSION['rol'] == 1 ) {
                                ?>
                    <th scope="col">Administrar</th>
                    <?php } ?>  
                </tr>
            </thead>

            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td data-titulo="Código materia"><?php echo $fila['id_materia'] ?></td>
                        <td data-titulo="Materia"><?php echo $fila['nombre_materia'] ?></td>
                        <td data-titulo="Identificación"><?php echo $fila['cedula'] ?></td>
                        <td data-titulo="Instructor" style="text-transform: capitalize;"><?php echo $fila['instructor'] ?></td>
                        <?php
                            if ($_SESSION['rol'] == 1 ) {
                                ?>
                        <td class="administrar">
                            <a class="ver" href="paginas/materiasVer.php?mate=<?php echo $fila['id_materia'] ?>">
                                <span class="icon_ver"><i class="fas fa-info-circle"></i></span>
                            </a>
                            <a class="editar" href="paginas/materiasEditar.php?mate=<?php echo $fila['id_materia'] ?>">
                                <span class="icon_ver"><i class="fas fa-edit"></i></span>
                            </a>
                            <a class="eliminar" href="paginas/materiasEliminar.php?mate=<?php echo $fila['id_materia'] ?>">
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
                $query = "SELECT m.id_materia,m.nombre_materia,p.cedula,concat(p.nombre_1,' ',p.nombre_2,' ',p.apellido_1,' ',p.apellido_2) as instructor FROM `materia` m
                INNER JOIN persona p ON m.id_instructor=p.id_persona";
                $resultado = mysqli_query($con, $query);
                // contar el total de registros
                $total_registros = mysqli_num_rows($resultado);
                //ceil() para redonder el numero total de registros
                $total_paginas = ceil($total_registros / $por_pagina);
                ?>

                <ul>
                    <li><a class="activePrimera" href="#" onclick="ajax('contenido', 'paginas/tablaMateria.php?pagina=1')">Primera</a></li>
                    <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                        <li><a class="active2" href="#" onclick="ajax('contenido', 'paginas/tablaMateria.php?pagina=<?php echo $i ?>')"><?php echo $i ?></a></li>
                    <?php } ?>
                    <li><a class="activeUltima" href="#" onclick="ajax('contenido','paginas/tablaMateria.php?pagina=<?php echo $total_paginas ?>')">Ultima</a></li>
                </ul>
            </div>
        </div>

    </div>

    <script src="js/tabla.js"></script>

</body>

</html>