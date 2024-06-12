<?php
require_once '../control/CalificarController.php';
require_once '../control/ComboxController.php';
/* if(isset($_FILES["foto"]["name"])){ //con esto se verifica si se envio la informacion
  echo "si";
  } */
//var_dump($_POST);
session_start();
$usuario = $_SESSION['correo'];
$rol = $_SESSION['rol'];
if (isset($usuario) && $rol == 1) {

?>
    <html>

    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>



    </head>

    <!-- boton atras -->
    <div class="btn_back">
        <a href="../index.php">
            <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
            <span class="txt_back">Volver</span>
        </a>
    </div>

    <body>
        <div class="content" style="width: 600px; margin: auto;">
            <form action="" method="POST" enctype="multipart/form-data">


                <h3>Calificar</h3>



                <div class="form-group">
                    <label for="id_nota">ID nota</label>
                    <input type="number" placeholder="Ingrese el Id de la nota" class="form-control" id="id_nota" name="id_nota" value="<?php echo $id_nota ?>">

                </div>


                <div class="form-group">
                    <label for="id_alumno">Estudiante</label>

                    <select name="id_alumno" id="id_alumno" class="form-control">
                        <option value="0">Seleccione un Estudiante</option>
                        <?php
                        foreach ($alumno as $objAlu) {
                            if ($objAlu->getId_alumno() != 0)

                        ?>

                            <option <?php if ($id_alumno == $objAlu->getId_alumno()) echo " selected"; ?> value="<?php echo $objAlu->getId_alumno(); ?>"><?php echo $objAlu->getNombre_completo(); ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="id_materia">Materia</label>
                    <select name="id_materia" id="id_materia" class="form-control">
                        <option value="0">Seleccione una Materia</option>
                        <?php
                        foreach ($materia as $objMat) {
                            if ($objMat->getId_materia() != 0)

                        ?>

                            <option <?php if ($id_materia == $objMat->getId_materia()) echo " selected"; ?> value="<?php echo $objMat->getId_materia(); ?>"><?php echo $objMat->getMateria(); ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>



                <div class="form-group">
                    <label for="nota_1">Nota 1</label>
                    <input type="text" class="form-control" id="nota_1" name="nota_1" value="<?php echo $nota_1 ?>">
                </div>
                <div class="form-group">
                    <label for="nota_2">Nota 2</label>
                    <input type="text" class="form-control" id="nota_2" name="nota_2" value="<?php echo $nota_2 ?>">
                </div>


                <?php if ($consultado == true) { ?>

                    <button style="margin: 15px " type="submit" name="accion" value="Modificar" class="btn btn-info">Modificar</button>
                    <button style="margin: 15px " type="submit" name="accion" value="Eliminar" class="btn btn-danger">Eliminar</button>
                <?php } ?>

                <?php if ($consultado != true) { ?>
                    <button style="margin: 15px " type="submit" name="accion" value="Guardar" class="btn btn-primary">Guardar</button>

                <?php } ?>
                <button style="margin: 15px " type="submit" name="accion" value="Consultar" class="btn btn-primary">Consultar</button>





            </form>

            <?php echo @$mensaje; ?>




        </div>

        <div class="content" style="width: 80%;  margin: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id Nota</th>
                        <th scope="col">Estudiante</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Nota 1</th>
                        <th scope="col">Nota 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lista->num_rows < 1) {
                    ?>
                        <tr>
                            <td colspan="6"> No hay Alumnos registrados. <a href="#">Crear Alumno nuevo</a></td>
                        </tr>

                        <?php
                    } else {
                        while ($fila = $lista->fetch_object()) {
                        ?>

                            <tr>
                                <td><?php echo $fila->id_nota; ?> </td>
                                <td><?php echo $fila->id_alumno; ?></td>
                                <td><?php echo $fila->id_materia; ?></td>
                                <td><?php echo $fila->nota_1; ?></td>
                                <td><?php echo $fila->nota_2; ?></td>
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
} else {
    header("location:../index.php");
}
?>