<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
// require_once "../control/PersonController.php";
// require_once "../control/RolController.php";
require_once('./insertarNoticia.php');

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
    <html lang="es">

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
        $query = "SELECT N.id,N.titulo,N.portada,N.descripcion,C.nombre,CONCAT(P.nombre_1,P.nombre_2,P.apellido_1,P.apellido_2) AS autor
        from noticia N 
        INNER JOIN persona P ON  N.id_persona= P.id_persona
        INNER JOIN  categoria_noticia C ON N.id_categoria =C.id_categoria 
        GROUP BY N.id LIMIT $empieza,$por_pagina";
        $resultado = mysqli_query($con, $query);
        ?>

       
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
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>categoria</th>
                        <th>autor</th>
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
                            <td ><img src="<?php echo $fila['portada']?>" width="50px" height="50px" /></td>
                            <!-- <td><?php echo $fila['id'] ?></td> -->
                                
                            <td data-titulo="Identificación"><?php echo $fila['titulo']?></td>
                            <td data-titulo="Nombre"><?php echo $fila['descripcion']?></td>
                            <td data-titulo="Edad"><?php echo $fila['nombre']?></td>
                            <td data-titulo="Grupo"><?php echo $fila['autor']?></td>
                            <?php
                            if ($_SESSION['rol'] == 1) {
                            ?>
                                
                                <td class="administrar">

                                    <!-- aqui -->
                                    <a class="editar" href="editarNoticias.php?titulo=<?php echo $fila['titulo']?>">

                                        <span class="icon_ver"><i class="fas fa-edit"></i></span>
                                    </a>

                                    <a class="eliminar" href="eliminarNoticias.php?titulo=<?php echo $fila['titulo']?>">
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
                    // la Pgina inicia en 0
                    $empieza = ($pagina - 1) * $por_pagina;
                    // seleccionar los registros de la tabla persona con limit
                    $query = "SELECT N.id,N.titulo,N.portada,N.descripcion,C.nombre,CONCAT(P.nombre_1,P.nombre_2,P.apellido_1,P.apellido_2) AS autor
                    from noticia N 
                    INNER JOIN persona P ON  N.id_persona= P.id_persona
                    INNER JOIN  categoria_noticia C ON N.id_categoria =C.id_categoria 
                    GROUP BY N.id LIMIT $empieza,$por_pagina";
                    $resultado = mysqli_query($con, $query);
                    // contar el total de registros
                    $total_registros = mysqli_num_rows($resultado);
                    //ceil() para redonder el numero total de registros
                    $total_paginas = ceil($total_registros / $por_pagina);
                    ?>
                    <!-- aqui -->
                    <ul>
                        <li><a class="activePrimera" href="#" onclick="ajax('contenido',
                         'tablaNoticias.php?pagina=1')">Primera</a></li>
                        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                            <li><a class="active2" href="#" onclick="ajax('contenido', 'tablaNoticias.php?pagina=<?php echo $i ?>')"><?php echo $i ?></a></li>
                        <?php } ?>
                        <li><a class="activeUltima" href="#" onclick="ajax('contenido','tablaNoticias.php?pagina=<?php echo $total_paginas ?>')">Ultima</a></li>
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
// } else {
//     header("location:../index.php");
// }
?>