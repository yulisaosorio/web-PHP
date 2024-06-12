<?php
require_once '../control/GrupoController.php';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>



</head>


<body>

    <div class="btn_back">
        <a href="../index.php">
            <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
            <span class="txt_back">Volver</span>
        </a>
    </div>

    <div class="content" style="width: 600px; margin: auto;">
        <!-- AQUI -->
        <form action="" method="POST" enctype="multipart/form-data">


            <h3>Crear Grupo</h3>
                <!--  -->
            <div class="form-group">
                <label for="id_ficha_grupo">ID Grupo</label>
                <input type="number" placeholder="Ingrese el Id del grupo para consultar" class="form-control" id="id_ficha_grupo" name="id_ficha_grupo" value="<?php echo $id_ficha_grupo ?>">
            </div>



            <div class="form-group">
                <label for="nom_grupo">Nombre del Grupo</label>
                <input type="text" class="form-control" id="nom_grupo" name="nom_grupo" value="<?php echo $nom_grupo ?>">
            </div>

            <div class="form-group">
                <label for="id_instructor">Instructor</label>

                <select name="id_instructor" id="id_instructor" class="form-control">
                    <option value="0">Seleccione un Instructor</option>
                    <?php
                    foreach ($instructor as $objInst) {
                        if ($objInst->getId_instructor() != 0)

                    ?>

                        <option <?php if ($id_instructor == $objInst->getId_instructor()) echo " selected"; ?> value="<?php echo $objInst->getId_instructor(); ?>"><?php echo $objInst->getNombre_completo(); ?> </option>
                    <?php
                    }
                    ?>
                </select>

            </div>


            <div class="form-group">
                <label for="id_jornada">Jornada</label>
                <select name="id_jornada" id="id_jornada" class="form-control">
                    <option value="0">Seleccione una Jornada</option>
                    <?php
                    foreach ($jornada as $objJornada) {
                        if ($objJornada->getId_jornada() != 0)

                    ?>

                        <option <?php if ($id_jornada == $objJornada->getId_jornada()) echo " selected"; ?> value="<?php echo $objJornada->getId_jornada(); ?>"><?php echo $objJornada->getJornada(); ?> </option>
                    <?php
                    }
                    ?>
                </select>
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
                    <th scope="col">Id Grupo</th>
                    <th scope="col">Nombre del Grupo</th>
                    <th scope="col">Instructor</th>
                    <th scope="col">Jornada</th>

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
                            <td ><?php echo $fila->id_ficha_grupo; ?> </td>
                            <td ><?php echo $fila->nom_grupo; ?></td>
                            <td ><?php echo $fila->id_instructor; ?></td>
                            <td><?php echo $fila->jornada; ?></td>
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