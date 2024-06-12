<?php

require_once '../control/GrupoController.php';
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
        <link rel="stylesheet" href="../css/crear_grupo.css">
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
                                        crear grupo
                                    </div>
                                    <hr>
                                    <!-- <br> -->
                                    <!-- MENSAJE -->
                                    <div class="mensaje">
                                        <?php echo @$mensaje; ?>
                                    </div>

                                </div>
                            </div>

                            <div class="rightDe_inner">
                                <div class="campos_contact">

                                    <div style="display:none ;" class="dato_li">
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <!-- <input type="text" class="input_contactos rightDe" placeholder="id grupo "> -->
                                        <input type="number" placeholder="Ingrese el Id del grupo para consultar" class="input_contactos rightDe" id="id_ficha_grupo" name="id_ficha_grupo" value="<?php echo $id_ficha_grupo ?>">
                                    </div>
                                    <div class="dato_li">
                                        <div class="icon">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                        <!-- <input type="text" class="input_contactos rightDe" placeholder="Nombre del grupo"> -->
                                        <input type="text" class="input_contactos rightDe" id="nom_grupo" name="nom_grupo" value="<?php echo $nom_grupo ?>" placeholder="Nombre del grupo">
                                    </div>

                                </div>

                                <div class="campos_contact">
                                    <div class="dato_li">
                                        <!-- <select class="selecionar ">
                                <option>Seleccione un instructor</option>
                                <option value="value1" class="Instructor">Facundo alberto </option>
                                <option value="value2" class="Instructor">fausto del jesus </option>
                                <option value="value2" class="Instructor">marta andrea </option>
                            </select> -->
                                        <div class="icon">
                                            <i class="fas fa-user-friends"></i>
                                        </div>

                                        <select name="id_instructor" id="id_instructor" class="selecionar">
                                            <option value="0" class="Instructor">Seleccione un Instructor</option>
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


                                    <div class="dato_li">
                                        <!-- <select class="selecionar ">
                                <option>Seleccione una jornada</option>
                                <option value="value1" class="opjornada">Mañana</option>
                                <option value="value2" class="opjornada">Tarde</option>
                            </select> -->
                                        <div class="icon">
                                            <i class="fas fa-clock"></i>
                                        </div>

                                        <!-- <label for="id_jornada">Jornada</label> -->
                                        <select name="id_jornada" id="id_jornada" class="selecionar">
                                            <option value="0" class="opjornada">Seleccione una Jornada</option>
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
                                </div>

                                <div class="boton">
                                    <!-- <a href="#" class="btn btn_guardar">guardar</a> -->

                                    <?php if ($consultado == true) { ?>

                                        <!-- <button style="margin: 15px;box-shadow: 5px 5px 10px black; " type="submit" name="accion" value="Modificar" class="btn btn_guardar">Modificar</button> -->
                                        <!-- <button style="margin: 15px; box-shadow: 5px 5px 10px black; " type="submit" name="accion" value="Eliminar" class="btn btn_guardar">Eliminar</button> -->
                                    <?php } ?>

                                    <?php if ($consultado != true) { ?>
                                        <button style="margin: 15px; box-shadow: 5px 5px 10px black;" type="submit" name="accion" value="Guardar" class="btn btn_guardar">Guardar</button>

                                    <?php } ?>
                                    <!-- <button style="margin: 15px; box-shadow: 5px 5px 10px black;" type="submit" name="accion" value="Consultar" class="btn btn_guardar">Consultar</button> -->

                                    <!-- <a href="#" style="box-shadow: 5px 5px 10px black;" class="btn btn_cancelar">cancelar</a> -->
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