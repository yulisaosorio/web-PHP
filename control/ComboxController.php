<?php
require_once '../modelo/Combox.php';
require_once '../cad/ComboxCAD.php'; 



$objCAD = new ComboxCAD();
$ficha_grupo = $objCAD->listarFicha_grupo();
$padre = $objCAD->listarPadre();
$madre = $objCAD->listarMadre();
$alumno = $objCAD->listarEstudiante();
$instructor = $objCAD->listarInstructor();
$materia = $objCAD->listarMaterias();
$jornada = $objCAD->listarJornadas();