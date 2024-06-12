<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
require_once "../control/PersonController.php";
require_once "../control/RolController.php";
require_once '../control/EstadoController.php';

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
    <link rel="stylesheet" href="../css/tbl_instructores.css">
    <script src="js/jquery-3.5.1.js"></script>
  </head>

  <body>

    <?php

    // conexion BD
    $objConexion = new ConeccionDB();
    $con = $objConexion->conectarMysql();


    // cantidad de registro por pagina
    $por_pagina = 3;

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

    <h3>Padres de familia</h3>
    <table align="center" border="3">
      <tr>
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
      </tr>

      <?php
      while ($fila = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
          <!-- <td><?php echo $fila['id_persona'] ?></td> -->
          <td data-titulo="cedula"><?php echo $fila['cedula'] ?></td>
          <td data-titulo="nombre"><?php echo $fila['nombre'] ?></td>
          <td data-titulo="edad"><?php edad($fila['fecha_nac']) ?></td>
          <td data-titulo="clave"><?php echo $fila['clave'] ?></td>
          <td data-titulo="telefono"><?php echo $fila['telefono'] ?></td>
          <td data-titulo="dirección"><?php echo $fila['direccion'] ?></td>
          <td data-titulo="edad"><?php echo $fila['edad'] ?></td>
          <td data-titulo="rol"><?php echo $fila['rol'] ?></td>
          <td data-titulo="estado"><?php echo $fila['estado'] ?></td>
          <td><img src="fotos/<?php echo $fila['foto'] ?>" width="50px" height="50px" /></td>
          <td>
            <a href="#">Ver</a>
            <a href="#">Editar</a>
            <a href="#">Eliminar</a>
          </td>
        </tr>



      <?php
      }
      ?>
    </table>

    <!-- paginacion -->
    <div>
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

      <a href="#" onclick="ajax('contenido', 'paginas/tbl_padres.php?pagina=1')">Primera</a>
      <!-- ajax('contenido', 'paginas/tbl_instructores.php') -->



      <?php
      for ($i = 1; $i <= $total_paginas; $i++) { ?>
        <a href="#" onclick="ajax('contenido', 'paginas/tbl_padres.php?pagina=<?php echo $i ?>')"><?php echo $i ?> </a>
      <?php } ?>
      <a href="#" onclick="ajax('contenido','paginas/tbl_padres.php?pagina=<?php echo $total_paginas ?>')">Ultima</a>

    </div>

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