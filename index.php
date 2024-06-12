<?php
require_once 'control/Loguear_CTRL.php';

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <link rel="shortcut icon" href="img/ydjk.png" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <title>YDJK</title>
</head>

<body>
    <div class="login">
        <div class="logo_login">
            <img class="imagen" src="img/ydjk.png" alt="logo">
        </div>

        <form class="formulario" method="POST" action="">
            <div class="sesion">
                <span>Administrador educativo</span>
            </div>

            <div class="datos">
                <div class="datos_ingresar">
                    <span class="icon_login"><i class="far fa-envelope"></i></span>
                    <input type="email" name="correo" class="datos_input" placeholder="EJ:usuario@gmail.com">
                </div>
                <div class="datos_ingresar">
                    <span class="icon_login"><i class="fas fa-lock"></i></span>
                    <input type="password" name="clave" class="datos_input" placeholder="Clave">
                </div>
                <br>
                <div class="sesion">
                    <h6> <?php echo @$mensaje; ?> </h>
                </div>


                <div class="btn_iniciarS">
                    <button type="submit" name="accion" value="Ingresar" class="bnt_ingresar">Ingresar</button>
                </div>

            </div>
        </form>

        <div class="comunicado">
            <span>¿Olvidó su contraseña?</span> <br>
            <span>por favor comuniquese con su administrador</span>
        </div>


    </div>




</body>

</html>