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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="../css/tabla.css"> -->
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
    $query = "SELECT PER.id_persona,PER.cedula,CONCAT(PER.nombre_1,' ',PER.nombre_2,' ',PER.apellido_1) as nombre,PER.clave,PER.telefono,PER.direccion,PER.fecha_nac,ROL.nombre_rol AS rol, EST.nombre AS estado,PER.foto
          FROM `persona` PER 
          INNER JOIN rol ROL ON PER.rol = ROL.id_rol
          INNER JOIN estado EST ON PER.estado = EST.id_estado 
          WHERE ROL.id_rol = 3 ORDER BY PER.nombre_1 LIMIT $empieza,$por_pagina";
    $resultado = mysqli_query($con, $query);


    ?>



    <div class="datatable-container">
        <div class="header-tools">
            <div class="tools">
                <ul>
                    <li>
                        <a href="#" onclick="ajax('contenido','paginas/tablaUsuarios.php')">
                            <span class="icon_tituloTabla"><i class="fas fa-list-ul"></i></span>
                            <span class="tituloTabla">Ver todos</span>
                        </a>
                    </li>
                    <li><a href="#" onclick="ajax('contenido', 'paginas/tablaInstructores.php')">
                            <span class="icon_tituloTabla"><i class="fas fa-chalkboard-teacher"></i></span>
                            <span class="tituloTabla">Instructores</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="ajax('contenido','paginas/tablapadres.php')">
                            <span class="icon_tituloTabla"><i class="fas fa-user-friends"></i></span>
                            <span class="tituloTabla">Padres de familia</span>
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
                    <th>Foto</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Clave</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th></th>
                    <th scope="col">Administrar</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <!-- <td class="table-choeckbox"><input type="checkbox" name="" id=""></td> -->
                        <td><img src="fotos/<?php echo $fila['foto'] ?>" width="50px" height="50px" /></td>
                        <!-- <td><?php echo $fila['id_persona'] ?></td> -->
                        <td data-titulo="cedula"><?php echo $fila['cedula'] ?></td>
                        <td data-titulo="nombre"><?php echo $fila['nombre'] ?></td>
                        <td data-titulo="edad"><?php edad($fila['fecha_nac']) ?></td>
                        <td data-titulo="telefono"><?php echo $fila['telefono'] ?></td>
                        <td data-titulo="dirección"><?php echo $fila['direccion'] ?></td>
                        <td data-titulo="clave"><?php echo $fila['clave'] ?></td>
                        <td data-titulo="rol"><?php echo $fila['rol'] ?></td>
                        <td data-titulo="estado"><?php echo $fila['estado']  ?></td>
                        <td>
                            <?php if ($fila['estado'] == 'Activo') { ?><span class="away"></span>
                            <?php } else { ?><span class="offline"></span><?php  } ?>
                        </td>
                        <td class="administrar">
                            <a class="ver" href="paginas/usuarios_ver.php?cedu=<?php echo $fila['cedula'] ?>">
                                <span class="icon_ver"><i class="fas fa-info-circle"></i></span>
                            </a>
                            <a class="editar" href="paginas/usuariosEditar.php?cedu=<?php echo $fila['cedula'] ?>">
                                <span class="icon_ver"><i class="fas fa-edit"></i></span>
                            </a>
                            <a class="eliminar" href="paginas/usuariosEliminar.php?cedu=<?php echo $fila['cedula'] ?>">
                                <span class="icon_ver"><i class="fas fa-trash-alt"></i></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="footer-tools">
            <div class="list-items">
                show
                <select name="n-entries" id="n-entries" class="n-entries">
                    <option value="">5</option>
                    <option value="" selected>10</option>
                    <option value="">15</option>
                </select>
                enties
            </div>

            <div class="pages">
                <?php
                // seleccionar todo de la tabla usuarios
                $query = "SELECT PER.*,ROL.nombre_rol AS rol, EST.nombre AS estado FROM `persona` PER INNER JOIN rol ROL ON PER.rol = ROL.id_rol
              INNER JOIN estado EST ON PER.estado = EST.id_estado 
              WHERE ROL.id_rol = 3 ORDER BY PER.nombre_1";
                $resultado = mysqli_query($con, $query);
                // contar el total de registros
                $total_registros = mysqli_num_rows($resultado);
                //ceil() para redonder el numero total de registros
                $total_paginas = ceil($total_registros / $por_pagina);
                ?>

                <ul>
                    <li><a class="activePrimera" href="#" onclick="ajax('contenido', 'paginas/tablapadres.php?pagina=1')">Primera</a></li>
                    <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                        <li><a class="active2" href="#" onclick="ajax('contenido', 'paginas/tablapadres.php?pagina=<?php echo $i ?>')"><?php echo $i ?></a></li>
                    <?php } ?>
                    <li><a class="activeUltima" href="#" onclick="ajax('contenido','paginas/tablapadres.php?pagina=<?php echo $total_paginas ?>')">Ultima</a></li>
                </ul>
            </div>
        </div>

    </div>

    <script src="js/tabla.js"></script>

    <script>
        const dt = new DataTable('#datatable', [{
            id: 'badd',
            text: 'agregar',
            icon: 'fas fa-plus-circle',
            action: function() {
                //codigo callback
            }
        }]);

        dt.parse();
    </script>

</body>
</html>
<?php
}else{
header("location:../index.php");
}
?>