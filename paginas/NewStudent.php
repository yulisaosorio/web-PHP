<?php
require_once '../control/AlumnoController.php';
require_once '../control/EstadoController.php';
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
       

    
    </head>
    <body>
        <div class="content" style = "width: 600px; margin: auto;">
            <form action="" method="POST" enctype="multipart/form-data" form class="row g-3">
                


                <h3>Nuevo Alumno</h3>
                
                <?php if ($consultado == true) { ?>
                    <div class= col-md-12>
                    <label for="id_alumno">ID</label>
                    <input type="number" readonly class="form-control" id="id_alumno" name="id_alumno" value="<?php echo $id_alumno ?>">
                </div>
                <?php } ?>

                <div class= col-md-12>
                    <label for="identificacion">Identificación</label>
                    <input type="number" class="form-control" id="identificacion" name="identificacion" value="<?php echo $identificacion ?>">
                </div>
                
                
                <div class="col-md-3" style="padding-top: 5px" >
                    <label for="nombre_1">Primer Nombre</label>
                    <input type="text" class="form-control" id="nombre_1" name="nombre_1" value="<?php echo $nombre_1 ?>">
                </div>
                
                

                <div class="col-md-3" style="padding-top: 5px"  >
                    <label for="nombre_2">Segundo Nombre</label>
                    <input type="text" class="form-control" id="nombre_2" name="nombre_2" value="<?php echo $nombre_2 ?>">
                </div>
                <div class="col-md-3" style="padding-top: 5px"  >
                    <label for="apellido_1">Primer Apellido</label>
                    <input type="text"  class="form-control" id="apellido_1" name="apellido_1"value="<?php echo $apellido_1 ?>">
                </div>
               <div class="col-md-3" style="padding-top: 5px"  >
                    <label for="apellido_2">Segundo Apellido</label>
                    <input type="text" class="form-control" id="apellido_2" name="apellido_2"value="<?php echo $apellido_2 ?>">
                </div>
                <div class= "col-md-6" style="padding-top: 5px" >
                    <label for="fecha_nac">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nac" name="fecha_nac"value="<?php echo $fecha_nac ?>">
                </div>
                <div class= "col-md-6" style="padding-top: 5px" >
                    <label for="edad">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad"value="<?php echo $edad ?>">
                </div>
                
                <div class="col-md-6" style="padding-top: 5px">
                    <label for="id_padre">Nombre del Padre</label>
                    <select name="id_padre" id="id_padre" class="form-control">
                      
                        <?php
                        foreach ($padre as $objPadre) {
                            if ($objPadre->getId_padre() != 0)
                                
                                ?>

                            <option <?php if ($id_padre == $objPadre->getId_padre()) echo " selected"; ?> value="<?php echo $objPadre->getId_padre(); ?>"><?php echo $objPadre->getNombre_completo(); ?>  </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                
                <div class="col-md-6" style="padding-top: 5px">
                    <label for="id_madre">Nombre de la Madre</label>
                    <select name="id_madre" id="id_madre" class="form-control">
                        
                        <?php
                        foreach ($madre as $objMadre) {
                            if ($objMadre->getId_madre() != 0)
                                
                                ?>

                            <option <?php if ($id_madre == $objMadre->getId_madre()) echo " selected"; ?> value="<?php echo $objMadre->getId_madre(); ?>"><?php echo $objMadre->getNombre_completo(); ?>  </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                
                
                 <div class="col-md-6" style="padding-top: 5px"  >
                    <label for="estados">Estado</label>
                    <select name="estados" id="estados" class="form-control">
                        <option value="1">Seleccione...</option>
                        <?php
                        foreach ($estado as $objEstado) {
                            if ($objEstado->getId_estado() != 1)
                                
                                ?>

                            <option <?php if ($id_estado == $objEstado->getId_estado()) echo " selected"; ?> value="<?php echo $objEstado->getId_estado(); ?>"><?php echo $objEstado->getNombre(); ?>  </option>
                            <?php
                        }
                        ?>


                    </select>

                </div>
                
                 <div class="col-md-6" style="padding-top: 5px">
                    <label for="id_ficha_grupo">Grupo</label>
                    <select name="id_ficha_grupo" id="id_ficha_grupo" class="form-control">
                        <option value="1">Seleccione...</option>
                        <?php
                        foreach ($ficha_grupo as $objFicha_grupo) {
                            if ($objFicha_grupo->getId_ficha_grupo() != 1)
                                
                                ?>

                            <option <?php if ($id_ficha_grupo == $objFicha_grupo->getId_ficha_grupo()) echo " selected"; ?> value="<?php echo $objFicha_grupo->getId_ficha_grupo(); ?>"><?php echo $objFicha_grupo->getNombre_grupo(); ?>  </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                
             
                 <div class="col-md-12" style="padding-top: 5px"  >
                    <label for="foto">Foto</label>
                    <input type="file" accept="image/*" class="form-control" id="foto" name="foto">
                </div>
                
                

                
                <?php if ($consultado == true) { ?>
                    <div class="col-md-12" style="padding-top: 5px"  >

                        <img  class="img-thumbnail"  src="../fotosAlum/<?php echo $nombreArchivo ?> " width="200px" />

                    </div>
                    <button style="margin: 15px "type="submit" name ="accion" value="Modificar" class="btn btn-info">Modificar</button>
                    <button style="margin: 15px "type="submit" name ="accion" value="Eliminar" class="btn btn-danger">Eliminar</button>
                <?php } ?>

                <?php if ($consultado != true) { ?>
                    <button style="margin: 15px " type="submit" name ="accion" value="Guardar" class="btn btn-primary">Guardar</button>

                <?php } ?>
                <button  style="margin: 15px "type="submit" name ="accion" value="Consultar" class="btn btn-primary">Consultar</button>


                
                

            </form>

            <?php echo @$mensaje; ?>

            
            

        </div>
        
        <div class="content"  style = "width: 80%;  margin: auto;">
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Identificación</th>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Nombre del Padre</th>
                        <th scope="col">Nombre de la Madre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Accion</th>
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
                                <td><?php echo $fila->id_alumno; ?>  </td>  
                                <td><?php echo $fila->identificacion; ?></td>  
                                <td><?php echo $fila->nombre_1 ,' ', $fila->nombre_2,' ', $fila->apellido_1,' ', $fila->apellido_2; ?></td>
                                <td><?php echo $fila->fecha_nac; ?></td>
                                <td><?php echo $fila->edad; ?></td>
                                <td><?php echo $fila->id_padre; ?></td>
                                <td><?php echo $fila->id_madre; ?></td>
                                <td><?php echo $fila->estado; ?></td>
                                <td><?php echo $fila->id_ficha_grupo; ?></td>
                                <td> <img src="../fotosAlum/<?php echo $fila->foto; ?> " width="50px"  height="50px"/> </td> 
                                <td><a href="#">Crear</a> </td>
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