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
$rol= $_SESSION['rol'];
if(isset($usuario) && $rol==1){
?>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
    <!-- <div class="content" style="width: 600px; margin: auto;">
        <form action="" method="POST" enctype="multipart/form-data">

            <h3>Nuevo Usuario</h3>

            <?php if ($consultado == true) { ?>
                <div class="form-group">
                    <label for="id_persona">ID</label>
                    <input type="number" readonly class="form-control" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>">

                </div>
            <?php } ?>

            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="number" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula ?>">
            </div>
            <div class="form-group">
                <label for="nombre_1">Primer Nombre</label>
                <input type="text" class="form-control" id="nombre_1" name="nombre_1" value="<?php echo $nombre_1 ?>">
            </div>

            <div class="form-group">
                <label for="nombre_2">Segundo Nombre</label>
                <input type="text" class="form-control" id="nombre_2" name="nombre_2" value="<?php echo $nombre_2 ?>">
            </div>
            <div class="form-group">
                <label for="apellido_1">Primer Apellido</label>
                <input type="text" class="form-control" id="apellido_1" name="apellido_1" value="<?php echo $apellido_1 ?>">
            </div>
            <div class="form-group">
                <label for="apellido_2">Segundo Apellido</label>
                <input type="text" class="form-control" id="apellido_2" name="apellido_2" value="<?php echo $apellido_2 ?>">
            </div>


            <div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" class="form-control" id="clave" name="clave" value="<?php echo $clave ?>">
            </div>


            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono ?>">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion ?>">
            </div>
            <div class="form-group">
                <label for="fecha_nac">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?php echo $fecha_nac ?>">
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $edad ?>">
            </div>
            }

            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo ?>">
            </div>


            <div class="form-group">
                <label for="profesion">Profesión</label>
                <input type="text" class="form-control" id="profesion" name="profesion" value="<?php echo $profesion ?>">
            </div>

            <div class="form-group">
                <label for="rols">Rol</label>
                <select name="rols" id="rols" class="form-control">
                    <option value="1">Seleccione...</option>
                    <?php
                    foreach ($rol as $objRol) {
                        if ($objRol->getId_rol() != 1)

                    ?>

                        <option <?php if ($id_rol == $objRol->getId_rol()) echo " selected"; ?> value="<?php echo $objRol->getId_rol(); ?>"><?php echo $objRol->getNombre_rol(); ?> </option>
                    <?php
                    }
                    ?>


                </select>

            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" accept="image/*" class="form-control" id="foto" name="foto">
            </div>

            <div class="form-group">
                <label for="estados">Estado</label>
                <select name="estados" id="estados" class="form-control">
                    <option value="1">Seleccione...</option>
                    <?php
                    foreach ($estado as $objEstado) {
                        if ($objEstado->getId_estado() != 1)

                    ?>

                        <option <?php if ($id_estado == $objEstado->getId_estado()) echo " selected"; ?> value="<?php echo $objEstado->getId_estado(); ?>"><?php echo $objEstado->getNombre(); ?> </option>
                    <?php
                    }
                    ?>


                </select>

            </div>



            <?php echo @$mensaje; ?>
            <?php if ($consultado == true) { ?>
                <div class="form-group">

                    <img class="img-thumbnail" src="../fotos/<?php echo $nombreArchivo ?> " width="200px" />

                </div>
                <button type="submit" name="accion" value="Modificar" class="btn btn-info">Modificar</button>
                <button type="submit" name="accion" value="Eliminar" class="btn btn-danger">Eliminar</button>
            <?php } ?>

            <?php if ($consultado != true) { ?>
                <button type="submit" name="accion" value="Guardar" class="btn btn-primary">Guardar</button>

            <?php } ?>
            <button type="submit" name="accion" value="Consultar" class="btn btn-primary">Consultar</button>



        </form>
    </div> -->

    <div class="content" style="width: 90%;  margin: auto;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Primer nombre</th>
                    <th scope="col">Segundo nombre</th>
                    <th scope="col">Primer apellido</th>
                    <th scope="col">Segundo apellido</th>
                    <th scope="col">Clave</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Fecha de nacimiento</th>  
                    <th scope="col">Edad</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Profesion</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Foto</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($lista->num_rows < 1) {
                ?>
                    <tr>
                        <td colspan="6"> No hay usuarios registrados...</td>
                    </tr>

                    <?php
                } else {
                    while ($fila = $lista->fetch_object()) {
                    ?>

                        <tr>
                            <td><?php echo $fila->id_persona; ?></td>
                            <td><?php echo $fila->cedula; ?></td>
                            <td><?php echo $fila->nombre_1; ?></td>
                            <td><?php echo $fila->nombre_2; ?></td>
                            <td><?php echo $fila->apellido_1; ?></td>
                            <td><?php echo $fila->apellido_2; ?></td>
                            <td><?php echo $fila->clave; ?></td>
                            <td><?php echo $fila->telefono; ?></td>
                            <td><?php echo $fila->direccion; ?></td>
                            <td><?php echo $fila->fecha_nac; ?></td>
                            <td><?php echo $fila->edad; ?></td>
                            <td><?php echo $fila->correo; ?></td>
                            <td><?php echo $fila->profesion; ?></td>
                            <td><?php echo $fila->rol; ?></td>
                            <td><?php echo $fila->estado; ?></td>

                            <td> <img src="../fotos/<?php echo $fila->foto; ?> " width="50px" height="50px" /> </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
}else{
header("location:../index.php");
}
?>