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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/materias.css">
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
                <div class="resume">

                    <div class="rightD">
                        <div class="header">
                            <div class="names">
                                Nueva materia
                            </div>
                            <hr>

                            <div class="mensaje">
                                <?php echo @$mensaje; ?>
                            </div>
                        </div>

                        <div class="rightD_inner">
                            <div class="campos_info">
                                <div class="datos_li" style="display:none;">
                                    <div class="icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <!-- <input type="text" class="input_info right" placeholder="Id materia"> -->
                                    <input type="number" class="input_info right" placeholder="Id materia" id="id_materia" name="id_materia" value="<?php echo $id_materia ?>">

                                </div>

                                <div class="datos_li">
                                    <div class="icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <input type="text" class="input_info right" placeholder="nombre  de la materia" id="nombre_materia" name="nombre_materia" value="<?php echo $nombre_materia ?>">
                                </div>

                            </div>


                            <div class="campos_info">
                                <div class="datos_li">
                                    <div class="icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <select name="id_instructor" id="id_instructor" class="selecionarP">
                                        <option value="0">Instructor</option>
                                        <?php foreach ($instructor as $objInstructor) {
                                            if ($objInstructor->getId_instructor() != 0) ?>
                                            <option class="opInstructor" <?php if ($id_instructor == $objInstructor->getId_instructor()) echo " selected"; ?> value="<?php echo $objInstructor->getId_instructor(); ?>"><?php echo $objInstructor->getNombre_completo(); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="boton">

                                <?php if ($consultado == true) { ?>

                                    <button type="submit" name="accion" value="Modificar" class="bton  bton_guardar">Modificar</button>
                                    <button type="submit" name="accion" value="Eliminar" class="bton  btn-danger">Eliminar</button>
                                <?php } ?>

                                <?php if ($consultado != true) { ?>
                                    <button type="submit" name="accion" value="Guardar" class="bton  bton_guardar">Guardar</button>
                                    <!-- <button type="submit" name="accion" value="Consultar" class="bton  bton_guardar">Consultar</button> -->

                                <?php } ?>


                                <!-- <a href="#" class="bton bton_guardar">guardar</a> -->
                                <button class="bton bton_cancelar">cancelar</button>


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
}else{
header("location:../index.php");
}
?>