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

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
        <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/calificarAlum.css">
        <title>YDJK</title>
    </head>


    <body>

        <div class="wrapper">
            <!-- contenedor de logo e informacion -->
            <div class="head_info">
                <div class="logo"><img src="../img/ydjk.png" alt="logo"></div>
                <h5>administrador educativo</h5>
            </div>

            <div class="wrapper_inner" id="wrapper_inner">

                <!-- boton atras -->
                <div class="btn_back">
                    <a href="../index.php">
                        <span class="icon_back"><i class="fas fa-chevron-circle-left"></i></span>
                        <span class="txt_back">Volver</span>
                    </a>
                </div>
                <form class="container" action="" method="POST" enctype="multipart/form-data">
                    <div class="resumen">
                        <div class="rightDe">

                            <div class="header">
                                <div class="name_role">
                                    <div class="name">
                                        ¿Eliminar calificacion?
                                    </div>
                                    <hr>
                                    <div class="mensaje">
                                        <?php echo @$mensaje; ?>
                                    </div>

                                </div>
                            </div>

                            <div class="rightDe_inner">
                                <div class="campos_conta">
                                    <div style="display:none ;" class="dat_li">
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>

                                        <input type="number" placeholder="Ingrese el Id de la nota para consultar" class="input_contactos rightDe" id="id_nota" name="id_nota" value="<?php echo $id_nota ?>">

                                    </div>


                                    <div class="dat_li">
                                        <select name="id_alumno" id="id_alumno" class="selecionar">
                                            <option value="0" class="Instructor">Seleccione un Estudiante</option>
                                            <?php foreach ($alumno as $objAlu) {
                                                if ($objAlu->getId_alumno() != 0) ?>
                                                <option <?php if ($id_alumno == $objAlu->getId_alumno()) echo " selected"; ?> value="<?php echo $objAlu->getId_alumno(); ?>"><?php echo $objAlu->getNombre_completo(); ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>


                                    <div class="dat_li">
                                        <select name="id_materia" id="id_materia" class="selecionar">
                                            <option value="0">Seleccione una Materia</option>
                                            <?php foreach ($materia as $objMat) {
                                                if ($objMat->getId_materia() != 0) ?>
                                                <option class="opmateria" <?php if ($id_materia == $objMat->getId_materia()) echo " selected"; ?> value="<?php echo $objMat->getId_materia(); ?>"><?php echo $objMat->getMateria(); ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="campos_conta">
                                    <div class="dat_li">
                                        <div class="icon">
                                            <i class="fas fa-spell-check"></i>
                                        </div>
                                        <input type="text" class="input_contactos rightDe" placeholder="nota 1 " id="nota_1" name="nota_1" value="<?php echo $nota_1 ?>">
                                    </div>

                                    <div class="dat_li">
                                        <div class="icon">
                                            <i class="fas fa-spell-check"></i>
                                        </div>
                                        <input type="text" class="input_contactos rightDe" placeholder="nota 2" id="nota_2" name="nota_2" value="<?php echo $nota_2 ?>">

                                    </div>

                                </div>


                                <div class="boton">
                                    <?php if ($consultado == true) { ?>

                                        <!-- <button style="margin: 15px; box-shadow: 5px 5px 10px black; " type="submit" name="accion" value="Modificar" class="btn btn_guardar">Modificar</button> -->
                                        <button style="margin: 15px; box-shadow: 5px 5px 10px black; " type="submit" name="accion" value="Eliminar" class="btn btn_guardar">Eliminar</button>
                                    <?php } ?>

                                    <?php if ($consultado != true) { ?>
                                        <!-- <button style="margin: 15px; box-shadow: 5px 5px 10px black; " type="submit" name="accion" value="Guardar" class="btn btn_guardar">Guardar</button> -->

                                    <?php } ?>
                                    <!-- <button style="margin: 15px; box-shadow: 5px 5px 10px black; " type="submit" name="accion" value="Consultar" class="btn btn_guardar">Consultar</button> -->





                                    <!-- <a href="#" class="btn btn_guardar">calificar</a> -->
                                    <!-- <a href="#" class="btn btn_cancelar">cancelar</a> -->
                                </div>
                            </div>

                        </div>

                    </div>
            </div>
            </form>
        </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("location:../index.php");
}
?>