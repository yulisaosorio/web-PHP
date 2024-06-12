<?php
require_once '../modelo/Rol.php';
require_once '../cad/RolCAD.php'; 


$objCAD = new RolCAD();
$rolUser = $objCAD->listar();


