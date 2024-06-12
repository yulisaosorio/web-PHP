<?php
require_once '../control/AlumnoController.php';
require_once '../control/EstadoController.php';
require_once '../control/ComboxController.php';

// var_dump($_POST);
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
    <link rel="stylesheet" href="../css/alumno.css">
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
                    <div class="left">
                        <div class="img_foto">
                            <?php if ($consultado == true) { ?>
                                <img class="img-thumbnail" src="../fotosAlum/<?php echo $nombreArchivo ?> " width="150" />
                                <input type="file" accept="image/*" class="foto" id="foto" name="foto">
                            <?php } else { ?>
                                <img src="../img/sinFoto_Alumnos.jpg" alt="">
                                <input type="file" accept="image/*" class="foto" id="foto" name="foto">
                            <?php }  ?>
                            <!-- <input type="file" src="img/foto_perfil.jpg" class="foto" name="foto" id="" value=""> -->
                            <!-- <input type="file" accept="image/*" class="foto" id="foto" name="foto"> -->
                        </div>

                        <div class="datos_contacto pb">
                            <div class="titulo">
                                Datos
                            </div>

                            <div class="contacto">
                                <ul>
                                    <li style="display: none;">

                                        <div class="datos_li">
                                            <input type="number" readonly class="input_contact" id="id_alumno" name="id_alumno" value="<?php echo $id_alumno ?>">
                                        </div>

                                    </li>

                                    <li>
                                        <div class="datos_li">
                                            <span class="iconDatos cedula"><i class="fas fa-id-card"></i></span>
                                            <span class="contact_input"><?php echo $identificacion ?></span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="datos_li">
                                            <span class="iconDatos nombre"><i class="fas fa-user"></i></span>
                                            <span class="contact_input"><?php echo $nombre_1 . ' ' . $nombre_2 . ' ' . $apellido_1 . ' ' . $apellido_2 ?></span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="datos_li">

                                            <span class="iconDatos fecha_naci"><i class="fas fa-calendar-alt"></i></span>
                                            <span class="contact_input"><?php echo $fecha_nac ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>


                    <div class="right">

                        <div class="header">
                            <div class="name_role">
                                <div class="name">
                                    informacion de alumno
                                </div>
                                <hr>
                            </div>

                            <div class="mensaje">
                                <?php echo @$mensaje; ?>
                            </div>

                            <div class="boton">
                                <?php if ($consultado == true) { ?>
                                    <button type="submit" name="accion" value="Modificar" class="btn btn_guardar">Modificar</button>
                                    <button type="submit" name="accion" value="Eliminar" class="btn btn_guardar">Eliminar</button>
                                <?php } ?>

                                <?php if ($consultado != true) { ?>
                                    <button type="submit" name="accion" value="Guardar" class="btn btn_guardar">Guardar</button>
                                    <button type="submit" name="accion" value="Consultar" class="btn btn_guardar">Consultar</button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="right_inner">

                            <div class="titulo">
                                informacion de padres
                            </div>

                            <div class="campos_contactos">
                                <div class="datos_li">
                                    <div class="icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <!-- <input type="text" class="input_contact right" placeholder="Id padre"> -->

                                    <select disabled name="id_padre" id="id_padre" class="selecionar">
                                        <option value="1">Seleccione un padre</option>
                                        <?php foreach ($padre as $objPadre) {
                                            if ($objPadre->getId_padre() != 0) ?>
                                            <option <?php if ($id_padre == $objPadre->getId_padre()) echo " selected"; ?> value="<?php echo $objPadre->getId_padre(); ?>"><?php echo $objPadre->getNombre_completo(); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="datos_li">
                                    <div class="icon">
                                        <i class="fas fa-female"></i>
                                    </div>
                                    <!-- <input type="text" class="input_contact right" placeholder="id madre "> -->
                                    <select disabled name="id_madre" id="id_madre" class="selecionar">
                                        <option value="1">Seleccione madre</option>
                                        <?php
                                        foreach ($madre as $objMadre) {
                                            if ($objMadre->getId_madre() != 0)
                                        ?>
                                            <option <?php if ($id_madre == $objMadre->getId_madre()) echo " selected"; ?> value="<?php echo $objMadre->getId_madre(); ?>"><?php echo $objMadre->getNombre_completo(); ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="titulo">
                                administrativo
                            </div>

                            <div class="campos_contactos">
                                <div class="datos_li">
                                    <div class="icon">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <!-- <input type="password" class="input_contact  right" placeholder="ficha grupo"> -->

                                    <select disabled name="id_ficha_grupo" id="id_ficha_grupo" class="selecionar">
                                        <option value="1">Seleccione...</option>
                                        <?php
                                        foreach ($ficha_grupo as $objFicha_grupo) {
                                            if ($objFicha_grupo->getId_ficha_grupo() != 1)

                                        ?>

                                            <option <?php if ($id_ficha_grupo == $objFicha_grupo->getId_ficha_grupo()) echo " selected"; ?> value="<?php echo $objFicha_grupo->getId_ficha_grupo(); ?>"><?php echo $objFicha_grupo->getNombre_grupo(); ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="datos_li">
                                    <div class="icon">
                                        <i class="fas fa-user-cog"></i>
                                    </div>
                                    <select disabled name="estados" id="estados" class="selecionar">
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