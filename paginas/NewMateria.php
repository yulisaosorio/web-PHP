<?php
//si la pagina esta dentro de una carpeta siempre sera necesario el ../
// si no esta en carpeta todos seran sin el ../
require_once '../control/MateriaController.php';
require_once '../control/ComboxController.php';
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

    <div class="btn_back">
        <a href="../index.php">
            <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
            <span class="txt_back">Volver</span>
        </a>
    </div>
    <div class="content" style="width: 600px; margin: auto;">
        <form action="" method="POST" enctype="multipart/form-data">

            <h3>Nueva Materia</h3>


            <div class="form-group">
                <label for="id_materia">Id Materia</label>
                <input type="number" class="form-control" id="id_materia" name="id_materia" value="<?php echo $id_materia ?>">
            </div>


            <div class="form-group">
                <label for="nombre_materia">Nombre de la Materia</label>
                <input type="text" class="form-control" id="nombre_materia" name="nombre_materia" value="<?php echo $nombre_materia ?>">
            </div>

            <div class="form-group">
                <label for="id_instructor">Profesor a cargo</label>
                <select name="id_instructor" id="id_instructor" class="form-control">
                    <option value="0">Seleccione...</option>
                    <?php foreach ($instructor as $objInstructor) {
                        if ($objInstructor->getId_instructor() != 0) ?>
                        <option <?php if ($id_instructor == $objInstructor->getId_instructor()) echo " selected"; ?> value="<?php echo $objInstructor->getId_instructor(); ?>"><?php echo $objInstructor->getNombre_completo(); ?> </option>
                    <?php } ?>
                </select>
            </div>

            <?php echo @$mensaje; ?>


            <?php if ($consultado == true) { ?>

                <button type="submit" name="accion" value="Modificar" class="btn btn-info">Modificar</button>
                <button type="submit" name="accion" value="Eliminar" class="btn btn-danger">Eliminar</button>
            <?php } ?>

            <?php if ($consultado != true) { ?>
                <button type="submit" name="accion" value="Guardar" class="btn btn-primary">Guardar</button>
                <button type="submit" name="accion" value="Consultar" class="btn btn-primary">Consultar</button>

            <?php } ?>


        </form>


        <div class="content" style="width: 100%;  margin: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id materia</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Instructor</th>


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
                                <td><?php echo $fila->id_materia; ?> </td>
                                <td><?php echo $fila->nombre_materia; ?></td>
                                <td><?php echo $fila->nombre_completo; ?></td>




                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
}else{
header("location:../index.php");
}
?>